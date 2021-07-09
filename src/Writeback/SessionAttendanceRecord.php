<?php namespace Wonde\Writeback;

use Wonde\Exceptions\InvalidAttendanceException;
use Wonde\Exceptions\InvalidInputException;
use Wonde\Exceptions\InvalidSessionException;

class SessionAttendanceRecord
{
    /**
     * @var string
     */
    private $student_id;

    /**
     * @var string
     */
    private $employee_id;

    /**
     * @var string
     */
    private $date;

    /**
     * @var string
     */
    private $session;

    /**
     * @var string
     */
    private $attendance_code_id;

    /**
     * @var string
     */
    private $comment;

    /**
     * @var int
     */
    private $minutesLate;

    /**
     * Set student id
     *
     * @param string $student_id
     * @return void
     * @throws InvalidAttendanceException
     */
    public function setStudentId($studentId)
    {
        if (empty($studentId)) {
            throw new InvalidAttendanceException('Student id can not be set to null.');
        }

        $this->student_id = $studentId;
    }

        /**
     * Set employee id
     *
     * @param string $employee_id
     * @return void
     * @throws InvalidAttendanceException
     */
    public function setEmployeeId($employee_id)
    {
        $this->employee_id = $employee_id;
    }

    /**
     * Set date
     *
     * @param string $date
     * @return void
     * @throws InvalidAttendanceException
     */
    public function setDate($date)
    {
        if (empty($date)) {
            throw new InvalidAttendanceException('Date can not be set to null.');
        }

        $time = strtotime($date);

        if ($time === false) {
            throw new InvalidAttendanceException('Date provided is invalid');
        }

        $date       = date('Y-m-d', $time);
        $this->date = $date;
    }

    /**
     * Set date
     *
     * @param string $session
     * @return void
     * @throws InvalidSessionException
     */
    public function setSession($session)
    {
        $session = strtoupper($session);

        if ($session == 'AM' || $session == 'PM') {
            $this->session = $session;
        } else {
            throw new InvalidSessionException('The session is invalid');
        }
    }

    /**
     * Set attendance code id
     *
     * Attendance codes can be fetched from the attendance-code endpoint
     *
     * @param string $attendanceCodeId
     * @return void
     * @throws InvalidAttendanceException
     */
    public function setAttendanceCodeId($attendanceCodeId)
    {
        if (empty($attendanceCodeId)) {
            throw new InvalidAttendanceException('Attendance code id can not be set to null.');
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
        return ! (empty($this->date) || empty($this->student_id) || empty($this->session) || empty($this->attendance_code_id));
    }

    /**
     * Return the student id
     *
     * @return string
     */
    public function getStudentId()
    {
        return $this->student_id;
    }

    /**
     * Return the student id
     *
     * @return string
     */
    public function getEmployeeId()
    {
        return $this->employee_id;
    }

    /**
     * Return the date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Return the session
     *
     * @return string
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * Return the attendance code
     *
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
            'date'               => $this->getDate(),
            'session'            => $this->getSession(),
            'student_id'         => $this->getStudentId(),
            'attendance_code_id' => $this->getAttendanceCodeId()
        ];

        $comment = $this->getComment();

        if ( ! empty($comment)) {
            $required['comment'] = $comment;
        }
        
        $employee_id = $this->getEmployeeId();

        if ( ! empty($employee_id)) {
            $required['employee_id'] = $employee_id;
        }

        $minutesLate = $this->getMinutesLate();

        if ( ! empty($minutesLate)) {
            $required['minutes_late'] = $minutesLate;
        }

        return $required;
    }

    /**
     * Get the comment value
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set the comment value
     *
     * @param string $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * Set minutes late
     *
     * @param $number
     * @throws InvalidInputException
     */
    public function setMinutesLate($number)
    {
        if ( ! is_numeric($number)) {
            throw new InvalidInputException('Only pass a numeric value to minutes late');
        }

        $this->minutesLate = $number;
    }

    /**
     * Get minutes late
     *
     * @return int
     */
    public function getMinutesLate()
    {
        return $this->minutesLate;
    }
}