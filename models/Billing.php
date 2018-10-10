<?php

require_once dirname(__FILE__) . '/BaseDBObject.php';

class Billing extends BaseDBObject {

    const TABLE_NAME = 'billing';

    const COL_ID = 'id';
    const COL_FIRM_ID = 'firm_id';
    const COL_TRANSACTION_DATE = 'transaction_date';
    const COL_AMOUNT = 'amount';
    const COL_SELECTED_NUMBER_COUNT = 'selected_number_count';

    protected function _getCols():array {
        $cols = [
            'id' => COL_TYPE_INT,
            'firm_id' => COL_TYPE_INT,
            'transaction_date' => COL_TYPE_VARCHAR,
            'amount' => COL_TYPE_INT,
            'selected_number_count' => COL_TYPE_INT
        ];

        return $cols;
    }

    public function _getColVal(string $col_name) {
        $ret = null;
        switch ($col_name) {
            case self::COL_ID:
                $ret = $this->getId();
                break;
            case self::COL_FIRM_ID:
                $ret = $this->getFirmId();
                break;
            case self::COL_TRANSACTION_DATE:
                $ret = $this->getTransactionDate();
                break;
            case self::COL_AMOUNT:
                $ret = $this->getAmount();
                break;
            case self::COL_SELECTED_NUMBER_COUNT:
                $ret = $this->getSelectedNumberCount();
                break;
        }

        return $ret;
    }

    public function _getTableName(): string {
      return self::TABLE_NAME;
    }

    public function _getPKColName(): string {
        return self::COL_ID;
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->fields[self::COL_ID];
    }

    /**
     * @param mixed $id
     */
    public function setId($id) {
        $this->fields[self::COL_ID] = $id;
    }

    /**
     * @return mixed
     */
    public function getFirmId() {
        return $this->fields[self::COL_FIRM_ID];
    }

    /**
     * @param mixed $firm_id
     */
    public function setFirmId($firm_id) {
        $this->fields[self::COL_FIRM_ID] = $firm_id;
    }

    /**
     * @return mixed
     */
    public function getTransactionDate() {
        return $this->fields[self::COL_TRANSACTION_DATE];
    }

    /**
     * @param mixed $transaction_date
     */
    public function setTransactionDate($transaction_date) {
        $this->fields[self::COL_TRANSACTION_DATE] = $transaction_date;
    }

    /**
     * @return mixed
     */
    public function getAmount() {
        return $this->fields[self::COL_AMOUNT];
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount) {
        $this->fields[self::COL_AMOUNT] = $amount;
    }

    /**
     * @return mixed
     */
    public function getSelectedNumberCount() {
        return $this->fields[self::COL_SELECTED_NUMBER_COUNT];
    }

    /**
     * @param mixed $selected_number_count
     */
    public function setSelectedNumberCount($selected_number_count) {
        $this->fields[self::COL_SELECTED_NUMBER_COUNT] = $selected_number_count;
    }

}