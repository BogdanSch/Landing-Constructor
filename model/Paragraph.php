<?php
class Paragraph extends Block {
    private $paragraph_text;
    function __construct($text) {
        $this->paragraph_text = $text;
    }
    public function draw() {
        $str = <<<EOD
     <!-------------Блок "Text"-------------------------->
    <div class='text'>        
       {$this->paragraph_text}
    </div>
    <!-------------Кінець блоку "Text"-------------------->\n
EOD;
        return $str;
    }
}
