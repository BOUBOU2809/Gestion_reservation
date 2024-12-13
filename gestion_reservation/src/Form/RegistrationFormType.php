<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Validator\Constraints\NotBlank;  // Importation correcte de la classe NotBlank
use Symfony\Component\Form\FormInterface;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'constraints' => [new NotBlank()] // Validation NotBlank pour l'email
            ])
            ->add('password', PasswordType::class, [
                'constraints' => [new NotBlank()] // Validation NotBlank pour le mot de passe
            ])
            ->add('name', TextType::class, [
                'constraints' => [new NotBlank()] // Validation NotBlank pour le nom
            ])
            ->add('phoneNumber', TelType::class, [
                'constraints' => [new NotBlank()] // Validation NotBlank pour le téléphone
            ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
