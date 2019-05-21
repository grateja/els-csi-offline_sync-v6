<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property string $username
 * @property string $email
 * @property string $pword_hash
 * @property integer $account_type_id
 * @property integer $education_level_id
 * @property integer $role
 * @property string $last_login
 * @property integer $is_active
 * @property integer $emp_id
 */
class Users extends CActiveRecord {

    protected $oldAttributes;
    public $old_password;
    public $new_password;
    public $confirm_password;
    public $repeat_password;

    const PAGE_SIZE = 15;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'users';
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

    public static function clearSessions()
    {
        unset($_SESSION[self::tbl()]);
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('created_at, username', 'required'),
            array('account_type_id, is_active, emp_id, role', 'numerical', 'integerOnly' => true),
            array('updated_at, last_login', 'safe'),
            //array('emp_id', 'unique', 'message' => 'Selected employee already exists!'),
            array('email', 'email'),
            array('username', 'length', 'max' => 20),
            array('username', 'unique', 'message' => 'User already exists!'),
            array('pword_hash, confirm_password', 'required', 'on' => 'createUser'),
            array('pword_hash', 'length', 'max' => 255),
            array('new_password', 'compare', 'compareAttribute' => 'confirm_password', 'on' => 'createUser'),
            array('emp_id', 'unique', 'on' => 'create'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, created_at, updated_at, username, email, account_type_id, is_active, last_login, emp_id, role', 'safe', 'on' => 'search'),
//            array('old_password, new_password, repeat_password', 'required', 'on' => 'update'),
//            array('repeat_password', 'compare', 'compareAttribute' => 'new_password', 'on' => 'update'),
            array('old_password, new_password, confirm_password', 'required', 'on' => 'reset'),
            array('confirm_password', 'compare', 'compareAttribute' => 'new_password', 'on' => 'reset'),
            array('new_password, confirm_password, old_password', 'required', 'on' => 'changePassword'),
            array('old_password', 'findPasswords', 'on' => 'changePassword'),
            array('confirm_password', 'compare', 'compareAttribute' => 'new_password', 'on' => 'changePassword'),
           // array('new_password, confirm_password', 'required', 'on' => 'updateChangePassword'),
            array('confirm_password', 'compare', 'compareAttribute' => 'new_password', 'on' => 'updateChangePassword'),
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
            'accountType' => array(self::BELONGS_TO, 'AccountTypes', 'account_type_id'),
            'employees' => array(self::BELONGS_TO, 'Employees', 'emp_id'),
            'roles' => array(self::BELONGS_TO, 'Roles', 'role'),
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
            'username' => 'Username',
            'email' => 'Email',
            'pword_hash' => 'Password',
            'new_password' => 'New Password',
            'confirm_password' => 'Confirm Password',
            'repeat_password' => 'Repeat Password',
            'account_type_id' => 'Account Type',
            'educational_level_id' => 'Education Level',
            'role' => 'Role',
            'last_login' => 'Last Login',
            'is_active' => 'Is Active',
            'emp_id' => 'Employee ID'
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

        $criteria->compare('username', $this->username, true);

        $criteria->compare('email', $this->email, true);

        $criteria->compare('account_type_id', $this->account_type_id);

        $criteria->compare('is_active', $this->is_active);

        $criteria->compare('last_login', $this->last_login, true);

        $criteria->compare('role', $this->role, true);

        $criteria->compare('emp_id', $this->emp_id, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 10,
            )
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * @return Users the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function sql_validateAccount($username, $password)
    {
        $cnn = Utilities::createConnection();
        $sql = 'SELECT count(*) FROM ' . self::tbl() . ' WHERE username = :username AND pword_hash = :pwordHash limit 1';
        $command = $cnn->createCommand($sql);
        $command->bindValue(':username', $username, PDO::PARAM_STR);
        $command->bindValue(':pwordHash', md5($password), PDO::PARAM_STR);
        return $command->queryScalar();
    }

    public static function sql_validateAccount_byAccountType($username, $password, $accountTypeID)
    {
        $cnn = Utilities::createConnection();
        $sql = 'SELECT count(*) FROM ' . self::tbl() . ' WHERE username = :username AND pword_hash = :pwordHash AND account_type_id = :accountTypeID limit 1';
        $command = $cnn->createCommand($sql);
        $command->bindValue(':username', $username, PDO::PARAM_STR);
        $command->bindValue(':pwordHash', md5($password), PDO::PARAM_STR);
        $command->bindValue(':accountTypeID', $accountTypeID, PDO::PARAM_INT);
        return '1 => ' . $command->queryScalar();
    }

    function getIsActive()
    {
        return Utilities::get_ActiveSelect($this->is_active);
    }

    public static function model_getAllData_byActive($isActive)
    {
        return self::model()->findAll('is_active = :isActive', array(':isActive' => $isActive));
    }

    public static function model_getUserName($emp_id)
    {
        $cnn = Utilities::createConnection();
        $sql = 'select username from ' . self::tbl() . ' where emp_id = :emp_id limit 1';
        $command = $cnn->createCommand($sql);
        $command->bindValue(':emp_id', $emp_id, PDO::PARAM_INT);
        return $command->queryScalar();
    }

    public static function model_getAccountType_byUserID($userID)
    {
        $cnn = Utilities::createConnection();
        $sql = 'select account_type_id from ' . self::tbl() . ' where id = :userID limit 1';
        $command = $cnn->createCommand($sql);
        $command->bindValue(':userID', $userID, PDO::PARAM_INT);
        return $command->queryScalar();
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

    //For Change Password
    public static function setClassChangePasswordActive($value = null)
    {
        $_SESSION[self::tbl()]['changePassword']['classActive'] = $value;
    }

    public static function getClassChangePasswordActive()
    {
        return $_SESSION[self::tbl()]['changePassword']['classActive'];
    }

    public function findPasswords($attribute, $params)
    {
        $users = Users::model()->findByPK(Settings::get_UserID()); //this is not a proven technique yet.

        if ($users->pword_hash != md5($this->old_password)) {
            return $this->addError($attribute, 'Incorrect Old Password');
        }
    }

    //End for change Password
    public static function sql_getEmployeeID_byUserID($userID)
    {
        $cnn = Utilities::createConnection();
        $sql = 'select emp_id from ' . self::tbl() . ' where id = :userID limit 1';
        $command = $cnn->createCommand($sql);
        $command->bindValue(':userID', $userID, PDO::PARAM_INT);
        return $command->queryScalar();
    }

    public static function sql_updateIsOverrideUserAccess($userID, $userAccess)
    {
        $cnn = Utilities::createConnection();
        $sql = 'UPDATE  ' . self::tbl() . ' set is_override_useraccess = :userAccess WHERE id = :userID limit 1';
        $command = $cnn->createCommand($sql);
        $command->bindValue(':userID', $userID, PDO::PARAM_INT);
        $command->bindValue(':userAccess', $userAccess, PDO::PARAM_INT);
        return $command->execute();
    }

}
