<?php

namespace Stanx\Monolog\Handler;

use Fabiang\Xmpp\Client;
use Fabiang\Xmpp\Protocol\Message;
use Monolog\Handler\MailHandler;
use Monolog\Logger;

/**
 * Handler sends logs via XMPP to multiple receivers
 */
class XmppHandler extends MailHandler
{
    /**
     * @var Client
     */
    protected $xmpp;

    /**
     * @var string[] Array of receivers
     */
    protected $receivers;

    /**
     * @param Client     $xmpp   Xmpp Client instance
     * @param string[]   $receivers
     * @param int|string $level  The minimum logging level at which this handler will be triggered
     * @param bool       $bubble Whether the messages that are handled can bubble up the stack or not
     */
    public function __construct(Client $xmpp, array $receivers, $level = Logger::DEBUG, bool $bubble = true)
    {
        parent::__construct($level, $bubble);

        $this->xmpp = $xmpp;
        $this->receivers = $receivers;
    }

    protected function send(string $content, array $records) : void
    {
        $message = new Message($content);

        foreach($this->receivers as $receiver)
        {
            $this->xmpp->send(
                $message->setTo($receiver)
            );
        }
    }
}
