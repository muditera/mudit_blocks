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
 * This file contains the Course modules block.
 *
 * @package    block_course_modules
 * @copyright  Mudit S <sharma.mudit811@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

 defined('MOODLE_INTERNAL') || die();

 require_once($CFG->dirroot . '/blocks/course_modules/lib.php');

class block_course_modules extends block_list {

    public function init() {
        $this->title = get_string('pluginname', 'block_course_modules');
    }

    public function get_content() {
        if ($this->content !== null) {
            return $this->content;
        }
        $this->content = (object) [
            'items'  => [],
            'icons'  => [],
        ];

        $modinfo = get_fast_modinfo($this->page->course); // Getting all the information of course module.

        foreach ($modinfo->cms as $coursemodule) {
            $this->content->items[] = html_writer::link($coursemodule->url, get_module_data($coursemodule));
        }
        return $this->content;
    }

    public function applicable_formats() {
        return [
            'course-view' => true, // To show the block in course view page only.
        ];
    }
}
