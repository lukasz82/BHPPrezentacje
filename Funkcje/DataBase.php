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

	public static function InsertDataToDatabase($sql)
	{
		if (self::$db->query($sql) === TRUE) 
		{
    		echo "Wstawiem rekordy";
		} 
		else 
		{
    		echo "Dupa: " . $sql . "<br>" . self::$db->error;
		}
		self::$db->close();
	} 


} 
?>