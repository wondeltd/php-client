<?php namespace Wonde;

use Wonde\Endpoints\BootstrapEndpoint;

class ResultIterator extends BootstrapEndpoint implements \Iterator
{
    /**
     * @var array
     */
    public $array;

    /**
     * @var string
     */
    public $token;

    /**
     * @var array
     */
    private $meta;

    /**
     * @var string
     */
    private $logPath = '';

    public function __construct($givenArray, $token, $logPath = '')
    {
        $this->array = $givenArray->data;
        $this->token = $token;
        $this->meta  = ! empty($givenArray->meta) ? $givenArray->meta : new \stdClass();
        $this->logPath = $logPath;
    }

    function rewind()
    {
        return reset($this->array);
    }

    function current()
    {
        return current($this->array);
    }

    function key()
    {
        return key($this->array);
    }

    function next()
    {
        return next($this->array);
    }

    function valid()
    {
        $valid = key($this->array) !== null;

        if ( ! $valid) {

            if ( ! empty($this->meta->pagination->next)) {

                $nextResponse = $this->getUrl($this->meta->pagination->next)->getBody()->getContents();
                $decoded      = json_decode($nextResponse);

                $this->logResponse($this->logPath, $this->meta->pagination->next, $nextResponse);

                $this->meta  = ! empty($decoded->meta) ? $decoded->meta : new \stdClass();
                $this->array = $decoded->data;

                reset($this->array);

                return (bool) count($this->array);
            }

        } else {
            return $valid;
        }
    }
}
