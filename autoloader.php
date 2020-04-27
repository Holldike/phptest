<?php

spl_autoload_register(function ($className) {
    $fileName = str_replace("\\", DIRECTORY_SEPARATOR, $className);
    include 'src' . DIRECTORY_SEPARATOR . $fileName . '.php';
});