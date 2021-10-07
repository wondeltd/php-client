<?php
use PHPUnit\Framework\TestCase;

class MiscEndPointsTest extends TestCase
{
    /**
     * @var \Wonde\Endpoints\Schools
     */
    public $school;

    private $token;

    private $schoolId;

    /**
     * @var \Wonde\Client
     */
    private $client;

    public function setUp(): void
    {
        ini_set('memory_limit', '3000M');
        $this->token    = file_get_contents(__DIR__ . '/../.token');
        $this->client   = new \Wonde\Client($this->token);
        $this->schoolId = file_get_contents(__DIR__ . '/../.school');
        $this->school   = $this->client->school($this->schoolId);
    }

    public function test_request_access()
    {
        $response = $this->client->requestAccess($this->schoolId);
        $this->assertTrue($response->success);
    }

    public function test_revoke_access()
    {
        $response = $this->client->revokeAccess($this->schoolId);
        $this->assertTrue($response->success);
    }

    public function test_single_school()
    {
        $school = $this->client->schools->get(file_get_contents(__DIR__ . '/../.school'));
        $this->assertTrue($school instanceof stdClass);
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

    public function tests_attendance_summaries()
    {
        $items = [];
        foreach ($this->school->attendanceSummaries->all() as $row) {
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

    public function test_achievements_attributes()
    {
        $items = [];
        foreach ($this->school->achievementsAttributes->all() as $row) {
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

    public function test_behaviour_attributes()
    {
        $items = [];
        foreach ($this->school->behavioursAttributes->all() as $row) {
            $items[] = $row;
            $this->assertTrue($row instanceof stdClass);
            $this->assertNotEmpty($row);
        }
        $this->assertTrue($items > 10);
    }

    public function test_delete_behaviour()
    {
        $response = $this->school->behaviours->delete('A1971302099');
        $this->assertTrue($response instanceof stdClass);
    }

    public function test_delete_achievement()
    {
        $response = $this->school->achievements->delete('A125747323');
        $this->assertTrue($response instanceof stdClass);
    }

    public function test_behaviour_post()
    {
        $array = [
            'students'      => [
                [
                    'student_id'  => 'A1039521228',
                    'role'        => 'AG',
                    'action'      => 'COOL',
                    'action_date' => '2016-04-01',
                    'points'      => 200,
                ],
                [
                    'student_id' => 'A870869351',
                    'role'       => 'TA',
                    'points'     => 2,
                ],
            ],
            'employee_id'   => 'A1375078684',
            'date'          => '2016-03-31',
            'status'        => 'REV2',
            'type'          => 'BULL',
            'bullying_type' => 'B_INT',
            'comment'       => 'Bulling incident',
            'activity_type' => 'RE',
            'location'      => 'CORR',
            'time'          => 'LUN',
        ];

        try {
            $response = $this->school->behaviours->create($array);
        } catch ( \Wonde\Exceptions\ValidationError $error ) {
            $errors = $error->getErrors();
        }
    }

    public function test_achievement_post()
    {
        $array = [
            'students'      => [
                [
                    'student_id' => 'A1039521228',
                    'points'     => 200,
                    'award'      => 'TROP',
                    'award_date' => '2016-04-05',
                ],
            ],
            'employee_id'   => 'A1375078684',
            'date'          => '2016-04-04',
            'type'          => 'NYPA',
            'comment'       => 'A4',
            'activity_type' => 'RE',
        ];

        try {
            $response = $this->school->achievements->create($array);
        } catch ( \Wonde\Exceptions\ValidationError $error ) {
            $errors = $error->getErrors();
        }
    }
}

