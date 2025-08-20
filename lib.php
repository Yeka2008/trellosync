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
 * lib file for the plugin Trello Sync
 *
 * @package    local_trellosync
 * @copyright  2025 Nubia Culma (nubia.culma@openlms.net)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
 /**
  * Locate the trellosync and project trello links in the menu.
  *
  */
function local_trellosync_extend_navigation_course($navigation, $course, $context) {
    global $PAGE;

        $navigation->add(
            get_string('pluginname', 'local_trellosync'),
            new moodle_url('/local/trellosync/trellosync_config.php', ['id' => $course->id]),
            navigation_node::TYPE_SETTING
        );
        $navigation->add(
            get_string('projecttrello', 'local_trellosync'),
            new moodle_url('/local/trellosync/dashboard.php', ['id' => $course->id]),
            navigation_node::TYPE_SETTING
        );
}
