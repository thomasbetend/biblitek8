<?php

namespace App\Form;

use App\Entity\IdealBibliotheque;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IdealBibliothequeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('book1')
            ->add('book2')
            ->add('book3')
            ->add('book4')
            ->add('book5')
            ->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => IdealBibliotheque::class,
        ]);
    }
}
