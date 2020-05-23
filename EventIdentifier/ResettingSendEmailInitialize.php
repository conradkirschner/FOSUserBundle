<?php


namespace FOS\UserBundle\EventIdentifier;

use FOS\UserBundle\Event\GetResponseNullableUserEvent;
use FOS\UserBundle\Model\GroupInterface;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * The RESETTING_SEND_EMAIL_INITIALIZE event occurs when the send email process is initialized.
 *
 * This event allows you to set the response to bypass the email confirmation processing.
 * The event listener method receives a FOS\UserBundle\Event\GetResponseNullableUserEvent instance.
 *
 * @Event("FOS\UserBundle\Event\GetResponseNullableUserEvent")
 */
class ResettingSendEmailInitialize extends GetResponseNullableUserEvent
{
    public function __construct(UserInterface $user = null, Request $request)
    {
        parent::__construct($user, $request);
    }
}