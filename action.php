<?php
function generateHeader($headerTitle = "Landing Constructor", $headerLogo = "", array $headerLinks = [
    "Home" => "index.php",
    "About" => "about.php"
])
{
    $header = new Header($headerTitle, $headerLogo, $headerLinks);
    echo $header->draw();
}
function generateLandingPreview()
{
    $landingPreview = <<<EOD
<div class="landing__result">
    <h2>The previous result:</h2>
    <hr>
    <a href="landing.zip" class="design" download>Download the result</a>
    <a href="landing/index.html" class="design" target="_blank">Check up the result in the new tab</a>
    <iframe width="100%" height="550px" src="./landing/index.html"></iframe>
</div>
EOD;
    echo $landingPreview;
}
function generateHeroAndLandingSection()
{
    echo <<<EOD
<section class="hero animate__animated animate__backInLeft">
        <div class="container">
    <div class="hero__wrap">
        <div class="hero__content">
            <h1>Welcome to our free Landing Generator</h1>
            <p>Unleash the Full Potential of Your Creative Concepts and Watch Them Materialize into Spectacular Realities through the Expertise and Excellence of Our Comprehensive Construction Services.</p>
            <a href="#landing" class="btn btn-primary btn-hero">Get Started</a>
        </div>
        <img class="hero__image" src="./assets/images/hero-image.jpg" alt="hero image">
    </div>
    </div>
</section>
<section class="landing" id="landing">
    <div class="container">
        <div class="landing__wrap">
            <h2 class="landing__title">Create your complete website for free right here</h2>
            <form class="landing__form amount form" enctype="multipart/form-data" action="{$_SERVER['PHP_SELF']}"
                method="get">
                <div class="landing__number">
                    <h4>Enter the amount of blocks that you want: </h4>
                    <input type="number" name="blocks-amount" value="2" placeholder="Enter the amount of blocks: "
                        class="form-control" required/>
                </div>
                <input type="submit" name="submitB" value="Generate Landing" class="btn btn-primary" id="ok"/>
            </form>
        </div>
    </div>
</section>
EOD;
}
function generateAskForm($amount)
{
    $askFormGenerator = new AskFormGenerator($amount);
    $askFormGenerator->generateForm();
    $askFormGenerator->printForm();
}
function generatePageBlocksForm($blockTypes)
{
    $blocksFormGenerator = new PageBlocksFormGenerator($blockTypes);
    $blocksFormGenerator->generateForm();
    $blocksFormGenerator->printForm();
}
function generateFooter($footerCopyright = "All rights reserved by Bohdan Shcherbak!")
{
    $footer = new Footer($footerCopyright);
    echo $footer->draw();
}