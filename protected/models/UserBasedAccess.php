<?php

/**
 * This is the model class for table "user_based_access".
 *
 * The followings are the available columns in table 'user_based_access':
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $menu_id
 * @property integer $module_id
 * @property integer $user_id
 * @property integer $controller_id
 * @property string $controller_name
 * @property integer $action_id
 * @property string $action_name
 * @property integer $is_accesible
 * @property integer $parent_id
 * @property integer $is_deleted
 */
class UserBasedAccess extends CActiveRecord {

    protected $oldAttributes;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'user_based_access';
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
            array('created_at', 'required'),
            array('module_id, user_id, controller_id, action_id, is_accesible, is_deleted, menu_id, parent_id', 'numerical', 'integerOnly' => true),
            array('controller_name, action_name', 'length', 'max' => 100),
            array('updated_at', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, created_at, updated_at, module_id, user_id, controller_id, controller_name, action_id, action_name, is_accesible, is_deleted,  menu_id ,parent_id', 'safe', 'on' => 'search'),
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
            'menus' => array(self::BELONGS_TO, 'Menus', 'menu_id'),
            'modules' => array(self::BELONGS_TO, 'Modules', 'module_id'),
            'controllers' => array(self::BELONGS_TO, 'Controllers', 'controller_id'),
            'actions' => array(self::BELONGS_TO, 'Actions', 'action_id'),
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
            'module_id' => 'Module',
            'menu_id' => 'Menu',
            'user_id' => 'User',
            'controller_id' => 'Controller',
            'controller_name' => 'Controller Name',
            'action_id' => 'Action',
            'action_name' => 'Action Name',
            'is_accesible' => 'Is Accesible',
            'parent_id' => 'Parent',
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

        $criteria->compare('menu_id', $this->menu_id);

        $criteria->compare('module_id', $this->module_id);

        $criteria->compare('user_id', $this->user_id);

        $criteria->compare('controller_id', $this->controller_id);

        $criteria->compare('controller_name', $this->controller_name, true);

        $criteria->compare('action_id', $this->action_id);

        $criteria->compare('action_name', $this->action_name, true);

        $criteria->compare('is_accesible', $this->is_accesible);

        $criteria->compare('parent_id', $this->parent_id);

        $criteria->compare('is_deleted', $this->is_deleted);

        return new CActiveDataProvider('UserBasedAccess', array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * @return UserBasedAccess the static model class
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

    function getIsAccesible()
    {
        return Utilities::get_ActiveSelect($this->is_accesible);
    }

    public static function model_getByMenuIDUserID($menuID, $userID)
    {
        return self::model()->find('menu_id = :menuID AND user_id = :userID', array(':menuID' => $menuID, ':userID' => $userID));
    }

    public function addRecord()
    {
        $model = new UserBasedAccess();

        $model->updated_at = $this->updated_at;
        $model->created_at = $this->created_at;
        $model->module_id = $this->module_id;
        $model->menu_id = $this->menu_id;
        $model->user_id = $this->user_id;
        $model->controller_id = $this->controller_id;
        $model->controller_name = $this->controller_name;
        $model->action_id = $this->action_id;
        $model->action_name = $this->action_name;
        $model->is_accesible = $this->is_accesible;
        $model->parent_id = $this->parent_id;
        $model->is_deleted = $this->is_deleted;


        if ($model->validate()) {
            $model->save();

            $modelArr[0] = $model->id;
            $modelArr[1] = 'User Based Access Successfully Created.';
        } else {
            $modelArr[0] = 0;
            $modelArr[1] = Utilities::get_ModelErrors($model->errors);
        }

        return $modelArr;
    }

    public static function sql_updateIsAccessible_byMenuIDUserID($menuID, $userID, $isAccesible)
    {
        $cnn = Utilities::createConnection();
        $sql = 'UPDATE  ' . self::tbl() . ' set is_accesible = :isAccesible WHERE menu_id = :menuID AND user_id = :userID limit 1';
        $command = $cnn->createCommand($sql);
        $command->bindValue(':isAccesible', $isAccesible, PDO::PARAM_INT);
        $command->bindValue(':menuID', $menuID, PDO::PARAM_INT);
        $command->bindValue(':userID', $userID, PDO::PARAM_INT);
        return $command->execute();
    }

    public static function model_getChildrenByParentIDUserID($parentID, $userID, $isAccesible)
    {
        return self::model()->findAll('parent_id = :parentID AND user_id =:userID AND is_accesible=:isAccesible', array(':parentID' => $parentID, ':userID' => $userID, ':isAccesible' => $isAccesible));
    }

    public static function model_getParentUserID($parentID, $userID, $isAccesible)
    {
        return self::model()->findAll('parent_id = :parentID AND user_id =:userID AND is_accesible=:isAccesible', array(':parentID' => $parentID, ':userID' => $userID, ':isAccesible' => $isAccesible));
    }

    public static function model_getByUserID_menuID($menuID, $userID, $isDeleted)
    {
        return self::model()->findAll(' menu_id = :menuID AND user_id = :userID AND is_deleted =:isDeleted', array(':menuID' => $menuID, ':userID' => $userID, ':isDeleted' => $isDeleted));
    }

}
