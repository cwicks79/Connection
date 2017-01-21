<?php

	include_once './db_functions.php';

	//Create Object for DB_Functions clas
	$db = new DB_Functions();

	//Get JSON posted by Android Application
	$json = $_POST["usersJSON"];

	//Remove Slashes
	if (get_magic_quotes_gpc()){
		$json = stripslashes($json);
	}

	//Decode JSON into an Array
	$data = json_decode($json);

	//Util arrays to create response JSON
	$a=array();
	$b=array();

	//Loop through an Array and insert data read from JSON into MySQL DB
	for($i=0; $i<count($data) ; $i++)
	{

		//Store User into MySQL DB
		$res = $db->storesession($data[$i]->sessionNum, $data[$i]->userNum, $data[$i]->startDate, $data[$i]->startTime, $data[$i]->endDate, $data[$i]->endTime,
			$data[$i]->hoursWorked, $data[$i]->workedOn, $data[$i]->learned);
	
		//Based on insertion, create JSON response
		if($res){
			$b["sessionNum"] = $data[$i]->sessionNum;
			$b["userNum"] = $data[$i]->userNum;
			$b["startDate"] = $data[$i]->startDate;
			$b["startTime"] = $data[$i]->startTime;
			$b["endDate"] = $data[$i]->endDate;
			$b["endTime"] = $data[$i]->endTime;
			$b["hoursWorked"] = $data[$i]->hoursWorked;
			$b["workedOn"] = $data[$i]->workedOn;
			$b["learned"] = $data[$i]->learned;
			$b["UpdateStatus"] = 'yes';
			array_push($a,$b);
		}else{
			$b["sessionNum"] = $data[$i]->sessionNum;
			$b["userNum"] = $data[$i]->userNum;
			$b["startDate"] = $data[$i]->startDate;
			$b["startTime"] = $data[$i]->startTime;
			$b["endDate"] = $data[$i]->endDate;
			$b["endTime"] = $data[$i]->endTime;
			$b["hoursWorked"] = $data[$i]->hoursWorked;
			$b["workedOn"] = $data[$i]->workedOn;
			$b["learned"] = $data[$i]->learned;
			$b["UpdateStatus"] = 'no';
			array_push($a,$b);
	}
}
//Post JSON response back to Android Application
echo json_encode($a);
?>