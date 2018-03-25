<?php
class Sessions
{
	// Zmienna, która sprawdza czy zmienna sesyjna zostala zainicjowana
	
	private $check_session;
	private $variable_name = "";

	public function __construct()
   	{
    	$this->check_session = 0;
   	}

   	// Zwraca true jeżeli obiekt zostal zainicjowany
   	public function getSessionState()
   	{
   		return $this->check_session;
   	}

   	public function clearArray()
   	{
   		unset($_SESSION[$this->variable_name]);
   		return $this->check_session = 0;
   	}

    public function set($variable_name, $value)
	{	
		if (!isset($_SESSION[$variable_name])) 
		{
        	$_SESSION[$variable_name];
        	$this->variable_name = $variable_name;
        	$this->check_session = 1;
    	} 	
        $_SESSION[$variable_name] = $value;
	} 

	public function get($variable_name)
	{		
        return $_SESSION[$variable_name];
	} 

	public function setArr($variable_name)
	{	
		if (!isset($_SESSION[$variable_name])) 
		{
        	$_SESSION[$variable_name] = array();
        	$this->variable_name = $variable_name;
        	$this->check_session = 1;
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