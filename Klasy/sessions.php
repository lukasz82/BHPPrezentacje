<?php
class Sessions
{
	// Zmienna, która sprawdza czy zmienna sesyjna zostala zainicjowana
	public $check_session = false;

    public function set($variable_name, $value)
	{	
		if (isset($_SESSION[$variable_name])) 
		{
        	$_SESSION[$variable_name];
        	$check_session = true;
    	} 	
        $_SESSION[$variable_name] = $value;
	} 

	public function get($variable_name)
	{		
        return $_SESSION[$variable_name];
	} 

	public function setArr($variable_name)
	{	
		if (isset($_SESSION[$variable_name])) 
		{
        	$_SESSION[$variable_name] = array();
        	$check_session = true;
    	} 	
	} 

	public function putArr($index_name, $value)
	{	
        if ($value != NULL)
    	{
        	$_SESSION[$index_name][] = $value;
        }
    } 	

	public function getArr($variable_name, $key)
	{		
        return $_SESSION[$variable_name][$key];
	} 

	public function drop($variable_name, $key)
	{		
		array_splice($_SESSION[$variable_name], $key, 1 );
	}

	public function count($variable_name)
	{		
		return count($_SESSION[$variable_name]);
	}
} 
?>