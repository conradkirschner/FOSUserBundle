<?php


namespace FOS\UserBundle\EventIdentifier;

use FOS\UserBundle\Event\UserEvent;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * The USER_CREATED event occurs when the user is created with UserManipulator.
 *
 * This event allows you to access the created user and to add some behaviour after the creation.
 *
 * @Event("FOS\UserBundle\Event\UserEvent")
 */
class UserCreated extends UserEvent
{
    public function __construct(UserInterface $user, Request $request = null)
    {
        parent::__construct($user, $request);
    }
}