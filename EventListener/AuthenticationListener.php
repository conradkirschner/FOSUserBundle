<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FOS\UserBundle\EventListener;

use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\UserEvent;
use FOS\UserBundle\EventIdentifier\RegistrationComplete;
use FOS\UserBundle\EventIdentifier\RegistrationConfirmed;
use FOS\UserBundle\EventIdentifier\ResettingResetCompleted;
use FOS\UserBundle\EventIdentifier\SecurityImplicitLogin;
use FOS\UserBundle\Security\LoginManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Exception\AccountStatusException;

class AuthenticationListener implements EventSubscriberInterface
{
    /**
     * @var LoginManagerInterface
     */
    private $loginManager;

    /**
     * @var string
     */
    private $firewallName;

    /**
     * AuthenticationListener constructor.
     *
     * @param string $firewallName
     */
    public function __construct(LoginManagerInterface $loginManager, $firewallName)
    {
        $this->loginManager = $loginManager;
        $this->firewallName = $firewallName;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            RegistrationComplete::class => 'authenticate',
            RegistrationConfirmed::class => 'authenticate',
            ResettingResetCompleted::class=> 'authenticate',
        ];
    }

    /**
     * @param string $eventName
     */
    public function authenticate(FilterUserResponseEvent $event, $eventName, EventDispatcherInterface $eventDispatcher)
    {
        try {
            $this->loginManager->logInUser($this->firewallName, $event->getUser(), $event->getResponse());

            $eventDispatcher->dispatch(new SecurityImplicitLogin($event->getUser(), $event->getRequest()));
        } catch (AccountStatusException $ex) {
            // We simply do not authenticate users which do not pass the user
            // checker (not enabled, expired, etc.).
        }
    }
}
