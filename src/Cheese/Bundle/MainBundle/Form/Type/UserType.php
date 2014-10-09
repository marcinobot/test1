<?php

namespace Cheese\Bundle\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Cheese\Bundle\MainBundle\Form\EventListener\UserEditSubscriber;

/**
 * UserType
 */
class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', 'text', array('label' => 'Insert e-mail *'))
            ->add('dateOfBirth', 'text', array('label' => 'DOB *'))
            ->add('accountNumber', 'text', array('label' => 'Account Number *'))
            ->add('save', 'submit', array('label' => 'submit', 
                'attr' => ['class' => 'button']));
       
        $builder->addEventSubscriber(new UserEditSubscriber());
    }

    public function getName()
    {
        return 'user';
    }
}
