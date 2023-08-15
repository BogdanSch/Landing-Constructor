<?php

class Heading extends Block
{
	private $heading_text;
    public function __construct($heading_text) {
    	$this->heading_text = $heading_text;
    }
	public function draw()
    {
        $str = <<<EOD
        <!-------------Block "Heading"-------------------------->
        <h1 class='heading'>        
            {$this->heading_text}
        </h1>
        <!-------------End "Heading"-------------------->\n
EOD;
        return $str;
    }
}
