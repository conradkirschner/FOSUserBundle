<?php


namespace FOS\UserBundle\EventIdentifier;


use FOS\UserBundle\Event\FilterGroupResponseEvent;
use FOS\UserBundle\Model\GroupInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * The GROUP_CREATE_COMPLETED event occurs after saving the group in the group creation process.
 *
 * This event allows you to access the response which will be sent.
 *
 * @Event("FOS\UserBundle\Event\FilterGroupResponseEvent")
 */
class GroupCreateCompleted extends FilterGroupResponseEvent
{
    /**
     * FormEvent constructor.
     */
    public function __construct(GroupInterface $group, Request $request, Response $response)
    {
        parent::__construct($group, $request, $response);
    }
}