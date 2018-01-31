<?php
class Buttons
{
	private $name = "";
	private $value = "";
	private $id = "";
	private $type = "";
	private $height ="100px";
	private $width = "100px";
	private $text = "przycisk";
	private $background_color = "#123456";
	private $text_color = "white";
	private $border_color = "#123456";

	public function __construct($text,$name, $value, $type, $width, $height, $background_color, $text_color, $border_color) 
	{ 
		$this->text = $text;
		$this->name = $name;
		$this->value = $value;
		$this->type = $type;
		$this->width = $width;
		$this->height = $height;
		$this->background_color = $background_color;
		$this->text_color = $text_color;
		$this->border_color = $border_color;
	}

	public function Show_witch_value($value)
	{
		echo '
		<button 
		name="'.$this->name.'" 
		value="'.$value.'" 
		class="btn btn-info btn-sm" 
		style="
			width:'.$this->width.'; 
			height:'.$this->height.'; 
			background-color: '.$this->background_color.'; 
			color:'.$this->text_color.'; 
			border-color: '.$this->border_color.';"
		>
			'.$this->text.'
		</button>';
	}

	public function Show()
	{
		echo '
		<button 
		name="'.$this->name.'" 
		value="";
		class="btn btn-info btn-sm" 
		style="
			width:'.$this->width.'; 
			height:'.$this->height.'; 
			background-color: '.$this->background_color.'; 
			color:'.$this->text_color.'; 
			border-color: '.$this->border_color.';"
		>
			'.$this->text.'
		</button>';
	}

	public function Show_witch_line_and_value($value)
	{
		echo '
		<button 
		name="'.$this->name.'" 
		value="'.$value.'" ;
		class="btn btn-info btn-sm" 
		style="
			width:'.$this->width.'; 
			height:'.$this->height.'; 
			background-color: '.$this->background_color.'; 
			color:'.$this->text_color.'; 
			border-color: '.$this->border_color.';"
			line-height: 2;"
		>
			'.$this->text.'
		</button>';
	}
	
} 
?>