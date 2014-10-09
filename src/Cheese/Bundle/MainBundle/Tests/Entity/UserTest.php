<?php

namespace Cheese\Bundle\MainBundle\Tests\Entity;

use Cheese\Bundle\MainBundle\Entity\User;

/**
 * Description of UserTest
 *
 * @author marcin
 */
class UserTest extends \PHPUnit_Framework_TestCase
{
    public function testNewUser() 
    {
        $user = new User('mail', 23, '123423');
        
        $this->assertInstanceOf('Cheese\Bundle\MainBundle\Entity\User', $user);
    }
}
