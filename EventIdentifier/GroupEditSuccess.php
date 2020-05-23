<?php


namespace FOS\UserBundle\EventIdentifier;

use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * The GROUP_EDIT_SUCCESS event occurs when the group edit form is submitted successfully.
 *
 * This event allows you to set the response instead of using the default one.
 *
 * @Event("FOS\UserBundle\Event\FormEvent")
 */
class GroupEditSuccess extends FormEvent
{
    public function __construct(FormInterface $form, Request $request)
    {
        parent::__construct($form, $request);
    }
}