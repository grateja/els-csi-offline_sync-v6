<?php

/**
 * This is the model class for table "machine_statuses".
 *
 * The followings are the available columns in table 'machine_statuses':
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property string $name
 * @property integer $seq
 * @property integer $is_deleted
 */
class MachineStatuses extends CActiveRecord
{
    
        const STATUS_IDLE = 1;
        const STATUS_RUNNING = 2;
        const STATUS_PAUSED = 3;
        const STATUS_DEFECTIVE = 4;
        
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'machine_statuses';
	}
        
        public static function tbl()
        {
                return self::tableName();
        }
        
        public function beforeSave()
        {
                if($this->isNewRecord)
                    $model->created_at = Settings::get_DateTime ();
                else
                    $model->updated_at = Settings::get_DateTime ();

                return parent::beforeSave();
        }        

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('is_deleted, seq', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('updated_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, created_at, updated_at, name, is_deleted', 'safe', 'on'=>'search'),
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
			'id' => 'Id',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
			'name' => 'Remarks',
                        'seq' => 'Seq',
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

		$criteria->compare('is_deleted',$this->is_deleted);

		return new CActiveDataProvider('MachineStatuses', array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return MachineStatuses the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public static function sql_getName_byID($id)
        {
                $cnn = Utilities::createConnection();
                $sql = 'SELECT name FROM ' . self::tbl() . ' WHERE id = :machineStatusID';
                $command = $cnn->createCommand($sql);
                $command->bindValue(':machineStatusID', $id, PDO::PARAM_INT);
                return $command->queryScalar();
        }     
        
        public static function model_getAllData_byIsDeleted($isDeleted = 0)
        {
            $crit = new CDbCriteria();
            $crit->condition = 'is_deleted = :isDeleted';
            $crit->params = array(':isDeleted' => Utilities::NO);
            $crit->order = 'seq asc';
            return self::model()->findAll($crit);;
        }        
        
        public function getIsDeleted()
        {
            return Utilities::get_ActiveSelect($this->is_deleted);
        }
}