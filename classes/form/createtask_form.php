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
 * form for create new task.
 *
 * @package    local_trellosync
 * @category   form
 * @copyright  2025 Nubia Culma (nubia.culma@openlms.net)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace local_trellosync\form;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir.'/formslib.php');
require_once($CFG->dirroot.'/local/trellosync/classes/form/createtask_form.php');
   /**
    * Define los elementos del formulario.
    *
    * Recupera las listas de Trello configuradas para el curso
    * y añade campos para el título, la descripción y la lista de destino.
    *
    * @return void
    */
class createtask_form extends \moodleform {

    /**
     * Define los elementos del formulario.
     *
     * Recupera el ID del curso, obtiene la configuración de Trello y
     * muestra los campos necesarios para crear la tarjeta.
     *
     * @return void
     */
    public function definition() {
        global $DB;
        $courseid = required_param('id', PARAM_INT);
        $config = $DB->get_record('local_trellosync', ['courseid' => $courseid]);
        $mform = $this->_form;
        $trello = new \local_trellosync\service\trello_client();
        $lists = $trello->get_lists($config->boardid, $config->apikey, $config->token);

        foreach ($lists as $list) {
            $listoptions[$list->id] = $list->name;
        }
        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);
        $mform->addElement('text', 'title_task', get_string('title_task', 'local_trellosync'));
        $mform->setType('title_task', PARAM_TEXT);
        $mform->addRule('title_task', null, 'required');
        $mform->addElement('textarea', 'description', get_string('description', 'local_trellosync'));
        $mform->setType('description', PARAM_TEXT);
        $mform->addRule('description', null, 'required');
        $mform->addElement('select', 'listsid', get_string('selec_list', 'local_trellosync'), $listoptions);
        $mform->setType('listsid', PARAM_TEXT);
        $mform->addRule('listsid', null, 'required');

        $this->add_action_buttons(true, get_string('create_task', 'local_trellosync'));

    }
}

