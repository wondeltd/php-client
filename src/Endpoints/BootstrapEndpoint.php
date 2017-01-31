<?php namespace Wonde\Endpoints;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Wonde\Exceptions\ValidationError;
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
        if ((float) Client::VERSION >= 6) {
            return new Client([
                'headers' => [
                    'Authorization' => 'Basic ' . base64_encode($this->token . ':'),
                    'User-Agent'    => 'wonde-php-client-' . \Wonde\Client::version
                ]
            ]);
        } else {
            return new Client([
                'defaults' => [
                    'headers' => [
                        'Authorization' => 'Basic ' . base64_encode($this->token . ':'),
                        'User-Agent'    => 'wonde-php-client-' . \Wonde\Client::version
                    ]
                ]
            ]);
        }
    }

    /**
     * Throw an error
     *
     * @param ClientException $exception
     * @return null
     * @throws ValidationError
     */
    private function throwError(ClientException $exception)
    {
        if ($exception->getResponse()->getStatusCode() === 422) {

            // Status code 422 is a validation error
            $validationError = new ValidationError('Validation has failed');
            $validationError->setErrors(json_decode($exception->getResponse()->getBody()->getContents()));
            throw $validationError;
        } else {
            throw $exception;
        }
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
        return $this->client()->get($url);
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

    /**
     * Make a post request
     *
     * @param       $endpoint
     * @param array $body
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function postRequest($endpoint, $body = [])
    {
        return $this->postUrl(self::endpoint . $endpoint, $body);
    }

    /**
     * Make a post request to url
     *
     * @param       $url
     * @param array $body
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    private function postUrl($url, $body = [])
    {
        return $this->client()->post($url, $body);
    }

    /**
     * Make a post request and decode the response
     *
     * @param array $body
     * @return \stdClass
     */
    public function post($body = [])
    {
        $body                            = ['body' => json_encode($body)];
        $body['headers']['Content-Type'] = 'application/json';

        try {
            $post = $this->postRequest($this->uri, $body);
        } catch ( ClientException $exception ) {
            return $this->throwError($exception);
        }

        $response = $post->getBody()->getContents();

        $decoded = json_decode($response);

        return $decoded;
    }


    /**
     * Make a delete request
     *
     * @param       $endpoint
     * @param array $body
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function deleteRequest($endpoint, $body = [])
    {
        return $this->deleteUrl(self::endpoint . $endpoint, $body);
    }

    /**
     * Make a delete request to url
     *
     * @param       $url
     * @param array $body
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    private function deleteUrl($url, $body = [])
    {
        return $this->client()->delete($url, $body);
    }

    /**
     * Make a delete request and decode the response
     *
     * @param array $body
     * @return \stdClass
     */
    public function delete($body = [])
    {
        $body                            = ['body' => json_encode($body)];
        $body['headers']['Content-Type'] = 'application/json';

        try {
            $delete = $this->deleteRequest($this->uri, $body);
        } catch ( ClientException $exception ) {
            return $this->throwError($exception);
        }

        $response = $delete->getBody()->getContents();

        $decoded = json_decode($response);

        return $decoded;
    }
}