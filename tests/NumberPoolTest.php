<?php

require_once dirname(dirname(__FILE__)) . '/models/NumberPool.php';

class NumberPoolTest {

    public function runTest() {
        $this->insertNumberTest();
    }

    private function insertNumberTest() {

        $new_number = '05452837537';

        $NumberPool = new NumberPool();
        $NumberPool->setNumber($new_number);
        $number_id = $NumberPool->insertObject();

        /** @var NumberPool[] $NumberPool1 */
        $NumberPool1 = $NumberPool->selectWithWhere($number_id, EQUAL, $number_id, NumberPool::COL_NUMBER);

        $found_number = $NumberPool1[0]->getNumber();
        echo "found_number: $found_number \n";

        if($found_number != $new_number) {
            echo "insertNumberTest Failed";
        } else {
            echo "insertNumberTest Passed";
        }
    }

}

$NumberPoolTest = new NumberPoolTest();
$NumberPoolTest->runTest();