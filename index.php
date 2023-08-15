<?php
require_once("autoload.php");

generateHeader();

if (isset($_GET['blocks-amount'])) {
    generateAskForm($_GET['blocks-amount']);
} elseif (isset($_POST['blocks-types'])) {
    $blockTypes = $_POST;
    generatePageBlocksForm($blockTypes);
} else {
    generateHeroAndLandingSection();
}
if (!Model::is_dir_empty("landing/")) {
    generateLandingPreview();
}

generateFooter();