<?php

class MenuController extends Controller
{
	
	public function actionIndex()
	{
			
		$this->render('index');
	}
	
	public function actionAddPoint()
	{
		if(UserIdentity::getProperty('role')=='root' or UserIdentity::getProperty('role')=='admin'):
			 
			 if($_REQUEST['parent_id']>0){
			 	$item=Items::model()->findByPk($_REQUEST['parent_id']);
				$response['header']='Добавление пунктов в раздел '.$item->name;
			 }
			 else{
			 	$response['header']='Добавление пунктов в корневой раздел';
			 }
				echo CJSON::encode($response);
			 
		else:
			exit;
		endif;
	}
	
	public function actionEditPoint()
	{
		if(UserIdentity::getProperty('role')=='root' or UserIdentity::getProperty('role')=='admin'):
			 	
			$item=Items::model()->findByPk($_REQUEST['id']);
			$parent_item=Items::model()->findByPk($item->parent_id);
			
			 if($parent_item){ 	
				$response['header']='Редактирование пункта "'.$item->name.'"  в разделе '.$parent_item->name;
				$response['name']=$item->name;
			 }
			 else{
			 	$response['header']='Редактирование пункта в корневом разделе';
				$response['name']=$item->name;

			 }
				echo CJSON::encode($response);
			 		
		else:
			exit;
		endif;
	}
	
	public function actionRemovePoint()
	{
		if(UserIdentity::getProperty('role')=='root' or UserIdentity::getProperty('role')=='admin'):
			 	
			Items::model()->removeItems($_REQUEST['item_id']);
			if(Items::$deleted){
				$response['answer']=1;
				
				if(Items::$recursive){
					$response['recursive']=1;
					$response['url']=SITE_PATH.'catalog/show/index?item_id='.$_REQUEST['item_id'];
				}
				else{
					$response['recursive']=0;

				}
			}
			else{
				$response['answer']=0;
			}
			
			echo CJSON::encode($response);

			 		
		else:
			exit;
		endif;
	}
	
	public function actionSubmenu(){
	
		$parent_id=$_POST['parent_id'];
		$level=$_POST['level'];
			
		if(isset($type)):
		
		$response['ids']=Items::model()->getChilds($parent_id);
		
		else:
		$items=Items::model()->getItemsByParent($parent_id);
		if(UserIdentity::getProperty('role')=='root' or UserIdentity::getProperty('role')=='admin'){
			$enable_edit=true;
		}
		else{
			$enable_edit=false;
		}
		$response['content']=$this->render('submenu',array('items'=>$items,'enable_edit'=>$enable_edit),true);
		$response['id']=$parent_id;
		
		if($items)
			$response['have_childs']=1;
		else
			$response['have_childs']=0;
			
		endif;	
		
		
		$response['level']=$level;

		echo CJSON::encode($response);
		
		
		
	}
	
	protected function beforeAction($action){
			$this->layout='ajax';

		return true;
	}
	
	 
}