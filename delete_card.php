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
 * page delete card.
 *
 * @package    local_trellosync
 * @copyright  2025 Nubia Culma
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();
require('../../config.php');

require_once(__DIR__.'/classes/service/trello_client.php');

$courseid = required_param('id', PARAM_INT);
$cardid = required_param('cardid', PARAM_TEXT);
$confirm = optional_param('confirm', false, PARAM_TEXT);
$cancel = optional_param('cancel', false, PARAM_TEXT);

require_login($courseid);

$context = context_course::instance($courseid);
require_capability('moodle/course:update', $context);

$PAGE->set_url(new moodle_url('/local/trellosync/delete_card.php', ['id' => $courseid, 'cardid' => $cardid]));
$PAGE->set_context($context);
$PAGE->set_title(' Delete Card');
$PAGE->set_heading('comfirm delete of Card');
$PAGE->set_pagelayout('admin');


if ($cancel) {
    require_sesskey();
    redirect(new moodle_url('/local/trellosync/dashboard.php', ['id' => $courseid]),
    get_string('carddeletedfail', 'local_trellosync'), null);
}
if ($confirm) {
    require_sesskey();
    $config = $DB->get_record('local_trellosync', ['courseid' => $courseid]);
    $trello = new \local_trellosync\service\trello_client($config);

    $result = $trello->delete_card($cardid);

    if ($result) {
        redirect(new moodle_url('/local/trellosync/dashboard.php', ['id' => $courseid]),
        get_string('carddeletedsuccess', 'local_trellosync'));
    } else {
        redirect(new moodle_url('/local/trellosync/dashboard.php', ['id' => $courseid]),
        get_string('carddeletedfail', 'local_trellosync'), null);
    }
}

 echo $OUTPUT->header();

    $yesurl = new moodle_url('/local/trellosync/delete_card.php', [
        'id' => $courseid,
        'cardid' => $cardid,
        'confirm' => 1,
        'sesskey' => sesskey(),
    ]);

    $nourl = new moodle_url('/local/trellosync/delete_card.php', [

        'id' => $courseid,
        'cardid' => $cardid,
        'cancel' => 1,
        'sesskey' => sesskey(),
    ]);

    $templatecontext = [
        'question' => get_string('confirmdeletecard', 'local_trellosync'),
        'yesurl' => $yesurl->out(false),
        'nourl' => $nourl->out(false),
        ];

    echo $OUTPUT->render_from_template('local_trellosync/confirm', $templatecontext);

    echo $OUTPUT->footer();
