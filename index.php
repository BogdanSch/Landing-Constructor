<?php
require_once("autoload.php");
$header = new Header("Landing Constructor");
$block_types = [];
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
    $block_types = $_POST;
    $blocks_generator = new PageBlocksFormGenerator($block_types);
    $blocks_generator->generate_form();
    $blocks_generator->print_form();
}
elseif(isset($_GET['result'])){
    echo '<div class="landing__result">
    <h2>Result</h2>
    <hr>
    <a href="landing.zip" class="design" download>Download the result</a>
    <a href="landing/index.html" class="design" target="_blank">Check up the result in the new tab</a>
    <iframe width="900px" height="550px" src="./landing/index.html"></iframe>
</div>';
}

$footer = new Footer("All rights reserved by Bohdan Shcherbak!");
echo $footer->draw();