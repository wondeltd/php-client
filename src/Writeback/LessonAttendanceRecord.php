<?php namespace Wonde\Writeback;

use Wonde\Exceptions\InvalidLessonAttendanceException;

class LessonAttendanceRecord
{
    /**
     * @var string
     */
    private $student_id;

    /**
     * @var string
     */
    private $lesson_id;

    /**
     * @var string
     */
    private $attendance_code_id;

    /**
     * Set student id
     *
     * @param string $date
     * @return void
     * @throws InvalidLessonAttendanceException
     */
    public function setStudentId($studentId)
    {
        if (empty($studentId)) {
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
        if (empty($lessonId)) {
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
        if (empty($attendanceCodeId)) {
            throw new InvalidLessonAttendanceException('Attendance code id can not be set to null.');
        }

        $this->attendance_code_id = $attendanceCodeId;
    }

    /**
     * Check that all required attributes are set
     *
     * @return bool
     */
    public function isValid()
    {
        return ! (empty($this->student_id) || empty($this->lesson_id) || empty($this->attendance_code_id));
    }

    /**
     * @return string
     */
    public function getStudentId()
    {
        return $this->student_id;
    }

    /**
     * @return string
     */
    public function getLessonId()
    {
        return $this->lesson_id;
    }

    /**
     * @return string
     */
    public function getAttendanceCodeId()
    {
        return $this->attendance_code_id;
    }

    /**
     * Return object as array
     *
     * @return array
     */
    public function toArray()
    {
        $required = [
            'lesson_id'          => $this->getLessonId(),
            'student_id'         => $this->getStudentId(),
            'attendance_code_id' => $this->getAttendanceCodeId()
        ];

        return $required;
    }

}