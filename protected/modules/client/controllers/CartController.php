<?php

Yii::import('application.modules.autoparts.models.OrdersStatus');
Yii::import('application.modules.autoparts.models.TypePayments');

class CartController extends Controller
{
	public $default_type_payment='card';
	public $default_type_delivery='self';
	public $document_actions=array(
	2=>'card',
	3=>'bill',
	4=>'invoice'
	);
	
	public function actionIndex()
	{
		$this->pageTitle='Корзина '.$this->prefix_title;
		if(isset($_SESSION['order_info']))
			unset($_SESSION['order_info']);
			
		if(isset($_SESSION['orders_document'])){
			unset($_SESSION['orders_document']);

		}
			
		if(isset($_SESSION['user_info']))
			unset($_SESSION['user_info']);
			
		if(isset($_SESSION['order_id']))
			unset($_SESSION['order_id']);
		if(UserIdentity::getProperty('role')){
			$orders=Basket::model()->findAll('user_id=:user_id',array(':user_id'=>UserIdentity::getProperty('id')));
			$ids=CArray::arrayFromObjects($orders,null,'id');
		}
		else{
			$orders=Basket::model()->orders_guests();
			$ids=array();
		}
			
		if(isset($_POST['type'])):
		
			ob_start();
			$this->render('index',array('orders'=>$orders,'ids_orders'=>$ids));
			$response['content']=ob_get_contents();
			$response['title']=$this->pageTitle;
			ob_clean();
			echo CJSON::encode($response);
		
		else:
			$this->render('index',array('orders'=>$orders,'ids_orders'=>$ids));
		
		endif;
			

	}
	
	public function actionChangeQuantity()
	{
		if(isset($_POST['type'])):
			if(UserIdentity::getProperty('role'))
				$response=Basket::model()->changeQuantity();
			else
				$response=Basket::model()->changeQuantityGuests();			
			echo CJSON::encode($response);
		
		else:
		
			$this->redirect(SITE_PATH);
		
		endif;
	}
	
	
	function actionPreOrder()
	{
		$this->pageTitle='Оформление заказа '.$this->prefix_title;
		$buffer=explode(';',$_REQUEST['orders']);
		$_SESSION['order_info']=$_POST;
		
		foreach($buffer as $elem){
			if($elem!=''){
				list($key,$value)=explode('-',$elem);
				$arr[$key]=$value;
			}	
		}
		$user=Users::model()->findByPk(UserIdentity::getProperty('id'));
		$sum=0;
		foreach($arr as $key=>$value){
			$orders[$key]=Basket::model()->findByPk($key);
			$sum+=$orders[$key]->sum_client;
		}
		$_SESSION['order_info']['summary']=$sum;
		$data=array(
		'orders'=>$orders,
		'user'=>$user,
		'type_payment'=>Basket::$type_payments[$this->default_type_payment],
		'type_delivery'=>Basket::$type_delivery[$this->default_type_delivery],
		);
		
		$_SESSION['user_info'] = array(
		'fio'=>$user->fio,
		'address'=>$user->address
		);
		$_SESSION['orders_document']=$orders;
		
		if(isset($_POST['type'])):
			$response['content']=$this->renderPartial('preorder',$data,true);
			$response['title']=$this->pageTitle;
			$response['answer']=1;		
			echo CJSON::encode($response);
		else:
			$this->render('preorder',$data);
		endif;

	}
	
	public function actionOrder()
	{
		$buffer=explode(';',$_SESSION['order_info']['orders']);
		
		foreach($buffer as $elem){
		
			if($elem!=''){
				list($key,$value)=explode('-',$elem);
				$arr[$key]=$value;
			}
			
		}
		
		$user=Users::model()->findByPk(UserIdentity::getProperty('id'));
		$res=Messages::mail_notice($user,'order');
		
		if(isset($_POST['type'])):
		
			$res=Basket::model()->Order($arr);
			if($res)
				$num=Basket::model()->count('user_id=:user_id',array(':user_id'=>UserIdentity::getProperty('id')));

			ob_start();
			if($res)
				$this->renderPartial('order');
			else
				echo '<div>Неизвестная ошибка!</div>';
			$response['num']=$this->renderPartial('add',array('num'=>$num),true);
			$response['answer']=1;
			$response['content']=ob_get_contents();
			$response['document_link']='/client/document/'.$this->document_actions[$user->type_payments->id];

			ob_clean();
			echo CJSON::encode($response);
		
		else:
			
			$res=Basket::model()->OrderWithoutAjax();
			$this->render('order');
		
		endif;
				
	}
	
	
	
	
	
	protected function beforeAction($action)
	{
		$action=$this->getAction()->getId();

		if($action=='changequantity')
			return true;
		parent::beforeAction($action);
		if(isset($_POST['type']) and $_POST['type']=='ajax')
			$this->layout='ajax';
		if(count($this->breadcrumbs)>0)	
			$this->breadcrumbs=array();
		$this->breadcrumbs['Корзина']=SITE_PATH.$this->module->id.'/cart';
		return true;
	}
	
	
}

?>