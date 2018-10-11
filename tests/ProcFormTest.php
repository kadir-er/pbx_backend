<?php

class ProcFormTest {


    public function runTests() {
        $this->preparePostData();

        require_once dirname(dirname(__FILE__)) . '/api/FormProcAPI.php';
    }

    private function preparePostData() {
        $_POST[] = "";
    }
}

$ProcFormTest = new ProcFormTest();
$ProcFormTest->runTests();