<?php

class Image
{
    private $image;
    function __construct($image)
    {
        $this->image = $image;
    }
    public function draw()
    {
        $str = <<<EOD
            <img src="{$this->image}" alt=\"image" class="content-image">
        EOD;
        return $str;
    }
}