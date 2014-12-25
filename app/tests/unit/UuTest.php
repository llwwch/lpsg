<?php


class UuTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testMe()
    {
        $this->assertFalse(false);
    }

    public function testYou()
    {
        $this->assertFalse(true);
    }

}