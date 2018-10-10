<?php

require_once dirname(dirname(__FILE__)) . '/models/Firm.php';
require_once dirname(dirname(__FILE__)) . '/models/Representers.php';


class FirmController {

    public function createFirm(string $name, string $address, string $sector, string $firm_tax_office, int $tax_id) {
        $Firm = new Firm();
        $Firm->setName($name);
        $Firm->setAddress($address);
        $Firm->setSector($sector);
        $Firm->setTaxOffice($firm_tax_office);
        $Firm->setTaxId($tax_id);
        $id = $Firm->insertObject();

        return $id;
    }

    public function assignRepresentor($firm_id, $representor_id) {
        $Firm = new Firm();
        $Firm->setId($firm_id);
        $Firm->setRepresenterId($representor_id);
        $Firm->updateObject();
    }

}