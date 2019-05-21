<?php

/**
 * This is the model class for table "role_based_views".
 *
 * The followings are the available columns in table 'role_based_views':
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $role_id
 * @property integer $menu_id
 * @property string $menu_name
 * @property integer $is_viewable
 * @property integer $module_id
 * @property integer $is_deleted
 */
class RoleBasedViews extends CActiveRecord {

    protected $oldAttributes;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'role_based_views';
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
            array('created_at, role_id, menu_id, menu_name, is_viewable, module_id', 'required'),
            array('role_id, menu_id, is_viewable, module_id, is_deleted', 'numerical', 'integerOnly' => true),
            array('menu_name', 'length', 'max' => 100),
            array('updated_at', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, created_at, updated_at, role_id, menu_id, menu_name, is_viewable, module_id, is_deleted', 'safe', 'on' => 'search'),
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
            'roles' => array(self::BELONGS_TO, 'Roles', 'role_id'),
            'menus' => array(self::BELONGS_TO, 'Menus', 'menu_id'),
            'modules' => array(self::BELONGS_TO, 'Modules', 'module_id'),
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
            'role_id' => 'Role',
            'menu_id' => 'Menu',
            'menu_name' => 'Menu Name',
            'is_viewable' => 'Is Viewable',
            'module_id' => 'Module',
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

        $criteria->compare('role_id', $this->role_id);

        $criteria->compare('menu_id', $this->menu_id);

        $criteria->compare('menu_name', $this->menu_name, true);

        $criteria->compare('is_viewable', $this->is_viewable);

        $criteria->compare('module_id', $this->module_id);

        $criteria->compare('is_deleted', $this->is_deleted);

        return new CActiveDataProvider('RoleBasedViews', array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * @return RoleBasedViews the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    function getIsDeleted()
    {
        return Utilities::get_ActiveSelect($this->is_deleted);
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

    function getIsViewable()
    {
        return Utilities::get_ActiveSelect($this->is_viewable);
    }

}
