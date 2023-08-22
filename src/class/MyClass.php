<?php

namespace Inc\Class;

class MyClass {
    private $your_class;
    private $his_class;
    private $expl;

    public function __construct( YourClass $dependency, HisClass $his, Exp_Test $exp ) {
        $this->your_class = $dependency;
        $this->his_class  = $his;
        $this->expl       = $exp;
    }

    function loader() {
        $this->your_class->doSomething();
        $this->his_class->doNow();
        $this->expl->printExplode();
    }
}