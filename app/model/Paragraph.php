<?php
class Paragraph extends Block
{
    private $paragraph_text;
    function __construct($text)
    {
        $this->paragraph_text = $text;
    }
    public function draw()
    {
        $str = <<<EOD
     <!-------------Block "Paragraph"-------------------------->
    <div class='text'>        
       {$this->paragraph_text}
    </div>
    <!-------------End "Paragraph"-------------------->\n
EOD;
        return $str;
    }
}