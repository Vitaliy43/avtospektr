<?php

class MenuController extends Controller
{

	public function actionIndex()
	{
			
		$this->render('index');
	}
	
	public function actionSubmenu()
	{
	
		$parent_id=$_POST['parent_id'];
		$level=$_POST['level'];
		
		$items=ClientItems::model()->getItemsByParent($parent_id);
		
		$parent_item=ClientItems::model()->findByPk($parent_id);
		
		$response['content']=$this->render('submenu',array('items'=>$items,'parent_item'=>$parent_item),true);
		$response['id']=$parent_id;
		
		if($items)
			$response['have_childs']=1;
		else
			$response['have_childs']=0;
			
		
		
		
		$response['level']=$level;

		echo CJSON::encode($response);
		
		
		
	}
	
	
}