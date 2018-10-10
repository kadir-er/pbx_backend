<?php

require_once dirname(dirname(__FILE__)) . '/models/NumberPool.php';

/**
 * Class FreeNumberSupplier
 *
 * This class provides phone numbers that are not allocated by a firm
 *
 */
class NumberPoolController {

    /**
     * Returns an array of phone numbers that can be allocated
     */
    public function getFreeNumbers() {
        $NumberPool =  new NumberPool();
        $free_numbers = $NumberPool->findFreeNumbers();

        return $free_numbers;
    }

    public function assignNumbersToFirm(int $firm_id, $number_ids, $numbers_type, $contract_time) {
        $DT = new DateTime();
        $contract_start_date = $DT->format('d/m/y');
        $contract_end_date = null;

        if($contract_time > 0 && $contract_time < 4) {
            $DT->modify("+$contract_time year");
            $contract_end_date = $DT->format('d/m/y');
        }

        foreach ($number_ids as $number_id) {
            $NumberPool =  new NumberPool();
            $NumberPool->setId($number_id);
            $NumberPool->setFirmId($firm_id);
            $NumberPool->setContractStartsDate($contract_start_date);
            $NumberPool->setContractEndDate($contract_end_date);
            $NumberPool->setNumberType($numbers_type);
            $NumberPool->updateObject();
        }
    }

}