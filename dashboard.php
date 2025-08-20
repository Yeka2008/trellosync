<?php
// This file is part of Moodle - https://moodle.org/.
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Main page of the trellosync plugin.
 *
 * @package    local_trellosync
 * @copyright  2025 Nubia Culma
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require('../../config.php');

require_once(__DIR__.'/classes/form/createtask_form.php');

$courseid = required_param('id', PARAM_INT);
require_login($courseid);


$context = context_course::instance($courseid);
require_capability('moodle/course:update', $context);

$PAGE->set_url(new moodle_url('/local/trellosync/dashboard.php', ['id' => $courseid]));
$PAGE->set_context($context);
$PAGE->set_title('Proyecto Trello');
$PAGE->requires->jquery();
$PAGE->set_heading('Proyecto Trello');
$PAGE->requires->js_call_amd('local_trellosync/main', 'init');
$PAGE->set_pagelayout('admin');

$config = $DB->get_record('local_trellosync', ['courseid' => $courseid]);

echo $OUTPUT->header();
echo $OUTPUT->heading('Proyecto Trello');

if (isset($config->token) && !empty($config->token)) {

    $trello = new \local_trellosync\service\trello_client();

    $lists = $trello->get_lists($config->boardid);

    $listoptions = [];

    foreach ($lists as $list) {
        $listoptions[$list->id] = $list->name;
    }

    $mform = new \local_trellosync\form\createtask_form();

    if ($mform->is_cancelled()) {
        redirect(new moodle_url('/course/view.php', ['id' => $courseid]));
    } else if ($data = $mform->get_data()) {

        $selectedlist = $data->listsid ?? '';
        $listid = !empty($selectedlist) ? $selectedlist : ($lists[0]->id ?? null);

        if ($listid) {
            $trello->create_card(
                $listid,
                $data->title_task,
                $data->description,

            );

        }
        redirect(new moodle_url('/local/trellosync/dashboard.php', ['id' => $courseid]));
    }

    $mform->set_data(['id' => $courseid]);
    $mform->display();

    echo html_writer::start_div('d-flex flex-row overflow-auto');

    foreach ($lists as $list) {
        $cards = $trello->get_cards($list->id);

        $carddata = [];

        foreach ($cards as $card) {
            $carddata[] = [
                'name' => $card->name,
                'desc' => $card->desc,
                'url'  => $card->shortUrl ?? null,
                'cardid' => $card->id,
                'courseid' => $courseid,
                'sesskey' => sesskey(),
            ];

        }

        $listcontext = [
            'listname' => $list->name,
            'cards'    => $carddata,
            'courseid' => $courseid,
            'sesskey' => sesskey(),
        ];

        echo $OUTPUT->render_from_template('local_trellosync/lists', $listcontext);
    }

    echo html_writer::end_div();
} else {
    echo $OUTPUT->notification('Trello no está configurado para este curso.', 'notifyproblem');
}
echo $OUTPUT->footer();
