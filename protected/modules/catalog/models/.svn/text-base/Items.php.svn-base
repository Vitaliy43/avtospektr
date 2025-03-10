<?php

/**
 * This is the model class for table "avtospektr_1c.items".
 *
 * The followings are the available columns in table 'avtospektr_1c.items':
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property integer $position
 */
class Items extends ItemsTree
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Items the static model class
	 * 
	 * 
	 */
	
	 
	public $childs=array();
	public $changes=array(
	'Фильтра'=>'Фильтры',
	'Аксесуары'=>'Аксессуары',
	'Топливный'=>'Топливные'
	);
	
	public $unparsed=array();
	 
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'catalog_1c_items';
	}
	
	public function getItemIdByName($name)
	{
		foreach($this->changes as $key=>$value){
			$name=str_replace($key,$value,$name);			
		}
		
		$items=$this->getItemsByName($name,'id');
		if(count($items)>1):
			$item=$items[count($items)-1];
			return $item->id;
		elseif(count($items)==1):
			$item=$items[0];
			return $item->id;
		else:
			//$this->unparsed[]=$name;
		endif;
		
		
		return false;
	}
	
	public function addItems($array,$parent_id,$level)
	{
		foreach($array as $elem){
			$item=new Items;
			$item->parent_id=$parent_id;
			$item->name=$elem;
			$item->level=$level;
			$item->purchase_point_id=UserIdentity::getPurchasePoint();
			$res=$item->save();
			if(!$res)
				return false;
		}
		return true;
	}
	
	public function editItem($item_id,$name)
	{
		$point=$this->findByPk($item_id);
//		echo 'item_id '.$item_id.'<br>';
//		die();
		$point->name=$name;
		return $point->save();
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('parent_id', 'required'),
			array('parent_id, position', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, parent_id, name, position', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'parent_id' => 'Parent',
			'name' => 'Name',
			'position' => 'Position',
		);
	}
	
	
	
	public function getItemName($name){
	
			$item=$this->find(array(
			'select'=>'name',
			'condition'=>'id=:id',
			'params'=>array(':id'=>$id)
			
			)
			);
			
			return $item->show_name;
			
		}
	


	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('position',$this->position);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}