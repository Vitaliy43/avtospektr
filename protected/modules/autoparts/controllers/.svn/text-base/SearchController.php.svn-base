<?php

Yii::import('application.modules.autoparts.models.WebService');
Yii::import('application.modules.autoparts.models.SearchResult');
Yii::import('application.modules.autoparts.models.Crosses');
Yii::import('application.modules.autoparts.models.WebServices.Iksora');
Yii::import('application.modules.autoparts.models.WebServices.Autostels');
Yii::import('application.modules.autoparts.models.WebServices.Partkom');
Yii::import('application.modules.autoparts.models.SelfStore');
Yii::import('application.helpers.CString');

class SearchController extends Controller
{
	protected $search_code;
	
	
	public function actionIndex()
	{

		$this->pageTitle='Поиск запчастей '.$this->prefix_title;
		if(empty($_REQUEST['sort']))
			$sort='price_client';
		else
			$sort=$_REQUEST['sort'];
            
        if(isset($_REQUEST['submit']) and $_REQUEST['cash']==0){
			$this->search();

		}
        
		if(isset($_REQUEST['search_code'])){
			$brands=SearchResult::model()->getBrands($this->search_code);
			$num_brands=SearchResult::model()->countBrands($this->search_code);
			$ibox=$this->renderPartial('list_brands',array('brands'=>$brands,'num_brands'=>$num_brands),true);

		}
		else{
			$ibox='';

		}
		$result=array();
		$search_panel=$this->renderPartial('search_panel',array('sort'=>$sort,'box'=>$ibox),true);
		if(isset($_POST['type'])):
			ob_start();
			$this->renderPartial('index',array('search_panel'=>$search_panel));
			$response['content']=ob_get_contents();
			ob_clean();
			echo CJSON::encode($response);
		else:
			$this->render('index',array('search_panel'=>$search_panel));
		
		endif;
	
	}
	
	protected function search()
	{
		$command = Yii::app()->db->createCommand();
		if(UserIdentity::getProperty('role'))
			$command->delete('search_result','user_id=:user_id',array(':user_id'=>UserIdentity::getProperty('id')));
		else
			$command->delete('search_result_guests','ip=:ip',array(':ip'=>$_SERVER['REMOTE_ADDR']));
		Iksora::model()->search($this->search_code);
        	Autostels::model()->search($this->search_code);
        if(UserIdentity::getProperty('role')=='manager')
            Partkom::model()->search($this->search_code);
		if(UserIdentity::getProperty('role')){
			SelfStore::model()->search(SearchResult::model()->getNumbers());
			if(!defined('YII_DEBUG'))
				Crosses::model()->collect_crosses($this->search_code,UserIdentity::getProperty('id'));
		}
		
	}
	
	public function actionResult()
	{
		$result=Search::Result($this->search_code);
		$distributors=Distributors::model()->findAll();
		$site_distributors=CArray::arrayFromObjects($distributors,'id','site');
		$client_name_distributors=CArray::arrayFromObjects($distributors,'id','client_name');
		$ibox='';
		
		$search_panel=$this->renderPartial('search_panel',array('sort'=>$_REQUEST['sort'],'box'=>$ibox),true);
		$search_result=$this->renderPartial('search_result',array('search_result'=>$result['search_result'],'cross_result'=>$result['cross_result'],'site_distributors'=>$site_distributors,'client_name_distributors'=>$client_name_distributors),true);
		
		if(isset($_POST['type'])):
			ob_start();
			$this->renderPartial('index',array('search_result'=>$search_result,'search_panel'=>$search_panel));

			$response['content']=ob_get_contents();
			ob_clean();
			echo CJSON::encode($response);

		else:
			$this->render('index',array('search_result'=>$search_result,'search_panel'=>$search_panel));
		endif;
		
	}
	

	protected function beforeAction($action)
	{
		parent::beforeAction($action);
		if(isset($_REQUEST['search_code']) and $_REQUEST['search_code']!=''){
			$this->search_code=CString::cut_spaces($_REQUEST['search_code']);

		}

		$this->layout='//layouts/autoparts';
		return true;

	}
	
	
	
	
	
}

?>