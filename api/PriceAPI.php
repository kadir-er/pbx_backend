<?php

require_once dirname(__FILE__) . '/api_constants.php';
require_once dirname(dirname(__FILE__)) . '/controllers/PaymentCalculator.php';

class PriceAPI {

    public function calculatePrice(array $post_content) {
        $firm_id = 0; // the firm is not created yet, so set it's id to 0
        $sub_number_count = $this->extractValFromArray($post_content, SELECTED_SUB_NUMBER_COUNT);
        $commitment_time = $this->extractValFromArray($post_content, SELECTED_SUB_NUMBER_COUNT);

        $PaymentCalculator = new PaymentCalculator();
        $price = $PaymentCalculator->calculate_price($firm_id, $sub_number_count, $commitment_time);
        return $price;
    }

    private function extractValFromArray(array $post_content, $required_field) {
        $ret = null;
        if(isset($post_content[$required_field])) {
            $ret = $post_content[$required_field];
        }
        return $ret;
    }

}

$PriceAPI = new PriceAPI();
$ret[CALCULATED_PRICE] = $PriceAPI->calculatePrice($_POST);

return json_encode($ret);