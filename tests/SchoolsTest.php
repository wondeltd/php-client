<?php

use GuzzleHttp\Exception\ClientException;
use PHPUnit\Framework\TestCase;
use \Wonde\Client;

class SchoolsTest extends TestCase
{
    private const BASE_URL = 'schools/';
    private $client;
    private $schoolsApi;
    protected function setUp(): void
    {
        $this->token = file_get_contents(__DIR__ . '/../.token');
        $this->client = new Client($this->token);
        $this->schoolsApi = $this->client->schools;
    }

    public function testSchoolsPendingEndpointIsCorrectAfterMultipleCalls()
    {
        $this->schoolsApi->pending();
        $this->assertEquals('schools/pending/', $this->schoolsApi->uri);

        $this->schoolsApi->pending();
        // Before fix issue
        $this->assertNotEquals('schools/pending/pending', $this->schoolsApi->uri);

        $this->assertEquals('schools/pending/', $this->schoolsApi->uri);
    }

    public function testSchoolAuditedEndpointIsCorrectAfterMultipleCalls()
    {
        $this->schoolsApi->audited();
        $this->assertEquals('schools/audited/', $this->schoolsApi->uri);

        $this->schoolsApi->audited();
        // Before fix issue
        $this->assertNotEquals('schools/audited/audited', $this->schoolsApi->uri);

        $this->assertEquals('schools/audited/', $this->schoolsApi->uri);
    }

    public function testSchoolDeclinedEndpointIsCorrectAfterMultipleCalls()
    {
        $this->schoolsApi->declined();
        $this->assertEquals('schools/declined/', $this->schoolsApi->uri);

        $this->schoolsApi->declined();
        // Before fix issue
        $this->assertNotEquals('schools/declined/declined', $this->schoolsApi->uri);

        $this->assertEquals('schools/declined/', $this->schoolsApi->uri);
    }

    public function testSchoolRevokedEndpointIsCorrectAfterMultipleCalls()
    {
        $this->schoolsApi->revoked();
        $this->assertEquals('schools/revoked/', $this->schoolsApi->uri);

        $this->schoolsApi->revoked();
        // Before fix issue
        $this->assertNotEquals('schools/revoked/revoked/', $this->schoolsApi->uri);

        $this->assertEquals('schools/revoked/', $this->schoolsApi->uri);
    }

    public function testSearchSchoolEndpointIsCorrectAfterMultipleCalls()
    {
        $this->schoolsApi->search([], ['postcode' => 'SW1A']);
        $this->assertEquals('schools/all/', $this->schoolsApi->uri);

        $this->schoolsApi->search([], ['postcode' => 'SW1A']);
        // Before fix issue
        $this->assertNotEquals('schools/all/all/', $this->schoolsApi->uri);

        $this->assertEquals('schools/all/', $this->schoolsApi->uri);

        $this->schoolsApi->search([], ['postcode' => 'SW1A']);
        // Before fix issue
        $this->assertNotEquals('schools/all/all/all/', $this->schoolsApi->uri);

        $this->assertEquals('schools/all/', $this->schoolsApi->uri);
    }

    public static function allSchoolsUriParams()
    {
        return [
            ['all/', self::BASE_URL . 'all/'],
            ['all/', self::BASE_URL . 'all/'],
            ['', self::BASE_URL],
            [null, self::BASE_URL],
        ];
    }

    public static function specificSchoolUriParams()
    {
        return [
            [1, 'all/', self::BASE_URL . '1/all/'],
            [null, 'all/', self::BASE_URL . 'all/'],
            [null, '', self::BASE_URL],
            [null, null, self::BASE_URL],
        ];
    }

    /**
     *@dataProvider allSchoolsUriParams
     */
    public function testConstructUriMethod($endpoint, $expected)
    {
        $this->assertSame($expected, $this->schoolsApi->constructUri($endpoint));
    }

    /**
     *@dataProvider specificSchoolUriParams
     */
    public function testConstructUriMethodForSpecificSchool($id, $endpoint, $expected)
    {
        $this->assertSame($expected, $this->client->school($id)->constructUri($endpoint));
    }
}