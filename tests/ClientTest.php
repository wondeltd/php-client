<?php

class ClientTest extends PHPUnit_Framework_TestCase
{

    public function testCreateClient()
    {
        //        $class = new \Wonde\Client('token');
        //        $this->assertTrue($class instanceof \Wonde\Client);

        $client       = new \Wonde\Client('TOKEN#########');
        var_dump($client->schools->search([]));

    }
}