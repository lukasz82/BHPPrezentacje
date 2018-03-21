<?php
class UploadMethods
{
	public $check_status = false;

    public function getInit($name)
	{	
		if (isset($_GET[$name])) 
		{
        	$_GET[$name];
        	$this->check_status = true;
    	} 
	} 

	public function get($name)
	{		
		if ($this->check_status == true)
		{
        	return $_GET[$name];
    	} else {
    		return 0;
    	}
	} 

	public function set($name, $val)
	{		
        $_GET[$name] = $val;
	} 
} 
?>