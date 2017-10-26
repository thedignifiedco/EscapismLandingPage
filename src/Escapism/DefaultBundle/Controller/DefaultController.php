<?php

namespace Escapism\DefaultBundle\Controller;

use Escapism\DefaultBundle\Entity\NewsletterSignup;
use Escapism\DefaultBundle\Form\NewsletterSignupType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

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
	 * @Template()
	 *
	 * @param Request $request
	 *
	 * @return Response|array
	 */
	public function indexAction( Request $request ) {
		$newsletterSignup = new NewsletterSignup();
		$form             = $this->createForm( NewsletterSignupType::class, $newsletterSignup, [
			'action' => $this->generateUrl( 'index' ),
			'method' => "POST",
		] );
		$form->add( 'submit', SubmitType::class, [ 'label' => "Notify me!" ] );

		$form->handleRequest( $request );
		if ( $form->isSubmitted() && $form->isValid() ) {
			$em = $this->getDoctrine()->getManager();
			$em->persist( $newsletterSignup );
			$em->flush();
			$parameters = [
				'status' => 'success',
				'html' => $this->renderView("EscapismDefaultBundle:Default:success.html.twig"),
			];
		}

		return [
			'form' => $form->createView(),
		];
	}
}