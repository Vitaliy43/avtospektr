<?php



$box='<div id="photoBox" style="display:none;">';

//print_r($brands);
$box.='<div class="container_search_result" style="padding: 10px 100px 10px 100px;background:#62C653;">';
$box.='<div style="margin-bottom:0px;"><h2 style="background-color:#fff; color: #444 !important ;">Выберите производителя</h2><div>&nbsp;</div></div>';
if(count($brands)>0):
$box.='<table border="1" cellpadding="0" cellspacing="0" class="search_panel" width=100%>';

//$counter=0;

$box.='<tr><td onclick="output_search_result(\'all\',\''.SITE_PATH.$this->module->id.'/search/result'.'\');"><font size="3">все производители</font></td></tr>';

foreach($brands as $brand):

//$box.="<tr id='tr_$counter' onmouseover='select_tr(this.id,1)' onmouseout='select_tr(this.id,0//)'>";
$box.="<tr>";

//$box.="<td class='changed_out' id='td_$counter'>".$brand['manufacturer']."</td>";
$manufacturer=$brand['manufacturer'];

$box.="<td onclick=\"output_search_result('$manufacturer','".SITE_PATH.$this->module->id.'/search/result'."');\"><font size='3'>".$manufacturer."</font></td>";
	
	//$counter++;
 
	
	$box.='</tr>';
	
	endforeach;
	
	$box.='</table>';
	else:
	
	$box.='<div>Поиск не дал результатов</div>';
	
	endif;
$box.='</div>';
$box.='        
</div>';

$box_panel='<div id="content_ibox" style="display:block;">';
	$box_panel.="<div id=\"ibox_wrapper\" style=\"position: absolute; top: 5px; left: 5px; display: block; visibility: visible; width: 600px;z-index:1000;background: #222; border-color: #444;\">";
	//$box_panel.="<div id=\"box_wrapper\" width=80% style=\"background: #222; border-color: #444;min-height:300px;\">";
	$box_panel.='<div id="ibox_content" style="overflow: auto;background: #222; border-color: #222; color:#fff;margin: 25px 0 0 0; padding: 10px;">';
	
	//$box_panel.='<br><h2>Выберите результаты поиска</h2>';
	//$box_panel.='<div class="tableBox" style="text-transform:uppercase;"><table cellspacing=1 cellspacing=4>';
	$box_panel.=$box;
	//$box_panel.='</table>';
	
	$box_panel.='</div><div id="ibox_footer_wrapper" style="left: 0; right: 0; top: 0; padding: 3px 10px;"><a href="javascript:void(0)" style="color: #CDE4BF; font-weight: bold; text-decoration: none; padding: 0 3px;">Закрыть</a><div id="ibox_footer">&nbsp;</div></div>"';
	//$box_panel.='</div><div id="box_footer_wrapper" style="padding: 3px 10px;"><a href="javascript:void(0)" style="color: #8dd6e2; font-weight: bold; text-decoration: none; padding: 0 3px;">Закрыть</a><div id="box_footer">&nbsp;</div></div>"';
	$box_panel.='</div>';
	$box_panel.='</div>';
	

echo $box;



?>

<script>
$(document).ready(function(){
    var ibox=$('#photoBox').html();
TINY.box.show({html:ibox,boxid:'frameless',animate:true,close:true});	
});
</script>

