<?php

class DocumentController extends Controller
{
	public $inn = '432204271411';
	public $current_account = '40802810600070140154';
	public $correspondence_account = '30101810300000000728';
	public $bik = '043304728';
	public $ogrn = '311432211100043';
	public $recipient = 'ИП Бабурин А.В';
	public $recipient_full = 'ИП Бабурин Александр Владимирович';
	public $bank_recipient = 'АКБ «Вятка-банк» ОАО (Омутнинский дополнительный офис) ';
	
	
	public function actionCard(){
		
		$this->pageTitle='Оплата с банковской карты';
		$this->render('card');
		
	}
	
	public function actionBill(){
		
		$data = array();
		$this->pageTitle='Оплата по счету';
		if(isset($_SESSION['orders_document'])){
			$data=array(
			'orders'=>$_SESSION['orders_document'],
			'payer'=>$_SESSION['user_info']['fio'],
			'consignee'=>$_SESSION['user_info']['fio'],
			'summary'=>$_SESSION['order_info']['summary'],
			'order_id'=>'A-'.$_SESSION['order_id']
			);
		}
		else{
			$data=array();
		}
		$this->render('bill',$data);
	}
	
	public function actionInvoice(){
		
		$this->pageTitle='Оплата по квитанции';
		if(isset($_SESSION['orders_document'])){
			$summary=$_SESSION['order_info']['summary'];
			if(is_float($summary)){
				$rest=$summary-((int)$summary);
				$rub=(int)$summary;
				$kop=$rest*100;
				$rub=sprintf("%01.1f",$rub);
				$kop=sprintf("%01.1f",$kop);
			}
			else{
				$rub=sprintf("%01.1f",$summary);
				$kop=sprintf("%01.1f",0);
			}
			
			$data=array(
			'payer'=>$_SESSION['user_info']['fio'],
			'address'=>$_SESSION['user_info']['address'],
			'consignee'=>$_SESSION['user_info']['fio'],
			'summary'=>$_SESSION['order_info']['summary'],
			'rub'=>$rub,
			'kop'=>$kop
			);
		}
		else{
			$data=array();
		}
		
		$this->render('invoice',$data);
	}
	
	public function actionContract(){
		
		$this->pageTitle='Договор';
		$this->render('contract');
	}
		protected function beforeAction($action)
	{
		$this->layout='//layouts/document';
		return true;

	}
}

?>