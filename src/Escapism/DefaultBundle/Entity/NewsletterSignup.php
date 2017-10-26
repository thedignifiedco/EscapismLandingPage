<?php

namespace Escapism\DefaultBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * NewsletterSignup
 *
 * @ORM\Table(name="newsletter_signup")
 * @ORM\Entity(repositoryClass="Escapism\DefaultBundle\Repository\NewsletterSignupRepository")
 * @UniqueEntity(fields="email", message="This email has already been used.")
 */
class NewsletterSignup {
	/**
	 * @var int
	 *
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="firstName", type="string", length=255)
	 */
	private $firstName;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="surname", type="string", length=255)
	 */
	private $surname;

	/**
	 * @var string $email
	 *
	 * @ORM\Column(name="email", type="string", length=255, unique=true)
	 * @Assert\Email(message="Please enter a valid email address.", checkMX = true)
	 */
	private $email;

	/**
	 * @var string
	 *
	 */
	private $termsConditions;

	/**
	 * Get id
	 *
	 * @return integer
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Set firstName
	 *
	 * @param string $firstName
	 *
	 * @return NewsletterSignup
	 */
	public function setFirstName( $firstName ) {
		$this->firstName = $firstName;

		return $this;
	}

	/**
	 * Get firstName
	 *
	 * @return string
	 */
	public function getFirstName() {
		return $this->firstName;
	}

	/**
	 * Set surname
	 *
	 * @param string $surname
	 *
	 * @return NewsletterSignup
	 */
	public function setSurname( $surname ) {
		$this->surname = $surname;

		return $this;
	}

	/**
	 * Get surname
	 *
	 * @return string
	 */
	public function getSurname() {
		return $this->surname;
	}

	/**
	 * Set email
	 *
	 * @param string $email
	 *
	 * @return NewsletterSignup
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
	 * Set termsConditions
	 *
	 * @param string $termsConditions
	 *
	 * @return NewsletterSignup
	 */
	public function setTermsConditions( $termsConditions ) {
		$this->termsConditions = $termsConditions;

		return $this;
	}

	/**
	 * Get termsConditions
	 *
	 * @return string
	 */
	public function getTermsConditions() {
		return $this->termsConditions;
	}
}
