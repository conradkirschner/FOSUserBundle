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

use FOS\UserBundle\EventIdentifier\ChangePasswordCompleted;
use FOS\UserBundle\EventIdentifier\GroupCreateCompleted;
use FOS\UserBundle\EventIdentifier\GroupDeleteCompleted;
use FOS\UserBundle\EventIdentifier\GroupEditCompleted;
use FOS\UserBundle\EventIdentifier\ProfileEditCompleted;
use FOS\UserBundle\EventIdentifier\RegistrationComplete;
use FOS\UserBundle\EventIdentifier\ResettingResetCompleted;
use Symfony\Contracts\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Translation\DataCollectorTranslator;

class FlashListener implements EventSubscriberInterface
{
    /**
     * @var string[]
     */
    private static $successMessages = [
        ChangePasswordCompleted::class => 'change_password.flash.success',
        GroupCreateCompleted::class => 'group.flash.created',
        GroupDeleteCompleted::class => 'group.flash.deleted',
        GroupEditCompleted::class => 'group.flash.updated',
        ProfileEditCompleted::class => 'profile.flash.updated',
        RegistrationComplete::class => 'registration.flash.user_created',
        ResettingResetCompleted::class => 'resetting.flash.success',
    ];

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * FlashListener constructor.
     */
    public function __construct(SessionInterface $session, TranslatorInterface $translator)
    {
        $this->session = $session;
        $this->translator = $translator;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            ChangePasswordCompleted::class => 'addSuccessFlash',
            GroupCreateCompleted::class => 'addSuccessFlash',
            GroupDeleteCompleted::class => 'addSuccessFlash',
            GroupEditCompleted::class => 'addSuccessFlash',
            ProfileEditCompleted::class => 'addSuccessFlash',
            RegistrationComplete::class => 'addSuccessFlash',
            ResettingResetCompleted::class => 'addSuccessFlash',
        ];
    }

    /**
     * @param string $eventName
     */
    public function addSuccessFlash(Event $event, $eventName)
    {
        if (!isset(self::$successMessages[$eventName])) {
            throw new \InvalidArgumentException('This event does not correspond to a known flash message');
        }

        $this->session->getFlashBag()->add('success', $this->trans(self::$successMessages[$eventName]));
    }

    /**
     * @param string$message
     *
     * @return string
     */
    private function trans($message, array $params = [])
    {
        return $this->translator->trans($message, $params, 'FOSUserBundle');
    }
}
