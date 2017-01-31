<?php namespace Wonde\Writeback;

use Wonde\Exceptions\InvalidAttendanceException;
use Wonde\Writeback\SessionAttendanceRecord;

class SessionRegister
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
     * @param SessionAttendanceRecord|array $attendance
     * @return void
     * @throws InvalidAttendanceException
     */
    public function add($attendance)
    {
        $attendance = is_array($attendance) ? $attendance : [$attendance];

        foreach ($attendance as $attendanceSingular) {

            if ($attendanceSingular instanceof SessionAttendanceRecord && $attendanceSingular->isValid()) {
                $this->attendance[] = $attendanceSingular->toArray();
            } else {
                if ( ! $attendanceSingular instanceof SessionAttendanceRecord) {
                    throw new InvalidAttendanceException('Attendance is not an instance of the Attendance Class.');
                }

                if ( ! $attendanceSingular->isValid()) {
                    throw new InvalidAttendanceException('Attendance has empty fields.');
                }
            }
        }
    }
}