<?php
require_once dirname(__FILE__) . '/BaseDBObject.php';

class NumberPool extends BaseDBObject {

    const TABLE_NAME = 'number_pool';

    const COL_ID = 'id';
    const COL_FIRM_ID = 'firm_id';
    const COL_NUMBER = 'number';
    const COL_TYPE = 'number_type';
    const COL_CONTRACT_STARTS_DATE = 'contract_starts_date';
    const COL_CONTRACT_END_DATE = 'contract_end_date';

    const TYPE_MAIN_NUMBER = 0;
    const TYPE_SUB_NUMBER = 1;

    public function findFreeNumbers() {
        $ret = []; // store free numbers as unique_id => number

        $all_free_numbers = $this->selectWithWhere(NumberPool::COL_FIRM_ID, EQUAL, 0);
        foreach ($all_free_numbers as $free_number) {

            $ret[] = [
                    self::COL_ID => $free_number[self::COL_ID],
                    self::COL_NUMBER => $free_number[self::COL_NUMBER]
                ];
        }

        return $ret;
    }

    public function selectWithWhere($col, $operator, $value, $which_col = '*',
                                    $andOr = null, $col2 = null, $operator2 = null, $value2 = null, $col1_type = 'int', $col2_type = 'int'): array {

        $rows = parent::selectWithWhere($col, $operator, $value, $which_col, $andOr, $col2, $operator2, $value2, $col1_type, $col2_type);

        return $rows;
    }

    protected function _getCols():array {
        $cols = [
            'id' => COL_TYPE_INT,
            'firm_id' => COL_TYPE_INT,
            'number' => COL_TYPE_VARCHAR,
            'number_type' => COL_TYPE_INT,
            'contract_starts_date' => COL_TYPE_VARCHAR,
            'contract_end_date' => COL_TYPE_VARCHAR,
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
            case self::COL_NUMBER:
                $ret = $this->getNumber();
                break;
            case self::COL_TYPE:
                $ret = $this->getNumberType();
                break;
            case self::COL_CONTRACT_STARTS_DATE:
                $ret = $this->getContractStartsDate();
                break;
            case self::COL_CONTRACT_END_DATE:
                $ret = $this->getContractEndDate();
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
        return isset($this->fields[self::COL_ID])? $this->fields[self::COL_ID] : null;
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
        return isset($this->fields[self::COL_FIRM_ID])? $this->fields[self::COL_FIRM_ID] : null ;
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
    public function getNumber() {
        return $this->fields[self::COL_NUMBER];
    }

    /**
     * @param mixed $number
     */
    public function setNumber($number) {
        $this->fields[self::COL_NUMBER] = $number;
    }

    /**
     * @return mixed
     */
    public function getNumberType() {
        return $this->fields[self::COL_TYPE];
    }

    /**
     * @param mixed $number_type
     */
    public function setNumberType($number_type) {
        $this->fields[self::COL_TYPE] = $number_type;
    }

    /**
     * @return mixed
     */
    public function getContractStartsDate() {
        return $this->fields[self::COL_CONTRACT_STARTS_DATE];
    }

    /**
     * @param mixed $contract_starts_date
     */
    public function setContractStartsDate($contract_starts_date) {
        $this->fields[self::COL_CONTRACT_STARTS_DATE] = $contract_starts_date;
    }

    /**
     * @return mixed
     */
    public function getContractEndDate() {
        return $this->fields[self::COL_CONTRACT_END_DATE];
    }

    /**
     * @param mixed $contract_end_date
     */
    public function setContractEndDate($contract_end_date) {
        $this->fields[self::COL_CONTRACT_END_DATE] = $contract_end_date;
    }
    
}