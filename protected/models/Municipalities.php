<?php

/**
 * This is the model class for table "municipalities".
 *
 * The followings are the available columns in table 'municipalities':
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $province_id
 * @property string $name
 * @property integer $is_deleted
 */
class Municipalities extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'municipalities';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('created_at, name', 'required'),
			array('province_id, is_deleted', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('updated_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, created_at, updated_at, province_id, name, is_deleted', 'safe', 'on'=>'search'),
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
                    'students' => array(self::HAS_MANY,'Students','student_id'),
                    'studentAddresses' => array(self::HAS_MANY, 'StudentAddresses', 'municipality_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
			'province_id' => 'Province',
			'name' => 'Name',
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
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('province_id',$this->province_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('is_deleted',$this->is_deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Municipalities the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public static function model_getData_byIsDeleted($isDeleted)
        {
            return self::model()->findAll('is_deleted = :isDeleted', array(':isDeleted'=>  $isDeleted));
        }          
        
        public static function model_getAllData_byProvinceID($provinceID)
        {
            return self::model()->findAll('province_id = :provinceID', array(':provinceID'=>  $provinceID));
        }          
        
        public static function model_getRowData_byID($id)
        {
            return self::model()->find('id = :id',array(':id' => $id));
        }
        
        function getName()
        {
            return Utilities::setCapitalFirst($this->name);
        }
        
}
