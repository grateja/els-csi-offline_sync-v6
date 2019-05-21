<?php

/**
 * This is the model class for table "account_types".
 *
 * The followings are the available columns in table 'account_types':
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property string $name
 * @property string $landing_module
 * @property string $landing_controller
 * @property string $landing_action
 * @property integer $is_deleted
 */
class AccountTypes extends CActiveRecord {

    protected $oldAttributes;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'account_types';
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

        $changedArray = array_diff_assoc($this->attributes, $this->oldAttributes);

        foreach ($changedArray as $key => $value) {
            if (strcmp($key, 'updated_at'))
                AuditTrails::newRecord(AuditTrails::TRANS_TYPE_UPDATE, self::tbl(), $key, $this->attributes['id'], $this->oldAttributes[$key], $value, Settings::get_UserID(), Settings::get_EmployeeID());
        }

        return parent::beforeSave();
    }

    public function afterFind()
    {
        $this->oldAttributes = $this->attributes;
        return parent::afterFind();
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('created_at, name, landing_module, landing_controller, landing_action', 'required'),
            array('is_deleted', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 255),
            array('updated_at', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, created_at, updated_at, name, landing_module, landing_controller, landing_action, is_deleted', 'safe', 'on' => 'search'),
            array('id, created_at, updated_at, name, landing_module, landing_controller, landing_action, is_deleted', 'safe', 'on' => 'searchAdmin'),
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
            'created_at' => 'Date Created',
            'updated_at' => 'Last Modified',
            'name' => 'Name',
            'landing_module' => 'Landing Module',
            'landing_controller' => 'Landing Controller',
            'landing_action' => 'Landing Action',
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

        $criteria->compare('name', $this->name, true);

        $criteria->compare('landing_module', $this->landing_module, true);

        $criteria->compare('landing_controller', $this->landing_controller, true);

        $criteria->compare('landing_action', $this->landing_action, true);

        $criteria->compare('is_deleted', $this->is_deleted);

        return new CActiveDataProvider('AccountTypes', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 18,
            )
        ));
    }

    public function searchAdmin()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('t.id', $this->id);

        $criteria->compare('t.created_at', $this->created_at, true);

        $criteria->compare('t.updated_at', $this->updated_at, true);

        $criteria->compare('t.name', $this->name, true);

        $criteria->compare('t.landing_module', $this->landing_module, true);

        $criteria->compare('t.landing_controller', $this->landing_controller, true);

        $criteria->compare('t.landing_action', $this->landing_action, true);

        $criteria->compare('t.is_deleted', $this->is_deleted);

        return new CActiveDataProvider('AccountTypes', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 18,
            )
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * @return AccountTypes the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    function getIsDeleted()
    {

        return Utilities::get_ActiveSelect($this->is_deleted);
    }

    public static function model_getData_byIsDeleted($isDeleted)
    {
        return self::model()->findAll('is_deleted = :isDeleted', array(':isDeleted' => $isDeleted));
    }

    public static function model_getData_byAccountTypeId($id)
    {
        return self::model()->findAll('id = :id', array(':id' => $id));
    }

    public static function model_getAllData_byDeleted($isDeleted)
    {
        return self::model()->findAll('is_deleted = :isDeleted', array(':isDeleted' => $isDeleted));
    }

    public static function setClassActive($value = null)
    {
        $_SESSION[self::tbl()]['classActive'] = $value;
    }

    public static function getClassActive()
    {
        return $_SESSION[self::tbl()]['classActive'];
    }

    public static function setClassOpen($value = null)
    {
        $_SESSION[self::tbl()]['classOpen'] = $value;
    }

    public static function getClassOpen()
    {
        return $_SESSION[self::tbl()]['classOpen'];
    }

    public static function setClassNewActive($value = null)
    {
        $_SESSION[self::tbl()]['new']['classActive'] = $value;
    }

    public static function getClassNewActive()
    {
        return $_SESSION[self::tbl()]['new']['classActive'];
    }

    public static function setClassManageActive($value = null)
    {
        $_SESSION[self::tbl()]['manage']['classActive'] = $value;
    }

    public static function getClassManageActive()
    {
        return $_SESSION[self::tbl()]['manage']['classActive'];
    }

    const USER_ADMIN = 1;
    const USER_USER = 2;

    public static function getAccountTypes($id = null)
    {
        $accountTypes = array(
            self::USER_ADMIN => 'Admin',
            self::USER_USER => 'User',
        );

        if ($id == '') {
            return $accountTypes;
        } else {
            return $accountTypes[$id];
        }
    }

}
