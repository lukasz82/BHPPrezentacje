<?php
class DataBase
{
	private static $db;
	
	public static function InitializeDB()
	{
		self::$db = new mysqli('localhost', 'root' , 'admin' , 'bhpprezentacje' );
    	if (mysqli_connect_errno())
        {
        	echo 'brak polaczenia';
        	exit;
    	} 
	} 	

	public static function GetDataFromDatabase($slq_question)
	{
		$result = self::$db -> query ($slq_question);
		$count = $result->num_rows;
		$results = array ("result"=>$result, "count"=>$count);
		self::$db->close();
		return $results;
	} 
} 
?>