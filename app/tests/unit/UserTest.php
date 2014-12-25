<?php

class UserTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
    }

    protected function tearDown()
    {
    }

    public function testYou()
    {
        $this->assertFalse(true);
    }

    // tests
    public function testMe()
    {
        $user = new User();
        $data = ['email'=>'asdf@asdf.com', 'password'=>"asdfsd"];
        $this->assertTrue($user->store($data));
        $this->assertFalse(true);
        $this->assertEquals($user->test(), "hack", "#############");
        $this->assertEquals(1, 2 );
    }

    public function testaaa()
    {
        $userController = new UserController();

        $this->assertEquals($userController->test(), "test", "#############");

        // $this->call();
    }

}