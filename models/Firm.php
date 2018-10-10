<?php
require_once dirname(__FILE__) . '/BaseDBObject.php';

class Firm extends BaseDBObject {

    const TABLE_NAME = 'firm';

    const COL_ID = 'id';
    const COL_NAME = 'name';
    const COL_ADDRESS = 'address';
    const COL_SECTOR = 'sector';
    const COL_TAX_OFFICE = 'tax_office';
    const COL_TAX_ID = 'tax_id';
    const COL_REPRESENTER_ID = 'representer_id';

    protected function _getCols():array {
        $cols = [
            'id' => COL_TYPE_INT,
            'name' => COL_TYPE_VARCHAR,
            'address' => COL_TYPE_VARCHAR,
            'sector' => COL_TYPE_INT,
            'tax_office' => COL_TYPE_VARCHAR,
            'tax_id' => COL_TYPE_INT,
            'representer_id' => COL_TYPE_INT
        ];
        return $cols;
    }

    public function _getColVal(string $col_name) {
        $ret = null;
        switch ($col_name) {
            case self::COL_ID:
                $ret = $this->getId();
                break;
            case self::COL_NAME:
                $ret = $this->getName();
                break;
            case self::COL_ADDRESS:
                $ret = $this->getAddress();
                break;
            case self::COL_SECTOR:
                $ret = $this->getSector();
                break;
            case self::COL_TAX_OFFICE:
                $ret = $this->getTaxOffice();
                break;
            case self::COL_TAX_ID:
                $ret = $this->getTaxId();
                break;
            case self::COL_REPRESENTER_ID:
                $ret = $this->getRepresenterId();
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
    public function getName() {
        return $this->fields[self::COL_NAME];
    }

    /**
     * @param mixed $name
     */
    public function setName($name) {
        $this->fields[self::COL_NAME] = $name;
    }

    /**
     * @return mixed
     */
    public function getAddress() {
        return $this->fields[self::COL_ADDRESS];
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address) {
        $this->fields[self::COL_ADDRESS] = $address;
    }

    /**
     * @return mixed
     */
    public function getSector() {
        return $this->fields[self::COL_SECTOR];
    }

    /**
     * @param mixed $sector
     */
    public function setSector($sector) {
        $this->fields[self::COL_SECTOR] = $sector;
    }

    /**
     * @return mixed
     */
    public function getTaxOffice() {
        return $this->fields[self::COL_TAX_OFFICE];
    }

    /**
     * @param mixed $tax_office
     */
    public function setTaxOffice($tax_office) {
        $this->fields[self::COL_TAX_OFFICE] = $tax_office;
    }

    /**
     * @return mixed
     */
    public function getTaxId() {
        return $this->fields[self::COL_TAX_ID];
    }

    /**
     * @param int $tax_id
     */
    public function setTaxId(int $tax_id) {
        $this->fields[self::COL_TAX_ID] = $tax_id;
    }

    /**
     * @return mixed
     */
    public function getRepresenterId() {
        return $this->fields[self::COL_REPRESENTER_ID];
    }

    /**
     * @param mixed $representer_id
     */
    public function setRepresenterId($representer_id) {
        $this->fields[self::COL_REPRESENTER_ID] = $representer_id;
    }

}