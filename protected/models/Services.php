<?php

/**
 * This is the model class for table "services".
 *
 * The followings are the available columns in table 'services':
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $branch_id
 * @property string $name
 * @property integer $service_type_id
 * @property string $amount
 * @property string $file_path
 * @property string $file_pics
 * @property integer $is_sync
 * @property integer $is_deleted
 */
class Services extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'services';
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
            $this->updated_at = Settings::get_DateTime();

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
            array('created_at', 'required'),
            array('branch_id, service_type_id, is_sync, is_deleted', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 50),
            array('amount', 'length', 'max' => 12),
            array('file_path, file_pics', 'length', 'max' => 100),
            array('updated_at', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, created_at, updated_at, branch_id, name, service_type_id, amount, file_path, file_pics, is_sync, is_deleted', 'safe', 'on' => 'search'),
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
            'created_at' => 'Date Created',
            'updated_at' => 'Last Modified',
            'branch_id' => 'Branch',
            'name' => 'Name',
            'service_type_id' => 'Service Type',
            'amount' => 'Amount',
            'file_path' => 'File Path',
            'file_pics' => 'File Pics',
            'is_sync' => 'Is Sync',
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

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);

        $criteria->compare('created_at', $this->created_at, true);

        $criteria->compare('updated_at', $this->updated_at, true);

        $criteria->compare('branch_id', $this->branch_id);

        $criteria->compare('name', $this->name, true);

        $criteria->compare('service_type_id', $this->service_type_id);

        $criteria->compare('amount', $this->amount, true);

        $criteria->compare('file_path', $this->file_path, true);

        $criteria->compare('file_pics', $this->file_pics, true);

        $criteria->compare('is_sync', $this->is_sync);

        $criteria->compare('is_deleted', $this->is_deleted);

        $criteria->order = 'created_at DESC';

        return new CActiveDataProvider('Services', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => Utilities::PAGE_SIZE,
            )
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * @return Services the static model class
     */
    public static function model($className = __CLASS__)
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
