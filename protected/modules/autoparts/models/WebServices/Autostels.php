<?php

class Autostels extends WebService {
    
    protected $check_url='http://allautoparts.ru';
	
    public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return 'search_result';
	}
    
    public $site='allautoparts.ru';
    
    
    function get_wsdl($service){
        
        $wsdl="https://allautoparts.ru/WEBService/".$service."Service.svc/wsdl?wsdl"; 
        
        return $wsdl;
        
    } 
    
    
    
	 function generateRandom($maxlen = 32) {
      $code = '';
      while (strlen($code) < $maxlen) {
         $code .= mt_rand(0, 9);
      }
      return $code;
   }
   
   
   
   
	
	
	 function createAddBasketRequestXML($data) {
      $session_info = $data['session_guid'] ?
			'SessionGUID="'.$data['session_guid'].'"' :
			'UserLogin="'.base64_encode($data['session_login']).'" UserPass="'.base64_encode($data['session_password']).'"';
		$xml = '<root>
                 <SessionInfo ParentID="'.$data['session_id'].'" '.$session_info.' />
                 <rows>
                    <row>
                        <Reference>'.$data['Reference'].'</Reference>
                        <AnalogueCodeAsIs>'.$data['AnalogueCodeAsIs'].'</AnalogueCodeAsIs>
                        <AnalogueManufacturerName>'.$data['AnalogueManufacturerName'].'</AnalogueManufacturerName>
                        <OfferName>'.$data['OfferName'].'</OfferName>
                        <LotBase>'.$data['LotBase'].'</LotBase>
                        <LotType>'.$data['LotType'].'</LotType>
                        <PriceListDiscountCode>'.$data['PriceListDiscountCode'].'</PriceListDiscountCode>
                        <Price>'.$data['Price'].'</Price>
                        <Quantity>'.$data['Quantity'].'</Quantity>
                        <PeriodMin>'.$data['PeriodMin'].'</PeriodMin>
                        <ConstraintPriceUp>-1</ConstraintPriceUp>
                        <ConstraintPeriodMinUp>-1</ConstraintPeriodMinUp>
                    </row>
                 </rows>
				</root>';
		return $xml;
   }
   
   function insert_base($result){
		
		$distributor=Distributors::model()->find('site=:site',array(':site'=>$this->site));

        $base_markup=$this->getBaseMarkup($distributor->id,$distributor->add_price_default);
		if(UserIdentity::getProperty('role'))
			$complex_markups=$this->getComplexMarkups($distributor->id);	
		else
			$complex_markups=$this->getComplexMarkups($distributor->id,$this->guest_id);		
		$base_add_price=($base_markup/100)+1; 

		list($period_min,$period_max)=explode('/',$distributor->period_delivery);
		$command = Yii::app()->db->createCommand();


  foreach($result as $row){

   $period=$row['PeriodMin'].'/'.$row['PeriodMax'];
   $new_period_min=$row['PeriodMin']+$period_min;
   $new_period_max=$row['PeriodMax']+$period_max;

   $period=$new_period_min.'/'.$new_period_max;
//   if(UserIdentity::getProperty('role'))
   		$complex_add_price=$this->getMarkup($complex_markups,$row['Price']);
//	else
//		$complex_add_price=false;
   if($complex_add_price==false)
   		$add_price=$base_add_price;
	else
		$add_price=$complex_add_price;

	if(UserIdentity::getProperty('role')){
		 $fields=array('id'=>null,
   		'manufacturer'=>$row['AnalogueManufacturerName'],
   		'number'=>CString::cut_spaces($row['AnalogueCodeAsIs']),
   		'info'=>$row['ProductName'],
   		'price'=>round($row['Price'],1),
   		'price_client'=>round($row['Price']*$add_price,1),
   		'period'=>$period,
   		'period_min'=>$row['PeriodMin']+$new_period_min,
   		'period_max'=>$row['PeriodMax']+$new_period_max,
   		'quantity'=>$row['Quantity'],
   		'distributor_id'=>$distributor->id,
   		'uniq_id'=>$row['Reference'],
   		'user_id'=>UserIdentity::getProperty('id')
   		);
		$command->insert('search_result',$fields);

	}
	else{
		
		 $fields=array('id'=>null,
   		'manufacturer'=>$row['AnalogueManufacturerName'],
   		'number'=>CString::cut_spaces($row['AnalogueCodeAsIs']),
   		'info'=>$row['ProductName'],
   		'price'=>round($row['Price'],1),
   		'price_client'=>round($row['Price']*$add_price,1),
   		'period'=>$period,
   		'period_min'=>$row['PeriodMin']+$new_period_min,
   		'period_max'=>$row['PeriodMax']+$new_period_max,
   		'quantity'=>$row['Quantity'],
   		'distributor_id'=>$distributor->id,
   		'uniq_id'=>$row['Reference'],
	   'ip'=>$_SERVER['REMOTE_ADDR']
   		);
		$command->insert('search_result_guests',$fields);

	}
  
		
	}
	
	
}
   
	
	 function parseAddBasketResponseXML($xml) {
      $data = array();
		foreach($xml->rows->row as $row) {
			$_row = array();
			foreach($row as $key => $field) {
				$_row[(string)$key] = (string)$field;
			}
			$data[] = $_row;
		}
		return $data;
   }
	
	
    
    function ordersInWork($data){
	
	
		$access=$this->access($this->site);

		
		$defaults = array(
		'session_id' => $access['id'],
		'session_guid' => '',
		'session_login' => $access['login'],
		'session_password' => $access['pass'],
		
		
	);
	
	$parsed_data=array_merge($defaults,$data);
	
	$SOAP = new soap_transport();

		
    
    $SOAP->_wsdl_uri=$this->get_wsdl('Order');
    
    //print_r($parsed_data);

					//Генерация запроса
                    
					$requestXMLstring = $this->createOrdersInWorkXML($parsed_data);
                    
                    //echo htmlspecialchars($requestXMLstring);

                $errors=array();
					//Выполнение запроса
					$responceXML = $SOAP->query('OrdersInWork', array('SearchParametersXml' => $requestXMLstring), $errors);
                    
    
    	
	}
	
	function createOrdersInWorkXML($data){
		
		
		$session_info = $data['session_guid'] ?
			'SessionGUID="'.$data['session_guid'].'"' :
			'UserLogin="'.base64_encode($data['session_login']).'" UserPass="'.base64_encode($data['session_password']).'"';
		
		$xml='<root>

	<SessionInfo ParentID="'.$data['session_id'].'" '.$session_info.'/>

  <parameters>

    <states>

      <state>'.$data['state'].'</state>

    </states>

    <orderNums>
    
        <orderNum>Zakaz_1</orderNum>

      

    </orderNums>

    <stocksonly>0</stocksonly>

    <dateFrom>'.$data['data_from'].'</dateFrom>

    <dateTo>'.$data['data_to'].'</dateTo>

    <searchArticles>

      <searchArticle searchType="article"><![CDATA[425430]]></searchArticle> 

    </searchArticles>

    <sort>cost ASC</sort>

    <page>

      <pageNumber>1</pageNumber>

      <pageLength>100</pageLength>

    </page>

  </parameters>

</root>';

	return $xml;
		
		
	}
	
    
    
    
    function validateData(&$data, &$errors) {
		if (!$data['search_code'])
			$errors[] = 'Необходимо ввести номер для поиска';

		if (!$data['session_id'])
			$errors[] = 'Необходимо указать ID входа для работы с сервисом';

		if ((!$data['session_login'] || !$data['session_password']) && !$data['session_guid'])
			$errors[] = 'Необходимо ввести логин и пароль'.$data['session_guid'];

		$data['instock'] = $data['instock'] ? 1 : 0;
		$data['showcross'] = $data['showcross'] ? 1 : 0;
		$data['periodmin'] = $data['periodmin'] ? (int)$data['periodmin'] : -1;
		$data['periodmax'] = $data['periodmax'] ? (int)$data['periodmax'] : -1;

		return count($errors) ? false : true;
	}
    
    
    function parseSearchResponseXML($xml) {
		$data = array();
		foreach($xml->rows->row as $row) {
			$_row = array();
			foreach($row as $key => $field) {
				$_row[(string)$key] = (string)$field;
			}
         $_row['Reference'] = $this->generateRandom(9);
			$data[] = $_row;
		}
		return $data;
	}
    
	
	function createSearchRequestXML($data) {
		$session_info = $data['session_guid'] ?
			'SessionGUID="'.$data['session_guid'].'"' :
			'UserLogin="'.base64_encode($data['session_login']).'" UserPass="'.base64_encode($data['session_password']).'"';

		$xml = '<root>
				  <SessionInfo ParentID="'.$data['session_id'].'" '.$session_info.'/>
				  <search>
					 <skeys>
						<skey>'.$data['search_code'].'</skey>
					 </skeys>
					 <instock>'.$data['instock'].'</instock>
					 <showcross>'.$data['showcross'].'</showcross>
					 <periodmin>'.$data['periodmin'].'</periodmin>
					 <periodmax>'.$data['periodmax'].'</periodmax>
				  </search>
				</root>';
		return $xml;
	}
	
	function search($search_code){
		
    
	$access=$this->access($this->site);
	if (!$this->check_domain_available($this->check_url)){
   return false;
    
}
   	
	//Обработка входных данных:
	//Значения формы по-умолчанию
	if(isset($_REQUEST['CrossType']))
		$showcross='ON';
	else
		$showcross='';
	
	$defaults = array(
		'session_id' => $access['id_enter'],
		'session_guid' => '',
		'session_login' => $access['login'],
		'session_password' => $access['password'],
		'search_code' => $search_code,
		'instock' => 'ON',
		'showcross' => $showcross,
		'periodmin' => 0,
		'periodmax' => 10,
	);
	
		
		$errors = array();
				$parsed_data = $defaults;	//Данные из формы копируются в другую переменную, чтобы
												//подготовить их для формирования запроса.
												//Исходные данные будут отображены на форме.

				//Проверка данных
				
                if ($this->validateData($parsed_data, $errors)) {
					//Подключение класса SOAP-клиента и создание экземпляра
                    
                    
                    
                    
					$SOAP = new soap_transport();
					if(!$SOAP)
						return false;
                    
                    
                    
                    $SOAP->_wsdl_uri=$this->get_wsdl('Search');

					//Генерация запроса
					$requestXMLstring = $this->createSearchRequestXML($parsed_data);
                    
                   
                   
                    //echo "errors $errors <br>";
                   // var_dump($errors);

					//Выполнение запроса
					$responceXML = $SOAP->query('SearchOffer', array('SearchParametersXml' => $requestXMLstring),$errors);
                    
                    
                   
                   

					//Получен ответ
					if ($responceXML) {
						//Установка параметра session_guid, полученного из ответа сервиса.
						//Параметр используется, как замена связке session_login + session_password,
						//и при повторном поиске может быть подставлен в запрос вместо неё
						$attr = $responceXML->rows->attributes();
						$data['session_guid'] = (string)$attr['SessionGUID'];

						//Разбор данных ответа
						$result = $this->parseSearchResponseXML($responceXML);
					}
                    
                   
				}
    
		
		if(isset($result) and count($result)>0)$this->insert_base($result);
		
	}
    
    }
	

