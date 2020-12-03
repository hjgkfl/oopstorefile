<?php

function classAutoloader ($class) {
    include_once $class . '.php';
}

spl_autoload_register('classAutoloader');
