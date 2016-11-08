<?php

namespace HeatMap\Tests;

use HeatMap\RainbowVis;

class RainbowVisTest extends \PHPUnit_Framework_TestCase
{
    /** @var  RainbowVis */
    protected $rainbowVis;

    public function setUp()
    {}

    public function testCanInstantiate(){
        $this->rainbowVis = new RainbowVis(array('red', 'blue'), 10, 20);
        $this->assertInstanceOf(RainbowVis::class, $this->rainbowVis);
    }

    public function testInstantiateWithLessThanTwoColorsThrowsException(){
        $this->expectException(\InvalidArgumentException::class);
        $this->rainbowVis = new RainbowVis(array('black'), 10, 20);
    }

    public function testSetSpectrum(){
        $this->rainbowVis = new RainbowVis(array('red', 'blue'), 10, 20);
        $this->rainbowVis->setSpectrum('red', 'blue');
        $this->assertEquals(array('red', 'blue'), $this->rainbowVis->getSpectrum());
    }

    public function testCanDoColorAtWithTwoColorsAndSmallerValueThenMinReturnsMinColor(){
        $this->rainbowVis = new RainbowVis(array('black', 'white'), 10, 20);
        $this->assertEquals('000000', $this->rainbowVis->colorAt(5));
    }

    public function testCanDoColorAtWithTwoColorsAndBiggerValueThenMaxReturnsMaxColor(){
        $this->rainbowVis = new RainbowVis(array('black', 'white'), 10, 20);
        $this->assertEquals('ffffff', $this->rainbowVis->colorAt(25));
    }

    public function testCanDoColorAtWithTwoColors(){
        $this->rainbowVis = new RainbowVis(array('black', 'white'), 10, 20);
        $this->assertEquals('808080', $this->rainbowVis->colorAt(15));
    }

    public function testCanDoColorAtWithThreeColors(){
        $this->rainbowVis = new RainbowVis(array('black', 'white', 'blue'), 0, 40);
        $this->assertEquals('ffffff', $this->rainbowVis->colorAt(20));
        $this->assertEquals('808080', $this->rainbowVis->colorAt(10));
        $this->assertEquals('8080ff', $this->rainbowVis->colorAt(30));
    }
}
