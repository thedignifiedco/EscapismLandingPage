<?php

namespace Escapism\DefaultBundle\Service;

use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class AbstractMailer
 *
 * @package SUM\BaseBundle\Services
 */
abstract class AbstractMailer implements MailerInterface
{
    /** @var string $tag */
    protected $tag = "SUM_MAILER";

    /** @var null|ContainerInterface $container */
    protected $container = null;

    /**
     * Basic constructor
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     *    Send an Swift_Message
     *
     * @param \Swift_Mime_Message $message
     *
     * @return boolean
     */
    public function send(\Swift_Mime_Message $message)
    {
        return $this->container->get('mailer')->send($message);
    }
}
