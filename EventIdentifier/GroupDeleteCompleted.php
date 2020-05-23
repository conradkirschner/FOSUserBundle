<?php


namespace FOS\UserBundle\EventIdentifier;


use FOS\UserBundle\Event\FilterGroupResponseEvent;
use FOS\UserBundle\Model\GroupInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * The GROUP_DELETE_COMPLETED event occurs after deleting the group.
 *
 * This event allows you to access the response which will be sent.
 *
 * @Event("FOS\UserBundle\Event\FilterGroupResponseEvent")
 */
class GroupDeleteCompleted extends FilterGroupResponseEvent
{
    public function __construct(GroupInterface $group, Request $request, Response $response)
    {
        parent::__construct($group, $request, $response);
    }
}