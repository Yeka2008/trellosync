<?php
// This file is part of Moodle - http://moodle.org/
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
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Integration with Trello
 *
 * Form for integration data with Trello
 * @package    local_trellosync
 * @copyright  2025 Nubia Culma (nubia.culma@openlms.net)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace local_trellosync\form;
defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir.'/formslib.php');
/**
 * Clase trellosync para recoger las credenciales de Trello.
 *
 * @package    local_trellosync
 * @category   form
 */
class trellosync_form extends \moodleform {
    /**
     * obtiene las credenciales de Trello.
     *
     * @param string $boardid ID del tablero.
     * @param string $token de Trello.
     * @param string $apikey de Trello.
     *
     */
    public function definition() {

        $mform = $this->_form;

        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);
        $mform->addElement('text', 'apikey', get_string('apikey', 'local_trellosync'));
        $mform->setType('apikey', PARAM_TEXT);
        $mform->addRule('apikey', null, 'required');
        $mform->addElement('text', 'token', get_string('token', 'local_trellosync'));
        $mform->setType('token', PARAM_TEXT);
        $mform->addRule('token', null, 'required');
        $mform->addElement('text', 'boardid', get_string('boardid', 'local_trellosync'));
        $mform->setType('boardid', PARAM_TEXT);
        $mform->addRule('boardid', null, 'required');

        $this->add_action_buttons();

    }
}
