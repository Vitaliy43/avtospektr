
<?php
if(isset($_POST['type'])):
if($type=='login')
	$this->Widget('application.components.ProfileWidget',array('model_name'=>$this->type_profile));
else
	$this->Widget('application.components.LoginWidget');

else:
?>	
<?php if(isset($answer)):?>
<script type="text/javascript">
$(document).ready(function(){
	
	myAlert('<?php echo $answer;?>');
	
    });  
	
</script>
<?php endif;?>

<?php

endif;

?>