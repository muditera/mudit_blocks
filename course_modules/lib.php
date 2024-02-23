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
 * Returns completion status functions
 *
 * @package    block_course_modules
 * @copyright  Mudit S <sharma.mudit811@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

 // Return completion string according to completion status.
function get_completion_status($completionvalue) {

    switch ($completionvalue) {
        case 0:
            return get_string('notcompleted', 'block_course_modules');
        case 1:
            return get_string('completed', 'block_course_modules');
        case 2:
            return get_string('passwithgrade', 'block_course_modules');
        case 3:
            return get_string('failwithgrade', 'block_course_modules');
        default:
            return get_string('unknowncompletion', 'block_course_modules');
    }
}

// Return completion status from course_modules_completion table.
function fetch_completion_status($cmid) {

    global $DB, $USER;

    $completion = $DB->get_record('course_modules_completion', ['coursemoduleid' => $cmid, 'userid' => $USER->id]);
    if (!$completion) {
        return;
    }
    return $completion->completionstate;

}

function get_module_data($coursemodule) {

    $completionstatus = fetch_completion_status($coursemodule->id); // Fetching completion status.
    $urltext = $coursemodule->id . ' - ' . $coursemodule->name . ' - ' .
        userdate($coursemodule->added, get_string('strftimedate', 'langconfig'))
        . ' - ' . get_completion_status($completionstatus);

    return $urltext;

}
