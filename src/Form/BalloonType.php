<?php

namespace App\Form;

use App\Entity\Balloon;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BalloonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('isActive', CheckboxType::class, ['required' => false])
            ->add('price', NumberType::class, ['scale' => 2])
            ->add('color', EntityType::class, [
                'class' => 'App\Entity\Color',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('color')
                        ->andWhere('color.isActive = :value')->setParameter('value', true)
                        ->orderBy('color.name', 'ASC');
                },
                'choice_label' => 'name',
                'placeholder' => '',
            ])
            ->add('colorType', EntityType::class, [
                'class' => 'App\Entity\ColorType',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('colorType')
                        ->andWhere('colorType.isActive = :value')->setParameter('value', true)
                        ->orderBy('colorType.name', 'ASC');
                },
                'choice_label' => 'name',
                'placeholder' => '',
            ])
            ->add('diameter', EntityType::class, [
                'class' => 'App\Entity\Diameter',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('diameter')
                        ->andWhere('diameter.isActive = :value')->setParameter('value', true)
                        ->orderBy('diameter.name', 'ASC');
                },
                'choice_label' => 'name',
                'placeholder' => '',
            ])
            ->add('material', EntityType::class, [
                'class' => 'App\Entity\Material',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('material')
                        ->andWhere('material.isActive = :value')->setParameter('value', true)
                        ->orderBy('material.name', 'ASC');
                },
                'choice_label' => 'name',
                'placeholder' => '',
            ])
            ->add('printType', EntityType::class, [
                'class' => 'App\Entity\PrintType',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('printType')
                        ->andWhere('printType.isActive = :value')->setParameter('value', true)
                        ->orderBy('printType.name', 'ASC');
                },
                'choice_label' => 'name',
                'placeholder' => '',
            ])
            ->add('shape', EntityType::class, [
                'class' => 'App\Entity\Shape',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('shape')
                        ->andWhere('shape.isActive = :value')->setParameter('value', true)
                        ->orderBy('shape.name', 'ASC');
                },
                'choice_label' => 'name',
                'placeholder' => '',
            ])
            ->add('supplier', EntityType::class, [
                'class' => 'App\Entity\Supplier',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('supplier')
                        ->andWhere('supplier.isActive = :value')->setParameter('value', true)
                        ->orderBy('supplier.name', 'ASC');
                },
                'choice_label' => 'name',
                'placeholder' => '',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Balloon::class,
        ]);
    }
}
