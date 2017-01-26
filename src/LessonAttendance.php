<?php namespace Wonde;

use Wonde\Exceptions\InvalidLessonAttendanceException;

class LessonAttendance
{
    /**
     * @var string
     */
    public $student_id;

    /**
     * @var string
     */
    public $lesson_id;

    /**
     * @var string
     */
    public $attendance_code_id;

    /**
     * Set student id
     *
     * @param string $date
     * @return void
     * @throws InvalidLessonAttendanceException
     */
    public function setStudentId($studentId)
    {
        if(empty($studentId)){
            throw new InvalidLessonAttendanceException('Student id can not be set to null.');
        }

        $this->student_id = $studentId;
    }

    /**
     * Set lesson_id
     *
     * @param string $lessonId
     * @return void
     * @throws InvalidLessonAttendanceException
     */
    public function setLessonId($lessonId)
    {
        if(empty($lessonId)){
            throw new InvalidLessonAttendanceException('Lesson id can not be set to null.');
        }

        $this->lesson_id = $lessonId;
    }

    /**
     * Set attendance code id
     *
     * @param string $attendanceCodeId
     * @return void
     * @throws InvalidLessonAttendanceException
     */
    public function setAttendanceCodeId($attendanceCodeId)
    {
        if(empty($attendanceCodeId)){
            throw new InvalidLessonAttendanceException('Attendance code id can not be set to null.');
        }

        $this->attendance_code_id = $attendanceCodeId;
    }

}