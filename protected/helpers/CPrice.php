<?php

class CPrice
{
	/**
 * Get money in specific format 1234 = 1 234
 * —static
 * —param $price money number
 * —return string money in specific format
 * Yii::app()->params[Yii::app()->params['region']]
        * - currensy symbol definded in 
 *  main.php
 */
 public static function getMoneyFormat($price)
 { 
 
 /*
  if ($price<>'0')
  {
   if ((int)$price == $price) // return 1 256,- {corrency symbol}
   {
    return number_format( (int)$price, 0, ',', ' ' ).'.-'.
Yii::app()->params[Yii::app()->params['region']];
   }
   else // return 1 256,25 {corrency symbol}
   return number_format( (float)$price, 2, ',', ' ' ).
Yii::app()->params[Yii::app()->params['region']]; 
  }
  else
  return FALSE; // $prise = 0 or $prise = null
  
  */
  
  return self::show_money($price);
  
  
 }
 
 private static function show_money($money){
	
	$money=round($money,2);
	$money=sprintf("%01.2f",$money);
	return $money;
	
}
 
 
}



?>