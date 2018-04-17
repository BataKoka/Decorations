<?php

namespace App\Form;

use App\Entity\Celebration;
use App\Entity\CelebrationType as TipProslave;
use App\Entity\Location;
use App\Repository\CelebrationTypeRepository;
use App\Repository\LocationRepository;
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
                'class' => TipProslave::class,
                'choice_label' => 'name',
                'placeholder' => '',
                'query_builder' => function (CelebrationTypeRepository $repo) {
                    return $repo->findAllActive();
                }
            ])
            ->add('location', EntityType::class, [
                'class' => Location::class,
                'choice_label' => 'name',
                'placeholder' => '',
                'query_builder' => function (LocationRepository $repo) {
                    return $repo->findAllActive();
                },
                'choice_attr' => function (Location $location, $key, $index) {
                    return ['data-percentage' => $location->getPercentage()];
                }
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
