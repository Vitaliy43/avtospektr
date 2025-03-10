<?php

class CTime
{
 	
 public $days_in_year;
 public static $days_month=array(1=>31,2=>28,3=>31,4=>30,5=>31,6=>30,7=>31,8=>31,9=>30,10=>31,11=>30,12=>31);
 public $months_names=array(1=>'Январь',2=>'Февраль',3=>'Март',4=>'Апрель',5=>'Май',6=>'Июнь',7=>'Июль',8=>'Август',9=>'Сентябрь',10=>'Октябрь',11=>'Ноябрь',12=>'Декабрь');
 public static $months_names_declension=array(1=>'Января',2=>'Февраля',3=>'Марта',4=>'Апреля',5=>'Мая',6=>'Июня',7=>'Июля',8=>'Августа',9=>'Сентября',10=>'Октября',11=>'Ноября',12=>'Декабря');
 public static $contain_seconds=array(
 'minute'=>60,
 'hour'=>3600,
 'day'=>86400
 );



	public static function data_for_filename($data1,$data2)
	{
		
		$data1=str_replace('.','_',$data1);
		$data2=str_replace('.','_',$data2);
		$data="$data1-$data2";
		
		return $data;
		
	}
	
	public static function min_data()
	{
		$res=Yii::app()->db->createCommand(array(
    	'select'=>'MIN(data_shipping) AS min_data',
    	'from'=>'orders_archive'
	))->queryRow();
		return $res['min_data'];
	}
	
	public static function max_data()
	{
		$res=Yii::app()->db->createCommand(array(
    	'select'=>'MAX(data_shipping) AS max_data',
    	'from'=>'orders_archive'
	))->queryRow();
		return $res['max_data'];
	}
	
	
	public static function differ_time($date1,$date2,$measure)
	{
		$differ=$date2-$date1;
		if(($differ/self::$contain_seconds[$measure])>=1)
			return true;
		return false;
	}


	public static function human_to_unix($datestr = '')
	{
		if ($datestr == '')
		{
			return FALSE;
		}

		$datestr = trim($datestr);
		$datestr = preg_replace("/\040+/", ' ', $datestr);

		if ( ! preg_match('/^[0-9]{2,4}\-[0-9]{1,2}\-[0-9]{1,2}\s[0-9]{1,2}:[0-9]{1,2}(?::[0-9]{1,2})?(?:\s[AP]M)?$/i', $datestr))
		{
			return FALSE;
		}

		$split = explode(' ', $datestr);

		$ex = explode("-", $split['0']);

		$year  = (strlen($ex['0']) == 2) ? '20'.$ex['0'] : $ex['0'];
		$month = (strlen($ex['1']) == 1) ? '0'.$ex['1']  : $ex['1'];
		$day   = (strlen($ex['2']) == 1) ? '0'.$ex['2']  : $ex['2'];

		$ex = explode(":", $split['1']);

		$hour = (strlen($ex['0']) == 1) ? '0'.$ex['0'] : $ex['0'];
		$min  = (strlen($ex['1']) == 1) ? '0'.$ex['1'] : $ex['1'];

		if (isset($ex['2']) && preg_match('/[0-9]{1,2}/', $ex['2']))
		{
			$sec  = (strlen($ex['2']) == 1) ? '0'.$ex['2'] : $ex['2'];
		}
		else
		{
			// Unless specified, seconds get set to zero.
			$sec = '00';
		}

		if (isset($split['2']))
		{
			$ampm = strtolower($split['2']);

			if (substr($ampm, 0, 1) == 'p' AND $hour < 12)
				$hour = $hour + 12;

			if (substr($ampm, 0, 1) == 'a' AND $hour == 12)
				$hour =  '00';

			if (strlen($hour) == 1)
				$hour = '0'.$hour;
		}

		return mktime($hour, $min, $sec, $month, $day, $year);
	}

	
	
	public static function get_from_date($date,$type)
	{
		list($data,$time)=explode(' ',$date);
		list($year,$month,$day)=explode('-',$data);
		return self::cut_zero($$type);
	}
	
	public static function get_days_in_month($year,$month)
	{
		if($month==2 and $year%4==0)
			$add=1;
		else
			$add=0;
			
		return self::$days_month[$month]+$add;
	}
	
	 
	
	public static function calendar_data()
	{
		$month=self::add_zero(date('m'));
		$day=self::add_zero(date('d'));
		$year=self::add_zero(date('Y'));
		return $day.'.'.$month.'.'.$year;
		
	}


	public static function data_to_db($data,$add_time=false)
	{
		
		if(strstr($data,'.')<>''):
		
		$buffer=explode('.',$data);
		if($add_time)
			$new_data="$buffer[2]-$buffer[1]-$buffer[0] ".date('H:i:s');
		else
			$new_data="$buffer[2]-$buffer[1]-$buffer[0] 00:00:00";

		
		else:
		
		$new_data=$data;
		
		endif;
		
		return $new_data;
		
		
	}


 public static function change_show_data($data)
 {
 	
	$temp = explode(' ',$data);
	$date=$temp[0];
	$time=$temp[1];
	$buffer=explode('-',$date);
	$year=$buffer[0];
	$month=$buffer[1];
	$day=$buffer[2];
	$new_date=$day.'.'.$month.'.'.$year;
	$new_data=$new_date.' '.$time;
	return $new_data;
	
	
 }
 
 
 
 function prev_day($day){
 	
	$day=date('j');
	$month=date('n');
	$year=date('Y');
	$leap=date('L');
	
	$prev_day=$day-1;
	
	if($leap)$this->days_month[2]=29;
	
	if($prev_day=='0'){
		
		$month-=1;
		
		if($month<>0){
			$prev_day=$this->days_month[$month];
			$prev_year=$year;
			$prev_month=$month-1;
			
			
		}
		else{
			$prev_month=12;
			$prev_day=31;
			$prev_year=$year-1;
			
			
		}
	
	
	
	}
	
	else{
		
		
	$prev_day=$day-1;
			$prev_year=$year;
			$prev_month=$month;	
		
		
	}
	
	$data=$prev_year.'-'.$this->add_zero($prev_month).'-'.$this->add_zero($prev_day);
	
	return $data;
	
	
 }

 function get_next_day($data){
        // echo "data $data <br>";

		list($year,$month,$day)=explode('-',$data);

		//echo "year $year month $month day $day <br>";


			$month=$this->cut_zero($month);
			$day=$this->cut_zero($day);


		//	echo "year $year month $month day $day <br>";

		$res=mysql_query("select number from data where month=$month and day=$day");
		$num=mysql_result($res,0,'number');

//echo "num $num <br>";
		$num++;

		if($num>$this->days_in_year) $num=1;

		$res=mysql_query("select day,month from data where number=$num");
		$day=mysql_result($res,0,'day');
		$month=mysql_result($res,0,'month');

		//echo "day $day month $month <br>";

		$result['day']=$day;
		$result['month']=$month;


           return $result;


        }


        public static function add_zero($num){

         if(strlen($num)==1) $num='0'.$num;
         return $num;

        }

        public static function cut_zero($num){

        if(strlen($num)==2 and substr($num,0,1)=='0') $num=substr($num,-1);
        return $num;

        }



	    function get_data_by_num($num){


			if($num<1) $num=365+$num;
	     $res=mysql_query("select day,month from data where number=$num");
	     $day=$this->add_zero(mysql_result($res,0,'day'));
	     $month=$this->add_zero(mysql_result($res,0,'month'));
	     $data="$day.$month";
	     return $data;


	    }

        function  string_data($date){

        $buffer=explode('-',$date);
        $year=$buffer[0];
        $month=$this->cut_zero($buffer[1]);
        $day=$this->cut_zero($buffer[2]);
        $str="$day ".$this->months_names_declension[$month]." $year г.";
        return $str;

        }

        function time_null($data){


         $data=str_replace('0000-00-00 00:00:00','-',$data);

		if($data=='') $data='-';

         return $data;

        }


        function get_num_by_data($data){

         list($data,$time)=explode(' ',$data);
         list($year,$month,$day)=explode('-',$data);

         $month=$this->cut_zero($month);
         $day=$this->cut_zero($day);

         $res=mysql_query("select number from data where day=$day and month=$month");
         $number=mysql_result($res,0,'number');
         return $number;

        }



	    function set_data_by_num(){

		global $base;

		 $res=mysql_result('select count(number) from data');
         $num_days=mysql_result($res,'count(number)');
        

         if($num_days<>$this->days_in_year) :

           mysql_query('truncate data');



         if($this->days_in_year==366){



         $this->days_month[2]=29;
         }
         else{
         $this->days_month[2]=28;   }


            $counter=0;
         for($i=1;$i<13;$i++):

         for($k=1;$k<$this->days_month[$i]+1;$k++):

         $counter++;


 			$fields=array('day'=>$k,'month'=>$i,'number'=>$counter);
            $base->insert('data',$fields);

         endfor;
         endfor;


         endif;


	    }


     	function list_last_months(){


		 $num_month=6;
         $curr_month=date('n');


         $end_year=$curr_month;
         $begin_year=$end_year-6;

         for($i=$begin_year;$i<$end_year+1;$i++):


         	if($i>12){ $num=$i-12;}
         	else{$num=$i;}

         	$months[$num]=$this->months_names[$num];



         endfor;


           return $months;


     	}








	    function set_days_in_year(){

	         if(date('L')) {$this->days_in_year=366;


}


        else
        {$this->days_in_year=365;}



	    }


        function list_date($mode){

        global $base;

		$curr_month=date('n');

        switch($mode){

         case 'm':
               $dates=$base->select("data","day,month","month=$curr_month");
             //  print_r($dates);

         break;


        }

return $dates;
        }
}

?>