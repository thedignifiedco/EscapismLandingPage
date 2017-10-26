<?php

namespace Escapism\DefaultBundle\Form;

use Doctrine\ORM\Mapping\UniqueConstraint;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class NewsletterSignupType extends AbstractType {
	/**
	 * {@inheritdoc}
	 */
	public function buildForm( FormBuilderInterface $builder, array $options ) {
		$builder->add( 'firstName', null, array(
					'required' => 'true',
					'constraints' => [
						new NotBlank(['message' => 'First name field cannot be empty']),
					],
					) )
		        ->add( 'surname', null, array(
			        'required' => 'true',
			        'constraints' => [
				        new NotBlank(['message' => 'Surname field cannot be empty']),
			        ],
		            ) )
		        ->add( 'email', EmailType::class, array(
			        'required' => 'true',
			        'constraints' => [
				        new NotBlank(['message' => 'Email field cannot be empty']),
				        new Email(['message' => 'Please enter a valid email']),
			        ],
		            ) )
		        ->add( 'termsConditions', CheckboxType::class, array(
			        'label'    => 'I agree to the terms and conditions:',
			        'required' => 'true',
			        'data' => true, ) );
	}

	/**
	 * {@inheritdoc}
	 */
	public function configureOptions( OptionsResolver $resolver ) {
		$resolver->setDefaults( [
			'data_class' => 'Escapism\DefaultBundle\Entity\NewsletterSignup',
		] );
	}

	/**
	 * {@inheritdoc}
	 */
	public function getBlockPrefix() {
		return 'newsletter_signup';
	}


}
