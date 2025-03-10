<?php

class Distributors extends CActiveRecord
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
		return 'distributors';
	}
	
	public function getListDistributors()
	{
		$list=$this->findAll();
		foreach($list as $elem){
			$arr[$elem->id]=$elem->name;
		}
		return $arr;
	}
	
	public function getAllForFilter($sort=''){
	
			$items=$this->findAll(array(
			'select'=>'*',
			'order'=>'site '.$sort
			
			)
			);
			
			$arr['0']='Все';
			
			foreach($items as $item){
				
				$arr[$item->id]=$item->name;
			}
			
			return $arr;
			
	}
	
	public function getDistributorActivity($id)
	{
		$res=Yii::app()->db->createCommand(array(
    	'select'=>$extract.' as amount',
    	'from'=>'orders_archive',
		'where'=>'user_id=:user_id AND data_shipping BETWEEN :prev_data AND :curr_data',
		'params'=>array(':user_id'=>$user_id,':prev_data'=>$prev_data,':curr_data'=>$curr_data)
			
		))->queryAll();
		
	}
	
	public function updateDistributor($id)
	{
	
		
		$distributor=$this->findByPk($id);
		$distributor->name=$_REQUEST['name'];
		$distributor->site=$_REQUEST['site'];
		$distributor->address=$_REQUEST['address'];
		$distributor->telephone=$_REQUEST['telephone'];
		$distributor->email=$_REQUEST['email'];
		$distributor->period_delivery=$_REQUEST['period_delivery'];
		$distributor->add_price_default=$_REQUEST['add_price_default'];
		$distributor->enable_discount=$_REQUEST['enable_discount'];
		$distributor->save();
		
		$access=Accesses::model()->find('distributor_id=:id',array(':id'=>$id));
		$access->id_enter=$_REQUEST['id_enter'];
		$access->login=$_REQUEST['access_login'];
		$access->password=$_REQUEST['access_password'];
		$access->save();
	
		
	}
	
	public function getDistributors()
	{
		$criteria=new CDbCriteria;
		$criteria->select='*';
		$criteria->with=array('accesses');
		$criteria->order='name';
		return $this->findAll($criteria);
	}
	
	public function getDistributorsById($id)
	{
		$criteria=new CDbCriteria;
		$criteria->select='*';
		$criteria->order='name';
		$criteria->with=array('accesses','distributor_activity');

		return $this->findByPk($id,$criteria);
	}
	
	public function getAvailableDistributors($client_id)
	{
		$criteria=new CDbCriteria;
		$criteria->select='*';
		$criteria->condition='id NOT IN (select distributor_id FROM markups WHERE user_id=:user_id)';
		$criteria->params=array(':user_id'=>$client_id);
		return $this->findAll($criteria);
	}
	
	
	public function relations()
	{
		return array(
		'orders_archive'=>array(self::HAS_MANY,'OrdersArchive','distributor_id'),
		'orders_status'=>array(self::HAS_MANY,'OrdersStatus','distributor_id'),
		'accesses'=>array(self::HAS_MANY,'Accesses','distributor_id'),
		'markups'=>array(self::HAS_MANY,'Markups','distributor_id'),
		'distributor_activity'=>array(self::HAS_MANY,'DistributorActivity','distributor_id')

		);
	}
	
	
}

class DistributorActivity extends Model
{

	public $roles=array(
	'client'=>'Клиент',
	'manager'=>'Менеджер'
	);
	
	

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return 'distributor_activity';
	}
	
	public function relations()
	{
		return array(
		'distributor'=>array(self::BELONGS_TO,'Distributors','distributor_id'),
		'user_role'=>array(self::BELONGS_TO,'Roles','user_role_id')
		);
	}
}

?>