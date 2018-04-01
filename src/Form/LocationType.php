<?php

namespace App\Form;

use App\Entity\Location;
use Doctrine\ORM\EntityRepository;
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
                'class' => 'App\Entity\LocationType',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('locationType')
                        ->andWhere('locationType.isActive = :param')
                        ->setParameter('param', true)
                        ->orderBy('locationType.name', 'ASC');
                },
                'choice_label' => 'name',
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
