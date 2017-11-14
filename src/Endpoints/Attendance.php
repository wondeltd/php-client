<?php namespace Wonde\Endpoints;

use Wonde\Writeback\SessionRegister;

class Attendance extends BootstrapEndpoint
{
    /**
     * @var string
     */
    public $uri = 'attendance/session/';

    /**
     * Session Register
     *
     * @param SessionRegister $register
     * @return \stdClass
     */
    public function sessionRegister(SessionRegister $register)
    {
        return $this->post($register);
    }
}