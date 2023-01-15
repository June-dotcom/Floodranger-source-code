<?php
class chartValFld{
	public $sensor_value;
	public $timestamps;

	function __construct($sensor_value, $timestamps){
		$this->sensor_value = $sensor_value;
		$this->timestamps = $timestamps;
	}
}