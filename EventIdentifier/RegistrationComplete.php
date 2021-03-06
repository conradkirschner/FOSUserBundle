<?php


namespace FOS\UserBundle\EventIdentifier;


use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * The REGISTRATION_COMPLETED event occurs after saving the user in the registration process.
 *
 * This event allows you to access the response which will be sent.
 *
 * @Event("FOS\UserBundle\Event\FilterUserResponseEvent")
 */
class RegistrationComplete extends FilterUserResponseEvent
{
    /**
     * FilterUserResponseEvent constructor.
     */
    public function __construct(UserInterface $user, Request $request, Response $response)
    {
        parent::__construct($user, $request, $response);
    }

}