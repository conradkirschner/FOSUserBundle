<?php


namespace FOS\UserBundle\EventIdentifier;

use FOS\UserBundle\Event\UserEvent;
use Symfony\Component\HttpFoundation\Request;

/**
 * The USER_DEACTIVATED event occurs when the user is created with UserManipulator.
 *
 * This event allows you to access the deactivated user and to add some behaviour after the deactivation.
 *
 * @Event("FOS\UserBundle\Event\UserEvent")
 */
class UserDeactivated extends UserEvent
{
    public function __construct(UserInterface $user, Request $request = null)
    {
        parent::__construct($user, $request);
    }
}