<?php

Yii::import('application.modules.autoparts.models.TypePayments');


class ProfileController extends Controller
{
	public function actionIndex()
	{
		$this->pageTitle='Профиль пользователя '.$this->prefix_title;
		$user=Users::model()->findByPk(UserIdentity::getProperty('id'));
		$type_payments=TypePayments::model()->getAllForFilter();
		unset($type_payments[0]);
		if(isset($_POST['type'])):
			ob_start();
			$this->render('index',array('user'=>$user,'type_payments'=>$type_payments));
			$response['content']=ob_get_contents();
			ob_clean();
			echo CJSON::encode($response);
		
		else:
			$this->render('index',array('user'=>$user,'type_payments'=>$type_payments));
		
		endif;

	}
	
	protected function beforeAction($action)
	{
	
		parent::beforeAction($action);		
		$this->breadcrumbs['Профиль']=SITE_PATH.$this->module->id.'/profile';

		return true;
	}
	
}

?>