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
 * Trellosync plugin settings page.
 *
 * @package    local_trellosync
 * @copyright  2025 Nubia Culma
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require('../../config.php');

$courseid = required_param('id', PARAM_INT);
require_login($courseid);

$context = context_course::instance($courseid);
require_capability('moodle/course:update', $context);

    // Configura la página.
$PAGE->set_url(new moodle_url('/local/trellosync/trellosync_config.php', ['id' => $courseid]));
$PAGE->set_context($context);
$PAGE->set_title('Configuración de Trello');
$PAGE->set_heading('Configuración de Trello');
$PAGE->set_pagelayout('admin');

    // Instancia y muestra el formulario.
$mform = new \local_trellosync\form\trellosync_form();

if ($mform->is_cancelled()) {
    redirect(new moodle_url('/course/view.php', ['id' => $courseid]));
} else if ($data = $mform->get_data()) {
    global $DB;

    $record = new stdClass();
    $record->courseid = $courseid;
    $record->apikey = $data->apikey;
    $record->token = $data->token;
    $record->boardid = $data->boardid;
    $record->timemodified = time();

    $existing = $DB->get_record('local_trellosync', ['courseid' => $courseid]);

    if ($existing) {
        $record->id = $existing->id;
        $record->timecreated = $existing->timecreated;
        $DB->update_record('local_trellosync', $record);
    } else {
        $record->timecreated = time();
        $DB->insert_record('local_trellosync', $record);
    }

    redirect(new moodle_url('/course/view.php', ['id' => $courseid]), '¡Configuración guardada!');
}

    // Precargar datos si existen.
if ($existing = $DB->get_record('local_trellosync', ['courseid' => $courseid])) {
    $mform->set_data($existing);
} else {
    $mform->set_data(['id' => $courseid]);
}

echo $OUTPUT->header();
echo $OUTPUT->heading('Conectar este curso con Trello');
$mform->display();
echo $OUTPUT->footer();
