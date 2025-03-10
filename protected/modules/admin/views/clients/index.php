<script type="text/javascript">
	<?php 
	$str='';
	$counter=0;
	foreach($this->all_distributors as $distributor){
		 $str.=$distributor->id;
		 
		 if($counter<count($this->all_distributors)-1){
		 	$str.=',';

		 }
		 
		 $counter++;
	}
	
	
	
?>
	distributors=new Array(<?php echo $str;?>);
	
</script>