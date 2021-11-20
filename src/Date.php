<?php
class Year {
  // Properties
  public $year;
  public $month;
  public $day;


  //get the current month
  function get_month($month){
  	if(date("M") == $month){
  		return $month;
  	}else{
  		echo "Error occured in getting the month";
  	}
  }

 
  
  //get the current year
  function get_year($year){
  	if(date("Y") == $year){
  		return $year;
  	}else{
  		echo "Error occured in getting the year";
  	}
  }

 

  //get the current date
  function get_day($day){
  	if(date("d") == $day){
  		return $day;
  	}else{
  		echo "Error occured in getting the day";
  	}
  }

 


  
}
?>