<?php
// This file is part of Moodle - https://moodle.org/
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
 * Plugin trello sync.
 *
 * @package     local_trellosync
 * @copyright   OpenLMS 2025 <nubia.tique@openlms.net>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define('AJAX_SCRIPT', true);

require_once('../../config.php');

require_login();
require_sesskey();
$action = required_param('action', PARAM_TEXT);

if ($action == 'deletetask') {
    global $DB;
    $cardid = required_param('cardid', PARAM_ALPHANUMEXT);
    $courseid = required_param('courseid', PARAM_INT);
    $trello = new \local_trellosync\service\trello_client();

    try {
        $trello->delete_card($cardid);
        echo json_encode(['message' => 'tarjeta eliminada exitosamente']);
    } catch (moodle_exception $e) {
        echo json_encode(['message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['message' => 'Accion no encontrada']);
}


