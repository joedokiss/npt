<?php

namespace Lib;

class ListController{

    protected $csvFile;

    public function __construct($csvFile)
    {
        $this->csvFile = __DIR__.'/../'.$csvFile;
    }

    /**
    * expected list
        $list=[
            'a'=>['b'=>10,'c'=>20],
            'b'=>['a'=>10,'d'=>100],
            'c'=>['a'=>20,'d'=>30],
            'd'=>['b'=>100,'c'=>30,'e'=>10],
            'e'=>['d'=>10,'f'=>1000],
            'f'=>['e'=>1000]
        ];
    */

    /**
    * read the CSV file and generate the nodes list
    */
    public function generateList(){
        $data = [];

        return $data;
    }

    /**
     * find the shortest paths from the provided start point and others
     */
    public function findPaths($node, $list, $next, $a = [])
    {
        
    }

    /**
     * get the matched path with total latency from the provided start and end points
     */
    public function getMatched($input, $path)
    {
        $result = [];
        
        return $result;
    }
}