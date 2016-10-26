<?php

namespace HeatMap\Tests;

use HeatMap\Color;

class ColorTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {}

    public function testCanInstantiate(){
        $color = Color::fromHex('#812dd3');
        $this->assertInstanceOf(Color::class, $color);
    }

    public function testCanInstantiateWithHtmlHexValue(){
        $color = Color::fromHex('#812dd3');
        $this->assertInstanceOf(Color::class, $color);
        $this->assertEquals(129, $color->getR());
        $this->assertEquals(45, $color->getG());
        $this->assertEquals(211, $color->getB());
        $this->assertEquals(1, $color->getA());
    }

    public function testCanInstantiateWithHexValue(){
        $color = Color::fromHex('812dd3');
        $this->assertInstanceOf(Color::class, $color);
        $this->assertEquals(129, $color->getR());
        $this->assertEquals(45, $color->getG());
        $this->assertEquals(211, $color->getB());
        $this->assertEquals(1, $color->getA());
    }

    public function testCanInstantiateAlpha(){
        $color = Color::fromHex('812dd3', 0.2);
        $this->assertInstanceOf(Color::class, $color);
        $this->assertEquals(129, $color->getR());
        $this->assertEquals(45, $color->getG());
        $this->assertEquals(211, $color->getB());
        $this->assertEquals(0.2, $color->getA());
    }
}
