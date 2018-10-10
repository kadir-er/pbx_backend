<?php

include_once __DIR__.'/config.php';

class DbConnect{

	private $connection;

//    public static $printQueries = true;
//    public static $printResults = true;
    public static $printQueries = false;
    public static $printResults = false;

	public function __construct(){
		$this->connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

		if (mysqli_connect_errno($this->connection)){
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
	}

	public function getDb(){
		return $this->connection;
	}


    /**
     * @param $query
     * @return array
     */
    public function runQuery($query) {
        $rows = [];

        if(self::$printQueries) {
            echo "<br>";
            print_r($query);
            echo "<br>";
        }
        mysqli_query($this->connection, "SET NAMES UTF8");

        $result = mysqli_query($this->connection, $query);

        if (!is_bool($result)) {
            if(mysqli_num_rows($result) > 0){
                while ($row = mysqli_fetch_assoc($result)) {
                    $rows[] = $row;
                }
            }
        } else if($result != 1) {
            $rows = $result;
        }

        if(self::$printResults) {
            echo ' <br>result: <br>';
            print_r($rows);
            echo '<br>';
        }

        return $rows;
    }

}