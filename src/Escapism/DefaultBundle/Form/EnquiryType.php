<?php

namespace Escapism\DefaultBundle\Form;

use Doctrine\ORM\Mapping\UniqueConstraint;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class EnquiryType extends AbstractType {
	/**
	 * {@inheritdoc}
	 */
	public function buildForm( FormBuilderInterface $builder, array $options ) {
		$builder->add( 'name', null, array(
					'required' => 'true',
					'constraints' => [
						new NotBlank(['message' => 'Name field cannot be empty']),
					],
					) )
		        ->add( 'email', EmailType::class, array(
			        'required' => 'true',
			        'constraints' => [
				        new NotBlank(['message' => 'Email field cannot be empty']),
				        new Email(['message' => 'Please enter a valid email']),
			        ],
					) )
		        ->add( 'subject', null, array(
			        'required' => 'true',
			        'constraints' => [
				        new NotBlank(['message' => 'Subject field cannot be empty']),
			        ],
		            ) )
		        ->add( 'usermessage', TextareaType::class, array(
			        'label'    => 'Message',
			        'required' => 'true',
			        'constraints' => [
				        new NotBlank(['message' => 'Message field cannot be empty']),
			        ],
		        ) )
		        ->add( 'spamCheck', CheckboxType::class, array(
			        'label'    => 'I am human:',
			        'required' => 'true',
			        'data' => false,
			        ) );
	}

	/**
	 * {@inheritdoc}
	 */
	public function configureOptions( OptionsResolver $resolver ) {
		$resolver->setDefaults( [
			'data_class' => 'Escapism\DefaultBundle\Entity\Enquiry',
		] );
	}

	/**
	 * {@inheritdoc}
	 */
	public function getBlockPrefix() {
		return 'enquiry';
	}


}
