<?php

namespace App\Form;

use App\Entity\Location;
use App\Entity\LocationType as TipLokacije;
use App\Repository\LocationTypeRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('percentage', IntegerType::class)
            ->add('isActive', CheckboxType::class, ['required' => false])
            ->add('locationType', EntityType::class, [
                'class' => TipLokacije::class,
                'choice_label' => 'name',
                'placeholder' => '',
                'query_builder' => function (LocationTypeRepository $repo) {
                    return $repo->findAllActive();
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Location::class,
        ]);
    }
}
