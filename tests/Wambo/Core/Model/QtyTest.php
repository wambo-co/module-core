<?php

namespace Wambo\Core\Model;

use PHPUnit\Framework\TestCase;

class QtyTest extends TestCase
{
    public function testUseOfQtyModel()
    {
        // arrange

        // act
        $qty = new Qty(2);

        // assert
        $this->assertEquals($qty->getValue(), 2);
    }
}