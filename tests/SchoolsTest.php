<?php

class SchoolsTest extends PHPUnit_Framework_TestCase
{
    public function test_get_all_schools()
    {
        $client = new \Wonde\Client('66e7882ac0477e369cf8e660883800c1e4e90ac3');

        // Loop through the schools you have access to
        foreach ($client->schools->all() as $resultSchool) {

            // Display school name
            echo $resultSchool->name . PHP_EOL;

            // Setup school
            $school = $client->school('A1329183376');

            // Get attendance
            foreach ($school->attendance->all() as $attendance) {
                echo $attendance->comment . PHP_EOL;
            }

            // Get attendance codes
            foreach ($client->attendanceCodes->all() as $attendanceCode) {
                echo $attendanceCode->code . PHP_EOL;
            }

            // Get achievements
            foreach ($school->achievements->all() as $achievement) {
                echo $achievement->type . PHP_EOL;
            }

            // Get behaviours
            foreach ($school->behaviours->all() as $behaviour) {
                echo $behaviour->incident . PHP_EOL;
            }

            // Get classes
            foreach ($school->classes->all() as $class) {
                echo $class->name . PHP_EOL;
            }

            // Get groups
            foreach ($school->groups->all() as $group) {
                echo $group->name . PHP_EOL;
            }

            // Get lessons
            foreach ($school->lessons->all() as $lesson) {
                echo $lesson->period_id . '-' . $lesson->class_id . PHP_EOL;
            }

            // Get lesson attendance
            foreach ($school->lessonAttendance->all() as $lessonAttendance) {
                echo $lessonAttendance->comment . PHP_EOL;
            }

            // Get medical conditions
            foreach ($school->medicalConditions->all() as $medicalCondition) {
                echo $medicalCondition->description . PHP_EOL;
            }

            // Get medical events
            foreach ($school->medicalEvents->all() as $medicalEvent) {
                echo $medicalEvent->description . PHP_EOL;
            }

            // Get periods
            foreach ($school->periods->all() as $period) {
                echo $period->name . PHP_EOL;
            }

            // Get periods
            foreach ($school->photos->all() as $photo) {
                echo $photo->hash . PHP_EOL;
            }

            // Get rooms
            foreach ($school->rooms->all() as $room) {
                echo $room->name . PHP_EOL;
            }

            // Get subjects
            foreach ($school->subjects->all() as $subject) {
                echo $subject->name . PHP_EOL;
            }


            // Example - Get all students for a school
            foreach ($client->school($school->id)->students->all() as $students) {
                echo $students->forename . ' ' . $students->surname . PHP_EOL;
            }

            // Example - Get all employees for a school
            foreach ($client->school($school->id)->employees->all() as $employee) {
                echo $employee->forename . ' ' . $employee->surname . PHP_EOL;
            }

            // Example - Get employees with their contact details object
            foreach ($school->employees->all(['contact_details']) as $employee) {
                echo $employee->forename . ' ' . $employee->surname . PHP_EOL;
            }

            // Example - Get students updated after a date with included data sets (contact_details, extended_details)
            foreach (
                $school->students->all([
                    'contact_details',
                    'extended_details'
                ], ['updated_after' => '2016-06-24 00:00:00']) as $students
            ) {
                echo $students->forename . ' ' . $students->surname . PHP_EOL;
            }
        }
    }
}