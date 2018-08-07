<?php

namespace App\Form;

use App\Entity\PointOfInterest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PointOfInterestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $values = array_flip(PointOfInterest::getTypes());

        $builder
            ->add('name', TextType::class, [
                'required' => true,
                'label' => 'Name',
                'translation_domain' => false,
            ])
            ->add('type', ChoiceType::class, [
                'required' => true,
                'label' => 'Type',
                'translation_domain' => false,
                'choices' => $values,
            ])
            ->add('coords', TextType::class, [
                'required' => true,
                'label' => 'Coordinates (format: X,Y,Z)',
                'translation_domain' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PointOfInterest::class,
        ]);
    }
}