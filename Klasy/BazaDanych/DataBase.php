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

	public static function DelDataFromDatabase($del_id)
    {
    	// Sprawdzam czy nie jest to jedyny wpis w bazie danych, jeśli tak to używam czyszczenia caej bazy ze śmieci i żeby indeksów nie pipierdzielilo
    	$count = self::$db->query("SELECT id FROM zdarzenia"); 

		$int = $count->num_rows;
    	if ($int == 1)
    	{
    		self::$db->query("TRUNCATE TABLE zdarzenia");
    		self::$db->query("TRUNCATE TABLE zdarzenie");
    		self::$db->close();
    	} else if ($int > 1)
    	{
        	self::$db -> query("DELETE zdarzenia, zdarzenie FROM zdarzenia INNER JOIN zdarzenie ON zdarzenia.id = zdarzenie.id_zdarzenia WHERE zdarzenia.id = '$del_id'");
        	self::$db->close();
    	}
    }
} 
?>