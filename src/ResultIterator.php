<?php namespace Wonde;

use Wonde\Endpoints\BootstrapEndpoint;

class ResultIterator extends BootstrapEndpoint implements \Iterator
{
    /**
     * @var array
     */
    private $array;

    /**
     * @var string
     */
    public $token;

    /**
     * @var array
     */
    private $meta;

    public function __construct($givenArray, $token)
    {
        $this->meta  = $givenArray->meta;
        $this->array = $givenArray->data;
        $this->token = $token;
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

                $this->meta  = $decoded->meta;
                $this->array = $decoded->data;

                reset($this->array);

                return (bool) count($this->array);
            }

        } else {
            return $valid;
        }
    }
}
