<?php
require_once("autoload.php");
IndexPage::generateHeader();

if (isset($_GET['blocks-amount'])) {
    IndexPage::generateAskForm($_GET['blocks-amount']);
} elseif (isset($_POST['blocks-types'])) {
    $blockTypes = $_POST;
    IndexPage::generatePageBlocksForm($blockTypes);
} else {
    IndexPage::generateMainPage();
}
if (!Model::is_dir_empty("landing/")) {
    IndexPage::generateLandingPreview();
}

IndexPage::generateFooter();