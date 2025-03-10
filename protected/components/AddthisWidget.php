<?php

class AddthisWidget extends CWidget {
	
	public function run(){
		
		$this->render('addthis',array('addthis' => $this->get_addthis()));
		
	}
	
	protected function get_addthis(){
		
		
		$addthis='<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style" style="width: 140px !important;">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
<a class="addthis_counter addthis_bubble_style"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4f910b8346b213e1"></script>
<!-- AddThis Button END -->';	
			
			//$html='<hr width=80% align=left><br>';
			return $addthis;
	}
	
}

?>