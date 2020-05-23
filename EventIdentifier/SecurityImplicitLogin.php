<?php


namespace FOS\UserBundle\EventIdentifier;

use FOS\UserBundle\Event\UserEvent;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * The SECURITY_IMPLICIT_LOGIN event occurs when the user is logged in programmatically.
 *
 * This event allows you to access the response which will be sent.
 *
 * @Event("FOS\UserBundle\Event\UserEvent")
 */
class SecurityImplicitLogin extends UserEvent
{
    public function __construct(UserInterface $user, Request $request = null)
    {
        parent::__construct($user, $request);
    }
}