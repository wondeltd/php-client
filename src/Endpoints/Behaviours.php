<?php namespace Wonde\Endpoints;

use GuzzleHttp\Psr7\Response;

class Behaviours extends BootstrapEndpoint
{
    /**
     * @var string
     */
    public $uri = 'behaviours/';

    /**
     * Delete a behaviour record by it's Wonde ID
     *
     * @param array $id
     * @return Response
     */
    public function delete($id)
    {
        return parent::deleteRequestReturnBody($this->uri . $id);
    }

    /**
     * Create a behaviour record
     *
     * @param $array
     * @return \stdClass
     */
    public function create($array)
    {
        return parent::post($array);
    }
}