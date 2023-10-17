<?php

class Image
{
    private $image;
    function __construct($image, $alt="image")
    {
        $this->image = $image;
    }
    public function draw()
    {
        $str = <<<EOD
            <img src="{$this->image}" alt="'.$this->image.'" class="content-image">
        EOD;
        return $str;
    }
}