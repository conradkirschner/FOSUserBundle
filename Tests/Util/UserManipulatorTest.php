<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FOS\UserBundle\Tests\Util;

use FOS\UserBundle\EventIdentifier\UserActivated;
use FOS\UserBundle\EventIdentifier\UserCreated;
use FOS\UserBundle\EventIdentifier\UserDeactivated;
use FOS\UserBundle\EventIdentifier\UserDemoted;
use FOS\UserBundle\EventIdentifier\UserPasswordChanged;
use FOS\UserBundle\EventIdentifier\UserPromoted;
use FOS\UserBundle\Tests\TestUser;
use FOS\UserBundle\Util\UserManipulator;
use PHPUnit\Framework\TestCase;

class UserManipulatorTest extends TestCase
{
    public function testCreate()
    {
        $userManagerMock = $this->getMockBuilder('FOS\UserBundle\Model\UserManagerInterface')->getMock();
        $user = new TestUser();

        $username = 'test_username';
        $password = 'test_password';
        $email = 'test@email.org';
        $active = true; // it is enabled
        $superadmin = false;

        $userManagerMock->expects($this->once())
            ->method('createUser')
            ->will($this->returnValue($user));

        $userManagerMock->expects($this->once())
            ->method('updateUser')
            ->will($this->returnValue($user))
            ->with($this->isInstanceOf('FOS\UserBundle\Tests\TestUser'));

        $eventDispatcherMock = $this->getEventDispatcherMock(UserCreated::class, true);

        $requestStackMock = $this->getRequestStackMock(true);

        $manipulator = new UserManipulator($userManagerMock, $eventDispatcherMock, $requestStackMock);
        $manipulator->create($username, $password, $email, $active, $superadmin);

        $this->assertSame($username, $user->getUsername());
        $this->assertSame($password, $user->getPlainPassword());
        $this->assertSame($email, $user->getEmail());
        $this->assertSame($active, $user->isEnabled());
        $this->assertSame($superadmin, $user->isSuperAdmin());
    }

    public function testActivateWithValidUsername()
    {
        $userManagerMock = $this->getMockBuilder('FOS\UserBundle\Model\UserManagerInterface')->getMock();
        $username = 'test_username';

        $user = new TestUser();
        $user->setUsername($username);
        $user->setEnabled(false);

        $userManagerMock->expects($this->once())
            ->method('findUserByUsername')
            ->will($this->returnValue($user))
            ->with($this->equalTo($username));

        $userManagerMock->expects($this->once())
            ->method('updateUser')
            ->will($this->returnValue($user))
            ->with($this->isInstanceOf('FOS\UserBundle\Tests\TestUser'));

        $eventDispatcherMock = $this->getEventDispatcherMock(UserActivated::class, true);

        $requestStackMock = $this->getRequestStackMock(true);

        $manipulator = new UserManipulator($userManagerMock, $eventDispatcherMock, $requestStackMock);
        $manipulator->activate($username);

        $this->assertSame($username, $user->getUsername());
        $this->assertTrue($user->isEnabled());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testActivateWithInvalidUsername()
    {
        $userManagerMock = $this->getMockBuilder('FOS\UserBundle\Model\UserManagerInterface')->getMock();
        $invalidusername = 'invalid_username';

        $userManagerMock->expects($this->once())
            ->method('findUserByUsername')
            ->will($this->returnValue(null))
            ->with($this->equalTo($invalidusername));

        $userManagerMock->expects($this->never())
            ->method('updateUser');

        $eventDispatcherMock = $this->getEventDispatcherMock(UserActivated::class, false);

        $requestStackMock = $this->getRequestStackMock(false);

        $manipulator = new UserManipulator($userManagerMock, $eventDispatcherMock, $requestStackMock);
        $manipulator->activate($invalidusername);
    }

    public function testDeactivateWithValidUsername()
    {
        $userManagerMock = $this->getMockBuilder('FOS\UserBundle\Model\UserManagerInterface')->getMock();
        $username = 'test_username';

        $user = new TestUser();
        $user->setUsername($username);
        $user->setEnabled(true);

        $userManagerMock->expects($this->once())
            ->method('findUserByUsername')
            ->will($this->returnValue($user))
            ->with($this->equalTo($username));

        $userManagerMock->expects($this->once())
            ->method('updateUser')
            ->will($this->returnValue($user))
            ->with($this->isInstanceOf('FOS\UserBundle\Tests\TestUser'));

        $eventDispatcherMock = $this->getEventDispatcherMock(UserDeactivated::class, true);

        $requestStackMock = $this->getRequestStackMock(true);

        $manipulator = new UserManipulator($userManagerMock, $eventDispatcherMock, $requestStackMock);
        $manipulator->deactivate($username);

        $this->assertSame($username, $user->getUsername());
        $this->assertFalse($user->isEnabled());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testDeactivateWithInvalidUsername()
    {
        $userManagerMock = $this->getMockBuilder('FOS\UserBundle\Model\UserManagerInterface')->getMock();
        $invalidusername = 'invalid_username';

        $userManagerMock->expects($this->once())
            ->method('findUserByUsername')
            ->will($this->returnValue(null))
            ->with($this->equalTo($invalidusername));

        $userManagerMock->expects($this->never())
            ->method('updateUser');

        $eventDispatcherMock = $this->getEventDispatcherMock(UserDeactivated::class, false);

        $requestStackMock = $this->getRequestStackMock(false);

        $manipulator = new UserManipulator($userManagerMock, $eventDispatcherMock, $requestStackMock);
        $manipulator->deactivate($invalidusername);
    }

    public function testPromoteWithValidUsername()
    {
        $userManagerMock = $this->getMockBuilder('FOS\UserBundle\Model\UserManagerInterface')->getMock();
        $username = 'test_username';

        $user = new TestUser();
        $user->setUsername($username);
        $user->setSuperAdmin(false);

        $userManagerMock->expects($this->once())
            ->method('findUserByUsername')
            ->will($this->returnValue($user))
            ->with($this->equalTo($username));

        $userManagerMock->expects($this->once())
            ->method('updateUser')
            ->will($this->returnValue($user))
            ->with($this->isInstanceOf('FOS\UserBundle\Tests\TestUser'));

        $eventDispatcherMock = $this->getEventDispatcherMock(UserPromoted::class, true);

        $requestStackMock = $this->getRequestStackMock(true);

        $manipulator = new UserManipulator($userManagerMock, $eventDispatcherMock, $requestStackMock);
        $manipulator->promote($username);

        $this->assertSame($username, $user->getUsername());
        $this->assertTrue($user->isSuperAdmin());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testPromoteWithInvalidUsername()
    {
        $userManagerMock = $this->getMockBuilder('FOS\UserBundle\Model\UserManagerInterface')->getMock();
        $invalidusername = 'invalid_username';

        $userManagerMock->expects($this->once())
            ->method('findUserByUsername')
            ->will($this->returnValue(null))
            ->with($this->equalTo($invalidusername));

        $userManagerMock->expects($this->never())
            ->method('updateUser');

        $eventDispatcherMock = $this->getEventDispatcherMock(UserPromoted::class, false);

        $requestStackMock = $this->getRequestStackMock(false);

        $manipulator = new UserManipulator($userManagerMock, $eventDispatcherMock, $requestStackMock);
        $manipulator->promote($invalidusername);
    }

    public function testDemoteWithValidUsername()
    {
        $userManagerMock = $this->getMockBuilder('FOS\UserBundle\Model\UserManagerInterface')->getMock();
        $username = 'test_username';

        $user = new TestUser();
        $user->setUsername($username);
        $user->setSuperAdmin(true);

        $userManagerMock->expects($this->once())
            ->method('findUserByUsername')
            ->will($this->returnValue($user))
            ->with($this->equalTo($username));

        $userManagerMock->expects($this->once())
            ->method('updateUser')
            ->will($this->returnValue($user))
            ->with($this->isInstanceOf('FOS\UserBundle\Tests\TestUser'));

        $eventDispatcherMock = $this->getEventDispatcherMock(UserDemoted::class, true);

        $requestStackMock = $this->getRequestStackMock(true);

        $manipulator = new UserManipulator($userManagerMock, $eventDispatcherMock, $requestStackMock);
        $manipulator->demote($username);

        $this->assertSame($username, $user->getUsername());
        $this->assertFalse($user->isSuperAdmin());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testDemoteWithInvalidUsername()
    {
        $userManagerMock = $this->getMockBuilder('FOS\UserBundle\Model\UserManagerInterface')->getMock();
        $invalidusername = 'invalid_username';

        $userManagerMock->expects($this->once())
            ->method('findUserByUsername')
            ->will($this->returnValue(null))
            ->with($this->equalTo($invalidusername));

        $userManagerMock->expects($this->never())
            ->method('updateUser');

        $eventDispatcherMock = $this->getEventDispatcherMock(UserDemoted::class, false);

        $requestStackMock = $this->getRequestStackMock(false);

        $manipulator = new UserManipulator($userManagerMock, $eventDispatcherMock, $requestStackMock);
        $manipulator->demote($invalidusername);
    }

    public function testChangePasswordWithValidUsername()
    {
        $userManagerMock = $this->getMockBuilder('FOS\UserBundle\Model\UserManagerInterface')->getMock();

        $user = new TestUser();
        $username = 'test_username';
        $password = 'test_password';
        $oldpassword = 'old_password';

        $user->setUsername($username);
        $user->setPlainPassword($oldpassword);

        $userManagerMock->expects($this->once())
            ->method('findUserByUsername')
            ->will($this->returnValue($user))
            ->with($this->equalTo($username));

        $userManagerMock->expects($this->once())
            ->method('updateUser')
            ->will($this->returnValue($user))
            ->with($this->isInstanceOf('FOS\UserBundle\Tests\TestUser'));

        $eventDispatcherMock = $this->getEventDispatcherMock(UserPasswordChanged::class, true);

        $requestStackMock = $this->getRequestStackMock(true);

        $manipulator = new UserManipulator($userManagerMock, $eventDispatcherMock, $requestStackMock);
        $manipulator->changePassword($username, $password);

        $this->assertSame($username, $user->getUsername());
        $this->assertSame($password, $user->getPlainPassword());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testChangePasswordWithInvalidUsername()
    {
        $userManagerMock = $this->getMockBuilder('FOS\UserBundle\Model\UserManagerInterface')->getMock();

        $invalidusername = 'invalid_username';
        $password = 'test_password';

        $userManagerMock->expects($this->once())
            ->method('findUserByUsername')
            ->will($this->returnValue(null))
            ->with($this->equalTo($invalidusername));

        $userManagerMock->expects($this->never())
            ->method('updateUser');

        $eventDispatcherMock = $this->getEventDispatcherMock(UserPasswordChanged::class, false);

        $requestStackMock = $this->getRequestStackMock(false);

        $manipulator = new UserManipulator($userManagerMock, $eventDispatcherMock, $requestStackMock);
        $manipulator->changePassword($invalidusername, $password);
    }

    public function testAddRole()
    {
        $userManagerMock = $this->getMockBuilder('FOS\UserBundle\Model\UserManagerInterface')->getMock();
        $username = 'test_username';
        $userRole = 'test_role';
        $user = new TestUser();

        $userManagerMock->expects($this->exactly(2))
            ->method('findUserByUsername')
            ->will($this->returnValue($user))
            ->with($this->equalTo($username));

        $eventDispatcherMock = $this->getMockBuilder('Symfony\Component\EventDispatcher\EventDispatcherInterface')->getMock();
        $requestStackMock = $this->getRequestStackMock(false);

        $manipulator = new UserManipulator($userManagerMock, $eventDispatcherMock, $requestStackMock);

        $this->assertTrue($manipulator->addRole($username, $userRole));
        $this->assertFalse($manipulator->addRole($username, $userRole));
        $this->assertTrue($user->hasRole($userRole));
    }

    public function testRemoveRole()
    {
        $userManagerMock = $this->getMockBuilder('FOS\UserBundle\Model\UserManagerInterface')->getMock();
        $username = 'test_username';
        $userRole = 'test_role';
        $user = new TestUser();
        $user->addRole($userRole);

        $userManagerMock->expects($this->exactly(2))
            ->method('findUserByUsername')
            ->will($this->returnValue($user))
            ->with($this->equalTo($username));

        $eventDispatcherMock = $this->getMockBuilder('Symfony\Component\EventDispatcher\EventDispatcherInterface')->getMock();
        $requestStackMock = $this->getRequestStackMock(false);

        $manipulator = new UserManipulator($userManagerMock, $eventDispatcherMock, $requestStackMock);

        $this->assertTrue($manipulator->removeRole($username, $userRole));
        $this->assertFalse($user->hasRole($userRole));
        $this->assertFalse($manipulator->removeRole($username, $userRole));
    }

    /**
     * @param string $event
     * @param bool   $once
     *
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getEventDispatcherMock($event, $once = true)
    {
        $eventDispatcherMock = $this->getMockBuilder('Symfony\Component\EventDispatcher\EventDispatcherInterface')->getMock();

        $eventDispatcherMock->expects($once ? $this->once() : $this->never())
            ->method('dispatch')
            ->with($event);

        return $eventDispatcherMock;
    }

    /**
     * @param bool $once
     *
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getRequestStackMock($once = true)
    {
        $requestStackMock = $this->getMockBuilder('Symfony\Component\HttpFoundation\RequestStack')->getMock();

        $requestStackMock->expects($once ? $this->once() : $this->never())
            ->method('getCurrentRequest')
            ->willReturn(null);

        return $requestStackMock;
    }
}
