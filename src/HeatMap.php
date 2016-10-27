<?php

namespace HeatMap;

class HeatMap
{
    /** @var  RainbowVis */
    protected $rainbowVis;

    /** @var array $spectrum */
    protected $spectrum = array('purple', 'red', 'yellow', 'lime', 'aqua', 'blue');

    /**
     * HeatMap constructor.
     */
    public function __construct(){}

    /**
     * @param array $spectrum
     * @return $this
     */
    public function setSpectrum(array $spectrum){
        $this->spectrum = $spectrum;
        return $this;
    }

    public function createWithAbsoluteLimits(array $data, float $min, float $max){

        if (! $this->isData2d($data)){
            throw new \InvalidArgumentException('Given data does not have 2 Dimensions');
        }

        $height = count($data);
        $width = count($data[0]);

        $rainbowVis = new RainbowVis($this->spectrum, $min, $max);
        $pngImage = new PngImage($width, $height);

        foreach ($data as $rKey => $row){
            foreach ($row as $cKey => $value){
                if (! is_null($value)){
                    $hex = $rainbowVis->colorAt($value);
                    $pngImage->setPixel($cKey, $rKey, Color::fromHex($hex));
                }
            }
        }

        $fileName = tempnam(sys_get_temp_dir(), 'heads');
        $pngImage->save($fileName);
        $pngImage->destroy();

        return $fileName;
    }

    public function createWithPercentileLimits(array $data, float $lowerPercentile, float $upperPercentile){
        if (! $this->isData2d($data)){
            throw new \InvalidArgumentException('Given data does not have 2 Dimensions');
        }

        $allValues = [];

        foreach ($data as $rKey => $row){
            foreach ($row as $cKey => $value){
                if (! is_null($value)){
                    array_push($allValues, $value);
                }
            }
        }

        usort($allValues, function($a, $b) {
            return ($a < $b) ? -1 : 1;
        });

        $min = $allValues[(int)count($allValues)/100*$lowerPercentile];
        $max = $allValues[(int)count($allValues)/100*$upperPercentile-1];
        unset($allValues);

        return $this->createWithAbsoluteLimits($data, $min, $max);
    }

    private function isData2d(array $data){
        return is_array($data) && is_array($data[0]) && !is_array($data[0][0]);
    }
}
