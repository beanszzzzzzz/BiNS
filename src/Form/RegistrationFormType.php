<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('firstName', TextType::class, [
                'label' => 'First Name',
                'constraints' => [
                    new NotBlank(['message' => 'Please enter a first name']),
                    new Length(['min' => 2, 'max' => 100]),
                ],
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Last Name',
                'constraints' => [
                    new NotBlank(['message' => 'Please enter a last name']),
                    new Length(['min' => 2, 'max' => 100]),
                ],
            ])
            ->add('phone', TextType::class, [
                'label' => 'Phone Number',
                'required' => false,
            ])
            ->add('roles', ChoiceType::class, [
                'label' => 'User Role',
                'choices' => [
                    'Admin' => 'ROLE_ADMIN',
                    'Manager' => 'ROLE_MANAGER',
                    'Cashier' => 'ROLE_CASHIER',
                    'Kitchen Staff' => 'ROLE_KITCHEN',
                    'General Staff' => 'ROLE_STAFF',
                ],
                'multiple' => true,
                'expanded' => true,
                'required' => true,
                'data' => ['ROLE_STAFF'], // Default role
            ])
            ->add('plainPassword', PasswordType::class, [
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}