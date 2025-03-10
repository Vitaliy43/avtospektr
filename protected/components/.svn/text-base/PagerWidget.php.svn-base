<?php

class PagerWidget extends CLinkPager
{

	/**
	 * @var string the text label for the next page button. Defaults to 'Next &gt;'.
	 */
	public $nextPageLabel='&gt;';
	/**
	 * @var string the text label for the previous page button. Defaults to '&lt; Previous'.
	 */
	public $prevPageLabel='&lt;';
	/**
	 * @var string the text label for the first page button. Defaults to '&lt;&lt; First'.
	 */
	public $firstPageLabel='&lt;&lt';
	/**
	 * @var string the text label for the last page button. Defaults to 'Last &gt;&gt;'.
	 */
	public $lastPageLabel='&gt;&gt;';
	/**
	 * @var string the text shown before page buttons. Defaults to 'Go to page: '.
	 */
	public $header='';
	/**
	 * @var string the text shown after page buttons.
	 */
	public $footer='';
	public $page_size;
	public $current_route;
	public $pager_place;
	public $is_filter;
	public $vin=false;
	
	public $list_page_sizes=array(
	'100'=>100,
	'50'=>50,
	'20'=>20,
	'10'=>10
	);
	/**
	 * @var mixed the CSS file used for the widget. Defaults to null, meaning
	 * using the default CSS file included together with the widget.
	 * If false, no CSS file will be used. Otherwise, the specified CSS file
	 * will be included when using this widget.
	 */
	
	
	
	protected function createSelectNumPages(){
		
		$html='<span class="num_pages" id="num_pages_container_'.$this->pager_place.'">Выводить по';
		$html.=CHtml::dropDownList('num_pages',$this->page_size,$this->list_page_sizes,array('onchange'=>'set_page_size(this,\''.SITE_PATH.$this->current_route.'\');return false;','id'=>'num_pages_'.$this->pager_place));
		$html.='&nbsp;строк';
		$html.='</span>';
		return $html;
	}
	
	protected function createPageButton($label,$page,$class,$hidden,$selected)
	{
	
		if(UserIdentity::getProperty('role')=='user' or UserIdentity::getProperty('role')=='client'){
			$type='client';
		}
		elseif(UserIdentity::getProperty('role')=='admin' or UserIdentity::getProperty('role')=='root' or UserIdentity::getProperty('role')=='manager'){
			$type='admin';
		}
	
		if($hidden || $selected)
			$class.=' '.($hidden ? self::CSS_HIDDEN_PAGE : self::CSS_SELECTED_PAGE);
			if($this->vin)
				return '<li class="'.$class.'">'.CHtml::link($label,$this->createPageUrl($page),array('onclick'=>"paginate_link_vin(this,'$type','$this->is_filter');return false;")).'</li>';
			else
				return '<li class="'.$class.'">'.CHtml::link($label,$this->createPageUrl($page),array('onclick'=>"paginate_link(this,'$type','$this->is_filter');return false;")).'</li>';
		
	}
	
	
	public function init(){
		
		parent::init();
		$this->footer=$this->createSelectNumPages();
		
	}
	
}

?>