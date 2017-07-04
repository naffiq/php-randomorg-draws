<?php

/**
 * Created by PhpStorm.
 * User: naffiq
 * Date: 7/4/17
 * Time: 17:23
 */

use naffiq\randomorg\Draw;

class DrawTest extends \PHPUnit\Framework\TestCase
{
    public function testNewRecord()
    {
        $draw = new Draw('Test', 1, [1,2,3,4], 1, 'test');

        $this->assertEquals(1, $draw->getId());
    }

    public function testEntries()
    {
        $draw = new Draw('Test', 1, [1], 1, 'test');

        $draw->pushEntry(2);

        $this->assertEquals(2, $draw->getEntriesCount());

        $draw->setEntries([1, 2, [3]]);
        $this->assertEquals(3, $draw->getEntriesCount());
    }
}