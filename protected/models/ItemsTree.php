<?php

class ItemsTree extends CActiveRecord
{

	public $tree=array();
	public $items=array();
	public static $recursive=false;
	public static $deleted=false;
	
	public function getChilds($id)
	{
		
		$items=$this->findAll(array(
		'select'=>'id',
		'condition'=>'parent_id=:id',
		'params'=>array(':id'=>$id),
		'order'=>'name'
		));
		
		if(count($items)>0){
			
			foreach($items as $item)
				$this->childs[]=$item->id;
			
		}
		
		
		
		if(count($items)>0)	:
			foreach($items as $item):
		
				if(isset($item->id)):
			
					$this->getChilds($item->id);
			
				endif;
		
			endforeach;
			
		endif;
		
		 return $this->childs;
		
	}
	
	public function getItemsFromTree()
	{
		foreach($this->tree as $id){
			$arr=$this->getItemsByParent($id);
			$this->items=array_merge($this->items,$arr);
		}
	}
	
	
	public function getItemsLinkTree($id,$prefix_link='',$arr=true)
	{
		$item=$this->findByPk($id);
		
		$this->tree[$item->id]=$prefix_link.$item->id;
		if($item->parent_id!=0)
			$this->getItemsLinkTree($item->parent_id,$prefix_link,$arr);
		
	}
	
	public function removeItems($id)
	{
		$res=$this->deleteByPk($id);
		self::$deleted=true;
		$childs=$this->findAll('parent_id=:parent_id',array(':parent_id'=>$id));
		if(count($childs)>0){
			self::$recursive=true;
			foreach($childs as $child){
				$this->removeItems($child->id);
			}
		}
		
		
	}
	
	public function getBreadcrumbFromTree($field='name')
	{
		ksort($this->tree);
		foreach($this->tree as $key=>$value){
			$item=$this->findByPk($key);
			$arr[$item->$field]=$value;

		}
		return $arr;
	}
	
	
	public function allChilds()
	{
		
		$items=$this->findAll(array(
		'select'=>'*'
		));
		
		foreach($items as $item):
		
			$childs=$this->getChilds($item->id);
			
			if($childs)
				$arr[$item->id]=$childs;
			$this->childs=array();
		
		endforeach;
		
		return $arr;
		
	}
	
	
	public function getItemByName($name,$order='name')
	{
		
		$item=$this->find(array(
		'select'=>'*',
		'condition'=>'name=:name',
		'params'=>array(':name'=>$name),
		'order'=>$order
		));
		
		return $item;
		
	}
	
	
	public function getItemsByName($name,$order='name')
	{
			
		$items=$this->findAll(array(
		'select'=>'*',
		'condition'=>'name=:name',
		'params'=>array(':name'=>$name),
		'order'=>$order
		));
		
		return $items;
		
	}
	
	public function getItemsByParent($id,$order='name')
	{
			
		$items=$this->findAll(array(
		'select'=>'*',
		'condition'=>'parent_id=:id',
		'params'=>array(':id'=>$id),
		'order'=>$order
		));
		
		return $items;
	}
	
	public function getItemsNextLevel($parent_id,$level,$order='name'){
		
		$items=$this->findAll(array(
		'select'=>'*',
		'condition'=>'parent_id=:id and level=:level',
		'params'=>array(':id'=>$parent_id,':level'=>$level+1),
		'order'=>$order
		));
		
		return $items;
	}
	
	
	
	public function getItems($id=0)
	{
		return $this->findAll(array(
		'select'=>'*',
		'condition'=>'parent_id=:id',
		'params'=>array(':id'=>$id),
		'order'=>'name'
		));
	}
	
}

?>