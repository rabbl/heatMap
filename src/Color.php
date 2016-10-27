<?php

namespace HeatMap;

class Color
{
    /** @var int */
    protected $r;

    /** @var int */
    protected $g;

    /** @var int */
    protected $b;

    /** @var float */
    protected $a;

    private final function __construct(){}

    public static function fromHex(string $hex, float $a = 1){

        $hex = ltrim($hex, '#');
        if (! ctype_xdigit($hex)){
            throw new \InvalidArgumentException(sprintf('Given value %s is no a HEX-Value.', $hex));
        }

        $instance = new self;
        list($instance->r, $instance->g, $instance->b) = sscanf($hex, "%02x%02x%02x");
        $instance->a = $a;

        return $instance;
    }

    /**
     * @return int
     */
    public function getR(){
        return $this->r;
    }

    /**
     * @return int
     */
    public function getG(){
        return $this->g;
    }

    /**
     * @return int
     */
    public function getB(){
        return $this->b;
    }

    /**
     * @return int
     */
    public function getA(){
        return $this->a;
    }
}
