<?php namespace Wonde;

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
     * @var string
     */
    private $token;

    /**
     * @var string
     */
    const version = '2.1.0';

    /**
     * Client constructor.
     */
    public function __construct($token)
    {
        if (empty($token) or ! is_string($token)) {
            throw new InvalidTokenException('Token string is required');
        }

        $this->token           = $token;
        $this->schools         = new Schools($token);
        $this->meta            = new Meta($token);
        $this->attendanceCodes = new AttendanceCodes($token);
    }

    /**
     * Return endpoints for single school
     *
     * @param $id
     * @return Schools
     */
    public function school($id)
    {
        return new Schools($this->token, $id);
    }

    /**
     * Request access to the current school
     *
     * @return \stdClass
     */
    public function requestAccess($schoolId)
    {
        $uri = 'schools/' . $schoolId . '/request-access';

        return (new BootstrapEndpoint($this->token, $uri))->post();
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
