<?php namespace Wonde;

use Wonde\Exceptions\InvalidAttendanceException;
use Wonde\Exceptions\InvalidSessionException;

class Attendance
{
    /**
     * @var string
     */
    public $student_id;

    /**
     * @var string
     */
    public $date;

    /**
     * @var string
     */
    public $session;

    /**
     * @var string
     */
    public $attendance_code_id;

    /**
     * Set student id
     *
     * @param string $date
     * @return void
     * @throws InvalidAttendanceException
     */
    public function setStudentId($studentId)
    {
        if(empty($studentId)){
            throw new InvalidAttendanceException('Student id can not be set to null.');
        }

        $this->student_id = $studentId;
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
        if(empty($date)){
            throw new InvalidAttendanceException('Date can not be set to null.');
        }

        $date = date('Y-m-d',strtotime($date));
        $this->date = $date;
    }

    /**
     * Set date
     *
     * @param string $session
     * @return void
     * @throws InvalidAttendanceException
     */
    public function setSession($session)
    {
        $session = strtoupper($session);

        if($session == 'AM' || $session == 'PM') {
            $this->session = $session;
        } else {
            throw new InvalidSessionException('The session is invalid');
        }
    }

    /**
     * Set attendance code id
     *
     * @param string $attendanceCodeId
     * @return void
     * @throws InvalidAttendanceException
     */
    public function setAttendanceCodeId($attendanceCodeId)
    {
        if(empty($attendanceCodeId)){
            throw new InvalidAttendanceException('Attendance code id can not be set to null.');
        }

        $this->attendance_code_id = $attendanceCodeId;
    }

}