<?php


class OptionsController extends Controller
{
	
	public function actionPagesize()
	{
		
		$page_size=$_POST['page_size'];
		
		if($page_size){
			
			
			if(isset($_SESSION['page_size'])){
				unset($_SESSION['page_size']);
			}
			$_SESSION['page_size']=$page_size;
			
			$response['answer']='true';
			
			echo CJSON::encode($response);
			
		}
		
		
	}
	
	public function actionPoint()
	{
		if(isset($_REQUEST['type'])):
		UserIdentity::setPurchasePoint($_GET['purchase_point'],true);		
		$new_point=UserIdentity::getPurchasePoint();
			$response['answer']=1;
		echo CJSON::encode($response);
		
		endif;
		
	}
	
		protected function beforeAction($action)
		{
				$action=$this->getAction()->getId();
				$this->layout='ajax';
				return true;
		}
}

?>