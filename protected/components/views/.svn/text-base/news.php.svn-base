
<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td><div id="head-left-menu"><h1>Новости</h1></div>
			</td>
		
		
		</tr>
		<tr>
		<!--td style="border-right: 1px solid #bde0a3;border-bottom: 1px solid #bde0a3;"-->
		<td>
		<div class="small_news">
		<?php 
		
		$html = '';
		
		foreach($data as $news):
		
		$href=$bacauto_path.'index.php?list=news&option='.$news['id'];
		
		$img=$news['pic_source'];

        $date=$news['date'];
    	$date=str_replace('-','/',$date);
    	$header=$news['name'];

    	//$href=PATH.'index.php?list=news&id='.$news['id']
    	$info=$news['mini_text'];
		
		$html.=' <div class="item">';
                    $html.= "<a href='$href' target='_blank'><img src='$img' alt='' width='80' height='60' /></a>
                      	<div class='info'>
                        	<a href='$href' target='_blank'><strong>$header</strong></a><br />
                            <span>$info</span>
                        </div>
                        <div class='clear'></div>
                  </div>";
		
		
		endforeach;
		
		echo $html;
		
		?>
		
		</div>
		
		
		
		
		</td>
		
		</tr>
					

	
	</table>