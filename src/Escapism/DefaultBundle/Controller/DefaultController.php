<?php

namespace Escapism\DefaultBundle\Controller;

use Escapism\DefaultBundle\Entity\NewsletterSignup;
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
				'status' => 'success',
				'message' => 'Thanks for signing up!'
			];
		} else {
			$parameters = [
				'status' => 'error',
				'message' => 'This email has been used!'
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
		$newsletterSignup = new NewsletterSignup();
		$form             = $this->createNewsletterSignupForm( $newsletterSignup );

		return [
				'form' => $form->createView(),
		];
	}

	/**
	 * @Route("/contact", name="Contact")
	 * @Template()
	 *
	 * @return array|Response
	 */
	public function contactAction() {
		$newsletterSignup = new NewsletterSignup();
		$form             = $this->createNewsletterSignupForm( $newsletterSignup );

		return [
			'form' => $form->createView(),
		];
	}

	/**
	 * @Route("/brands", name="Brands")
	 * @Template()
	 *
	 * @return array|Response
	 */
	public function brandsAction() {
		$newsletterSignup = new NewsletterSignup();
		$form             = $this->createNewsletterSignupForm( $newsletterSignup );

		return [
			'form' => $form->createView(),
		];
	}
}