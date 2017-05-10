<?php namespace Wonde\Endpoints;

use GuzzleHttp\Psr7\Response;

class Achievements extends BootstrapEndpoint
{
    /**
     * @var string
     */
    public $uri = 'achievements/';

    /**
     * Delete a achievement record by it's Wonde ID
     *
     * @param array $id
     * @return Response
     */
    public function delete($id)
    {
        return parent::deleteRequestReturnBody($this->uri . $id);
    }

    /**
     * Create a achievement record
     *
     * @param $array
     * @return \stdClass
     */
    public function create($array)
    {
        return parent::post($array);
    }
}