<?php
/**
* this file is the entry point of the entire program
*/

require_once __DIR__.'/lib/ListController.php';
require_once __DIR__.'/lib/Validation.php';

/**
 * cope with initial input via PHP CLI
 */
try{
    $csvFile = $argv[1];

    //some basic validations for input in CLI
    if($argc != 2){
        //the CLI will only accept two parameters
        //1. php file name
        //2. csv file path
        throw new Exception("Please input the right parameters! \n");
    }elseif (strpos($csvFile, '.csv' ) === false){
        //the 2nd parameter must be .csv file
        throw new Exception('The file must be .csv');
    }elseif (!file_exists(__DIR__.'/'.$csvFile)){
        //the CSV file shall be located in the same directory as index.php
        throw new Exception('The CSV file is not existed');
    }

    //get the intance to handle the nodes list
    $listController = new Lib\ListController($csvFile);
    //generate the nodes list
    $nodesList = $listController->generateList();

    //indication about how to input in CLI
    fwrite(STDOUT, "Please input [Device From] [Device To] [Time] followed by the ENTER key \n");

}catch (Exception $e){
    fwrite(STDOUT, 'Error: '.$e->getMessage()."\n");
    exit();
}

//start the session
//session_start();

do{
    //fetch the input for the path with latency
    fwrite(STDOUT, "Input: ");
    $input = trim(fgets(STDIN));

    //exit when receive the 'QUIT' as input
    if (strcmp(strtoupper($input), 'QUIT') === 0){
        break;
    }

    try{
        //some basic validations for the input of path with latency
        \Lib\Validation::validation($input);

        //find out paths
        $listController->findPaths(strtoupper($input[0]), $nodesList, [strtoupper($input[0]) => 0]);
        $paths = $_SESSION['list'];
        
        //find out the matched path (if there is) according to the input path and latency
        $inputParams = explode(' ', $input);
        $matched = $listController->getMatched($inputParams, $paths[0]);

        if (!empty($matched) && $matched[1] <= (int)$inputParams[2]){
            fwrite(STDOUT, "Output: $matched[0]=>$matched[1] \n");
        }else{
            fwrite(STDOUT, "Output: Path not found \n");
        }

    }catch (Exception $e){
        fwrite(STDOUT, 'Error: '.$e->getMessage()."\n");
    }
//the program will continue until the input is 'QUIT'
}while(strcmp(strtoupper($input), 'QUIT') !== 0);

echo "\nThank you, continuing...\n";
exit();