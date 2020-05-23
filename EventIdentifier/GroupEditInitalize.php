<?php


namespace FOS\UserBundle\EventIdentifier;


use FOS\UserBundle\Event\GetResponseGroupEvent;
use FOS\UserBundle\Model\GroupInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * The GROUP_EDIT_INITIALIZE event occurs when the group editing process is initialized.
 *
 * This event allows you to modify the default values of the user before binding the form.
 *
 * @Event("FOS\UserBundle\Event\GetResponseGroupEvent")
 */
class GroupEditInitalize extends GetResponseGroupEvent
{
    public function __construct(GroupInterface $group, Request $request)
    {
        parent::__construct($group, $request);
    }

}