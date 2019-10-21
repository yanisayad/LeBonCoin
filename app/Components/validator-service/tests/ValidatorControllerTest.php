<?php

namespace App\Tests\Controller;

use App\Utils\Palindrome;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ValidatorControllerTest extends WebTestCase
{
    protected $client;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    public function testValidEmail()
    {
        $this->client->request('POST', '/api/email', ['email' => 'toto@gmail.com']);

        $response = preg_replace('/HTTP(.*)index/s', "", $this->client->getResponse());

        $this->assertTrue(json_decode($response));
    }

    public function testInvalidEmail()
    {
        $this->client->request('POST', '/api/email', ['email' => 'ToTo@gmail.com']);

        $response = preg_replace('/HTTP(.*)index/s', "", $this->client->getResponse());

        $this->assertFalse(json_decode($response));
    }

    public function testPalindromeName()
    {
        $this->client->request('POST', '/api/palindrome', ['name' => 'kayak']);

        $response = preg_replace('/HTTP(.*)index/s', "", $this->client->getResponse());

        $this->assertFalse(json_decode($response));
    }

    public function testValidName()
    {
        $this->client->request('POST', '/api/palindrome', ['name' => 'leboncoin']);

        $response = preg_replace('/HTTP(.*)index/s', "", $this->client->getResponse());

        $this->assertTrue(json_decode($response));
    }

    public function testPalindrome()
    {
        $validName = new Palindrome('leboncoin');
        $this->assertTrue($validName->isValid());

        $invalidName = new Palindrome('kayak');
        $this->assertFalse($invalidName->isValid());
    }

}
