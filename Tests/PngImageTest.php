<?php

namespace HeatMap\Tests;

use HeatMap\Color;
use HeatMap\PngImage;

class PngImageTest extends \PHPUnit_Framework_TestCase
{
    /** @var  PngImage */
    private $pngImage;

    public function setUp(){
        $this->pngImage = new PngImage(100, 100);
    }

    public function testCanInstantiate(){
        $this->assertInstanceOf(PngImage::class, $this->pngImage);
    }

    public function testSetPixelWithXLowerThanZeroThrowsException(){
        $this->expectException(\InvalidArgumentException::class);
        $this->pngImage->setPixel(-1, 0, Color::fromHex('#123456'));
    }

    public function testSetPixelWithXHigherThanImageWidthThrowsException(){
        $this->expectException(\InvalidArgumentException::class);
        $this->pngImage->setPixel(101, 0, Color::fromHex('#123456'));
    }

    public function testSetPixelWithYLowerThanZeroThrowsException(){
        $this->expectException(\InvalidArgumentException::class);
        $this->pngImage->setPixel(0, -1, Color::fromHex('#123456'));
    }

    public function testSetPixelWithYHigherThanImageWidthThrowsException(){
        $this->expectException(\InvalidArgumentException::class);
        $this->pngImage->setPixel(0, 101, Color::fromHex('#123456'));
    }

    public function testCanSaveImageFile(){
        $fileName = __DIR__.'/test.png';
        $this->pngImage->save($fileName);
        $this->assertTrue(file_exists($fileName));
        unlink($fileName);
        $this->assertFalse(file_exists($fileName));
    }

    public function tearDown(){
        $this->pngImage->destroy();
        unset($this->pngImage);
    }
}
