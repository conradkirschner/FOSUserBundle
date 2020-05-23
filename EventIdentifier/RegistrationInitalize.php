<?php


namespace FOS\UserBundle\EventIdentifier;


use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Event\UserEvent;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * The REGISTRATION_INITIALIZE event occurs when the registration process is initialized.
 *
 * This event allows you to modify the default values of the user before binding the form.
 *
 * @Event("FOS\UserBundle\Event\UserEvent")
 */
class RegistrationInitalize extends UserEvent
{
    public function __construct(UserInterface $user, Request $request = null)
    {
        parent::__construct($user, $request);
    }
}