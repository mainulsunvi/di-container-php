<?php

class Autoload {
    private string $prefix;
    private string $base_dir;
    private string $full_path;

    function __construct() {
        spl_autoload_register( array( $this, "classAutoloader" ) );

        $this->base_dir = dirname( dirname( __FILE__ ) ) . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR;
        $this->prefix   = 'Inc\\';
    }

    function classAutoloader( $className ) {

        $className = ( str_contains( $className, '_' ) ) ? str_replace( '_', '-', $className ) : $className;

        $className = substr( $className, strlen( $this->prefix ) );
        $className = str_replace( '\\', DIRECTORY_SEPARATOR, $className );

        if ( preg_match( '/([^\\\\]+)$/', $className, $matches ) ) {
            $dirname = rtrim( $className, $matches[0] );
        }

        $this->full_path = $this->base_dir . strtolower( $dirname ) . $matches[0] . '.php';

        if ( file_exists( $this->full_path ) ) {
            require_once $this->full_path;
        }
    }
}

if ( class_exists( 'Autoload' ) ) {
    new Autoload();
}