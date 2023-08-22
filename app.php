<?php

require_once __DIR__ . '/loader/autoload.php';

use Inc\Class\MyClass;
use Inc\Class\Injection\DI_Container;

( function () {
    $container = new DI_Container();
    $myClass   = $container->get( MyClass::class );

    $myClass->loader();
} )();
