<?php

define('CONTROLER_FOLDER', dirname(dirname(__FILE__)) . '/controllers/');

require_once CONTROLER_FOLDER . 'BillCreator.php';
require_once CONTROLER_FOLDER . 'FirmController.php';
require_once CONTROLER_FOLDER . 'NumberPoolController.php';
require_once CONTROLER_FOLDER . 'RepresentorController.php';

require_once dirname(__FILE__) . '/api_constants.php';
require_once dirname(dirname(__FILE__)) . '/models/NumberPool.php';

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

class FormProcAPI {

    public function processFormContent(array $form_content) {
        $FirmController = new FirmController();
        $firm_id = $this->createFirm($FirmController, $form_content);
        $represenor_id = $this->createRepresentor($form_content, $firm_id);

        $FirmController->assignRepresentor($firm_id, $represenor_id);

        $this->allocateNumbers($firm_id, $form_content);

        $this->createBill($form_content, $firm_id);
    }


    /**
     * @param FirmController $FirmController
     * @param $form_content
     * @return int
     */
    private function createFirm(FirmController $FirmController, array $form_content): int {
        $firm_name = $this->extractValFromArray($form_content, FIRM_NAME);
        $firm_address = $this->extractValFromArray($form_content, FIRM_ADDRESS);
        $firm_sector = $this->extractValFromArray($form_content, FIRM_SECTOR);
        $firm_tax_office = $this->extractValFromArray($form_content, FIRM_TAX_OFFICE);
        $firm_tax_id = $this->extractValFromArray($form_content, FIRM_TAX_ID);

        $firm_id = $FirmController->createFirm($firm_name, $firm_address, $firm_sector, $firm_tax_office, $firm_tax_id);

        return $firm_id;
    }

    private function createRepresentor(array $form_content, int $firm_id):int {
        $representor_name = $this->extractValFromArray($form_content, REPRESENTOR_NAME);
        $representor_surname = $this->extractValFromArray($form_content, REPRESENTOR_SURNAME);
        $representor_email = $this->extractValFromArray($form_content, REPRESENTOR_EMAIL);
        $representor_tel = $this->extractValFromArray($form_content, REPRESENTOR_TEL);

        $RepresentorController = new RepresentorController();
        $represenor_id = $RepresentorController->createRepresentor($firm_id, $representor_name, $representor_surname, $representor_email, $representor_tel);

        return $represenor_id;
    }

    private function allocateNumbers(int $firm_id, array $form_content) {
        $main_number = $this->extractValFromArray($form_content, SELECTED_MAIN_NUMBER);
        $sub_numbers = $this->extractValFromArray($form_content, SELECTED_SUB_NUMBERS);
        $contract_time = $this->extractValFromArray($form_content, CONTRACT_TIME);

        $NumberPoolController = new NumberPoolController();
        $NumberPoolController->assignNumbersToFirm($firm_id, [$main_number], NumberPool::TYPE_MAIN_NUMBER, $contract_time);
        $NumberPoolController->assignNumbersToFirm($firm_id, $sub_numbers, NumberPool::TYPE_SUB_NUMBER, $contract_time);
    }

    /**
     * @param array $form_content
     * @param int   $firm_id
     */
    public function createBill(array $form_content, int $firm_id) {
        $sub_numbers = $this->extractValFromArray($form_content, SELECTED_SUB_NUMBERS);
        $contract_time = $this->extractValFromArray($form_content, CONTRACT_TIME);
        $BillCreator = new BillCreator();
        $BillCreator->createBill($firm_id, $sub_numbers, $contract_time);
    }

    private function extractValFromArray(array $form_content, $required_field) {
        $ret = null;
        if(isset($form_content[$required_field])) {
            $ret = $form_content[$required_field];
        }
        return $ret;
    }

}

$FormProcAPI = new FormProcAPI();
$FormProcAPI->processFormContent($_POST);