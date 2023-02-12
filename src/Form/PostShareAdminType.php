<?php

namespace App\Form;

use App\Entity\PostShare;
use App\Repository\PostShareRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostShareAdminType extends AbstractType
{
    public function __construct(private PostShareRepository $postShareRepository)
    {
        
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $postShares = $this->postShareRepository->findAll(); 

        $builder
            ->add('description', ChoiceType::class, [
                'placeholder' => 'Déjà écrits',
                'choices' => array_combine($postShares, $postShares)
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PostShare::class,
        ]);
    }
}
