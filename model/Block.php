<?php
abstract class Block {
    protected $on;
    protected $name;
    function __construct($name) {
        $this->name = $name;
    }
    public abstract function draw();
}
