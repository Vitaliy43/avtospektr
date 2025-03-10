<?php

Yii::import('application.modules.catalog.models.Products');
Yii::import('application.modules.catalog.CatalogModule');
Yii::import('application.modules.catalog.components.Import');


class CatalogController extends Controller
{
	public function actionIndex()
	{
		$this->actionImport();
	}
	
	public function actionAddPoint()
	{		
		$parent_id=$_POST['parent_id'];
		$level=$_POST['level'];
		$buffer=$_POST;
		$buffer=CArray::delete_index($buffer,array('type','parent_id','level'),true);
		$res=Items::model()->addItems($buffer,$parent_id,$level);
		if($res){
			$response['answer']=1;
			if($parent_id==0)
				$response['url']=SITE_PATH;
			else
				$response['url']=SITE_PATH.'catalog/show/index?item_id='.$parent_id;
		}
		else{
			$response['answer']=0;
		}
		echo CJSON::encode($response);

	}
	
	public function actionEditPoint()
	{		
		$res=Items::model()->editItem($_POST['item_id'],$_POST['point_name']);
		
		if($res){
			$response['answer']=1;
			$response['name']=$_POST['point_name'];
			
		}
		else{
			$response['answer']=0;
		}
		echo CJSON::encode($response);

	}
	
	public function actionImport()
	{
		$this->pageTitle='Импорт в каталог '.$this->prefix_title;
		$user=Users::model()->findByPk(UserIdentity::getProperty('id'));
		UserIdentity::setProperty('temp_password',$user->password);
		UserIdentity::setProperty('user_id',UserIdentity::getProperty('id'));
		UserIdentity::setProperty('purchase_point',UserIdentity::getPurchasePoint());
		$file_catalog=REAL_PATH.'/uploads/import/'.UserIdentity::getPurchasePoint().'.xls';
		$data_last_modified=CFile::getLastModifiedFile($file_catalog);
		
		if(Products::model()->count()>0)
			$isset_catalog=true;
		else
			$isset_catalog=false;
			 	
		if(isset($_POST['type'])):
		
		 ob_start();
		 if(isset($this->message_error) and $this->message_error!='0'){
		 	$this->render('end_import');
		 }
		 else{
		 	$this->renderPartial('import',array('isset_catalog'=>$isset_catalog,'data_last_modified'=>$data_last_modified));
		 }
		$response['content']=ob_get_contents();
		$response['title']=$this->getModule()->prefix_title.' - Импорт каталога';
		ob_clean();
		echo CJSON::encode($response);
		
	else:
	
		if(isset($this->message_error) and $this->message_error!='0'){
		 	$this->render('end_import');
		 }
		else{
		 	$this->render('import',array('isset_catalog'=>$isset_catalog,'data_last_modified'=>$data_last_modified));
		 }
		
	endif;

	}
	
	
	
	protected function beforeAction($action)
	{
		
			parent::beforeAction($action);
		if(isset($_POST['import'])){
			$import=new Import;
			$this->message_error=$import->importCatalog();
		}
			
		return true;
	}
}

?>