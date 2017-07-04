<?php

/**
 * Created by PhpStorm.
 * User: naffiq
 * Date: 7/4/17
 * Time: 17:29
 */

use naffiq\randomorg\DrawService;
use naffiq\randomorg\Draw;
use naffiq\randomorg\DrawResponse;

class DrawServiceTest extends \PHPUnit\Framework\TestCase
{
    private $_login;
    private $_password;

    protected function setUp()
    {
        parent::setUp();

        $this->_login = getenv('RANDOMORG_LOGIN');
        $this->_password = getenv('RANDOMORG_PASSWORD');
    }


    public function testConstructor()
    {
        $service = new DrawService($this->_login, $this->_password);

        $this->assertNotNull($service);
    }

    public function testRequiredLoginAndPassword()
    {
        $this->expectExceptionMessage('You have to specify login and password to Random.org service');
        new DrawService('', $this->_password);
    }

    public function testNewDraw()
    {
        $service = new DrawService($this->_login, $this->_password);

        $draw = $service->newDraw('Test', 1, [1,2,3,4], 1, 'test');
        $this->assertInstanceOf(Draw::class, $draw);
    }

    public function testHoldDraw()
    {
        $service = new DrawService($this->_login, $this->_password);

        $draw = $service->newDraw('Test', 2, [
            1, 2, 3
        ], 1, 'test');

        $result = $service->holdDraw($draw);

        $this->assertNotEmpty($result);
        $this->assertInstanceOf(DrawResponse::class, $result);
        $this->assertCount(1, $result->getWinners());
        $this->assertNull($result->getDrawId());
        $this->assertEquals('test', $result->getStatus());
        $this->assertEquals(3, $result->getEntryCount());
        $this->assertNotNull($result->getCompletionTime());
        $this->assertNull($result->getRecordUrl());
        $this->assertEquals(2, $result->getId());
    }
}