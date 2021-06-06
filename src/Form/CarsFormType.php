<?php

namespace App\Form;

use App\Entity\CarBodys;
use App\Entity\Cars;
use App\Entity\Engines;
use App\Entity\Marks;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('marks',EntityType::class, [
                'class' => Marks::class
            ])
            ->add('engines',EntityType::class, [
                'class' => Engines::class
            ])
            ->add('carBodys',EntityType::class, [
                'class' => CarBodys::class
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cars::class,
        ]);
    }
}
