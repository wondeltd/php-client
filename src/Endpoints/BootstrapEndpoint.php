<?php namespace Wonde\Endpoints;

use GuzzleHttp\Client;
use Wonde\ResultIterator;

class BootstrapEndpoint
{

    /**
     * @var string
     */
    const endpoint = 'https://api.wonde.com/v1.0/';

    /**
     * @var string
     */
    public $uri;

    /**
     * @var string
     */
    public $token;

    /**
     * BootstrapEndpoint constructor.
     */
    public function __construct($token, $uri = false)
    {
        $this->token = $token;

        if ($uri) {
            $this->uri = $uri . $this->uri;
        }
    }

    /**
     * Get the default guzzle client
     *
     * @return Client
     */
    private function client()
    {
        return new Client([
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode($this->token . ':'),
                'User-Agent'    => 'wonde-php-client-' . \Wonde\Client::version
            ]
        ]);
    }

    /**
     * Make a get request
     *
     * @param $endpoint
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    private function getRequest($endpoint)
    {
        return $this->getUrl(self::endpoint . $endpoint);
    }

    /**
     * Make a get request to url
     *
     * @param $url
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function getUrl($url)
    {
        return $this->client()->request('GET', $url);
    }

    /**
     * Get all of resource
     *
     * @param array $includes
     * @param array $parameters
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function all($includes = [], $parameters = [])
    {
        if ( ! empty($includes)) {
            $parameters['include'] = implode(',', $includes);
        }

        $uri = ! empty($parameters) ? $this->uri . '?' . http_build_query($parameters) : $this->uri;

        $response = $this->getRequest($uri)->getBody()->getContents();
        $decoded  = json_decode($response);

        return new ResultIterator($decoded, $this->token);
    }

    /**
     * Get single resource
     *
     * @param $id
     * @return mixed
     */
    public function get($id, $includes = [], $parameters = [])
    {
        if ( ! empty($includes)) {
            $parameters['include'] = implode(',', $includes);
        }

        $uri = ! empty($parameters) ? $this->uri . $id . '?' . http_build_query($parameters) : $this->uri . $id;

        $response = $this->getRequest($uri)->getBody()->getContents();
        $decoded  = json_decode($response);

        return $decoded->data;
    }
}