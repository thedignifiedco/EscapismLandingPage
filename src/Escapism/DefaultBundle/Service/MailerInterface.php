<?php

namespace Escapism\DefaultBundle\Service;

/**
 * Interface MailerInterface
 *
 * @package SUM\BaseBundle\Services
 */
interface MailerInterface
{
    /**
     *  Send an Swift_Message
     *
     * @param \Swift_Mime_Message|\Swift_Mime_MimePart $message
     *
     * @return boolean
     */
    public function send(\Swift_Mime_Message $message);
}
