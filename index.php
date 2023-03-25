<?php
require_once("autoload.php");
$header = new Header("Landing Constructor", "", "php");
$block_types = [];
echo $header->draw();
$landing_preview = <<<EOD
<div class="landing__result">
<h2>The previous result:</h2>
<hr>
<a href="landing.zip" class="design" download>Download the result</a>
<a href="landing/index.html" class="design" target="_blank">Check up the result in the new tab</a>
<iframe width="100%" height="550px" src="./landing/index.html"></iframe>
</div>
EOD;

if (empty($_REQUEST)) {
    echo <<<EOD
    <section class="hero animate__animated animate__backInLeft">
        <div class="hero__wrap">
            <div class="hero__content">
                <h1>Welcome to our free Landing Generator</h1>
                <p>Transform your ideas into reality with our construction services.</p>
                <a href="#landing" class="btn btn-primary btn-hero">Get Started</a>
            </div>
            <img class="hero__image" src="images/hero-image.jpg" alt="hero-image">
        </div>
    </section>
    <section class="landing" id="landing">
        <div class="container">
            <div class="landing__wrap">
                <h2>Create your free website here</h2>
                <form class="landing__form amount form" enctype="multipart/form-data" action="{$_SERVER['PHP_SELF']}"
                    method="get">
                    <div class="landing__number">
                        <h4>Enter the amount of blocks: </h4>
                        <input type="number" name="blocks-amount" value="2" placeholder="Enter the amount of blocks"
                            class="form-control" required/>
                    </div>
                    <input type="submit" name="submitB" value="Generate landing" class="btn btn-primary" id="ok" />
                </form>
            </div>
        </div>
    </section> 
EOD;
} elseif (isset($_GET['blocks-amount'])) {
    $ask_generator = new AskFormGenerator($_GET['blocks-amount']);
    $ask_generator->generate_form();
    $ask_generator->print_form();
} elseif (isset($_POST['add-block']) && isset($_POST['currentAmountBlocks'])) {
    $ask_generator = new AskFormGenerator($_POST['currentAmountBlocks'] + 1);
    $ask_generator->generate_form();
    $ask_generator->print_form();
} elseif (isset($_POST['blocks-types'])) {
    $block_types = $_POST;
    $blocks_generator = new PageBlocksFormGenerator($block_types);
    $blocks_generator->generate_form();
    $blocks_generator->print_form();
}
if (!Model::is_dir_empty("landing/")) {
    echo $landing_preview;
}

$footer = new Footer("All rights reserved by Bohdan Shcherbak!");
echo $footer->draw();