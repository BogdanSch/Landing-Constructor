<?php
require_once("autoload.php");
$header = new Header("Landing Constructor");
echo $header->draw();

if (empty($_REQUEST)) {
    echo <<<EOD
    <div class="landing-amount">
        <div class="container">
            <div class="landing__wrap">
                <form class="landing__form amount form" enctype="multipart/form-data" action="{$_SERVER['PHP_SELF']}"
                    method="get">
                    <div class="landing__number">
                        <h4>Enter the amount of blocks: </h4>
                        <input type="number" name="blocks-amount" value="2" placeholder="Enter the amount of blocks"
                            class="design"/>
                    </div>
                    <input type="submit" name="submitB" value="Generate landing" class="design" id="ok" />
                </form>
            </div>
        </div>
    </div> 
EOD;
}
elseif (isset($_GET['blocks-amount'])) {
    $ask_generator = new AskFormGenerator($_GET['blocks-amount']);
    $ask_generator->generate_form();
    $ask_generator->print_form();
}
elseif(isset($_POST['blocks-types'])){
    $blocks_generator = new PageBlocksFormGenerator($_POST);
    $blocks_generator->generate_form();
    $blocks_generator->print_form();
}

$footer = new Footer("All rights reserved by Bohdan Shcherbak!");
echo $footer->draw();