<?php

class ShowController extends Controller
{
	protected $prefix_controller = 'Каталог';
	public function actionIndex()
	{
		$item_id=$_REQUEST['item_id'];
		$parent_item=Items::model()->findByPk($item_id);
		$this->items=Items::model()->getItemsNextLevel($item_id,$parent_item->level);
		if(count($this->items)==0)
			$products=Products::model()->getProductsById($item_id);
		else
			$products=array();
		
		
		if(isset($_POST['type'])):
		
		 ob_start();
		$this->render('index',array('parent_item'=>$parent_item,'products'=>$products));
		$response['content']=ob_get_contents();
		$response['title']=$this->prefix_controller.' - '.$parent_item->name;
		ob_clean();
		echo CJSON::encode($response);
		
	else:
		$this->render('index',array('parent_item'=>$parent_item,'products'=>$products));
		
	endif;
		
	}
	
	protected function beforeAction($action)
	{
		parent::beforeAction($action);
		return true;
	}
}

?>