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
    public function __construct($token, $id = false, $logPath = '')
    {
        $this->token = $token;
        $this->logPath = $logPath;

        if ($id) {
            $this->uri = $this->uri . $id;
        }

        $this->templates = new Templates($token, $this->uri, $this->logPath);
        $this->aspects = new Aspects($token, $this->uri, $this->logPath);
        $this->marksheets = new MarkSheets($token, $this->uri, $this->logPath);
        $this->results = new Results($token, $this->uri, $this->logPath);
        $this->resultsets = new ResultSets($token, $this->uri, $this->logPath);
    }
}