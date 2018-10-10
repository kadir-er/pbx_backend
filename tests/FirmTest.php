<?php

require_once dirname(dirname(__FILE__)) . '/models/Firm.php';

class FirmTest {

    public function runTest() {
        $this->insertFirmTest();
        $this->assignRepresentorTest();
    }

    private function insertFirmTest() {
        $Firm = new Firm();
        $Firm->setName('new firm');
        $Firm->setTaxId(123321);
        $Firm->setTaxOffice('example tax office');
        $Firm->setSector('example firm sector');
        $Firm->setAddress('example firm address');

        $firm_id = $Firm->insertObject();

        $rows = $Firm->selectWithWhere(Firm::COL_ID, EQUAL, $firm_id);

        $found_id = $rows[0][Firm::COL_ID];
        $found_name = $rows[0][Firm::COL_NAME];
        echo "found_id: $found_id \n";
        echo "found_name: $found_name \n";

        if($found_id != $firm_id || $found_name != 'new firm') {
            echo "insertFirmTest Failed";
        } else {
            echo "insertFirmTest Passed";
        }
    }

}

$FirmTest = new FirmTest();
$FirmTest->runTest();