<?php

/**
 * This is the model class for table "audit_trails".
 *
 * The followings are the available columns in table 'audit_trails':
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property string $table_name
 * @property string $column_name
 * @property integer $data_id
 * @property string $old_value
 * @property string $new_value
 * @property integer $user_id
 * @property integer $emp_id
 * @property integer $trans_type
 * @property integer $is_deleted
 */
class AuditTrails extends CActiveRecord {

    protected $oldAttributes;

    const TRANS_TYPE_CREATE = 1;
    const TRANS_TYPE_UPDATE = 2;
    const TRANS_TYPE_DELETE = 3;
    const PAGE_SIZE = 20;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'audit_trails';
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

    public function addRecord()
    {
        $model = new AuditTrails();
        $model->created_at = $this->created_at;
        $model->updated_at = $this->updated_at;
        $model->table_name = $this->table_name;
        $model->column_name = $this->column_name;
        $model->data_id = $this->data_id;
        $model->old_value = $this->old_value;
        $model->new_value = $this->new_value;
        $model->user_id = $this->user_id;
        $model->emp_id = $this->emp_id;
        $model->is_deleted = $this->is_deleted;
        $model->trans_type = $this->trans_type;

        if ($model->validate()) {
            $model->save();
            $messageArr = array('id' => $model->id, 'status' => Utilities::STATUS_SUCCESS, 'message' => 'Audit Trail Successfully Saved.');
        } else {
            $messageArr = array('status' => Utilities::STATUS_FAILED, 'message' => Utilities::get_ModelErrors($model->errors));
        }
        return json_decode(json_encode($messageArr));
    }

    public static function newRecord($transType = self::TRANS_TYPE_UPDATE, $tableName, $columnName, $dataID, $oldValue, $newValue, $userID, $empID)
    {
        $model = new AuditTrails();
        $model->created_at = Settings::get_DateTime();
        $model->updated_at = Settings::get_DateTime();
        $model->table_name = $tableName;
        $model->column_name = $columnName;
        $model->data_id = $dataID;
        $model->old_value = $oldValue;
        $model->new_value = $newValue;
        $model->user_id = $userID;
        $model->emp_id = $empID;
        $model->is_deleted = Utilities::NO;
        $model->trans_type = $transType;
        $model->addRecord();
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('created_at, table_name, column_name, old_value, new_value', 'required'),
            array('user_id, emp_id, is_deleted', 'numerical', 'integerOnly' => true),
            array('table_name', 'length', 'max' => 100),
            array('old_value, new_value', 'length', 'max' => 255),
            array('updated_at', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, created_at, updated_at, table_name, old_value, new_value, user_id, emp_id, is_deleted', 'safe', 'on' => 'search'),
            array('id, created_at, updated_at, table_name, old_value, new_value, user_id, emp_id, is_deleted', 'safe', 'on' => 'searchAdmin'),
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
            'users' => array(self::BELONGS_TO, 'Users', 'user_id'),
            'employees' => array(self::BELONGS_TO, 'Employees', 'emp_id')
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
            'table_name' => 'Table Name',
            'column_name' => 'Column Name',
            'old_value' => 'Old Value',
            'new_value' => 'New Value',
            'user_id' => 'User ID',
            'emp_id' => 'Employee',
            'trans_type' => 'Transaction Type',
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

        $criteria->compare('table_name', $this->table_name, true);

        $criteria->compare('column_name', $this->column_name, true);

        $criteria->compare('old_value', $this->old_value, true);

        $criteria->compare('new_value', $this->new_value, true);

        $criteria->compare('user_id', $this->user_id);

        $criteria->compare('emp_id', $this->emp_id);

        $criteria->compare('trans_type', $this->trans_type);

        $criteria->compare('is_deleted', $this->is_deleted);

        return new CActiveDataProvider('AuditTrails', array(
            'criteria' => $criteria,
        ));
    }

    public function searchAdmin()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);

        $criteria->compare('created_at', $this->created_at, true);

        $criteria->compare('updated_at', $this->updated_at, true);

        $criteria->compare('table_name', $this->table_name, true);

        $criteria->compare('column_name', $this->column_name, true);

        $criteria->compare('old_value', $this->old_value, true);

        $criteria->compare('new_value', $this->new_value, true);

        $criteria->compare('user_id', $this->user_id);

        $criteria->compare('emp_id', $this->emp_id);

        $criteria->compare('trans_type', $this->trans_type);

        $criteria->compare('is_deleted', $this->is_deleted);

        $criteria->order = 'id desc';

        return new CActiveDataProvider('AuditTrails', array(
            'criteria' => $criteria,
            'pagination' => array('pageSize' => self::PAGE_SIZE)
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * @return AuditTrails the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function getTransType($id = null)
    {
        $transType = array(
            self::TRANS_TYPE_CREATE => 'Create',
            self::TRANS_TYPE_UPDATE => 'Update',
            self::TRANS_TYPE_DELETE => 'Delete'
        );

        if ($id == null) {
            return $transType;
        } else {
            return $transType[$id];
        }
    }

    public static function model_getTableNames()
    {
        $crit = new CDbCriteria();
        $crit->select = 'distinct table_name';
        $crit->order = 'table_name asc';

        return self::model()->findAll($crit);
    }

}
