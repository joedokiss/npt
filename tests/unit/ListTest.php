<?php
require_once __DIR__.'/../../lib/ListController.php';

class ListTest extends \PHPUnit_Framework_TestCase
{
    private $_listController;

    private $_nodesList;

    public function __construct()
    {
        $this->_listController = $listController = new \Lib\ListController('data.csv');
        $this->_nodesList = $this->_listController->generateList();
    }

	/** @test */
    public function list_has_six_keys_in_sequence()
    {
        $expectedKeys = ['A', 'B', 'C', 'D', 'E', 'F'];

        $actualKeys = [];

        foreach ($this->_nodesList as $key => $value){
            array_push($actualKeys,$key);
        }

        $this->assertEquals($expectedKeys,$actualKeys);
    }

    /** @test */
    public function A_can_reach_E_within_latency_60()
    {
        $start = 'A';
        $end = 'E';
        $matched = false;

        $this->_listController->findPaths($start, $this->_nodesList, ['A' => 0]);

        foreach ($_SESSION['list'][0] as $key => $value){
            if (preg_match("/^".$start."[a-zA-Z]*".$end."$/", $key) && $value <= 60){
                $matched = true;
                break;
            }
        }
        
        $this->assertEquals($matched, true);

    }

    /** @test */
    public function D_to_A_can_be_matched(){
        
    }
}

