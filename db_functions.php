<?php

class DB_Functions {

    private $db;

    //put your code here
    // constructor
    function __construct() {
        include_once './db_connect.php';
        // connecting to database
        $this->db = new DB_Connect();
        $this->db->connect();
    }

    // destructor
    function __destruct() {

    }

    /**
     * Storing new session
     * returns session details
     */
    public function storeSession($sessionNum,$userNum,$startDate,$startTime,$endDate,$endTime,$hoursWorked,$workedOn,$Learned) {
        // Insert session into database
        $result = mysql_query("INSERT INTO worklog (sessionNum, UserNum, StartDate, StartTime, EndDate, EndTime, HoursWorked, WorkedOn, Learned) 
			VALUES('$sessionNum','$userNum','$startDate','$startTime','$endDate','$endTime','$hoursWorked','$workedOn','$Learned')");

        if ($result) {
			return true;
        } else {
			if( mysql_errno() == 1062) {
				// Duplicate key - Primary Key Violation
				return true;
			} else {
				// For other errors
				return false;
			}
        }
    }
	 /**
     * Getting all users
     */
    public function getAllUsers() {
        $result = mysql_query("select * FROM users");
        return $result;
    }
}

?>