<?php


namespace FOS\UserBundle\EventIdentifier;


use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class GroupCreateSuccess extends FormEvent
{
    public function __construct(FormInterface $form, Request $request)
    {
        parent::__construct($form, $request);
    }
}