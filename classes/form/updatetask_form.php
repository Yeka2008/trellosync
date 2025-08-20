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
 * form for update task
 *
 * @package    local_trellosync
 * @copyright  2025 nubia.culma@openlms.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace local_trellosync\form;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir.'/formslib.php');

/**
 *  * Moodle form to update a Trello card.
 *
 * Defines the form fields and validation rules used for updating
 * an existing Trello card from within Moodle.
 */
class updatetask_form extends \moodleform {
    /**
     * * Moodle form to update a Trello card
     *
     * This class defines the fields of the form and the credentials used to update an existing card..
     *
     * @return void
     */
    public function definition() {

        $mform = $this->_form;
        $customdata = $this->_customdata;

        $courseid = $customdata['courseid'];
        $cardid = $customdata['cardid'];
        $listoptions = $customdata['lists'];

        $mform->addElement('hidden', 'id', $courseid);
        $mform->setType('id', PARAM_INT);
        $mform->addElement('hidden', 'cardid', $cardid);
        $mform->setType('cardid', PARAM_TEXT);
        $mform->addElement('text', 'title_task', get_string('title_task', 'local_trellosync'));
        $mform->setType('title_task', PARAM_TEXT);
        $mform->addRule('title_task', null, 'required');
        $mform->addElement('textarea', 'description', get_string('description', 'local_trellosync'));
        $mform->setType('description', PARAM_TEXT);
        $mform->addRule('description', null, 'required');
        $mform->addElement('select', 'listsid', get_string('selec_list', 'local_trellosync'), $listoptions);
        $mform->setType('listsid', PARAM_TEXT);
        $mform->addRule('listsid', null, 'required');

        $this->add_action_buttons(true, get_string('update_task', 'local_trellosync'));

    }
}

