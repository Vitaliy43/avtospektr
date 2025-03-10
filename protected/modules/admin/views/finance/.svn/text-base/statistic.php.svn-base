<?php

	

	if($type=='profit')
		$show_type=$this->prefix_title_non_declension.' - прибыль';
	else
		$show_type=$this->prefix_title_non_declension.' - оборот';
	if(count($amounts)>0):
	$list=Utility::getListForChart($amounts);
	$ticks=Utility::getTicksForChart($amounts);
	endif;
	
	$first_year=Utility::getFirstYearOrders();

	$show_type.=' за '.$year.' год';
	if(isset($_POST['year']))
		$current_year=$_POST['year'];
	else
		$current_year=date('Y');
	 
?>

<script type="text/javascript">
<?php if(count($amounts)>0):?>
$(function(){
	  //line1 = [14, 32, 41, 44, 40, 37, 29];
	  line1 = [<?php echo $list;?>];
	  line2 = [7, 12, 15, 17, 20, 27, 39];
	  $.jqplot("chart", [line1], {
	    title: '<?php echo $show_type;?>',
	    stackSeries: true,
	    seriesDefaults: {
	      renderer: $.jqplot.BarRenderer,
	      rendererOptions: { barMargin: 25 },
	      pointLabels: { stackedValue: true }
	    },
	    axes: {
	      xaxis:{ renderer:$.jqplot.CategoryAxisRenderer },
	      yaxis:{ ticks:[<?php echo $ticks;?>] }
	    }
	  });
	});

<?php endif;?>

</script>

<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('application.components.BreadcrumbsWidget', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif;?>
<h2>Финансовая <?php echo $this->section_header;?></h2>
<div class="container_chart">
<div id="container_choice_year">
<select id="choice_year" onchange="choice_year('<?php echo SITE_PATH.$this->module->id.'/'.$this->id.'/statistic';?>');">
<?php for($i=$first_year;$i<date('Y')+1;$i++):

	if($i==$current_year)
		$selected='selected';
	else
		$selected='';


	echo "<option value='$i' $selected>$i</option>";


endfor;
?>
</select>
</div>
<?php if(count($amounts)>0):?>
<div id="chart" >
</div>
<?php else:?>
<div style="padding-top:10px;">Данные о прибыли за этот год отсутствуют</div>
<?php endif;?>
</div>

