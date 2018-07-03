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
        $csv = fopen($this->csvFile, "r");
        $data = [];
        fgetcsv($csv);
        while (!feof($csv)) {
            $line = fgetcsv($csv);

            $data[$line[0]][$line[1]] = (int)$line[2];
            $data[$line[1]][$line[0]] = (int)$line[2];
        }
        fclose($csv);
        return $data;
    }

    /**
     * find the shortest paths from the provided start point and others
     */
    public function findPaths($node, $list, $next, $a = [])
    {
        if (count($next) == count($list)) {

            return $_SESSION['list'] = [array_merge($next, $a)];
            
        }
        foreach ($list[$node[strlen($node) - 1]] as $k => $v) {
            foreach ($next as $n => $m) {
                if ($k == $n[strlen($n) - 1]) {
                    unset($list[$node][$k]);
                }
            }
        }
        foreach ($list[$node[strlen($node) - 1]] as $k => $v) {
            $a[$node . $k] = $next[$node] + $v;
        }
        foreach ($a as $k => $v) {
            foreach ($next as $n => $m) {
                if ($k[strlen($k) - 1] == $n[strlen($n) - 1]) {
                    unset($a[$k]);
                }
            }
        }
        foreach ($a as $k => $v) {
            if (!isset($smallest) || $smallest > $v) {
                $smallest = $v;
                $node = $k;
            }
        }
        $next[$node] = $smallest;
        unset($smallest);
        $this->findPaths($node, $list, $next, $a);
    }

    /**
     * get the matched path with total latency from the provided start and end points
     */
    public function getMatched($input, $path)
    {
        $result = [];
        foreach ($path as $k => $v) {

            if (preg_match("/^$input[0][a-zA-Z]*$input[1]$/", $k)) {

                if (empty($result))
                    $result = array(implode('=>', str_split($k, 1)), $v);
                else if ($result[0] > $v)
                    $result = array(implode('=>', str_split($k, 1)), $v);
            }
        }
        return $result;
    }
}