<?php

namespace HeatMap\Tests;


use HeatMap\HeatMap;

class HeatMapTest extends \PHPUnit_Framework_TestCase
{

    public function setUp(){}

    public function testCanInstantiate(){
        $this->assertInstanceOf(HeatMap::class, new HeatMap());
    }

    public function testSetColorSpectrum(){
        $spectrum = array('blue', 'green', 'black');
        $heatMap = new HeatMap();
        $this->assertInstanceOf(HeatMap::class, $heatMap->setSpectrum($spectrum));
    }

    public function testCreateWithAbsoluteLimitsAnd1DDataArrayThrowsException(){
        $this->expectException(\InvalidArgumentException::class);
        $data = array(1,2,3);
        $heatMap = new HeatMap();
        $heatMap->createWithAbsoluteLimits($data, 1, 3);
    }

    public function testCreateWithAbsoluteLimitsAnd3DDataArrayThrowsException(){
        $this->expectException(\InvalidArgumentException::class);
        $data = array([[1,2,3],[1,2,3],[1,2,3]]);
        $heatMap = new HeatMap();
        $heatMap->createWithAbsoluteLimits($data, 1, 3);
    }

    public function testCreateWithAbsoluteLimitsAnd2DDataArrayThrowsException(){
        $data = array([1,2,3],[1,2,3],[1,2,3]);
        $heatMap = new HeatMap();
        $fileName = $heatMap->createWithAbsoluteLimits($data, 1, 3);
        $this->assertTrue(is_file($fileName));
        unlink($fileName);
    }

    public function testCreateWithPercentileLimitsAnd1DDataArrayThrowsException(){
        $this->expectException(\InvalidArgumentException::class);
        $data = array(1,2,3);
        $heatMap = new HeatMap();
        $heatMap->createWithPercentileLimits($data, 1, 3);
    }

    public function testCreateWithPercentileLimitsAnd3DDataArrayThrowsException(){
        $this->expectException(\InvalidArgumentException::class);
        $data = array([[1,2,3],[1,2,3],[1,2,3]]);
        $heatMap = new HeatMap();
        $heatMap->createWithPercentileLimits($data, 1, 3);
    }

    public function testCreateWithPercentileLimitsAnd2DDataArrayThrowsException(){
        $data = array([-1,2,3],[1,2,5],[1,2,3]);
        $heatMap = new HeatMap();
        $fileName = $heatMap->createWithPercentileLimits($data, 5, 95);
        $this->assertTrue(is_file($fileName));
        unlink($fileName);
    }
}
