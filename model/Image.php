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
        <!-------------Block "Image"-------------------------->
            <img src="{$this->image}" alt="image" class="content-image">
        <!-------------The end of block "Image"-------------------------->
EOD;
        return $str;
    }
}