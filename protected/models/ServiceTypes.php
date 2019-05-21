<?php

/**
* This is the model class for table "service_types".
*
* The followings are the available columns in table 'service_types':
*/
class ServiceTypes extends CActiveRecord
{
    /**
    * @return string the associated database table name
    */
    public function tableName()
    {
        return 'service_types';
    }

    public static function tbl()
    {
        return self::tableName();
    }	

    public function beforeSave() 
    {
        if ($this->isNewRecord)
        $this->created_at = Settings::get_DateTime();
        else
        $this->updated_at =  Settings::get_DateTime();

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
                // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('', 'safe', 'on'=>'search'),
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

            $criteria->order = 'created_at DESC';

        return new CActiveDataProvider('ServiceTypes', array(
            'criteria'=>$criteria,
            'pagination' => array(
                'pageSize' => Utilities::PAGE_SIZE,
            )
        ));
    }

    /**
    * Returns the static model of the specified AR class.
    * @return ServiceTypes the static model class
    */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public static function model_getAllData_byDeleted($isDeleted)
    {
        return self::model()->findAll('is_deleted = :isDeleted', array(':isDeleted' => $isDeleted));
    }

    function getIsDeleted()
    {
        return Utilities::get_ActiveSelect($this->is_deleted);
    }
}