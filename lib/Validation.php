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
        if (count($input) !== 3){
            throw new \Exception("Please ues whitespace to separate each segment");
        }
    }

    public static function nodeIsValid($start, $end){
        if (!in_array($start,self::$nodesList)){
            throw new \Exception("The start point is not valid");
        }

        if (!in_array($end,self::$nodesList)) {
            throw new \Exception("The end point is not valid");
        }

        if ($start === $end){
            throw new \Exception("Start and End points are duplicated");
        }
    }

    public static function latencyIsValid($latency){

        if ($latency < 0){
            throw new \Exception("The latency shall be positive");
        }
    }
}