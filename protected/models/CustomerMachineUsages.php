<?php

/**
 * This is the model class for table "customer_machine_usages".
 *
 * The followings are the available columns in table 'customer_machine_usages':
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $client_id
 * @property integer $laundry_shop_id
 * @property integer $branch_id
 * @property integer $transaction_id
 * @property integer $machine_id
 * @property integer $customer_id
 * @property string $start_datetime
 * @property string $end_datetime
 * @property integer $total_minutes
 * @property integer $user_id
 * @property integer $is_deleted
 */
class CustomerMachineUsages extends CActiveRecord
{
    
        const STATUS_IDLE = 1;
        const STATUS_RUNNING = 2;
        const STATUS_PAUSED = 3;
        const STATUS_COMPLETED = 4;
        const STATUS_DEFECTIVE = 5;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'customer_machine_usages';
	} 
        
        public static function tbl()
        {
            return self::tableName();
        }    
        
        public function beforeSave()
        {
           if($this->isNewRecord)
               $this->created_at = Settings::get_DateTime();
           else 
               $this->updated_at = Settings::get_DateTime();
           
           return parent::beforeSave();
        }
        
        public  function clearSessions()
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
			array('created_at, transaction_id, start_datetime', 'required'),
			array('client_id, laundry_shop_id, branch_id, transaction_id, machine_id, customer_id, total_minutes, user_id, is_deleted', 'numerical', 'integerOnly'=>true),
			array('updated_at, end_datetime', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, created_at, updated_at, client_id, laundry_shop_id, branch_id, transaction_id, machine_id, customer_id, start_datetime, end_datetime, total_minutes, user_id, is_deleted', 'safe', 'on'=>'search'),
			array('id, created_at, updated_at, client_id, laundry_shop_id, branch_id, transaction_id, machine_id, customer_id, start_datetime, end_datetime, total_minutes, user_id, is_deleted', 'safe', 'on'=>'searchAdmin'),
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
                    'clients' => array(self::BELONGS_TO,'Clients','client_id'),
                    'laundryShops' => array(self::BELONGS_TO,'LaundryShops','laundry_shop_id'),
                    'branches' => array(self::BELONGS_TO,'Branches','branch_id'),
                    'transactions' => array(self::BELONGS_TO,'Transactions','transaction_id'),
                    'machines' => array(self::BELONGS_TO,'Machines','machine_id'),
                    'customers' => array(self::BELONGS_TO,'Customers','customer_id'),
                    'users' => array(self::BELONGS_TO,'Users','user_name'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
			'client_id' => 'Client',
			'laundry_shop_id' => 'Laundry Shop',
			'branch_id' => 'Branch',
			'transaction_id' => 'Transaction',
			'machine_id' => 'Machine',
			'customer_id' => 'Customer',
			'start_datetime' => 'Start Datetime',
			'end_datetime' => 'End Datetime',
			'total_minutes' => 'Total Minutes',
			'user_id' => 'User',
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

		$criteria->compare('client_id',$this->client_id);

		$criteria->compare('laundry_shop_id',$this->laundry_shop_id);

		$criteria->compare('branch_id',$this->branch_id);

		$criteria->compare('transaction_id',$this->transaction_id);

		$criteria->compare('machine_id',$this->machine_id);

		$criteria->compare('customer_id',$this->customer_id);

		$criteria->compare('start_datetime',$this->start_datetime,true);

		$criteria->compare('end_datetime',$this->end_datetime,true);

		$criteria->compare('total_minutes',$this->total_minutes);

		$criteria->compare('user_id',$this->user_id);

		$criteria->compare('is_deleted',$this->is_deleted);

		return new CActiveDataProvider('CustomerMachineUsages', array(
			'criteria'=>$criteria,
		));
	}

        
        public function searchAdmin()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('t.id',$this->id);

		$criteria->compare('t.created_at',$this->created_at,true);

		$criteria->compare('t.updated_at',$this->updated_at,true);

		$criteria->compare('t.client_id',$this->client_id);

		$criteria->compare('t.laundry_shop_id',$this->laundry_shop_id);

		$criteria->compare('t.branch_id',$this->branch_id);

		$criteria->compare('t.transaction_id',$this->transaction_id);

		$criteria->compare('t.machine_id',$this->machine_id);

		$criteria->compare('t.customer_id',$this->customer_id);

		$criteria->compare('t.start_datetime',$this->start_datetime,true);

		$criteria->compare('t.end_datetime',$this->end_datetime,true);

		$criteria->compare('t.total_minutes',$this->total_minutes);

		$criteria->compare('t.user_id',$this->user_id);

		$criteria->compare('t.is_deleted',$this->is_deleted);

		return new CActiveDataProvider('CustomerMachineUsages', array(
			'criteria'=>$criteria,
		));
	}
	/**
	 * Returns the static model of the specified AR class.
	 * @return CustomerMachineUsages the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
    public static function insertRecord($customerTransactionID, $dateTime, $customerID, $branchID, $transactionID, $machineID, $totalMinutes, $userID = 0)
    {
        $model = new CustomerMachineUsages();
        
        $model->created_at = $dateTime;
        $model->updated_at = $dateTime;
        $model->customer_transaction_id = $customerTransactionID;
        $model->client_id = 0;
        $model->laundry_shop_id = 0;
        $model->branch_id = $branchID;
        $model->transaction_id = $transactionID;
        $model->machine_id = $machineID;
        $model->customer_id = $customerID;
        $model->start_datetime = $dateTime;
        $model->end_datetime = date('Y-m-d H:i:s', Utilities::addMinutes($model->start_datetime, $totalMinutes));
        $model->start_machine_status = MachineStatuses::STATUS_RUNNING;
        $model->end_machine_status = Utilities::NO;
        $model->total_minutes = $totalMinutes;
        $model->user_id = $userID;
        $model->is_deleted = Utilities::NO;
        
        $result = $model->addRecord();
    }        
    
    public function addRecord()
    {
        $model = new CustomerMachineUsages();
        
        $model->created_at = $this->created_at;
        $model->updated_at = $this->updated_at;
        $model->customer_transaction_id = $this->customer_transaction_id;
        $model->client_id = $this->client_id;
        $model->laundry_shop_id = $this->laundry_shop_id;
        $model->branch_id = $this->branch_id;
        $model->transaction_id = $this->transaction_id;
        $model->machine_id = $this->machine_id;
        $model->customer_id = $this->customer_id;
        $model->start_datetime = $this->start_datetime;
        $model->end_datetime = $this->end_datetime;
        $model->start_machine_status = $this->start_machine_status;
        $model->end_machine_status = $this->end_machine_status;
        $model->total_minutes = $this->total_minutes;
        $model->user_id = $this->user_id;
        $model->is_deleted = $this->is_deleted;
        
        if($model->validate()) {
            $model->save();
            $messageArr = array('id' => $model->id ,'status' => Utilities::STATUS_SUCCESS, 'message' => 'Machine Usage Successfully Saved.');
        } else {
            $messageArr = array( 'status' => Utilities::STATUS_FAILED, 'message' => Utilities::get_ModelErrors($model->errors));
        }

        return json_decode(json_encode($messageArr));         
    }    
    
    public static function getStatus($id = null)
    {
        $arr = array(
                self::STATUS_IDLE => 'Idle',
                self::STATUS_RUNNING => 'Running',
                self::STATUS_PAUSED => 'Paused',
                self::STATUS_COMPLETED => 'Completed',
                self::STATUS_DEFECTIVE => 'Defective'
            );
        
        if($id != '') {
            return $arr[$id];
        } else {
            return $arr;
        }
    }
    
    public static function sql_getLastID_byCustomerTransactionID($customerTransactionID )
    {
        $cnn = Utilities::createConnection();
        $sql = 'SELECT id FROM ' . self::tbl().' WHERE customer_transaction_id = :customerTransactionID order by id desc limit 1';
        $command = $cnn->createCommand($sql); 
        $command->bindValue(':customerTransactionID', $customerTransactionID, PDO::PARAM_INT);
        return $command->queryScalar();
    }
    
    public static function sql_updateEndDateTime($id, $endDateTime)
    {
        $cnn = Utilities::createConnection();
        $sql = 'UPDATE ' . self::tbl() . ' SET end_datetime = :endDateTime WHERE id = :ID';
        $command = $cnn->createCommand($sql);
        $command->bindValue(':ID', $id, PDO::PARAM_INT);
        $command->bindValue(':endDateTime', $endDateTime, PDO::PARAM_STR);
        $command->execute();
    }
    
    public static function sql_updateEndMachineStatus($id, $machineStatus)
    {
        $cnn = Utilities::createConnection();
        $sql = 'UPDATE ' . self::tbl() . ' SET end_machine_status = :endMachineStatus WHERE id = :ID';
        $command = $cnn->createCommand($sql);
        $command->bindValue(':ID', $id, PDO::PARAM_INT);
        $command->bindValue(':endMachineStatus', $machineStatus, PDO::PARAM_INT);
        $command->execute();        
    }
    
    public static function sql_updateTotalMinutes($id, $totalMinutes)
    {
        $cnn = Utilities::createConnection();
        $sql = 'UPDATE ' . self::tbl() . ' SET total_minutes = :totalMinutes WHERE id = :ID';
        $command = $cnn->createCommand($sql);
        $command->bindValue(':ID', $id, PDO::PARAM_INT);
        $command->bindValue(':totalMinutes', $totalMinutes, PDO::PARAM_INT);
        $command->execute();        
    }     
}