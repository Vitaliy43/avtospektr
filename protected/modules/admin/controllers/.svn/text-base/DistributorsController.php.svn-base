<?php

Yii::import('application.modules.autoparts.models.Distributors');
Yii::import('application.modules.autoparts.models.Accesses');

class DistributorsController extends Controller
{
	
	public function actionIndex()
	{
		$this->pageTitle='Поставщики '.$this->prefix_title;
		$distributors=Distributors::model()->getDistributors();
		
		if(isset($_POST['type'])):
		
		ob_start();
		$this->render('index',array('distributors'=>$distributors));
		$response['content']=ob_get_contents();
		$response['title']=$this->pageTitle;
		ob_clean();
		echo CJSON::encode($response);
		
	else:
		$this->render('index',array('distributors'=>$distributors));


	endif;
	}
	
	public function actionEdit()
	{
		$distributor_id=$_REQUEST['distributor_id'];
		$this->pageTitle='Редактирование поставщиков '.$this->prefix_title;
			
		$distributor=Distributors::model()->getDistributorsById($distributor_id);
		$distributor_activity_roles=DistributorActivity::model()->roles;
		
		if(isset($_POST['type'])):
		
		ob_start();
		$this->render('edit',array('distributor'=>$distributor,'distributor_activity_roles'=>$distributor_activity_roles));
		$response['content']=ob_get_contents();
		$response['title']=$this->pageTitle;
		ob_clean();
		echo CJSON::encode($response);
		
	else:
		$this->render('edit',array('distributor'=>$distributor,'distributor_activity_roles'=>$distributor_activity_roles));
	endif;
	
	}
	
	
	protected function beforeAction($action)
	{
		$action=$this->getAction()->getId();
		$this->model_name='Distributors';

		parent::beforeAction($action);
		
		if(isset($_REQUEST['update'])){
			Distributors::model()->updateDistributor($_REQUEST['distributor_id']);
			
		}
			
		return true;
	}
}

?>