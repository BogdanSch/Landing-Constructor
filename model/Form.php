<?php
class Form extends Block {
    private $value;
    function __construct($value) {
        $this->value = $value;
    }
    public function draw() {
        $str = <<<EOD
     <!-------------Блок "Form"-------------------------->
    <div class="form">        
        <form action="send.php" method="post">
            <input type="hidden" name="MAX_FILE_SIZE" value="30000" /> 
            <h3>Записаться</h3>    
            <div class="form__name">
                <input type="text" placeholder="Введите имя" class="design">
            </div>
            <div class="form__gmail">
                <input type="email" placeholder="Введите email" class="design">  
            </div>
            <input type="submit" name="submitB" value="{$this->value}" class="design" />
        </form> 
    </div>
    <!-------------Конец блока "Form"-------------------->\n
EOD;
        return $str;
    }
}
