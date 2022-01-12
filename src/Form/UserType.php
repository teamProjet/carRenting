<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', null , [
                'label' => false,
                'attr' => [
                    'class' => 'inputInscription',
                    'placeholder' => 'Email',
                ]],
                )
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les mot de passe renseignés doivent être identiques.',
                'options' => ['attr' => [
                    'class' => 'inputInscription',
                    'placeholder' => 'Mot de Passe',
                ]],
                'required' => true,
                'first_options'  => ['label' => false],
                'second_options' => ['label' => false],

            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
