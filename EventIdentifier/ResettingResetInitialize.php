<?php


namespace FOS\UserBundle\EventIdentifier;


use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * The RESETTING_RESET_INITIALIZE event occurs when the resetting process is initialized.
 *
 * This event allows you to set the response to bypass the processing.
 *
 * @Event("FOS\UserBundle\Event\GetResponseUserEvent")
 */
class ResettingResetInitialize extends GetResponseUserEvent
{
    public function __construct(UserInterface $user, Request $request = null)
    {
        parent::__construct($user, $request);
    }
}