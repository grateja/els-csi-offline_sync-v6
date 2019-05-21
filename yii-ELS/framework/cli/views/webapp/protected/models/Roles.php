<?php

/**
 * This is the model class for table "roles".
 *
 * The followings are the available columns in table 'roles':
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property string $name
 * @property integer $is_deleted
 */
class Roles extends CActiveRecord {

    protected $oldAttributes;
    
    const ROLE_ADMINISTRATOR = 1;
    const ROLE_STOCKCUSTODIAN = 2;
    const ROLE_PURCHASING = 3;
    const ROLE_ACCOUNTING = 4;
    const ROLE_SALES = 5;
    const ROLE_COORDINATAOR = 6;
    const ROLE_COST_ACCOUNTANT = 7;
    const CREDIT_AND_COLLECTION = 8;
    const ROLE_SALES_ADMIN = 9;
    

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'roles';
    }

    public static function tbl()
    {
        return self::tablename();
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
            array('created_at, name', 'required'),
            array('is_deleted', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 100),
            array('updated_at', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, created_at, updated_at, name, is_deleted', 'safe', 'on' => 'search'),
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

        $criteria->compare('is_deleted', $this->is_deleted);

        return new CActiveDataProvider('Roles', array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * @return Roles the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function setClassActive($value = NULL)
    {
        $_SESSION[self::tbl()]['classActive'] = $value;
    }

    public static function getClassActive()
    {
        return $_SESSION[self::tbl()]['classActive'];
    }

    public static function setClassOpen($value = NULL)
    {
        $_SESSION[self::tbl()]['classOpen'] = $value;
    }

    public static function getClassOpen()
    {
        return $_SESSION[self::tbl()]['classOpen'];
    }

    public static function setClassNewActive($value = NULL)
    {
        $_SESSION[self::tbl()]['new']['classActive'] = $value;
    }

    public static function getClassNewActive()
    {
        return $_SESSION[self::tbl()]['new']['classActive'];
    }

    public static function setClassManageActive($value = NULL)
    {
        $_SESSION[self::tbl()]['manage']['classActive'] = $value;
    }

    public static function getClassManageActive()
    {
        return $_SESSION[self::tbl()]['manage']['classActive'];
    }

    public static function setClassManageViewActive($value = null)
    {
        $_SESSION[self::tbl()]['manageView']['classActive'] = $value;
    }

    public static function getClassManageViewActive()
    {
        return $_SESSION[self::tbl()]['manageView']['classActive'];
    }

    public static function model_getAllData_byIsDeleted($isDeleted)
    {
        return self::model()->findAll('is_deleted = :isDeleted', array(':isDeleted' => $isDeleted));
    }

    public function getIsDeleted()
    {
        return Utilities::get_ActiveSelect($this->is_deleted);
    }

}
