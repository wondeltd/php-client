<?php
use PHPUnit\Framework\TestCase;

class AssessmentTest extends TestCase
{
    /**
     * @var \Wonde\Endpoints\Schools
     */
    public $school;

    public function setUp(): void
    {
        ini_set('memory_limit','3000M');
        $client = new \Wonde\Client(file_get_contents(__DIR__ . '/../.token'));
        $this->school = $client->school(file_get_contents(__DIR__ . '/../.school'));
    }

    public function test_templates()
    {
        $items = [];
        foreach ($this->school->assessment->templates->all() as $row) {
            $items[] = $row;
            $this->assertTrue($row instanceof stdClass);
            $this->assertNotEmpty($row);
        }
        $this->assertTrue($items > 10);
    }

    public function test_aspects()
    {
        $items = [];
        foreach ($this->school->assessment->aspects->all() as $row) {
            $items[] = $row;
            $this->assertTrue($row instanceof stdClass);
            $this->assertNotEmpty($row);
        }
        $this->assertTrue($items > 10);
    }

    public function test_results()
    {
        $items = [];
        foreach ($this->school->assessment->results->all() as $row) {
            $items[] = $row;
            $this->assertTrue($row instanceof stdClass);
            $this->assertNotEmpty($row);
        }
        $this->assertTrue($items > 10);
    }

    public function test_resultsets()
    {
        $items = [];
        foreach ($this->school->assessment->resultsets->all() as $row) {
            $items[] = $row;
            $this->assertTrue($row instanceof stdClass);
            $this->assertNotEmpty($row);
        }
        $this->assertTrue($items > 10);
    }

    public function test_marksheets()
    {
        $items = [];
        foreach ($this->school->assessment->marksheets->all() as $row) {
            $items[] = $row;
            $this->assertTrue($row instanceof stdClass);
            $this->assertNotEmpty($row);
        }
        $this->assertTrue($items > 10);
    }
}