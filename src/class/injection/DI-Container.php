<?php

namespace Inc\Class\Injection;

use Exception;
use ReflectionClass;
use ReflectionNamedType;
use Inc\Interface\Container\ContainerInterface;

class DI_Container implements ContainerInterface {
    public function get( $id ) {
        return $this->resolve( $id );
    }

    public function has( $id ): bool {
        return class_exists( $id );
    }

    protected function resolve( $class ) {
        $reflectionClass = new ReflectionClass( $class );
        $constructor     = $reflectionClass->getConstructor();

        if ( !$constructor ) {
            return new $class();
        }

        $parameters   = $constructor->getParameters();
        $dependencies = array();

        if ( !$parameters ) {
            return new $class();
        }

        foreach ( $parameters as $parameter ) {
            $dependencyClass = $parameter->getType();

            if ( !$dependencyClass ) {
                throw new Exception( "Class Perameters Do Not have any Type Hint" );
            }

            if ( $dependencyClass instanceof ReflectionNamedType && !$dependencyClass->isBuiltin() ) {
                $dependencies[] = $this->resolve( $dependencyClass->getName() );
            } else {
                throw new Exception( 'Class Do not have classified Depenency' );
            }
        }

        return $reflectionClass->newInstanceArgs( $dependencies );
    }
}