<?php


namespace FOS\UserBundle\EventIdentifier;


use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * The REGISTRATION_FAILURE event occurs when the registration form is not valid.
 *
 * This event allows you to set the response instead of using the default one.
 * The event listener method receives a FOS\UserBundle\Event\FormEvent instance.
 *
 * @Event("FOS\UserBundle\Event\FormEvent")
 */
class RegistrationFailure extends FormEvent
{
    public function __construct(FormInterface $form, Request $request)
    {
        parent::__construct($form, $request);
    }
}