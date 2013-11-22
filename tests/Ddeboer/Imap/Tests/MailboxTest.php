<?php

namespace Ddeboer\Imap\Tests;

use Ddeboer\Imap\Mailbox;
use Ddeboer\Imap\Exception\MailboxDoesNotExistException;

class MailboxTest extends AbstractTest
{
    /**
     * @var Mailbox
     */
    protected $mailbox;

    public function setUp()
    {
        try {
            $mailbox = $this->getConnection()->getMailbox('testing');
            $mailbox->delete();
        } catch (MailboxDoesNotExistException $e) {
            // Ignore mailbox not found
        }

        $this->mailbox = $this->getConnection()->createMailbox('testing');

        $this->createTestMessage($this->mailbox, 'Message 1');
        $this->createTestMessage($this->mailbox, 'Message 2');
        $this->createTestMessage($this->mailbox, 'Message 3');
    }

    public function testGetName()
    {
        $this->assertEquals('testing', $this->mailbox->getName());
    }

    public function testGetMessages()
    {
        $inbox = $this->getConnection()->getMailbox('INBOX');
        $messages = $inbox->getMessages();
        foreach ($messages as $m) {

        }
    }

    public function testCount()
    {
        $this->assertEquals(3, $this->mailbox->count());
    }

    public function tearDown()
    {
        try {
//            $this->mailbox->delete();
        } catch (\Exception $e) {
            // Ignore
        }
    }
}
