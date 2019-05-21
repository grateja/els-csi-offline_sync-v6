<?php

    /**
     * This is the model class for table "settings".
     *
     * The followings are the available columns in table 'settings':
     * @property integer $id
     * @property string $created_at
     * @property string $updated_at
     * @property string $var
     * @property string $value
     * @property string $description
     * @property integer $is_display
     */
    class Settings extends CActiveRecord {

        protected $oldAttributes;

        /**
         * @return string the associated database table name
         */
        public function tableName() {
            return 'settings';
        }

        public static function tbl() {
            return self::tableName();
        }

        public function beforeSave() {
            if ($this->isNewRecord)
                $this->created_at = Settings::get_DateTime();
            else
                $this->updated_at = Settings::get_DateTime();

            $changedArray = array_diff_assoc($this->attributes, $this->oldAttributes);

//        foreach ($changedArray as $key => $value) {
//            if (strcmp($key, 'updated_at'))
//                AuditTrails::newRecord(AuditTrails::TRANS_TYPE_UPDATE, self::tbl(), $key, $this->attributes['id'], $this->oldAttributes[$key], $value, Settings::get_UserID(), Settings::get_EmployeeID());
//        }
            Utilities::debug(Settings::get_UserID(), $caption);
            exit();
            return parent::beforeSave();
        }

        public function afterFind() {
            $this->oldAttributes = $this->attributes;
            return parent::afterFind();
        }

        public static function get_Date() {
            return date('Y-m-d');
        }

        public static function get_DateTime() {
            return date('Y-m-d H:i:s');
        }

        /**
         * @return array validation rules for model attributes.
         */
        public function rules() {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('var, value, description', 'required'),
                array('is_display', 'numerical', 'integerOnly' => true),
                array('var', 'length', 'max' => 50),
                array('value', 'length', 'max' => 100),
                array('description', 'length', 'max' => 255),
                array('updated_at', 'safe'),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, created_at, updated_at, var, value, description, is_display', 'safe', 'on' => 'search'),
            );
        }

        /**
         * @return array relational rules.
         */
        public function relations() {
            // NOTE: you may need to adjust the relation name and the related
            // class name for the relations automatically generated below.
            return array(
            );
        }

        /**
         * @return array customized attribute labels (name=>label)
         */
        public function attributeLabels() {
            return array(
                'id' => 'ID',
                'created_at' => 'Date Created',
                'updated_at' => 'Last Modified',
                'var' => 'Var',
                'value' => 'Value',
                'description' => 'Description',
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
        public function search() {
            // Warning: Please modify the following code to remove attributes that
            // should not be searched.

            $criteria = new CDbCriteria;

            $criteria->compare('id', $this->id);

            $criteria->compare('created_at', $this->created_at, true);

            $criteria->compare('updated_at', $this->updated_at, true);

            $criteria->compare('var', $this->var, true);

            $criteria->compare('value', $this->value, true);

            $criteria->compare('description', $this->description, true);

            $criteria->compare('is_display', $this->is_display);

            return new CActiveDataProvider('Settings', array(
                'criteria' => $criteria,
            ));
        }

        /**
         * Returns the static model of the specified AR class.
         * @return Settings the static model class
         */
        public static function model($className = __CLASS__) {
            return parent::model($className);
        }

        public static function model_getValue_byID($id) {
            return self::model()->findByPk($id);
        }

        public static function get_Username() {
            return Yii::app()->user->username;
        }

        public static function get_UserID() {
            return Yii::app()->user->user_id;
        }

        public static function get_Role() {
            return Yii::app()->user->role;
        }

        public static function get_Password() {
            return Yii::app()->user->password;
        }

        public static function get_PwordHash() {
            return Yii::app()->user->pword_hash;
        }

        public static function get_roleID() {
            return Yii::app()->user->role;
        }

        public static function get_EmployeeID() {
            return Yii::app()->user->emp_id;
        }

        public static function get_ClientID() {
            return Yii::app()->user->client_id;
        }

        public static function get_EducationalLevelID() {
            if ($_SESSION[Users::tbl()]['educational_level_id'] != '')
                return $_SESSION[Users::tbl()]['educational_level_id'];
            else
                return self::get_AppUser_EducationalLevelID();
        }

        public static function get_AppUser_EducationalLevelID() {
            return Yii::app()->user->educational_level_id;
        }

        // get base folder     
        public static function get_baseUrl() {
            return Yii::app()->baseUrl;
        }

        function getIsDisplay() {
            return Utilities::get_ActiveSelect($this->is_display);
        }

        public static function model_getAllData_byDisplay($isDisplay) {
            return self::model()->findAll('is_display = :isDisplay', array(':isDisplay' => $isDisplay));
        }

        public static function get_ControllerID() {
            return Yii::app()->controller->id;
        }

        public static function get_ActionID() {
            return Yii::app()->controller->action->id;
        }

        public static function setClassActive($value = null) {
            $_SESSION[self::tbl()]['classActive'] = $value;
        }

        public static function getClassActive() {
            return $_SESSION[self::tbl()]['classActive'];
        }

        public static function setClassOpen($value = null) {
            $_SESSION[self::tbl()]['classOpen'] = $value;
        }

        public static function getClassOpen() {
            return $_SESSION[self::tbl()]['classOpen'];
        }

        public static function setClassNewActive($value = null) {
            $_SESSION[self::tbl()]['new']['classActive'] = $value;
        }

        public static function getClassNewActive() {
            return $_SESSION[self::tbl()]['new']['classActive'];
        }

        public static function setClassManageActive($value = null) {
            $_SESSION[self::tbl()]['manage']['classActive'] = $value;
        }

        public static function getClassManageActive() {
            return $_SESSION[self::tbl()]['manage']['classActive'];
        }

        public static function setCapitalFirst($string) {
            return ucwords(strtolower($string));
        }

        public static function setCapitalAll($string) {
            return strtoupper($string);
        }

        public static function setLowerlAll($string) {
            return strtolower($string);
        }

        public static function get_SchoolYearID_Active() {
            return SchoolYears::sql_getID_byActive();
        }

        public static function setPercentage($n) {
            return ($n * 100);
        }

        // percentage means decimal points
        public static function setNumToPercentage($n) {
            return ($n / 100);
        }

        public static function setNumberFormat($n, $decimal) {
            return number_format($n, $decimal);
        }

        public static function setDateStandard($d) {
            return date('M d, Y', strtotime($d));
        }

        public static function setDateTimeStandard($d) {
            return date('M d, Y H:i:s', strtotime($d));
        }

        public static function setDateDash($d) {
            return date('M-d-Y', strtotime($d));
        }

        const CONFIG_BRANCH_CODE = 1;
        const CONFIG_SHOP_NAME = 2;
        const CONFIG_BRANCH_NAME = 3;
        const CONFIG_BRANCH_ID = 4;
        const CONFIG_MIN_PER_WASHDRY = 5;
        const CONFIG_MIN_PER_CYCLE = 6;
        const CONFIG_CARD_INITIAL_LOAD = 7;
        const CONFIG_CARD_NO_LENGTH = 8;
        const CONFIG_CARD_CODE = 9;
        const CONFIG_CARD_EXPIRATION_DAYS = 10;
        const CONFIG_ENVIRONMENT_SETUP = 11;
        const CONFIG_APPS_NAME = 12;
        const ENVIRONMENT_SETUP_QA = 13;
        const ENVIRONMENT_SETUP_PRODUCTION = 14;
        const CONFIG_COMPANY_NAME = 15;

        public static function sql_getValue_byID($id) {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT value FROM ' . self::tbl() . ' WHERE id = :ID';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':ID', $id, PDO::PARAM_INT);
            return $command->queryScalar();
        }

        public static function generateNewRefNO() {
            $length = Settings::model_getValue_byID(Settings::CONFIG_CODE_LENGTH)->value;
            $code = null;
            $codeStr = null;
            $date = date('Ym');
            for ($x = 0; $x < $length; $x++) {
                $code[$x] = rand(0, 9);
                $codeStr .= $code[$x];
            }

            if (self::sql_isCodeExists($codeStr) == true) {
                self::generateCode();
            }

            return $date . $codeStr;
        }

        public static function sql_isCodeExists($code) {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT count(*) FROM ' . CustomerPaymentHeaders::tbl() . ' WHERE ref_no = :code';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':code', $code, PDO::PARAM_STR);
            if ($command->queryScalar() > 0) {
                return true;
            } else {
                return false;
            }
        }

        public function getUserIP() {
            return CHttpRequest::getUserHostAddress();
        }

        public static function setPesoWithNumberFormat($n, $decimal) {
            return '₱ ' . number_format($n, $decimal);
        }

        public static function setPesoWithNumberFormatAndStyle($n, $decimal) {
            return '<span style="padding: 0 5px; float: right !important;">' . '₱ ' . number_format($n, $decimal) . '</span>';
        }

        public static function sessionDataUrl() {
            $sessionDataUrl = $_SESSION[Settings::tbl()]['url'];

            print $sessionDataUrl;
        }

        public static function get_employeeName() {
            $model = new Users();
            $employees = new Employees();
            $id = Settings::get_UserID();

            $model = Utilities::model_getByID($model, $id);
            $employees = Utilities::model_getByID($employees, $model->emp_id);
            return $employees->fullname;
        }

        public static function get_ModuleID() {
            return Yii::app()->controller->module->id;
        }

        public static function get_BranchID() {
            return Yii::app()->user->branch_id;
        }

        public static function calculateAge($sDateBirth) {
            $oDateNow = new DateTime();
            $oDateBirth = new DateTime($sDateBirth);
            // New interval
            $oDateIntervall = $oDateNow->diff($oDateBirth);
            // Output
            return $oDateIntervall->y;
        }

        public function DateDiffInterval($sDate1, $sDate2, $sUnit) {
            //subtract $sDate2-$sDate1 and return the difference in $sUnit (Days,Hours,Minutes,Seconds)
            $nInterval = strtotime($sDate1) - strtotime($sDate2);
            if ($sDate1 >= $sDate2) {
                if ($sUnit == 'D') { // days
                    $nInterval = round($nInterval / 60 / 60 / 24, 2);
                } else if ($sUnit == 'H') { // hours
                    $nInterval = round($nInterval / 60 / 60, 2);
                } else if ($sUnit == 'M') { // minutes
                    $nInterval = round($nInterval / 60, 2);
                } else if ($sUnit == 'S') { // seconds
                }
            } else {
                $nInterval = 0;
            }
            return round($nInterval, 2);
        }

        public static function sql_updateRecord($id, $value, $field) {
            $cnn = Utilities::createConnection();
            $sql = 'UPDATE  ' . self::tbl() . ' set ' . $field . ' =  :value WHERE id = :ID limit 1';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':ID', $id, PDO::PARAM_INT);
            $command->bindValue(':value', $value, PDO::PARAM_INT);
            return $command->execute();
        }

    }
    