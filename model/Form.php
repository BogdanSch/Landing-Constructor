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
            <label for="">Sign in</label> 
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            <div class="form__name">
                <label for="user_name">User name</label>
                <input name="user_name" type="text" class="form-control">
            </div>
            <div class="form__gmail">
                <label for="email">Email address</label>
                <input type="email" name="email class="form-control">  
            </div>
            <input type="submit" name="submitB" value="{$this->value}" class="btn btn-primary" />
        </form> 
    </div>
    <!-------------End of Block "Form"-------------------->\n
EOD;
        return $str;
    }
}
