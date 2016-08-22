<?php

class MiscEndPointsTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \Wonde\Endpoints\Schools
     */
    public $school;

    public function setUp()
    {
        ini_set('memory_limit','3000M');
        $client = new \Wonde\Client(file_get_contents(__DIR__ . '/../.token'));
        $this->school = $client->school(file_get_contents(__DIR__ . '/../.school'));
    }

    public function tests_students()
    {
        $items = [];
        foreach ($this->school->students->all() as $row) {
            $items[] = $row;
            $this->assertTrue($row instanceof stdClass);
            $this->assertNotEmpty($row);
        }
        $this->assertTrue($items > 10);
    }

    public function tests_employees()
    {
        $items = [];
        foreach ($this->school->employees->all() as $row) {
            $items[] = $row;
            $this->assertTrue($row instanceof stdClass);
            $this->assertNotEmpty($row);
        }
        $this->assertTrue($items > 10);
    }

    public function test_contacts()
    {
        $items = [];
        foreach ($this->school->contacts->all() as $row) {
            $items[] = $row;
            $this->assertTrue($row instanceof stdClass);
            $this->assertNotEmpty($row);
        }
        $this->assertTrue($items > 10);
    }

    public function test_subjects()
    {
        $items = [];
        foreach ($this->school->subjects->all() as $row) {
            $items[] = $row;
            $this->assertTrue($row instanceof stdClass);
            $this->assertNotEmpty($row);
        }
        $this->assertTrue($items > 10);
    }

    public function test_rooms()
    {
        $items = [];
        foreach ($this->school->rooms->all() as $row) {
            $items[] = $row;
            $this->assertTrue($row instanceof stdClass);
            $this->assertNotEmpty($row);
        }
        $this->assertTrue($items > 10);
    }

    public function test_groups()
    {
        $items = [];
        foreach ($this->school->groups->all() as $row) {
            $items[] = $row;
            $this->assertTrue($row instanceof stdClass);
            $this->assertNotEmpty($row);
        }
        $this->assertTrue($items > 10);
    }

    public function test_classes()
    {
        $items = [];
        foreach ($this->school->classes->all() as $row) {
            $items[] = $row;
            $this->assertTrue($row instanceof stdClass);
            $this->assertNotEmpty($row);
        }
        $this->assertTrue($items > 10);
    }

    public function test_events()
    {
        $items = [];
        foreach ($this->school->events->all() as $row) {
            $items[] = $row;
            $this->assertTrue($row instanceof stdClass);
            $this->assertNotEmpty($row);
        }
        $this->assertTrue($items > 10);
    }

    public function test_medical_events()
    {
        $items = [];
        foreach ($this->school->medicalEvents->all() as $row) {
            $items[] = $row;
            $this->assertTrue($row instanceof stdClass);
            $this->assertNotEmpty($row);
        }
        $this->assertTrue($items > 10);
    }

    public function test_medical_conditions()
    {
        $items = [];
        foreach ($this->school->medicalConditions->all() as $row) {
            $items[] = $row;
            $this->assertTrue($row instanceof stdClass);
            $this->assertNotEmpty($row);
        }
        $this->assertTrue($items > 10);
    }

    public function test_periods()
    {
        $items = [];
        foreach ($this->school->periods->all() as $row) {
            $items[] = $row;
            $this->assertTrue($row instanceof stdClass);
            $this->assertNotEmpty($row);
        }
        $this->assertTrue($items > 10);
    }

    public function test_lessons()
    {
        $items = [];
        foreach ($this->school->lessons->all() as $row) {
            $items[] = $row;
            $this->assertTrue($row instanceof stdClass);
            $this->assertNotEmpty($row);
        }
        $this->assertTrue($items > 10);
    }

    public function test_achievements()
    {
        $items = [];
        foreach ($this->school->achievements->all() as $row) {
            $items[] = $row;
            $this->assertTrue($row instanceof stdClass);
            $this->assertNotEmpty($row);
        }
        $this->assertTrue($items > 10);
    }

    public function test_behaviour()
    {
        $items = [];
        foreach ($this->school->behaviours->all() as $row) {
            $items[] = $row;
            $this->assertTrue($row instanceof stdClass);
            $this->assertNotEmpty($row);
        }
        $this->assertTrue($items > 10);
    }
}