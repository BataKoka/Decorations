<?php

namespace App\Form;

use App\Entity\Celebration;
use App\Entity\Location;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Form\EventListener\LocationChangeInCelebrationsFormListener;

class CelebrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('isActive', CheckboxType::class, ['required' => false])
            ->add('locationPercentage', IntegerType::class, [
                'attr' => ['readonly' => 'readonly'],
            ])
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                // prevents rendering it as type="date", to avoid HTML5 date pickers
                'html5' => false,
                // adds a class that can be selected in JavaScript + readonly attr
                'attr' => [
                    'class' => 'js-datepicker',
                    'readonly' => 'readonly',
                ],
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
            ])
            ->add('revenue', IntegerType::class)
            ->add('workerExpense', IntegerType::class)
            ->add('transportExpense', IntegerType::class)
            ->add('celebrationType', EntityType::class, [
                'class' => 'App\Entity\CelebrationType',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('celebrationType')
                        ->andWhere('celebrationType.isActive = :value')->setParameter('value', true)
                        ->orderBy('celebrationType.name', 'ASC');
                },
                'choice_label' => 'name',
                'placeholder' => '',
            ])
            ->add('location', EntityType::class, [
                'class' => 'App\Entity\Location',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('location')
                        ->andWhere('location.isActive = :value')->setParameter('value', true)
                        ->orderBy('location.name', 'ASC');
                },
                'choice_label' => 'name',
                'placeholder' => '',
                'choice_attr' => function (Location $location, $key, $index) {
                    return ['data-percentage' => $location->getPercentage()];
                },
            ])
//            ->addEventSubscriber(new LocationChangeInCelebrationsFormListener())
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Celebration::class,
        ]);
    }
}
