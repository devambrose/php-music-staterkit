<?php

class config{
    public $name="music";
    public $host="localhost";
    public $user="dev";
    public $port="3306";
    public $password="password";
}

class stringManager{
    function __construct(){
        $this->cont= [];
    }
    function generalTags($cont){
        $this->cont[]=$cont;
    }
    function toString(){
        return implode(" ",$this->cont);
    }
}
