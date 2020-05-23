<?php


namespace FOS\UserBundle\EventIdentifier;

use FOS\UserBundle\Event\GetResponseUserEvent;
use Symfony\Component\HttpFoundation\Request;

/**
 * The RESETTING_SEND_EMAIL_COMPLETED event occurs after the email is sent.
 *
 * This event allows you to set the response to bypass the the redirection after the email is sent.
 * The event listener method receives a FOS\UserBundle\Event\GetResponseUserEvent instance.
 *
 * @Event("FOS\UserBundle\Event\GetResponseUserEvent")
 */
class ResettingSendEmailCompleted extends GetResponseUserEvent
{
    public function __construct(UserInterface $user, Request $request = null)
    {
        parent::__construct($user, $request);
    }
}