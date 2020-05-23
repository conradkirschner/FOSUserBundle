<?php


namespace FOS\UserBundle\EventIdentifier;


use FOS\UserBundle\Event\UserEvent;
use Symfony\Component\HttpFoundation\Request;

/**
 * The USER_DEMOTED event occurs when the user is created with UserManipulator.
 *
 * This event allows you to access the demoted user and to add some behaviour after the demotion.
 *
 * @Event("FOS\UserBundle\Event\UserEvent")
 */
class UserDemoted extends UserEvent
{
    public function __construct(UserInterface $user, Request $request = null)
    {
        parent::__construct($user, $request);
    }
}