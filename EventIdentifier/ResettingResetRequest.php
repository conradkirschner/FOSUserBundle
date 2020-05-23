<?php


namespace FOS\UserBundle\EventIdentifier;


use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * The RESETTING_RESET_REQUEST event occurs when a user requests a password reset of the account.
 *
 * This event allows you to check if a user is locked out before requesting a password.
 * The event listener method receives a FOS\UserBundle\Event\GetResponseUserEvent instance.
 *
 * @Event("FOS\UserBundle\Event\GetResponseUserEvent")
 */
class ResettingResetRequest extends GetResponseUserEvent
{
    public function __construct(UserInterface $user, Request $request = null)
    {
        parent::__construct($user, $request);
    }
}