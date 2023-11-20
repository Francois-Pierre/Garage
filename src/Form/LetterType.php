<?php

namespace App\Form;

use App\Entity\Letter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LetterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Firstname', null, ['label' => 'Prénom'],)
            ->add('Name', null, ['label' => 'Nom'],)
            ->add('Mail', null, ['label' => 'e-mail'],)
            ->add('Phone', null, ['label' => 'Téléphone'],)
            ->add('Text', null, ['label' => 'Message'],)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Letter::class,
        ]);
    }
}
