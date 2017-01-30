<?php namespace Wonde\Writeback;

use Wonde\Exceptions\InvalidLessonAttendanceException;
use Wonde\Writeback\LessonAttendanceRecord;

class LessonRegister
{
    /**
     * @var array
     */
    public $attendance;

    /**
     * Register constructor.
     */
    public function __construct()
    {
        $this->attendance = [];
    }

    /**
     * Add attendance
     * @param LessonAttendanceRecord|array $lessonAttendance
     * @return void
     * @throws InvalidLessonAttendanceException
     */
    public function add($lessonAttendance)
    {
        $lessonAttendance = is_array($lessonAttendance) ? $lessonAttendance : [$lessonAttendance];

        foreach ($lessonAttendance as $lessonAttendanceSingular) {

            if ($lessonAttendanceSingular instanceof LessonAttendanceRecord && $lessonAttendanceSingular->isValid()) {
                $this->attendance[] = $lessonAttendanceSingular->toArray();
            } else {
                if ( ! $lessonAttendanceSingular instanceof LessonAttendanceRecord) {
                    throw new InvalidLessonAttendanceException('Attendance is not an instance of the LessonAttendance Class.');
                }

                if ( ! $lessonAttendanceSingular->isValid()) {
                    throw new InvalidLessonAttendanceException('Attendance has empty fields.');
                }
            }
        }
    }
}