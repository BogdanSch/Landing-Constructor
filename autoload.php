<?php
function autoload1($className) {
    $fileName = "model/".$className.'.php';
    include $fileName;
}
function autoload2($className) {
    $fileName = "controller/".$className.'.php';
    include $fileName;
}
spl_autoload_register ( "autoload1" );
spl_autoload_register ( "autoload2" );
