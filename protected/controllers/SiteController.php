<?php


class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	 
	

	public $screen_width;
	 
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		
		$this->pageTitle='Интернет-магазин Автоспектр';
		
	}
	
	
	public function actionInfo()
	{
		
		
	}
	
	public function actionContacts()
	{
		
	}
	
	public function actionAuto()
	{
		
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}
	
	
	protected function beforeAction($action)
	{
		parent::beforeAction($action);
		$action=$this->getAction()->getId();
		if($action=='index')
			$action='main';
		$article = '';

		$item=UserMenu::model()->find('name=:name',array(':name'=>$action));
		if($action!='auto'){
			if(isset($item->id))
				$article=Content::model()->find('user_menu_id=:id',array(':id'=>$item->id));

		}
		else{
			if(isset($_REQUEST['car_id']))
				$article=Content::model()->find('auto_car_id=:id',array(':id'=>$_REQUEST['car_id']));

		}
		if($article):
		
		 if($action=='main'){
		 	
		 }
		
		 else{
		 	$this->breadcrumbs[$item->show_name]='/site/'.$action;

		 }
		 
		 if($action=='auto'){
		 	$this->breadcrumbs[$article->header]='/site/'.$action.'/auto?car_id='.$article->auto_car_id;
			$link=Utility::getLinkFromContent($article->content);
			if($link)
				$this->redirect($link);
		 }
		 
		if($action!='main')
			$this->pageTitle=$item->show_name.' '.$this->prefix_title;
		else
			$this->pageTitle='Главная страница '.$this->prefix_title;
		if(isset($_POST['type'])){
			$response['content']=$this->render('article',array('article'=>$article),true);
			echo CJSON::encode($response);
		}
		else{
			
			$this->render('article',array('article'=>$article));
		}
		endif;
		
		
		
		return true;
	}

	/**
	 * Displays the contact page
	 */
	
	

	/**
	 * Displays the login page
	 */
	
	
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	
	
}