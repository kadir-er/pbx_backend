<?php

require_once dirname(dirname(__FILE__)) . '/models/Billing.php';
require_once dirname(__FILE__) . '/PaymentCalculator.php';

class BillCreator {

    public function createBill(int $firm_id, array $selected_sub_numbers, int $commitment_time) {
        $PaymentCalculator = new PaymentCalculator();
        $selected_number_count = count($selected_sub_numbers);
        $amount = $PaymentCalculator->calculate_price($firm_id, $selected_number_count, $commitment_time);


        $current_date = $this->getDateAsStr();
        $Bill = new Billing();
        $Bill->setAmount($amount);
        $Bill->setFirmId($firm_id);
        $Bill->setSelectedNumberCount($selected_number_count);
        $Bill->setTransactionDate($current_date);
        $Bill->insertObject();
    }

    private function getDateAsStr() {
        $DT = new DateTime();
        $current_date = $DT->format('d/m/Y');

        return $current_date;
    }

}