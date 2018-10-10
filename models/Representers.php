<?php
require_once dirname(__FILE__) . '/BaseDBObject.php';

class Representers extends BaseDBObject {

    const TABLE_NAME = 'representers';

    const COL_ID = 'id';
    const COL_FIRM_ID = 'firm_id';
    const COL_NAME = 'name';
    const COL_SURNAME = 'surname';
    const COL_EMAIL = 'email';
    const COL_TEL = 'tel';

    protected function _getCols():array {
        $cols = [
            'id' => COL_TYPE_INT,
            'firm_id' => COL_TYPE_INT,
            'name' => COL_TYPE_VARCHAR,
            'surname' => COL_TYPE_VARCHAR,
            'email' => COL_TYPE_VARCHAR,
            'tel' => COL_TYPE_VARCHAR,
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
            case self::COL_NAME:
                $ret = $this->getName();
                break;
            case self::COL_SURNAME:
                $ret = $this->getSurname();
                break;
            case self::COL_EMAIL:
                $ret = $this->getEmail();
                break;
            case self::COL_TEL:
                $ret = $this->getTel();
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
    public function getSurname() {
        return $this->fields[self::COL_SURNAME];
    }

    /**
     * @param mixed $surname
     */
    public function setSurname($surname) {
        $this->fields[self::COL_SURNAME] = $surname;
    }

    /**
     * @return mixed
     */
    public function getEmail() {
        return $this->fields[self::COL_EMAIL];
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email) {
        $this->fields[self::COL_EMAIL] = $email;
    }

    /**
     * @return mixed
     */
    public function getTel() {
        return $this->fields[self::COL_TEL];
    }

    /**
     * @param mixed $tel
     */
    public function setTel($tel) {
        $this->fields[self::COL_TEL] = $tel;
    }
    
}