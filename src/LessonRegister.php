<?php namespace Wonde;

use Wonde\Exceptions\InvalidLessonAttendanceException;

class LessonRegister
{
    /**
     * @var array
     */
    public $lessonAttendance;

    /**
     * Register constructor.
     */
    public function __construct()
    {
        $this->lessonAttendance = [];
    }

    /**
     * Add attendance
     * @param LessonAttendance|array $lessonAttendance
     * @return void
     * @throws InvalidLessonAttendanceException
     */
    public function add($lessonAttendance)
    {
        $lessonAttendance = is_array($lessonAttendance) ? $lessonAttendance : [$lessonAttendance];

        foreach ($lessonAttendance as $lessonAttendanceSingular){
            if(empty($lessonAttendanceSingular->student_id) || empty($lessonAttendanceSingular->lesson_id) || empty($lessonAttendanceSingular->attendance_code_id))
            {
                throw new InvalidLessonAttendanceException('Lesson Attendance is not complete.');
            } else {
                $this->lessonAttendance[] = $lessonAttendanceSingular;
            }
        }
    }
}