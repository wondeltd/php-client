<?php

class ClientTest extends PHPUnit_Framework_TestCase
{
    public function testCreateClient()
    {
        ini_set('memory_limit','3000M');
        $client = new \Wonde\Client(file_get_contents(__DIR__ . '/../.token'));
        $this->school = $client->school(file_get_contents(__DIR__ . '/../.school'));

    }
}