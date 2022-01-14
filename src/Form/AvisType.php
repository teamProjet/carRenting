<?php

namespace App\Form;

use App\Entity\Avis;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class AvisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('nom', null,)
            // ->add('prenom', null,)
            ->add('note', null,['attr' => ['placeholder' => 'donner une note']],)
            ->add('commentaire', null,['attr' => ['placeholder' => 'ecrire votre commentaire']],)
            // ->add('dateCreation', DateTimeType::class, array('input' => 'datetime_immutable',))
            // ->add('user')
            // ->add('car')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Avis::class,
        ]);
    }
}
