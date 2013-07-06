<?php

$includePath = array(
    __DIR__,
    __DIR__ . '/app/code/community/',
    __DIR__ . '/app/',
    __DIR__ . '/lib/',
    get_include_path()
);
set_include_path(implode(PATH_SEPARATOR, $includePath));
require_once 'lib/MageTest/autoload.php';
