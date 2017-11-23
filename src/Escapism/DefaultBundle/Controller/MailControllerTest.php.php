<?php

namespace Escapism\DefaultBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MailControllerTest extends WebTestCase
{
	public function testMailIsSentAndContentIsOk()
	{
		$client = static::createClient();

		// Enable the profiler for the next request (it does nothing if the profiler is not available)
		$client->enableProfiler();

		$crawler = $client->request('POST', '/contact');

		$mailCollector = $client->getProfile()->getCollector('swiftmailer');

		// Check that an email was sent
		$this->assertEquals(1, $mailCollector->getMessageCount());

		$collectedMessages = $mailCollector->getMessages();
		$message = $collectedMessages[0];

		// Asserting email data
		$this->assertInstanceOf('Swift_Message', $message);
		$this->assertEquals($subject, $message->getSubject());
		$this->assertEquals($email, key($message->getFrom()));
		$this->assertEquals('dignified.sorinolu-bimpe@sqauremile.com', key($message->getTo()));
		$this->assertEquals($usermessage, array('name' => $name),
			$message->getBody()
		);
	}
}