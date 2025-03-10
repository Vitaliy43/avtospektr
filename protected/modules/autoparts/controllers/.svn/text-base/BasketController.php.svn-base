<?php

Yii::import('application.modules.autoparts.models.OrdersStatus');
Yii::import('application.modules.autoparts.models.SearchResult');

class BasketController extends Controller
{
	public function ActionAdd()
	{
		if(isset($_REQUEST['id'])){
			
			$res=Basket::model()->Add($_REQUEST['id']);
			if($res){
				if(UserIdentity::getProperty('role')){
					$num=Basket::model()->count('user_id=:user_id',array(':user_id'=>UserIdentity::getProperty('id')));
				}
				else{
					$num=Basket::model()->count_items_guests();
				}
				$response['content']=$this->renderPartial('add',array('num'=>$num),true);
				$response['answer']=1;
			}
			else{
				$response['answer']=0;
			}	
			
				echo CJSON::encode($response);


		}
	}
	
	public function ActionDelete()
	{
		if(UserIdentity::getProperty('role'))
			$res=Basket::model()->deleteByPk($_REQUEST['id']);
		else
			$res=Basket::model()->deleteGuestsByPk($_REQUEST['id']);
		if($res){
				if(UserIdentity::getProperty('role'))
					$num=Basket::model()->count('user_id=:user_id',array(':user_id'=>UserIdentity::getProperty('id')));
				else
					$num=Basket::model()->count_items_guests();
				$response['content']=$this->renderPartial('add',array('num'=>$num),true);
				$response['answer']=1;
			}
			else{
				$response['answer']=0;
			}	
			
		echo CJSON::encode($response);

	}
	
	protected function beforeAction($action)
	{
		return true;
	}
	
	
}

?>