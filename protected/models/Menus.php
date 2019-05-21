<?php

/**
 * This is the model class for table "menus".
 *
 * The followings are the available columns in table 'menus':
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property string $name
 * @property integer $module_id
 * @property integer $is_main_menu
 * @property integer $is_parent
 * @property integer $parent_id
 * @property integer $is_url
 * @property integer $controller_id
 * @property string $controller_name
 * @property integer $action_id
 * @property string $action_name
 * @property string $params
 * @property integer $orders
 * @property string $li_class
 * @property string $i_class
 * @property string $span_class
 * @property string $link_class
 * @property integer $is_deleted
 */
class Menus extends CActiveRecord {

    protected $oldAttributes;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'menus';
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
            array('created_at', 'required'),
            array('module_id, is_main_menu, is_parent, parent_id, is_url, controller_id, action_id, orders, is_deleted', 'numerical', 'integerOnly' => true),
            array('name, controller_name, action_name, li_class, i_class, span_class, link_class', 'length', 'max' => 100),
            array('params', 'length', 'max' => 255),
            array('updated_at', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, created_at, updated_at, name, module_id, is_main_menu, is_parent, parent_id, is_url, controller_id, controller_name, action_id, action_name, params, orders, li_class, i_class, span_class, link_class, is_deleted', 'safe', 'on' => 'search'),
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
            'actions' => array(self::BELONGS_TO, 'Actions', 'action_id'),
            'controllers' => array(self::BELONGS_TO, 'Controllers', 'controller_id'),
            'modules' => array(self::BELONGS_TO, 'Modules', 'module_id'),
            'menus' => array(self::BELONGS_TO, 'Menus', 'parent_id'),
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
            'name' => 'Name',
            'module_id' => 'Module',
            'is_main_menu' => 'Is Main Menu',
            'is_parent' => 'Is Parent',
            'parent_id' => 'Parent',
            'is_url' => 'Is Url',
            'controller_id' => 'Controller',
            'controller_name' => 'Controller Name',
            'action_id' => 'Action',
            'action_name' => 'Action Name',
            'params' => 'Params',
            'orders' => 'Orders',
            'li_class' => 'Li Class',
            'i_class' => 'I Class',
            'span_class' => 'Span Class',
            'link_class' => 'Link Class',
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

        $criteria->compare('module_id', $this->module_id);

        $criteria->compare('is_main_menu', $this->is_main_menu);

        $criteria->compare('is_parent', $this->is_parent);

        $criteria->compare('parent_id', $this->parent_id);

        $criteria->compare('is_url', $this->is_url);

        $criteria->compare('controller_id', $this->controller_id);

        $criteria->compare('controller_name', $this->controller_name, true);

        $criteria->compare('action_id', $this->action_id);

        $criteria->compare('action_name', $this->action_name, true);

        $criteria->compare('params', $this->params, true);

        $criteria->compare('orders', $this->orders);

        $criteria->compare('li_class', $this->li_class, true);

        $criteria->compare('i_class', $this->i_class, true);

        $criteria->compare('span_class', $this->span_class, true);

        $criteria->compare('link_class', $this->link_class, true);

        $criteria->compare('is_deleted', $this->is_deleted);

        return new CActiveDataProvider('Menus', array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * @return Menus the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function model_getData_byIsDeleted($isDeleted)
    {
        return self::model()->findAll('is_deleted = :isDeleted AND is_parent = :isParent', array(':isDeleted' => $isDeleted, ':isParent' => Utilities::YES));
    }

    public static function model_getRowData_byID($id)
    {
        return self::model()->find('id = :id', array(':id' => $id));
    }

    function getName()
    {
        return Utilities::setCapitalFirst($this->name);
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
        $_SESSION[self::tbl()]['new']['classActve'] = $value;
    }

    public static function getClassNewActive()
    {
        return $_SESSION[self::tbl()]['new']['classActve'];
    }

    public static function setClassManageActive($value = NULL)
    {
        $_SESSION[self::tbl()]['manage']['classActve'] = $value;
    }

    public static function getClassManageActive()
    {
        return $_SESSION[self::tbl()]['manage']['classActve'];
    }

    public function getIsDeleted()
    {
        return Utilities::get_ActiveSelect($this->is_deleted);
    }

    public function getIsParent()
    {
        return Utilities::get_ActiveSelect($this->is_parent);
    }

    public function getIsMainMenu()
    {
        return Utilities::get_ActiveSelect($this->is_main_menu);
    }

    public function getIsUrl()
    {
        return Utilities::get_ActiveSelect($this->is_url);
    }

    public static function model_getAllMainMenu()
    {
        $crit = new CDbCriteria();
        $crit->condition = 'is_main_menu = :isMainMenu AND is_deleted = :isDeleted';
        $crit->params = array(':isMainMenu' => Utilities::YES, ':isDeleted' => Utilities::NO);
        $crit->order = 'orders asc';

        return self::model()->findAll($crit);
    }

    public static function model_getAllSubMenu_byParentID($parentID)
    {
        $crit = new CDbCriteria();
        $crit->condition = 'parent_id = :parentID AND is_deleted = :isDeleted';
        $crit->params = array(':parentID' => $parentID, ':isDeleted' => Utilities::NO);
        $crit->order = 'orders asc';

        return self::model()->findAll($crit);
    }

    public static function sql_getParentID_byMenuID($menuID)
    {
        $cnn = Utilities::createConnection();
        $sql = 'select distinct(parent_id) from ' . self::tbl() . ' where id = :menuID limit 1';
        $command = $cnn->createCommand($sql);
        $command->bindValue(':menuID', $menuID, PDO::PARAM_INT);
        return $command->queryScalar();
    }

    public static function sql_getRowData_controllerNameActionName($controllerName, $actionName)
    {
        $cnn = Utilities::createConnection();
        $sql = 'select id from ' . self::tbl() . ' WHERE controller_name =:controllerName AND action_name =:actionName';
        $command = $cnn->createCommand($sql);
        $command->bindValue(':controllerName', $controllerName, PDO::PARAM_STR);
        $command->bindValue(':actionName', $actionName, PDO::PARAM_STR);
        return $command->queryScalar();
    }

}
