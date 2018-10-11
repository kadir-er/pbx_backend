<?php

require_once dirname(dirname(__FILE__)) . '/controllers/NumberPoolController.php';

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

class NumberPoolAPI {

    public function getFreeNumbers() {
        $NumberPoolController = new NumberPoolController();
        $free_numbers = $NumberPoolController->getFreeNumbers();
        return $free_numbers;
    }
}

$NumberPoolAPI = new NumberPoolAPI();
$ret = $NumberPoolAPI->getFreeNumbers();

echo json_encode($ret);
return json_encode($ret);