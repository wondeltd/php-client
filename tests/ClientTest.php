<?php

class ClientTest extends PHPUnit_Framework_TestCase {

    public function testCreateClient()
    {
        $class = new \Wonde\Client('token');
        $this->assertTrue($class instanceof \Wonde\Client);
    }
}