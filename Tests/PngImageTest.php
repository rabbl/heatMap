<?php

namespace HeatMap\Tests;

use HeatMap\PngImage;

class PngImageTest extends \PHPUnit_Framework_TestCase
{

    public function setUp(){}

    public function testCanInstantiate(){
        $this->assertInstanceOf(PngImage::class, new PngImage(100,100));
    }

    public function testCanSaveImageFile(){
        $fileName = __DIR__.'/test.png';

        $pngImage = new PngImage(100, 100);
        $pngImage->save($fileName);
        $this->assertTrue(file_exists($fileName));
        unlink($fileName);
        $this->assertFalse(file_exists($fileName));
    }
}
