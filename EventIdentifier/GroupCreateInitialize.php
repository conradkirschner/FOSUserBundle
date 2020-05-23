<?php


namespace FOS\UserBundle\EventIdentifier;


use FOS\UserBundle\Event\GroupEvent;
use FOS\UserBundle\Model\GroupInterface;
use Symfony\Component\HttpFoundation\Request;

class GroupCreateInitialize extends GroupEvent
{
    /**
     * FormEvent constructor.
     */
    public function __construct(GroupInterface $group, Request $request)
    {
        parent::__construct($group, $request);
    }
}