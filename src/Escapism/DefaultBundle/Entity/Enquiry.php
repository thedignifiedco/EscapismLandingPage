<?php

namespace Escapism\DefaultBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Enquiry
 *
 */
class Enquiry {
	/**
	 * @var int
	 */
	private $id;

	/**
	 * @var string
	 */
	protected $name;

	/**
	 * @var string
	 */
	protected $subject;

	/**
	 * @var string
	 */
	protected $email;

	/**
	 * @var string
	 */
	protected $usermessage;

	/**
	 * @var string
	 */
	protected $spamCheck;

	/**
	 * Get id
	 *
	 * @return integer
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Set name
	 *
	 * @param string $name
	 *
	 * @return Enquiry
	 */
	public function setName( $name ) {
		$this->name = $name;

		return $this;
	}

	/**
	 * Get name
	 *
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Set subject
	 *
	 * @param string $subject
	 *
	 * @return Enquiry
	 */
	public function setSubject( $subject ) {
		$this->subject = $subject;

		return $this;
	}

	/**
	 * Get subject
	 *
	 * @return string
	 */
	public function getSubject() {
		return $this->subject;
	}

	/**
	 * Set email
	 *
	 * @param string $email
	 *
	 * @return Enquiry
	 */
	public function setEmail( $email ) {
		$this->email = $email;

		return $this;
	}

	/**
	 * Get email
	 *
	 * @return string
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * Set usermessage
	 *
	 * @param string $usermessage
	 *
	 * @return Enquiry
	 */
	public function setUsermessage( $usermessage ) {
		$this->usermessage = $usermessage;

		return $this;
	}

	/**
	 * Get usermessage
	 *
	 * @return string
	 */
	public function getUsermessage() {
		return $this->usermessage;
	}

	/**
	 * Set spamCheck
	 *
	 * @param string $spamCheck
	 *
	 * @return Enquiry
	 */
	public function setSpamCheck( $spamCheck ) {
		$this->spamCheck = $spamCheck;

		return $this;
	}

	/**
	 * Get spamCheck
	 *
	 * @return string
	 */
	public function getSpamCheck() {
		return $this->spamCheck;
	}
}
