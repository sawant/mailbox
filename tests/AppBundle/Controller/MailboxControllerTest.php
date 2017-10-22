<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MailboxControllerTest extends WebTestCase
{
    /**
     * @var Client
     */
    protected $client;

    protected function setUp()
    {
        parent::setUp();

        $this->client = static::createClient([], [
            'PHP_AUTH_USER' => 'appuser',
            'PHP_AUTH_PW'   => 'wV[Ho6HEz6AFboY',
        ]);
    }

    /**
     * @test
     */
    public function testListMessages()
    {
        $this->client->request('GET', '/api/mailbox/');

        $response = $this->client->getResponse();
        $data     = json_decode($response->getContent(), true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/json', $response->headers->get('Content-Type'));

        // Verify that result data has the correct keys
        $this->assertArrayHasKey('uid', $data[0]);
        $this->assertArrayHasKey('sender', $data[0]);
        $this->assertArrayHasKey('subject', $data[0]);
        $this->assertArrayHasKey('message', $data[0]);
        $this->assertArrayHasKey('time_sent', $data[0]);
        $this->assertArrayHasKey('read', $data[0]);
        $this->assertArrayHasKey('archived', $data[0]);
    }

    /**
     * @test
     */
    public function testListArchivedMessages()
    {
        $this->client->request('GET', '/api/mailbox/?filter=archived');

        $response = $this->client->getResponse();
        $data     = json_decode($response->getContent(), true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/json', $response->headers->get('Content-Type'));

        if ($data) {
            // Verify that result data has the correct keys
            $this->assertArrayHasKey('uid', $data[0]);
            $this->assertArrayHasKey('sender', $data[0]);
            $this->assertArrayHasKey('subject', $data[0]);
            $this->assertArrayHasKey('message', $data[0]);
            $this->assertArrayHasKey('time_sent', $data[0]);
            $this->assertArrayHasKey('read', $data[0]);
            $this->assertArrayHasKey('archived', $data[0]);
        }
    }

    /**
     * @test
     */
    public function testShowMessage()
    {
        $this->client->request('GET', '/api/mailbox/1');

        $response = $this->client->getResponse();
        $data     = json_decode($response->getContent(), true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/json', $response->headers->get('Content-Type'));

        // We can test data values as well, since we know what we are importing
        // But it's better done when we have data fixtures; so for now, just do a routine key check
        $this->assertArrayHasKey('uid', $data);
        $this->assertArrayHasKey('sender', $data);
        $this->assertArrayHasKey('subject', $data);
        $this->assertArrayHasKey('message', $data);
        $this->assertArrayHasKey('time_sent', $data);
        $this->assertArrayHasKey('read', $data);
        $this->assertArrayHasKey('archived', $data);
    }

    /**
     * @test
     */
    public function testReadMessage()
    {
        $this->client->request('PATCH', '/api/mailbox/1/read');

        $response = $this->client->getResponse();
        $data     = json_decode($response->getContent(), true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/json', $response->headers->get('Content-Type'));

        // The 'read' status of the message should now be true
        $this->assertEquals(true, $data['read']);
    }

    /**
     * @test
     */
    public function testArchiveMessage()
    {
        $this->client->request('PATCH', '/api/mailbox/2/archive');

        $response = $this->client->getResponse();
        $data     = json_decode($response->getContent(), true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/json', $response->headers->get('Content-Type'));

        // The 'read' status of the message should now be true
        $this->assertEquals(true, $data['archived']);
    }
}
