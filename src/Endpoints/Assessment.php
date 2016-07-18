<?php namespace Wonde\Endpoints;

use Wonde\Endpoints\Assessment\Aspects;
use Wonde\Endpoints\Assessment\MarkSheets;
use Wonde\Endpoints\Assessment\Results;
use Wonde\Endpoints\Assessment\ResultSets;
use Wonde\Endpoints\Assessment\Templates;

class Assessment extends BootstrapEndpoint
{
    /**
     * @var string
     */
    public  $uri = '';

    /**
     * @var Templates
     */
    public $templates;

    /**
     * @var Aspects
     */
    public $aspects;

    /**
     * @var MarkSheets
     */
    public $marksheets;

    /**
     * @var Results
     */
    public $results;

    /**
     * @var ResultSets
     */
    public $resultsets;

    /**
     * Assessment constructor.
     */
    public function __construct($token, $id = false)
    {
        $this->token = $token;

        if ($id) {
            $this->uri = $this->uri . $id;
        }

        $this->templates = new Templates($token, $this->uri);
        $this->aspects = new Aspects($token, $this->uri);
        $this->marksheets = new MarkSheets($token, $this->uri);
        $this->results = new Results($token, $this->uri);
        $this->resultsets = new ResultSets($token, $this->uri);
    }
}