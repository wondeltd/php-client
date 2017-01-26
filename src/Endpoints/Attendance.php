<?php namespace Wonde\Endpoints;

use Wonde\Register;

class Attendance extends BootstrapEndpoint
{
    /**
     * @var string
     */
    public $uri = 'attendance/session';

    /**
     * Session Register
     *
     * @param Register $register
     * @return array
     */
    public function sessionRegister(Register $register){

        return $this->post($register);

    }
}