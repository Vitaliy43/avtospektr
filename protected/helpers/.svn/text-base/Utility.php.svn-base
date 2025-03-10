<?php

class Utility 
{
	public static function createListStatuses($statuses,$status_groups,$id)
	{
		if($id==1)
			$group='waiting';
		else
			$group='working';
			
			foreach($statuses as $status){
				
				if(in_array($status->id,$status_groups[$group]))
					$arr[$status->id]=$status->show_status;
			}
			
			if($id==1)
				$arr[2]=str_replace('Пущено','Пустить',$arr[2]);
			
		return $arr;
	}
	
	public static function getLinkFromContent($text)
	{
		$text=str_replace('&amp;','&',$text);
		$res=preg_match('/(http:\/\/|https:\/\/)([^"]+)/', $text,$matches);
		if(!$res)
			return false;
		$result=trim($matches[0],'"');
		return $result;
	}
	
	public static function createForSelect($objects,$key,$value,$type='objects')
	{
		$arr[0]='------';
		for($i=0;$i<count($objects);$i++){
			if($type=='objects')
				$arr[$objects[$i]->$key]=$objects[$i]->$value;
			else
				$arr[$objects[$i][$key]]=$objects[$i][$value];

		}
		
		return $arr;
	}
	
	public static function image_get_sizes($filename,$max_height, $max_width){
 	
	$sizes = getimagesize($filename);
	$width = $sizes[0];
	$height = $sizes[1];
	$proportion = $height/$width;
	if($width > $height){
		$result['width'] = $max_width;
		$result['height'] = round($max_width * $proportion);
	}
	else{
		$result['height'] = $max_height;
		$result['width'] = round($max_height / $proportion);
	}
	
	return $result;
		
 }
	
	public static function generate_password($number)
  {
    $arr = array('a','b','c','d','e','f',
                 'g','h','i','j','k','l',
                 'm','n','o','p','r','s',
                 't','u','v','x','y','z',
                 'A','B','C','D','E','F',
                 'G','H','I','J','K','L',
                 'M','N','O','P','R','S',
                 'T','U','V','X','Y','Z',
                 '1','2','3','4','5','6',
                 '7','8','9','0');
    // Генерируем пароль
    $pass = "";
    for($i = 0; $i < $number; $i++)
    {
      // Вычисляем случайный индекс массива
      $index = rand(0, count($arr) - 1);
      $pass .= $arr[$index];
    }
    return $pass;
  }
	
	
	
	
	public static function countSumSale($data_shipping,$user_id)
	{ 
	
		$criteria=new CDbCriteria;
		$criteria->select='sum';
		$criteria->condition='data_shipping=:data_shipping AND user_id=:user_id';
		$criteria->params=array(':data_shipping'=>$data_shipping,':user_id'=>$user_id);
		$result=OrdersSales::model()->find($criteria);
	 	return round($result->sum,2);
		
	}
	
	public static function getClientDetailedInfo($client)
	{
		$distributors=Distributors::model()->getListDistributors();
		$all_markups=Markups::model()->findAll();
//		$html='Лимит для кредита: '.$client->client[0]->limit_credit.' руб.&nbsp;';
		//$html='Наценки: ';
		$html='';
		
		$markups=Markups::model()->getArrayByKey($all_markups,'user_id',$client->id,'distributor_id');
		
		foreach($markups as $key=>$value){
			
			$html.=$distributors[$key].':&nbsp;'.$value.'%&nbsp;';
			
		}
		
		return $html;
	}
	
	
	
	
	
	/////////////////// Выдает массив из ключей другого массива со значением равным кол-ву элементов с данным ключом. Предполагается,что исходный массив отсортирован по нужному ключу /////////////////////////////////////////////////////////

public static function array_keys_count($arr,$key,$limit,$sort='desc'){

	$buffer='';
	foreach($arr as $element){
		
		$curr=$element[$key];	
//		echo 'curr '.$curr.'<br>';
		
		if($buffer!=$curr){
		
			$buffer=$curr;
			$counter=1;
			$buff_arr[$buffer]=$counter;
			
		}
		else{
			$counter++;
			$buff_arr[$buffer]=$counter;
			
		}
		
	}
	
	if($sort=='desc')
		arsort($buff_arr);
	
		$counter=0;
	
	foreach($buff_arr as $k=>$v){
		
		$counter++;	
		if($counter>$limit)
		break;		
		$new_arr[$k]=$v;	
	}
	
	return $new_arr;
	
}

	public static function getFirstYearOrders()
	{
		$res=Yii::app()->db->createCommand(array(
    	'select'=>'MIN(data_shipping) as first_shipping',
    	'from'=>'orders_archive',
	))->queryAll();
		$buffer=$res[0]['first_shipping'];
		return CTime::get_from_date($buffer,'year');
	}
	
	public static function getOrderStatistic($option)
	{
		$elems=Config::model()->item('statistic_orders_elements',1);
		
		if($option=='user' or $option=='distributor')
			$option.='_id';
	
		$items=Yii::app()->db->createCommand(array(
    	'select'=>$option,
    	'from'=>'orders_archive',
		'order'=>$option
	))->queryAll();
		$arr=self::array_keys_count($items,$option,$elems);
		
		
		if($option=='user_id' or $option=='distributor_id'){
			$arr=self::changeStatisticList($arr,$option);
		}
		
		
		return $arr;
		
	}
	
	public static function changeStatisticList($arr,$option)
	{
		if($option=='distributor_id'){
			Yii::import('application.modules.autoparts.models.Distributors');
			
			foreach($arr as $key=>$value){
				$distributor=Distributors::model()->findByPk($key);
				$new_arr[$distributor->name]=$value;
			}
		}
		else{
			
			foreach($arr as $key=>$value){
				$user=UserIdentity::getUser($key);
				
				$new_arr[$key]['value']=$value;
				$new_arr[$key]['fio']=$user['fio'];
				$new_arr[$key]['login']=$user['user'];
			}
		}
		
		return $new_arr;
		
	}
	
	public static function getClientsList()
	{
	
		$criteria=new CDbCriteria;
		$criteria->select='id,fio';
		$criteria->condition='id IN (SELECT user_id FROM user_roles WHERE role_id=2)';
		$criteria->order='fio';
		$buffer_clients=Users::model()->findAll($criteria);
		
		$clients[0]='Все';
		foreach($buffer_clients as $client){
			$clients[$client->id]=$client->fio;
		}
		
		return $clients;
	}
	
	public static function getListForChart($list)
	{
		$counter=0;
		$last_elem=count($list)-1;
		$str='';
		
		foreach($list as $key=>$value){
			
			if($value){
				$str.=$value;
				if($counter!=$last_elem)
					$str.=',';
				
			}
			
			$counter++;
		}
		
		return $str;
	}
	
	public static function getTicksForChart($list)
	{
		$max=max($list)*1.25;
		 if($max>10000){
		 	$divider=10000;
		 }
		 elseif($max>100000){
		 	$divider=100000;
		 }
		 else{
		 	return '';
		 }
		 
		 $step=$max/$divider;
		 $round_step=(ceil($step)*$divider);
		 $step=$round_step/5;
		 
		 $str='';
		 
		 for($i=0;$i<$round_step;$i=$i+$step){
		 	$str.=$i.',';
		 }
		 $str=substr($str,0,-1);
		 
		 return $str;
	}
	
	public static function translit($str)
	{
        $tr = array(
            "А"=>"A",
            "Б"=>"B",
            "В"=>"V",
            "Г"=>"G",
            "Д"=>"D",
            "Е"=>"E",
            "Ж"=>"ZH",
            "З"=>"Z",
            "И"=>"I",
            "Й"=>"I",
            "К"=>"K",
            "Л"=>"L",
            "М"=>"M",
            "Н"=>"N",
            "О"=>"O",
            "П"=>"P",
            "Р"=>"R",
            "С"=>"S",
            "Т"=>"T",
            "У"=>"U",
            "Ф"=>"F",
            "Х"=>"H",
            "Ц"=>"TS",
            "Ч"=>"CH",
            "Ш"=>"SH",
            "Щ"=>"SHCH",
            "Ъ"=>"",
            "Ы"=>"Y",
            "Ь"=>"'",
            "Э"=>"E",
            "Ю"=>"IU",
            "Я"=>"IA",
            "Г"=>"G",
            "Ї"=>"YI",
            "І"=>"I",
            "Є"=>"E",

            "а"=>"a",
            "б"=>"b",
            "в"=>"v",
            "г"=>"g",
            "д"=>"d",
            "е"=>"e",
            "ж"=>"zh",
            "з"=>"z",
            "и"=>"i",
            "й"=>"i",
            "к"=>"k",
            "л"=>"l",
            "м"=>"m",
            "н"=>"n",
            "о"=>"o",
            "п"=>"p",
            "р"=>"r",
            "с"=>"s",
            "т"=>"t",
            "у"=>"u",
            "ф"=>"f",
            "х"=>"h",
            "ц"=>"ts",
            "ч"=>"ch",
            "ш"=>"sh",
            "щ"=>"shch",
            "ъ"=>"",
            "ы"=>"y",
            "ь"=>"'",
            "э"=>"e",
            "ю"=>"iu",
            "я"=>"ia",
            "г"=>"g",
            "ї"=>"yi",
            "і"=>"i",
            "є"=>"e",
            " "=> "-",
            "."=> "", 
            ":"=> "", 
            ";"=> "", 
            "/"=> "-"
        );

        return strtr($str,$tr);
	}

	public static function translit_url($urlstr)
	{
        if (preg_match('/[^A-Za-z0-9_\-]/', $urlstr)) {
            $urlstr = self::$translit($urlstr);
            $urlstr = preg_replace('/[^A-Za-z0-9_\-]/', '', $urlstr);
        }

        return strtolower(self::$url_title($urlstr));
	}
	
	public static function url_title($str, $separator = 'dash', $lowercase = FALSE)
	{
		if ($separator == 'dash')
		{
			$search		= '_';
			$replace	= '-';
		}
		else
		{
			$search		= '-';
			$replace	= '_';
		}

		$trans = array(
						'&\#\d+?;'				=> '',
						'&\S+?;'				=> '',
						'\s+'					=> $replace,
						'[^a-z0-9\-\._]'		=> '',
						$replace.'+'			=> $replace,
						$replace.'$'			=> $replace,
						'^'.$replace			=> $replace,
						'\.+$'					=> ''
					);

		$str = strip_tags($str);

		foreach ($trans as $key => $val)
		{
			$str = preg_replace("#".$key."#i", $val, $str);
		}

		if ($lowercase === TRUE)
		{
			$str = strtolower($str);
		}

		return trim(stripslashes($str));
	}
	
}

?>