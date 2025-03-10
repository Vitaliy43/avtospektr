<?php

class Content extends Model
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'content';
	}
	
	public function addContent()
	{
		$content=new Content;
		$content->header=$_REQUEST['header'];
		$content->content=$_REQUEST['editor'];
		$content->data_modified=date("Y-m-d H:i:s");
		$content->user_menu_id=0;
		$content->save();
	}
	
	public function updateContent($id)
	{
		$content=$this->findByPk($id);
		$content->header=$_REQUEST['header'];
		$content->content=$_REQUEST['editor'];
		$content->data_modified=date("Y-m-d H:i:s");
		$content->save();
	}
}

?>