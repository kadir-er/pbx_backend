<?php

require_once dirname(dirname(__FILE__)) . '/db/db_def.php';
require_once dirname(dirname(__FILE__)) . '/models/NumberPool.php';

class PaymentCalculator {

    const NO_COMMITMENT = 75;
    const ONE_YEAR_COMMITMENT_MONTHLY_PRICE = 70;
    const TWO_YEAR_COMMITMENT_MONTHLY_PRICE = 60;
    const THREE_YEAR_COMMITMENT_MONTHLY_PRICE = 50;

    const DISCOUNT_COUNT = 10; // After how many number purchased
    const DISCOUNT_RATE  = 10; // How much discount will be applied (percentage value e.g. 10 is 10%)


    /**
     *
     * @param int $firm_id : which firm
     * @param int $selected_sub_number_count : how many sub numbers selected,
     *                                       we only take sub number count, because main number is free
     * @param int $commitment_time : how many years does the customer wants
     * @return float|int
     */
    public function calculate_price(int $firm_id, int $selected_sub_number_count, int $commitment_time) {

        $NumberPool = new NumberPool();
        $currently_owned_number_count = $NumberPool->countWithWhere(NumberPool::COL_FIRM_ID, EQUAL, $firm_id);

        $total_price = 0;
        $commitment_price = $this->getPriceForCommitment($commitment_time);

        for($i = 0; $i < $selected_sub_number_count; $i++) {
            if($currently_owned_number_count > self::DISCOUNT_COUNT) {
                $total_price += $this->applyDiscount($commitment_price);

            } else {
                $total_price += $commitment_price;
            }

            $currently_owned_number_count++;
        }

        return $total_price;
    }

    /**
     * returns the price of each number according to its commitment time
     * @param int $commitment_time
     * @return int
     */
    private function getPriceForCommitment(int $commitment_time) {
        $price = -1;
        switch ($commitment_time) {
            case 0 :
                $price = self::NO_COMMITMENT;
                break;
            case 1 :
                $price = self::ONE_YEAR_COMMITMENT_MONTHLY_PRICE;
                break;
            case 2 :
                $price = self::TWO_YEAR_COMMITMENT_MONTHLY_PRICE;

                break;
            case 3 :
                $price = self::THREE_YEAR_COMMITMENT_MONTHLY_PRICE;
                break;
        }
        return $price;
    }

    private function applyDiscount($commitment_price) {
        $discounted_price = $commitment_price / 100 * (100 - self::DISCOUNT_RATE);

        return $discounted_price;
    }

}