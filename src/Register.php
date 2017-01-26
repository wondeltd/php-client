<?php namespace Wonde;

use Wonde\Exceptions\InvalidAttendanceException;

class Register
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
     * @param Attendance|array $attendance
     * @return void
     * @throws InvalidAttendanceException
     */
    public function add($attendance)
    {
        $attendance = is_array($attendance) ? $attendance : [$attendance];

        foreach ($attendance as $attendanceSingular){
            if(empty($attendanceSingular->date) || empty($attendanceSingular->student_id) || empty($attendanceSingular->session) || empty($attendanceSingular->attendance_code_id))
            {
                throw new InvalidAttendanceException('Attendance is not complete.');
            } else {
                $this->attendance[] = $attendance;
            }
        }
    }
}