<?php


namespace FOS\UserBundle\EventIdentifier;


use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ChangePasswordCompleted extends FilterUserResponseEvent
{
    /**
     * FilterUserResponseEvent constructor.
     */
    public function __construct(UserInterface $user, Request $request, Response $response)
    {
        parent::__construct($user, $request, $response);
    }

}