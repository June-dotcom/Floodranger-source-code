<?php 
class current_val
{
	 public $sensor_id;
    public $sensor_val;
    public $updated_at;
    public $sensor_val_remarks;
    public $overflow_status;


  function __construct($sensor_id,$sensor_val, $updated_at, $sensor_val_remarks, $overflow_status) {
  	    $this->sensor_id = $sensor_id; 
    $this->sensor_val = $sensor_val; 
    $this->updated_at = $updated_at; 
    $this->sensor_val_remarks = $sensor_val_remarks;
    $this->overflow_status = $overflow_status;
  }
}