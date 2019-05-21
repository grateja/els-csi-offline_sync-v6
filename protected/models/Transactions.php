<?php

/**
 * This is the model class for table "transactions".
 *
 * The followings are the available columns in table 'transactions':
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property string $name
 * @property integer $seq
 * @property integer $machine_type_id
 * @property integer $is_services
 * @property integer $is_deleted
 */
class Transactions extends CActiveRecord
{
        const TRANSACTION_WASHER= 1;
        const TRANSACTION_DRYER = 2;
        const TRANSACTION_TITAN = 3;
        const TRANSACTION_TOPUP = 4;
        const TRANSACTION_TOPDOWN = 5;
        const TRANSACTION_CARD_ACTIVATION= 6;
        const TRANSACTION_CARD_PAYMENT= 7;
////        const TRANSACTION_TOPUP = 7;
////        const TRANSACTION_REGISTRATION = 8;
////        const TRANSACTION_TOPDOWN = 9;
//        
//        const TRANS_WASH = 1;
//        const TRANS_DRY = 2;
//        const TRANS_TITAN = 3;
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'transactions';
	}
        
        public static function tbl()
        {
            return self::tableName();
        }
        
        public function beforeSave()
        {
            if($this->isNewRecord)
                $this->created_at = Settings::get_DateTime ();
            else
                $this->updated_at = Settings::get_DateTime ();
            
            return parent::beforeSave();
        }
        
        public static function clearSessions()
        {
            unset($_SESSION[self::tbl()]);
        }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('created_at, name, is_services, machine_type_id', 'required'),
			array('is_deleted', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			array('updated_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, created_at, updated_at, name, seq, is_services, is_deleted', 'safe', 'on'=>'search'),
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
                     'servicePrices' => array(self::HAS_MANY, 'ServicePrices', 'transaction_id'),
                     'servicePromos' => array(self::HAS_MANY, 'ServicePromos', 'transaction_id'),
                     'machineTransactionRuntime' => array(self::HAS_MANY, 'MachineTransactionRuntime', 'transaction_id'),
                     'machineTypes' => array(self::BELONGS_TO, 'MachineTypes', 'machine_type_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'created_at' => 'Date Created',
			'updated_at' => 'Last Modified',
			'name' => 'Name',
			'seq' => 'Sequence',
                        'machine_type_id' => 'Machine Type',
                        'is_services' => 'Services?',
			'is_deleted' => 'Is Deleted',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);

		$criteria->compare('created_at',$this->created_at,true);

		$criteria->compare('updated_at',$this->updated_at,true);

		$criteria->compare('name',$this->name,true);

		$criteria->compare('seq',$this->seq,true);
                
                $criteria->compare('machine_type_id',$this->machine_type_id,true);
                
                $criteria->compare('is_services',$this->is_services,true);

		$criteria->compare('is_deleted',$this->is_deleted);

		return new CActiveDataProvider('Transactions', array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return Transactions the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public static function model_getAllData_byIsDeleted($isDeleted){
            $crit = new CDbCriteria();
            $crit->condition = 'is_deleted = :isDeleted';
            $crit->params = array(':isDeleted' => Utilities::NO);
            $crit->order = 'seq asc';
            return self::model()->findAll($crit);
        }        
        
        public static function model_getAllData_byid($isDeleted){
            return self::model()->findALl('is_deleted = :isDeleted AND id IN(1,2,4)', array(':isDeleted'=>$isDeleted));
        }
        
        public static function model_getAllData_byMachineTypeID($isDeleted, $machineTypeID){
            return self::model()->findAll('is_deleted = :isDeleted AND machine_type_id = :machineTypeID', array(':isDeleted'=>$isDeleted,'machineTypeID'=>$machineTypeID));
        }
        
        
        public function getIsActive(){
            return Utilities::get_ActiveSelect($this->is_active);
        }
        
        public function getIsDeleted(){
            return Utilities::get_ActiveSelect($this->is_deleted);
        }
        
        public static function sql_getName_byID($tranactionID)
        {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT name FROM ' . self::tbl() . ' WHERE id = :tranactionID limit 1';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':tranactionID', $tranactionID, PDO::PARAM_INT);
            return $command->queryScalar();
        }
        
        public static function model_getAllData_byServices($isService = 1)
        {
            $crit = new CDbCriteria();
            $crit->condition = 'is_services = :isServices AND is_deleted = :isDeleted';
            $crit->params = array(':isServices' => $isService, ':isDeleted' => Utilities::NO);
            $crit->order = 'seq asc';
            return self::model()->findAll($crit);
        }       
        
        public function getIsServices(){
            return Utilities::get_ActiveSelect($this->is_services);
        }        
}