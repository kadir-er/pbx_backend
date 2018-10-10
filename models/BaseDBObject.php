<?php

include_once dirname(dirname(__FILE__)) . '/db/DbConnect.php';
include_once dirname(dirname(__FILE__)) . '/db/db_def.php';

abstract class BaseDBObject {

    protected $DBConnection;
    protected $fields;

    public function __construct() {
        $DBConnection = new DbConnect();
        $this->DBConnection = $DBConnection;
    }

    /**
     * Returns an array of column names that are belongs to Data Object
     *
     * @return array
     */
    protected abstract function _getCols(): array;

    /**
     * Returns the value of the required column of the Data Object
     *
     * @param string $col_name
     * @return mixed
     */
    protected abstract function _getColVal(string $col_name);

    protected abstract function _getTableName(): string;

    protected abstract function _getPKColName(): string;

    public function _setVal(string $field_name, $value) {
        $this->fields[$field_name] = $value;
    }

    /**
     * @param $table_name
     * @return array
     */
    public function selectAll($table_name) {
        $query = "select * from $table_name";
        $rows = $this->runQuery($query);
        return $rows;
    }

    public function insertObject() {
        $this->_setVal($this->_getPKColName(), 0);

        $table_name = $this->_getTableName();
        $cols = $this->_getCols();

        $insert_query = 'INSERT INTO `' . $table_name . '`';

        $table_cols_str = $this->getTableColsAsStr($cols);
        $insert_query .= " ($table_cols_str) values (";

        $vals = [];
        foreach ($cols as $col => $type) {
            $val = $this->_getColVal($col);
            if($val === null) {
                if($type == COL_TYPE_VARCHAR)
                    $val = '';
                else
                    $val = 0;
            }
            $vals[] = $val;
        }

        $values_str = implode(',',array_map([$this, 'changeValueSchema'], $vals));

        $insert_query .= $values_str . ');';

        $result = $this->runQuery($insert_query);

        $id = $this->getMaxCol($table_name, $this->_getPKColName());
        return $id;
    }

    public function updateObject() {
        $table_name = $this->_getTableName();
        $cols = $this->_getCols();
        $update_query = 'UPDATE `' . $table_name . '` SET ';

        $table_pk_value = null;
        foreach ($cols as $col => $type) {
            $value = $this->_getColVal($col);
            if($col == $this->_getPKColName()) {
                $table_pk_value = $value;
                continue;
            }
            if($value !== null) {
                $update_query .= "`$col`='$value',";
            }
        }

        // remove the last comma from update query
        $update_query = substr($update_query, 0, strlen($update_query) - 2);

        $update_query .= " WHERE " . $this->_getPKColName() . " " . EQUAL . " " . $table_pk_value;
        $result = $this->runQuery($update_query);

        return $result;
    }

    public function changeValueSchema($value) {
        if(is_string($value)) {
            return "'$value'";
        } else {
            return $value;
        }
    }

    public function selectWithWhere($col, $operator, $value, $which_col='*',
                                    $andOr=null, $col2=null, $operator2=null, $value2=null, $col1_type='int', $col2_type='int') {

        $table_name = $this->_getTableName();

        $select_query = "select $which_col from $table_name";
        if ($col1_type == 'int') {
            $query = $select_query . " where $col $operator $value $andOr ";
        } else {
            $query = $select_query . " where $col $operator '$value' $andOr ";
        }
        if ($col2 != null && $operator2 != null && $value2 != null) {
            if ($col2_type == 'int') {
                $query .= "$col2 $operator2 $value2";
            } else {
                $query .= "$col2 $operator2 '$value2'";
            }
        }
        $rows = $this->runQuery($query);

        return $rows;
    }

    public function count() {
        $count_query = $this->getCountQuery();

        $rows = $this->runQuery($count_query);

        return $rows[0];
    }

    public function countWithWhere($col, $operator, $value, $andOr=null, $col2=null, $operator2=null, $value2=null,
                                   $col1_type='int', $col2_type='int') {
        $count_query = $this->getCountQuery();

        if ($col1_type == 'int') {
            $query = $count_query . " where $col $operator $value $andOr ";
        } else {
            $query = $count_query . " where $col $operator '$value' $andOr ";
        }
        if ($col2 != null && $operator2 != null && $value2 != null) {
            if ($col2_type == 'int') {
                $query .= "$col2 $operator2 $value2";
            } else {
                $query .= "$col2 $operator2 '$value2'";
            }
        }

        $rows = $this->runQuery($query);

        return $rows['RowCount'];
    }

    private function getCountQuery() {
        $pk_col = $this->_getPKColName();
        $table_name = $this->_getTableName();
        return "SELECT COUNT($pk_col) AS RowCount FROM $table_name";
    }

    public function getMaxCol($table_name, $col) {

        $query = "select max($col) from $table_name";

        $rows = $this->runQuery($query);
        $max_id = $rows[0]["max($col)"];

        return $max_id;
    }

    public function deleteWithId($table_name, $col_name, $id) {
        $query = "DELETE FROM $table_name WHERE $col_name=$id";

        $rows = $this->runQuery($query);

        return $rows;
    }

    public function getTableColsAsStr($cols) {
        $cols_str = '';
        foreach ($cols as $col_name => $type) {
            $cols_str .= "`$col_name`,";
        }
        return substr($cols_str, 0, strlen($cols_str) - 1);
    }

    public function fromArray(array $fields): self {
        $cols = $this->_getCols();

        foreach ($cols as $col => $type) {
            $this->_setVal($col, $fields[$col]);
        }

        return $this;
    }

    public function toArray(self $Obj) {
        return $Obj->fields;
    }

    public function runQuery($query) {
        $result = $this->DBConnection->runQuery($query);
        return $result;
    }

}