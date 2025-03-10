<script type="text/javascript">

$(document).ready(function(){
		$('input[type=checkbox]').tzCheckbox({labels:['Enable','Disable']});
		var tz=$('#ch_email').next();	
		<?php if(isset($_REQUEST['for_cross']) and $_REQUEST['for_cross']==0):?>
		tz.addClass('tzCheckBox');
		<?php else:?>
		tz.addClass('tzCheckBox checked');
		<?php endif;?>
});

</script>

<?php

if(isset($_REQUEST['sort']))
	$sort=$_REQUEST['sort'];
else	
	$sort='price_client';


?>
<form id="form-zapros" method="POST" action="<?php echo SITE_PATH.'autoparts/search';?>">
				<p>
				<label for="search_code" >Номер детали:</label>
				<input name="search_code" type="text" value="<?php if(isset($_REQUEST['search_code'])) echo $_REQUEST['search_code'];?>" onclick="cut_text('DetailNum');" id="DetailNum">
				<input value="Поиск" type="submit" style="cursor:pointer;" name="submit"/>
				</p>
				<input type="hidden" name=cash id=cash value=0 >
				<input type="hidden" name="filter" value="1" id="filter">
				
				<p>
				<label for="sort">Сортировка:</label>
				<select id="SortType" name="sort">
					
					
					<?php
					
					if($sort=='price_client'){
	echo '<option class="bold" value=price_client selected>цена</option>
	<option class="bold" value=manufacturer>бренд</option>
	<option class="bold" value=period_max>срок</option>';
}
elseif($sort=='manufacturer'){
	echo '<option class="bold" value=price_client>цена</option>
	<option class="bold" value=manufacturer selected>бренд</option>
	<option class="bold" value=period_max>срок</option>';

}

else{
echo '<option class="bold" value=price_client>цена</option>
	<option class="bold" value=manufacturer>бренд</option>
	<option class="bold" value=period_max selected>срок</option>';


}
if(empty($_REQUEST['search_code']))
							$checked='checked=""';
elseif(isset($_REQUEST['search_code']) and isset($_REQUEST['cross']))
							$checked='checked=""';
						else
							$checked='';
					
							
					if(isset($_REQUEST['for_cross'])):
						if($_REQUEST['for_cross']==1)
							$checked='checked=""';
						else
							$checked='';
					endif;
					
					?>
					
				</select>
				</p>
				<?php if(isset($_REQUEST['search_code']) and isset($_REQUEST['CrossType'])):?>
				<input type="hidden" name="for_cross" id="for_cross" value="1"/>
				<?php elseif(isset($_REQUEST['search_code']) and empty($_REQUEST['CrossType'])):?>
				<input type="hidden" name="for_cross" id="for_cross" value="0"/>
				<?php endif;?>
				<p>
					<label for="ch_emails">Замены: </label>
			    	<input type="checkbox" id="ch_email" name="CrossType" data-on="ДА" data-off="НЕТ" <?php echo $checked;?>/>
				</p>

</form>
<?php

$html=ob_get_contents();
ob_clean();
if(isset($_REQUEST['filter']))
	$html.=$box;
	
echo $html;



?>
