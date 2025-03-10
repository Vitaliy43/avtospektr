<?php

Yii::import('application.modules.autoparts.models.Accesses');
Yii::import('application.modules.autoparts.models.Markups');

class WebService extends Model{
	
	public $guest_id = 63;
	public $authorized_id = 64;
	
	function __construct() {
   }


    function access($key,$purchase_point=null){
        
		if($purchase_point==null)
	 		return Accesses::model()->find('site=:site',array(':site'=>$key));
		else
			return Accesses::model()->find('id_enter=:purchase_point_id',array(':purchase_point_id'=>$key));

	}
	
	protected function file_get_contents($link)
	{
		$ch = curl_init($link);
    	curl_setopt($ch, CURLOPT_HEADER, 0);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    	$screen = curl_exec($ch); 
    	curl_close($ch);  
		return $screen; 
	}
	
	public function getComplexMarkups($distributor_id,$user_id=null)
	{
		$criteria=new CDbCriteria;
		$criteria->condition='user_id=:user_id AND distributor_id=:distributor_id AND price_range IS NOT NULL';
		if($user_id)
			$criteria->params=array(':user_id'=>$user_id,':distributor_id'=>$distributor_id);
		else
			$criteria->params=array(':user_id'=>UserIdentity::getProperty('id'),':distributor_id'=>$distributor_id);
		$criteria->order='price_range';
		$markups=Markups::model()->findAll($criteria);
		return $markups;
	}
	
	public function getMarkup($markups,$price)
	{
		foreach($markups as $markup){
			if($price<$markup->price_range){
				$add_price=$markup->markup;
				break;
			}
		}
		if(isset($add_price))
			return ($add_price/100)+1;
		return false;
	}
	
	public function getBaseMarkup($distributor_id,$price_default,$user_id=null)
	{
		if($user_id)
			$markup=Markups::model()->find('user_id=:user_id AND distributor_id=:distributor_id AND price_range IS NULL',array(':user_id'=>$user_id,':distributor_id'=>$distributor_id));
		else
			$markup=Markups::model()->find('user_id=:user_id AND distributor_id=:distributor_id AND price_range IS NULL',array(':user_id'=>UserIdentity::getProperty('id'),':distributor_id'=>$distributor_id));
        if($markup){
            return $markup->markup;
        }
        else{
            return $price_default;
        }

	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return 'search_result';
	}
	
	 function check_domain_available($domain)
  {
  if (!filter_var($domain, FILTER_VALIDATE_URL))
    return false;

  $curlInit = curl_init($domain);
  curl_setopt($curlInit, CURLOPT_CONNECTTIMEOUT, 10);
  curl_setopt($curlInit, CURLOPT_HEADER, true);
  curl_setopt($curlInit, CURLOPT_NOBODY, true);
  curl_setopt($curlInit, CURLOPT_RETURNTRANSFER, true);

  $response = curl_exec($curlInit);
  curl_close($curlInit);

  if ($response)
    return true;
  return false;
  }
	
}

/*
**
* Класс работы с SOAP-клиентом
* 
* Класс реализует логику работы с сервисами компании Автостелс, 
* через модуль расширения PHP - SOAP
* 
* @author Autostels
* @version 1.1
*/
  class soap_transport
  {
  //private $_wsdl_uri = 'https://allautoparts.ru/WEBService/SearchService.svc/wsdl?wsdl';   //Ссылка на WSDL-документ сервиса
  
  
  
  
    
    public $_wsdl_uri = "https://allautoparts.ru/WEBService/SearchService.svc";   
    //Ссылка на WSDL-документ сервиса
    
    private static $_soap_client = false;                                                    //Объект SOAP-клиента
    private static $_inited = false;                                                         //Флаг инициализации

   /**  
    * init
    * 
    * Инициализирует класс, создаёт объект SOAP-клиента и открывает соединение
    * 
    * @param &array $errors ссылка на текущий массив ошибок
    * @return true в случае успеха, false при ошибке
    */
    public function init(&$errors)
    {
      if(!self::$_inited)
      {
         try
         {
             
            
           if (self::$_soap_client = @new SoapClient($this->_wsdl_uri, array('soap_version' => SOAP_1_1)))
               self::$_inited = true;
         }
         catch (Exception $e)
         {
            $errors[] = 'Произошла ошибка связи с сервером Автостэлс. '.$e->getMessage();
            return false;
         }
      }
      return self::$_inited;
    }

    /**  
     * query
     * 
     * Выполняет запрашиваемый метод сервиса
     * 
     * @param string $method имя метода
     * @param string $requestData данные запроса
     * @param &array $errors ссылка на текущий массив ошибок
     * @return объект SimpleXMLElement в случае успеха, false при ошибке
     */
    public function query($method, $requestData, &$errors)
    {
      //Инициализация
      if (!$this->init($errors))
      {
        $errors[] = 'Ошибка соединения с сервером Автостэлс: Не может быть инициализирован класс SoapClient';
        return false;
      }
      
      //Выполнение запроса
      $result =  self::$_soap_client->$method($requestData);
      $resultKey = $method.'Result';
      
      //Проверка ответа на соответствие формату XML
      try
      {
        $XML = new SimpleXMLElement($result->$resultKey);
      }
      catch (Exception $e)
      {
        $errors[] = 'Ошибка сервиса Автоселс: полученные данные не являются корректным XML';
        return false;
      }
      
      //Проверка ответа на ошибки
      if(isset($XML->error)) {
        $errors[] = 'Ошибка сервиса Автоселс: '.(string)$XML->error->message;
        if ((string)$XML->error->stacktrace)
          $errors[] = 'Отладочная информация: '.(string)$XML->error->stacktrace;
        return false;
      }
      
      //Закрытие соединение
      $this->close();
      
      return $XML;
    }
    
    /**  
     * close
     * 
     * Закрывает соединение
     * 
     * @param void
     * @return void
     */
    public function close()
    {
      if( self::$_inited )
      {
        self::$_inited = false;
        self::$_soap_client = false;
      }
    }

  }







?>