<?php

namespace Wonde;

use Wonde\Endpoints\AttendanceCodes;
use Wonde\Endpoints\BootstrapEndpoint;
use Wonde\Endpoints\Schools;
use Wonde\Exceptions\InvalidTokenException;
use Wonde\Endpoints\Meta;

/**
 * @property Schools schools
 */
class Client
{
    /**
     * @var AttendanceCodes
     */
    public $attendanceCodes;

    /**
     * @var Meta
     */
    public $meta;

    /**
     * @var Schools
     */
    public $schools;

    /**
     * @var string
     */
    private $token;

    /**
     * @var string
     */
    const version = '3.1.1';

    /**
     * @var string
     */
    private $logPath = '';

    /**
     * Client constructor.
     */
    public function __construct($token, $logPath = '')
    {
         if (empty($token) or !is_string($token)) {
            throw new InvalidTokenException('Token string is required');
        }

        $this->token           = $token;
        $this->schools         = new Schools($token, false, $logPath);
        $this->meta            = new Meta($token, false, $logPath);
        $this->attendanceCodes = new AttendanceCodes($token, false, $logPath);
        $this->logPath = $logPath;
    }

    /**
     * Return endpoints for single school
     *
     * @param $id
     * @return Schools
     */
    public function school($id)
    {
        if(!empty($this->logPath)) {
            $this->logPath .= DIRECTORY_SEPARATOR . $id;
        }
        return new Schools($this->token, $id, $this->logPath);
    }

    /**
     * Request access to the current school
     *
     * @return \stdClass
     */
    public function requestAccess($schoolId, $payload = [])
    {
        $uri = 'schools/' . $schoolId . '/request-access';

        return (new BootstrapEndpoint($this->token, $uri))->post($payload);
    }

    /**
     * Revoke access to the current school
     *
     * @return \stdClass
     */
    public function revokeAccess($schoolId)
    {
        $uri = 'schools/' . $schoolId . '/revoke-access';

        return (new BootstrapEndpoint($this->token, $uri))->deleteRequestReturnBody($uri);
    }
}
