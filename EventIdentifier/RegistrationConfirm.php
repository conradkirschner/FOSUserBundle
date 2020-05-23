<?php


namespace FOS\UserBundle\EventIdentifier;


use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * The REGISTRATION_CONFIRM event occurs just before confirming the account.
 *
 * This event allows you to access the user which will be confirmed.
 *
 * @Event("FOS\UserBundle\Event\GetResponseUserEvent")
 */
class RegistrationConfirm extends GetResponseUserEvent
{
    public function __construct(UserInterface $user, Request $request = null)
    {
        parent::__construct($user, $request);
    }
}