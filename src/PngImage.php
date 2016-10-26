<?php

namespace HeatMap;

class PngImage
{

    protected $image;

    protected $width;

    protected $height;

    public function __construct(int $width, int $height)
    {
        $this->width = $width;
        $this->height = $height;
        $this->image = imagecreatetruecolor($width, $height);
        imagealphablending($this->image, false);
        imagesavealpha($this->image, true);

        $color = imagecolorallocatealpha($this->image, 255, 255, 255, 127);
        imagefill($this->image, 0, 0, $color);

    }

    public function setPixel(int $x, int $y, Color $color){
        if ($x < 0 || $x >= $this->width){
            throw new \InvalidArgumentException(sprintf('The value for x= %s is out of range (%s, %s)', $x, 0, $this->width-1));
        }

        if ($y < 0 || $y >= $this->height){
            throw new \InvalidArgumentException(sprintf('The value for x= %s is out of range (%s, %s)', $x, 0, $this->height-1));
        }

        $allocatedColor = imagecolorallocatealpha($this->image, $color->getR(), $color->getG(), $color->getB(), $color->getA());
        imagesetpixel($this->image, $x, $y, $allocatedColor);
    }

    public function save(string $fileName){
        return imagepng($this->image, $fileName);
    }

    public function destroy(){
        return imagedestroy($this->image);
    }
}