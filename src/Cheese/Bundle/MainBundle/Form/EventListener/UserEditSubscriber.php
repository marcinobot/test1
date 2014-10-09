<?php
namespace Cheese\Bundle\MainBundle\Form\EventListener;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UserEditSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(FormEvents::PRE_SET_DATA => 'preSetData');
    }

    public function preSetData(FormEvent $event)
    {
        $user = $event->getData();
        $form = $event->getForm();
        
        if (!empty($user) && !empty($user->getId()) && (int)$user->getId() > 0) {
            $form->add('email', 'text', array(
                'label' => 'Insert e-mail *',
                'disabled' => true));
        }
    }
}

