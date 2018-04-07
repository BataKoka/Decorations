<?php
/**
 * Created by PhpStorm.
 * User: Marko R
 * Date: 06/04/2018
 * Time: 20:08
 */

namespace App\Form\EventListener;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class LocationChangeInCelebrationsFormListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            FormEvents::PRE_SET_DATA => 'onPreSetData',
        ];
    }

    public function onPreSetData(FormEvent $event)
    {
        $data = $event->getData();
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
}