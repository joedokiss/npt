<?php
namespace Lib;

class Validation{

    //the list shall be organised via CSV reading
    public static $nodesList = ['A','B','C','D','E','F'];

    public static function validation($input){
        $input = explode(' ', $input);

        $startPoint = strtoupper($input[0]);
        $endPoint = strtoupper($input[1]);
        $latency = (int)$input[2];

        //input parameters via CLI must be valid
        self::inputIsValid($input);
        //start and end points must be in the defined list and not the same
        self::nodeIsValid($startPoint, $endPoint);
        //latency shall be positive
        self::latencyIsValid($latency);
    }

    public static function inputIsValid($input){
        
    }

    public static function nodeIsValid($start, $end){
        
    }

    public static function latencyIsValid($latency){

    }
}