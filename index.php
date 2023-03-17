<?php
require_once("autoload.php");
$header = new Header("Landing Constructor", "", "php");
$block_types = [];
echo $header->draw();
$landing_preview = <<<EOD
<div class="landing__result">
<h2>Result</h2>
<hr>
<a href="landing.zip" class="design" download>Download the result</a>
<a href="landing/index.html" class="design" target="_blank">Check up the result in the new tab</a>
<iframe width="100%" height="550px" src="./landing/index.html"></iframe>
</div>
EOD;
if (empty($_REQUEST)) {
    echo <<<EOD
    <div class="landing-amount">
        <div class="container">
            <div class="landing__wrap">
                <h1>Welcome to our free Landing Generator</h1>
                <form class="landing__form amount form" enctype="multipart/form-data" action="{$_SERVER['PHP_SELF']}"
                    method="get">
                    <div class="landing__number">
                        <h4>Enter the amount of blocks: </h4>
                        <input type="number" name="blocks-amount" value="2" placeholder="Enter the amount of blocks"
                            class="form-control"/>
                    </div>
                    <input type="submit" name="submitB" value="Generate landing" class="btn btn-primary" id="ok" />
                </form>
            </div>
        </div>
    </div> 
EOD;
    if(!Model::is_dir_empty("landing/")) 
        echo $landing_preview;
}
elseif (isset($_GET['blocks-amount'])) {
    $ask_generator = new AskFormGenerator($_GET['blocks-amount']);
    $ask_generator->generate_form();
    $ask_generator->print_form();
    if(!Model::is_dir_empty("landing/")) 
        echo $landing_preview;
}
elseif(isset($_POST['blocks-types'])){
    $block_types = $_POST;
    $blocks_generator = new PageBlocksFormGenerator($block_types);
    $blocks_generator->generate_form();
    $blocks_generator->print_form();
    if(!Model::is_dir_empty("landing/")) 
        echo $landing_preview;
}
elseif(isset($_GET['result'])){
    echo $landing_preview;
}

$footer = new Footer("All rights reserved by Bohdan Shcherbak!");
echo $footer->draw();