<?php


namespace FOS\UserBundle\EventIdentifier;

use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * The RESETTING_SEND_EMAIL_CONFIRM event occurs when all prerequisites to send email are
 * confirmed and before the mail is sent.
 *
 * This event allows you to set the response to bypass the email sending.
 * The event listener method receives a FOS\UserBundle\Event\GetResponseUserEvent instance.
 *
 * @Event("FOS\UserBundle\Event\GetResponseUserEvent")
 */
class ResettingSendEmailConfirm extends GetResponseUserEvent
{
    public function __construct(UserInterface $user, Request $request = null)
    {
        parent::__construct($user, $request);
    }
}