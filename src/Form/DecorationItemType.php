<?php

namespace App\Form;

use App\Entity\Balloon;
use App\Entity\DecorationItem;
use App\Repository\BalloonRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DecorationItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('price', NumberType::class, [
                'attr' => ['readonly' => 'readonly'],
            ])
            ->add('quantity', IntegerType::class)
            ->add('isActive', CheckboxType::class, ['required' => false])
            ->add('balloon', EntityType::class, [
                'class' => Balloon::class,
                'choice_label' => 'name',
                'placeholder' => '',
                'query_builder' => function (BalloonRepository $repo) {
                    return $repo->findAllActive();
                },
                'choice_attr' => function (Balloon $balloon, $key, $index) {
                    return ['data-price' => $balloon->getPrice()];
                }
            ])
            ->remove('decoration')
            ->add('total', NumberType::class, [
                'attr' => ['readonly' => 'readonly'],
                'mapped' => false,
                'scale' => 2,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DecorationItem::class,
        ]);
    }
}
