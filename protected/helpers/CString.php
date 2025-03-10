<?php
class CString
{

private $gunk=array(")","(");


private $translating_symbols1=array("Ya"=>"Я","ya"=>"я","Ye"=>"Е","ye"=>"е","yo"=>"ё","Yu"=>"Ю","yu"=>"ю","Y"=>"Й","y"=>"й","Th"=>"Ф","th"=>"ф","Ts"=>"Ц","ts"=>"ц","T"=>"Т","t"=>"т","Ph"=>"Ф","ph"=>"ф","P"=>"П","p"=>"п","Shch"=>"Щ","shch"=>"щ","Sh"=>"Ш","sh"=>"ш","Ch"=>"Ч","ch"=>"ч","A"=>"А","a"=>"а","B"=>"Б","b"=>"б","C"=>"К","c"=>"к","D"=>"Д","d"=>"д","E"=>"Э","e"=>"е","F"=>"Ф","f"=>"ф","G"=>"Г","g"=>"г","J"=>"Дж","j"=>"дж","I"=>"Ай","i"=>"и","Kh"=>"Х","kh"=>"х","K"=>"К","k"=>"к","Zh"=>"Ж","zh"=>"ж","H"=>"Х","h"=>"х","L"=>"Л","l"=>"л","M"=>"М","m"=>"м","N"=>"Н","n"=>"н","O"=>"О","o"=>"о","R"=>"Р","r"=>"р","S"=>"С","s"=>"с","U"=>"У","u"=>"у","V"=>"В","v"=>"в","Wa"=>"Уо","wa"=>"уо","Wo"=>"Уа","wo"=>"уа","Z"=>"З","z"=>"з","X"=>"Кс","x"=>"кс","Q"=>"Кв","q"=>"кв");

private $translating_symbols2=array("Ya"=>"Я","ya"=>"я","Ye"=>"Е","ye"=>"е","yo"=>"ё","Yu"=>"Ю","yu"=>"ю","Y"=>"Й","y"=>"й","Th"=>"Ф","th"=>"ф","Ts"=>"Ц","ts"=>"ц","T"=>"Т","t"=>"т","Ph"=>"Ф","ph"=>"ф","P"=>"П","p"=>"п","Shch"=>"Щ","shch"=>"щ","Sh"=>"Ш","sh"=>"ш","Ch"=>"Ч","ch"=>"ч","A"=>"А","a"=>"а","B"=>"Б","b"=>"б","C"=>"К","c"=>"к","D"=>"Д","d"=>"д","E"=>"Э","e"=>"е","F"=>"Ф","f"=>"ф","G"=>"Г","g"=>"г","J"=>"Дж","j"=>"дж","I"=>"И","i"=>"и","Kh"=>"Х","kh"=>"х","K"=>"К","k"=>"к","Zh"=>"Ж","zh"=>"ж","H"=>"Х","h"=>"х","L"=>"Л","l"=>"л","M"=>"М","m"=>"м","N"=>"Н","n"=>"н","O"=>"О","o"=>"о","R"=>"Р","r"=>"р","S"=>"С","s"=>"с","U"=>"У","u"=>"у","V"=>"В","v"=>"в","Wa"=>"Уо","wa"=>"уо","Wo"=>"Уа","wo"=>"уа","Z"=>"З","z"=>"з","X"=>"Кс","x"=>"кс","Q"=>"Кв","q"=>"кв");


	function output_html($html,$title){
	
		$output ='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>'.$title.'</title>
</head>
<body>';

	$output.=$html;
	return $output;
		
	}
	
	public static function mb_ucfirst($string){
		$first_symbol=mb_substr($string,0,1);
		$rest=mb_substr($string,1);
		return mb_strtoupper($first_symbol).$rest;
	}

	public static function output_doc($doc,$filename)
	{
		header("Content-Type: application/vnd.ms-word; charset = windows-1251\r\n");
		header("Content-Disposition: attachment; filename=$filename.doc");
		header("Content-Transfer-Encoding: binary");
		echo '<meta http-equiv=Content-Type content="text/html; charset=UTF-8">';  
		echo '<body>';
		echo $doc;
		
		echo '</body>';
	}

	public static function output_xls($xls,$filename)
	{
		
		header('Content-Type: text/x-csv; charset=utf-8');
		header("Content-Disposition: attachment;filename=$filename.xls");
		header("Content-Transfer-Encoding: binary ");
		
		$output ='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="author" content="Andrey" />
<title>deamur zapishi.net</title>
</head>
<body>';

$output.=$xls;
// закрываем тело страницы
$output .='</body></html>';
// И наконец выгрузка в EXCEL - что в скрипте как обычный вывод
return $output;
/*
// браузер выдаст окно на запрос загрузки и сохранения файла
// скрипт готов, пользуйтесь на здоровье !
// при перепечатке оставляйте ссылку на сайт zapishi.net :)
// Регистрируйтесь и публикуйте свои материалы на сайте - поможем друг
другу получить больше новых знаний! :)
*/

		
		
	}

			public static function escape_double_quote($str){
				
				$str=str_replace('"','˝',$str);
				return $str;
				
			}




			function cut_dividers($str,$array){
				
				foreach($array as $arr){
			//	echo "arr $arr <br>";
					$str=str_ireplace($arr,'',$str);
					
					
				}
				return $str;
			}



             public static function cut_spaces($string){

                      $string=str_replace(' ','',$string);
					  $string=str_replace('.','',$string);
					  $string=str_replace('-','',$string);
                      return $string;
                     }




         function cut_gunk($string,$trim){

         foreach($this->gunk as $char){
                  $string=str_replace($char,"",$string);

                 }
                 if($trim)$string=trim($string," ");
                  return $string;
                 }

                 function translate($word,$set=1){



switch($set){
case "1":

                     foreach($this->translating_symbols1 as $key=>$value){

                              $word=str_replace($key,$value,$word);

                             }
break;
case "2":
 foreach($this->translating_symbols2 as $key=>$value){

                              $word=str_replace($key,$value,$word);

                             }
break;



}


                         return $word;

                         }

                         function good_ucwords($string){

                         $words=explode(" ",$string);



                         foreach($words as $word){
                           $uc=substr($word,0,1);
                           $rest=substr($word,1);
                           $new_words[]=strtoupper($uc).$rest;

                         }

                            if(count($new_word)>1){
                                 $result=join(" ",$new_words);
                                 }
                                 else{$result=$new_words[0];}
                                  return $result;
                                 }

                public static function add_underline($string){

                           $string=str_replace(" ","_",$string);
                           return $string;
                                 }

                function cut_underline($string){

                           $string=str_replace("_"," ",$string);
                           return $string;
                                 }



function strip_tags_array($array){

print_r($array);


foreach($array as $key=>$value){
echo "$key $value <br>";
$new_array[$key]=strip_tags($value);

}

print_r($new_array);
return $new_array;
}


function clean_request($var){

 $var=strip_tags($var);
 $var=addslashes($var);
 return $var;

}


function set_dash($var){

 if(!$var) {$result='-';}
 else
 {$result=$var;}

 return $result;

}






 function declension ($word){

  mb_internal_encoding('UTF-8');
$buffer=$word;

  //echo "word $word <br>";
$last_symbol=mb_substr($word,-1);
//echo "last_symbol $last_symbol <br>";
$e=mb_substr($word,0,-1);
//echo "e $e <br>";
$e2=mb_substr($word,0,-2);
mb_regex_encoding('UTF-8');
//$last_symbol="ATT";
// $res=preg_match_all("#[[upper:]]#",mb_substr($last_symbol,-1));
$res=preg_match_all("#[А-Я]#uis",$last_symbol);
//$a=preg_match("#а#",$last_symbol);
//echo "res $res <br>";
$before_last=mb_substr($word,-2);
if(!$res):
if($before_last<>"ая"){
switch($last_symbol){

case "а":
$ending="ы"; $word=$e.$ending;
//echo "ending $ending <br>";
break;
case "я": $ending="и";
$word=$e.$ending;
break;
case "й": $ending="я";
$word=$e.$ending;
break;
case "ь": $ending="и";
$word=$e.$ending;
break;
case ($last_symbol=="о" or $last_symbol=="э" or $last_symbol=="у" or $last_symbol=="и" or $last_symbol=="."): $ending="";
break;
default:
$ending="а";

$word=$buffer.$ending;
}
}
else{

$ending="ой"; $word=$e2.$ending;
//echo "ending $ending <br>";

}
endif;

//endif;
return $word;
}

	static function get_cells($text,$width){
		
		$arr=str_split($text);
		$html='<table class="cells" cellspacing="0"><tr>';
		foreach($arr as $elem)
			$html.= '<td class="cell" style="width: '.$width.'%;">'.$elem.'</td>';
		
		$html.='</tr></table>';
		return $html;
	}


    }
      // echo mb_internal_encoding()."<br>";
?>