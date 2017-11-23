<?php

namespace Escapism\DefaultBundle\Controller;

use Escapism\DefaultBundle\Entity\Enquiry;
use Escapism\DefaultBundle\Entity\NewsletterSignup;
use Escapism\DefaultBundle\Form\EnquiryType;
use Escapism\DefaultBundle\Form\NewsletterSignupType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DefaultController
 *
 * @package Escapism\DefaultBundle\Controller
 */
class DefaultController extends Controller {
	/**
	 * Index action
	 *
	 * @Route("/", name="index")
	 * @Method("GET")
	 * @Template()
	 *
	 * @return Response|array
	 */
	public function indexAction() {
		$newsletterSignup = new NewsletterSignup();
		$form             = $this->createNewsletterSignupForm( $newsletterSignup );

		return [
			'form' => $form->createView(),
		];
	}


	/**
	 * Index action
	 *
	 * @Route("/", name="submit")
	 * @Method("POST")
	 *
	 * @param Request $request
	 *
	 * @return JsonResponse|array
	 */
	public function submitAction( Request $request ) {
		$newsletterSignup = new NewsletterSignup();
		$form             = $this->createNewsletterSignupForm( $newsletterSignup );

		$form->handleRequest( $request );
		if ( $form->isSubmitted() && $form->isValid() ) {
			$em = $this->getDoctrine()->getManager();
			$em->persist( $newsletterSignup );
			$em->flush();
			$parameters = [
				'status'  => 'success',
				'message' => 'Thanks for signing up!',
			];
		} else {
			$parameters = [
				'status'  => 'error',
				'message' => 'This email has been used!',
			];
		}

		return new JsonResponse( $parameters );
	}

	private function createNewsletterSignupForm( NewsletterSignup $newsletterSignup ) {
		$form = $this->createForm( NewsletterSignupType::class, $newsletterSignup, [
			'action' => $this->generateUrl( 'submit' ),
			'method' => "POST",
			'attr'   => [ 'id' => 'newsletter-signup-form' ],
		] );
		$form->add( 'submit', SubmitType::class, [ 'label' => "Notify me!" ] );

		return $form;

	}

	/**
	 * @Route("/about", name="About")
	 * @Template()
	 *
	 * @return array|Response
	 */
	public function aboutAction() {

		return [];
	}

	/**
	 * Contact action
	 *
	 * @Route("/contact", name="Contact")
	 * @Template()
	 *
	 * @Method("GET")
	 *
	 * @return Response|array
	 */
	public function contactAction() {
		$enquiry = new Enquiry();
		$form    = $this->createEnquiryForm( $enquiry );

		return [
			'form' => $form->createView(),
		];
	}


	/**
	 * Contact action
	 *
	 * @Route("/contact", name="enquirysubmit")
	 * @Method("POST")
	 *
	 * @param Request $request
	 *
	 * @return JsonResponse|array
	 */
	public function enquirysubmitAction( Request $request ) {
		$enquiry = new Enquiry();
		$form    = $this->createEnquiryForm( $enquiry );

		$form->handleRequest( $request );
		if ( $form->isValid() ) {
			$message = \Swift_Message::newInstance()
			                         ->setSubject( $enquiry->getSubject() )
			                         ->setFrom( $enquiry->getEmail() )
			                         ->setTo( 'dignified.sorinolu-bimpe@squaremile.com' )
			                         ->setBody( $enquiry->getUsermessage() );

			$result = $this->get( 'mailer.service' )->send( $message );

			$parameters = [
				'status'  => 'success',
				'message' => 'Thanks for your enquiry!',
				'result'  => $result,
			];
		} else {
			$errors  = $form->getErrors();
			$message = 'Your message failed!';
			foreach ( $errors as $error ) {
				$message .= "\n" . $error->getMessage();
			}
			$parameters = [
				'status'  => 'error',
				'message' => $message,
			];
		};

		return new JsonResponse( $parameters );
	}

	private function createEnquiryForm( Enquiry $enquiry ) {
		$form = $this->createForm( EnquiryType::class, $enquiry, [
			'action' => $this->generateUrl( 'enquirysubmit' ),
			'method' => "POST",
			'attr'   => [ 'id' => 'enquiry-form' ],
		] );
		$form->add( 'submit', SubmitType::class, [ 'label' => "Send" ] );

		return $form;

	}

	/**
	 * @Route("/brands", name="Brands")
	 * @Template()
	 *
	 * @return array|Response
	 */
	public function brandsAction() {

		return [];
	}
}