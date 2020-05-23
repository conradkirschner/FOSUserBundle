<?php


namespace FOS\UserBundle\EventIdentifier;

use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * The PROFILE_EDIT_INITIALIZE event occurs when the profile editing process is initialized.
 *
 * This event allows you to modify the default values of the user before binding the form.
 *
 * @Event("FOS\UserBundle\Event\GetResponseUserEvent")
 */
class ProfileEditInitialize extends GetResponseUserEvent
{
    public function __construct(UserInterface $user, Request $request = null)
    {
        parent::__construct($user, $request);
    }
}