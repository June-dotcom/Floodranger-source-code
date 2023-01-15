<?php
class sensorval {
  // Properties
  public $min_value;
  public $min_value_timestamp;
  public $max_value;
  public $max_value_timestamp;
  public $current_value;
  public $current_value_timestamp;

  // Methods
  function set_min_value($value) {
    $this->min_value = $value;
  }
  function get_min_value() {
    return $this->min_value;
  }

  function set_max_value($value){
    $this->max_value = $value;
  }

  function get_max_value(){
    return $this->max_value;
  }

  function set_current_value($value){
    $this->current_value = $value;
  }

  function get_current_value(){
    return $this->current_value;
  }

  function set_min_value_timestamp($value){
    $this->min_value_timestamp = $value;
  }

  function get_min_value_timestamp(){
    return $this->min_value_timestamp;
  }

  function set_max_value_timestamp($value){
    $this->max_value_timestamp = $value;
  }

  function get_max_value_timestamp(){
    return $this->max_value_timestamp;
  }

  function set_current_value_timestamp($value){
    $this->current_value_timestamp = $value;
  }

  function get_current_value_timestamp(){
    return $this->current_value_timestamp;
  }

}
