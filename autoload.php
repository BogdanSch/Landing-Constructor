<?php
function autoload_models($className) {
    $fileName = "app/model/".$className.".php";
    include $fileName;
}
function autoload_controllers($className) {
    $fileName = "app/controller/".$className.".php";
    include $fileName;
}

spl_autoload_register ("autoload_models");
spl_autoload_register ("autoload_controllers");