<?php

class GlobalModule extends CWebModule
{

	public $type_date=array(
	'archive'=>'Дата продажи',
	'status'=>'Дата заказа',
	'payments'=>'Дата платежа',
	'sales'=>'Дата продажи'
	);
	public $access=array();
	public $exceptions_access=array();
	public static $message_error;
	public $properties=array(
	'orders'=>array('id','number','info','sum_client','quantity','data_shipping'),
	'finance'=>array('id','data','type_operation','type_payment','sum','balance')
	);
	public $headers_properties=array(
	'orders'=>array('Id','Код детали','Описание','Сумма','Кол-во','Дата продажи'),
	'finance'=>array('Id','Дата','Операция','Вид платежа','Сумма','Баланс')
	);
	public $pdf_sizes_cols=array(
	'orders'=>array(40,88,250,56,40,100),
	'finance'=>array(40,100,190,150,40,50)
	);
	
	public $titles=array(
	'orders'=>array(
	'archive'=>'Архив заказов',
	'status'=>'Статус заказов'
	),
	'finance'=>array(
	'reports'=>'Финансовые отчеты',
	'payments'=>'Финансовые отчеты'
	)
	);

	
	protected function construct($items,$controller,$data=false)
	{
		if(UserIdentity::getProperty('role')=='root' or UserIdentity::getProperty('role')=='admin'){
			$this->properties['orders'][]='distributor';
			$this->headers_properties['orders'][]='Поставшик';
			$this->pdf_sizes_cols['orders'][]=100;
		}
		
		if($controller=='finance'){
			if($data)
				$items['items']=$this->correctFinanceItems($items['items']);
			else
				$items=$this->correctFinanceItems($items);
		}
		return $items;
	}
	
	public function checkAccess($action)
	{
		
		$current_role=UserIdentity::getProperty('role');
		
		if(array_key_exists('*',$this->access))
			$roles=$this->access['*'];
		else
			$roles=$this->access[$action];
			
			if(in_array($current_role,$roles))
				return true;
				
		return false;
		
	}
	
	protected function correctFinanceItems($items)
	{
		$num=count($items);
		for($i=0;$i<$num;++$i){
			
			if($items[$i]->type_operation==3)
				$items[$i]->type_operation='Зачисление средств';
			else
				$items[$i]->type_operation='Снятие средств';
				
			if($items[$i]->balance=='0')
				$items[$i]->balance='Нет данных';
			
				
		}
		return $items;
	}
	
	public function generateDOC($items,$controller,$action)
	{
		$items=$this->construct($items,$controller);
		$doc='<table>';
		$doc.='<tr>';
		foreach($this->headers_properties[$controller] as $header){
			$doc.='<th>'.$header.'</th>';
		}
			$doc.='</tr>';
		foreach($items as $item){
			$doc.='<tr>';
			foreach($this->properties[$controller] as $property){
		
				if($property=='type_payment')
					$doc.='<td align=center>'.$item->$property->show_type.'</td>';
				elseif($property=='distributor')
					$doc.='<td align=center>'.$item->$property->client_name.'</td>';
				else
					$doc.='<td align=center>'.$item->$property.'</td>';
			
				}
				
			$doc.='</tr>';
		}
	
		$doc.='</table>';
		
		$title=$this->get_title_file($controller,$action);
	
		echo CString::output_doc($doc,$title);
		
		
	}
	
	public function generateXLS($items,$controller,$action)
	{
	
	$items=$this->construct($items,$controller);
	$xls='<table>';
	$xls.='<tr>';
	foreach($this->headers_properties[$controller] as $header){
		$xls.='<th>'.$header.'</th>';
	}
		$xls.='</tr>';
	foreach($items as $item){
		$xls.='<tr>';
		foreach($this->properties[$controller] as $property){
			
			if($property=='type_payment')
				$xls.='<td>'.$item->$property->show_type.'</td>';
			elseif($property=='distributor')
					$xls.='<td align=center>'.$item->$property->client_name.'</td>';
			else
				$xls.='<td>'.$item->$property.'</td>';
			}
			
		$xls.='</tr>';
	}
	
	$xls.='</table>';
	
	$title=$this->get_title_file($controller,$action);
	
	echo CString::output_xls($xls,$title);
	
	}
	
	protected function get_title_file($controller,$action)
	{
		if(UserIdentity::getProperty('role')=='client')
			$title = UserIdentity::getProperty('fio').'-'.$this->titles[$controller][$action];
		else
			$title = $this->titles[$controller][$action];
			
		if(isset($_REQUEST['flag_filter'])):
			
			if(isset($_REQUEST['client_id'])){
				$client=Users::model()->findByPk($_REQUEST['client_id']);
				$title.='-'.$client->fio;

			}
			
			if(isset($_REQUEST['date1'])){
				$title.='-'.$_REQUEST['date1'].'_'.$_REQUEST['date2'];
			}
			
			if(isset($_REQUEST['distributor_id'])){
				$distributor=Distributors::model()->findByPk($_REQUEST['distributor_id']);
				$title.='-поставщик_'.$distributor->name;
			}
			
		endif;	

		$title = CString::add_underline($title);
		$title = CString::escape_double_quote($title);
		return $title;
	}
	
	public function generatePDF($data,$controller,$action)
	 {
    # Создаем PDF-документ.
	$data=$this->construct($data,$controller,true);
	
	Yii::import('application.vendors.tcpdf.TCPDF');
	Yii::import('application.vendors.Pdf');
	
	$data['user']=UserIdentity::getProperty('fio');
	$data['date']=date("Y-m-d H:i:s");
	
    $pdf = new Pdf( $data, 'P', 'pt', 'LETTER', $this->properties[$controller], $this->headers_properties[$controller], $this->pdf_sizes_cols[$controller]);
	
    # Создаем счет.
    $pdf->ExportContent();

	# Формируем название документа
	$title = $this->get_title_file($controller,$action);
    # Выводим PDF-документ.
    $pdf->Output( "$title.pdf", 'D');
}

public function getClient()
	{
		Yii::import('application.modules.autoparts.components.Finance');
	
		$result['average_amount']=round(Finance::getAverageAmount(),2);
		$result['balance']=round(Finance::getBalance(),2);
		$result['orders_in_work']=round(Finance::getOrdersWork(),2);
		$result['orders_in_store']=round(Finance::getOrdersStore(),2);
		$result['debt_by_orders']=$result['balance']-($result['orders_in_store']+$result['orders_in_work']);
		$result['price_group']=Finance::getPriceGroup($result['average_amount']);
		$result['limit_credit']=round(Finance::getLimitCredit(),2);
		
		if(empty($result['orders_in_work']))
			$result['orders_in_work']='0';
		
		if(empty($result['orders_in_store']))
			$result['orders_in_store']='0';
			
			if(empty($result['debt_by_orders']) or $result['debt_by_orders']<0)
			$result['debt_by_orders']='0';
			
		return $result;

		
	}


}

?>