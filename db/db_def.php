<?php

define ('SERVER', 'localhost');

define ('DATABASE_NAME', 'pbx_db');
define ('HOST_ADDRESS', 'http://'.SERVER.'/pbx_backend/');

//Tables
define ('TABLE_BILLING', 'billing');
define ('TABLE_FIRM', 'firm');
define ('TABLE_NUMBER_POOL', 'number_pool');
define ('TABLE_REPRESENTERS', 'representers');

define ('COL_TYPE_INT', 'int');
define ('COL_TYPE_FLOAT', 'float');
define ('COL_TYPE_VARCHAR', 'varchar');

//operators
define ('EQUAL', '=');
define ('NOT_EQUAL', '!=');
define ('LESS', '<');
define ('LESS_OR_EQUAL', '<=');
define ('GREATER', '>');
define ('GREATER_OR_EQUAL', '>=');