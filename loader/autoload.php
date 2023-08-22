<?php

function classAutoloader( $class ) {
    $prefix   = 'Inc\\';
    $base_dir = dirname( dirname( __FILE__ ) ) . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR;

    $class = ( str_contains( $class, '_' ) ) ? str_replace( '_', '-', $class ) : $class;

    $class = substr( $class, strlen( $prefix ) );
    $class = str_replace( '\\', DIRECTORY_SEPARATOR, $class );

    if ( preg_match( '/([^\\\\]+)$/', $class, $matches ) ) {
        $dirname = rtrim( $class, $matches[0] );
    }

    $full_path = $base_dir . strtolower( $dirname ) . $matches[0] . '.php';

    if ( file_exists( $full_path ) ) {
        require_once $full_path;
    }
}

spl_autoload_register( "classAutoloader" );