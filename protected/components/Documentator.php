<?php

/*
 *Класс предназначен для генерации документов из шаблонов документов
 * путем парсинга шаблона
*/	

class Documentator extends CApplicationComponent
{

 
	 public static function createPayment($payment)
	 {
	 	
	 	$path_documents=self::setPath();
	 	if($payment->type_operation==3)
			$html=file_get_contents($path_documents.'/pay-in_slip.html');
		else
			$html=file_get_contents($path_documents.'/debit_slip.html');
			
		
		 list($buffer,$time)=explode(' ',$payment->data);
         list($year,$month,$day)=explode('-',$buffer);
		 $month=CTime::cut_zero($month);
		 
		$user=Users::model()->findByPk($payment->user_id);
		$firm=FirmSettings::model()->find();
		
		$html=str_ireplace('%organization%',$firm->name,$html);
		 
		$html=str_ireplace('%id%',$payment->id,$html);
		$html=str_ireplace('%data%',CTime::change_show_data($payment->data),$html);
		$html=str_ireplace('%day%',$day,$html);
		$html=str_ireplace('%month%',CTime::$months_names_declension[$month],$html);
		$html=str_ireplace('%year%',$year,$html);
		$html=str_ireplace('%balance%',$payment->balance,$html);
		$html=str_ireplace('%sum%',$payment->sum,$html);
		$html=str_ireplace('%day%',$day,$html);
		$html=str_ireplace('%annotation%',$payment->annotation,$html);
		$html=str_ireplace('%client%',$user->fio,$html);
	
		return $html;
		
	 }
	 
	 
	 
	 public  static function setPath()
	 {
	 	return $_SERVER['DOCUMENT_ROOT'].'/templates';
	 }


}

?>