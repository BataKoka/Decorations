<?php

namespace App\Form;

use App\Entity\Balloon;
use App\Entity\Color;
use App\Entity\ColorType;
use App\Entity\Diameter;
use App\Entity\Material;
use App\Entity\PrintType;
use App\Entity\Shape;
use App\Entity\Supplier;
use App\Repository\ColorRepository;
use App\Repository\ColorTypeRepository;
use App\Repository\DiameterRepository;
use App\Repository\MaterialRepository;
use App\Repository\PrintTypeRepository;
use App\Repository\ShapeRepository;
use App\Repository\SupplierRepository;
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
                'class' => Color::class,
                'choice_label' => 'name',
                'placeholder' => '',
                'query_builder' => function (ColorRepository $repo) {
                    return $repo->findAllActive();
                }
            ])
            ->add('colorType', EntityType::class, [
                'class' => ColorType::class,
                'choice_label' => 'name',
                'placeholder' => '',
                'query_builder' => function (ColorTypeRepository $repo) {
                    return $repo->findAllActive();
                }
            ])
            ->add('diameter', EntityType::class, [
                'class' => Diameter::class,
                'choice_label' => 'name',
                'placeholder' => '',
                'query_builder' => function (DiameterRepository $repo) {
                    return $repo->findAllActive();
                }
            ])
            ->add('material', EntityType::class, [
                'class' => Material::class,
                'choice_label' => 'name',
                'placeholder' => '',
                'query_builder' => function (MaterialRepository $repo) {
                    return $repo->findAllActive();
                }
            ])
            ->add('printType', EntityType::class, [
                'class' => PrintType::class,
                'choice_label' => 'name',
                'placeholder' => '',
                'query_builder' => function (PrintTypeRepository $repo) {
                    return $repo->findAllActive();
                }
            ])
            ->add('shape', EntityType::class, [
                'class' => Shape::class,
                'choice_label' => 'name',
                'placeholder' => '',
                'query_builder' => function (ShapeRepository $repo) {
                    return $repo->findAllActive();
                }
            ])
            ->add('supplier', EntityType::class, [
                'class' => Supplier::class,
                'choice_label' => 'name',
                'placeholder' => '',
                'query_builder' => function (SupplierRepository $repo) {
                    return $repo->findAllActive();
                }
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
