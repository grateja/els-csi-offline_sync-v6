<?php

    /**
     * This is the model class for table "customers".
     *
     * The followings are the available columns in table 'customers':
     * @property integer $id
     * @property string $created_at
     * @property string $updated_at
     * @property integer $branch_id
     * @property integer $client_id
     * @property string $firstname
     * @property string $middlename
     * @property string $lastname
     * @property string $company_name
     * @property string $address
     * @property string $email
     * @property string $mobile
     * @property string $phone
     * @property integer $is_sync
     * @property integer $is_deleted
     * @property string $birthdate
     * @property integer $token_wash
     * @property integer $token_dry
     * @property integer $token_titan
     * @property integer $is_activated
     */
    class Customers extends CActiveRecord {

        protected $oldAttributes;

        const CUST_TYPE_PERSONAL = 1;
        const CUST_TYPE_CORPORATE = 2;
        const CASH = 1;
        const CREDIT = 2;
        const DEFAULT_CUSTOMER = 1;

        public $ccode_phone;
        public $ccode_mobile;
        public $area_code;
        public $address;
        public $sales_executive;

        /**
         * @return string the associated database table name
         */
        public function tableName() {
            return 'customers';
        }

        public static function tbl() {
            return self::tableName();
        }

        public function beforeSave() {
            if ($this->isNewRecord)
                $this->created_at = Settings::get_DateTime();
            else
                $this->updated_at = Settings::get_DateTime();

//            $changedArray = array_diff_assoc($this->attributes, $this->oldAttributes);
//
//            foreach ($changedArray as $key => $value) {
//                if (strcmp($key, 'updated_at'))
//                    AuditTrails::newRecord(AuditTrails::TRANS_TYPE_UPDATE, self::tbl(), $key, $this->attributes['id'], $this->oldAttributes[$key], $value, Settings::get_UserID(), Settings::get_EmployeeID());
//            }

            return parent::beforeSave();
        }

        public function afterFind() {
            $this->oldAttributes = $this->attributes;
            return parent::afterFind();
        }

        public static function clearSessions() {
            unset($_SESSION[self::tbl()]);
        }

        /**
         * @return array validation rules for model attributes.
         */
        public function rules() {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('created_at, firstname, lastname, birthdate', 'required'),
                array('branch_id, client_id, is_sync, is_deleted, token_wash, token_dry, token_titan, is_activated', 'numerical', 'integerOnly' => true),
                array('firstname, middlename, lastname', 'length', 'max' => 50),
                array('company_name, address, email', 'length', 'max' => 100),
                array('mobile, phone, points', 'length', 'max' => 15),
                array('updated_at, birthdate', 'safe'),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, created_at, updated_at, branch_id, client_id, firstname, middlename, lastname, company_name, address, email, mobile, phone, is_sync, is_deleted, birthdate, token_wash, token_dry, token_titan, is_activated, points', 'safe', 'on' => 'search'),
            );
        }

        /**
         * @return array relational rules.
         */
        public function relations() {
            // NOTE: you may need to adjust the relation name and the related
            // class name for the relations automatically generated below.
            return array(
                'regions' => array(self::BELONGS_TO, 'Regions', 'region_id'),
                'provinces' => array(self::BELONGS_TO, 'Provinces', 'province_id'),
                'municipalities' => array(self::BELONGS_TO, 'Municipalities', 'municipality_id'),
                'barangays' => array(self::BELONGS_TO, 'Barangays', 'barangay_id'),
                'users' => array(self::BELONGS_TO, 'Users', 'user_id'),
                'approvedByEmpID' => array(self::BELONGS_TO, 'Employees', 'approvedby_emp_id'),
                'branches' => array(self::BELONGS_TO, 'Branches', 'branch_id'),
                'clients' => array(self::BELONGS_TO, 'Clients', 'client_id'),
            );
        }

        /**
         * @return array customized attribute labels (name=>label)
         */
        public function attributeLabels() {
            return array(
                'id' => 'Id',
                'created_at' => 'Date Created',
                'updated_at' => 'Last Modified',
                'branch_id' => 'Branch',
                'client_id' => 'Client',
                'firstname' => 'Firstname',
                'middlename' => 'Middlename',
                'lastname' => 'Lastname',
                'company_name' => 'Company Name',
                'address' => 'Address',
                'email' => 'Email',
                'mobile' => 'Mobile',
                'phone' => 'Phone',
                'is_sync' => 'Is Sync',
                'is_deleted' => 'Is Deleted',
                'birthdate' => 'Birthdate',
                'token_wash' => 'Token Wash',
                'token_dry' => 'Token Dry',
                'token_titan' => 'Token Titan',
                'is_activated' => 'Is Activated',
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

            $criteria->compare('t.id', $this->id);

            $criteria->compare('t.created_at', $this->created_at, true);

            $criteria->compare('t.updated_at', $this->updated_at, true);

            $criteria->compare('t.branch_id', $this->branch_id);

            $criteria->compare('t.client_id', $this->client_id);

            $criteria->compare('t.firstname', $this->firstname, true);

            $criteria->compare('t.middlename', $this->middlename, true);

            $criteria->compare('t.lastname', $this->lastname, true);

            $criteria->compare('t.company_name', $this->company_name, true);

            $criteria->compare('t.address', $this->address, true);

            $criteria->compare('t.email', $this->email, true);

            $criteria->compare('t.mobile', $this->mobile, true);

            $criteria->compare('t.phone', $this->phone, true);

            $criteria->compare('t.is_sync', $this->is_sync);

            $criteria->compare('t.is_deleted', $this->is_deleted);

            $criteria->compare('t.birthdate', $this->birthdate, true);

            $criteria->compare('t.token_wash', $this->token_wash);

            $criteria->compare('t.token_dry', $this->token_dry);

            $criteria->compare('t.token_titan', $this->token_titan);

            $criteria->compare('t.is_activated', $this->is_activated);

            $criteria->order = 't.created_at DESC';

            return new CActiveDataProvider('Customers', array(
                'criteria' => $criteria,
                'pagination' => array(
                    'pageSize' => Utilities::PAGE_SIZE,
                )
            ));
        }

        public function addRecord() {

            $model = new Customers();

            $model->created_at = $this->created_at;
            $model->updated_at = $this->updated_at;
            $model->branch_id = $this->branch_id;
            $model->client_id = $this->client_id;
            $model->firstname = $this->firstname;
            $model->middlename = $this->middlename;
            $model->lastname = $this->lastname;
            $model->company_name = $this->company_name;
            $model->address = $this->address;
            $model->email = $this->email;
            $model->mobile = $this->mobile;
            $model->phone = $this->phone;
            $model->is_sync = $this->is_sync;
            $model->is_deleted = $this->is_deleted;
            $model->birthdate = $this->birthdate;
            $model->token_wash = $this->token_wash;
            $model->token_dry = $this->token_dry;
            $model->token_titan = $this->token_titan;
            $model->is_activated = $this->is_activated;

         
            $model->validate();
            if($model->save()) {
                $ID = $model->id;
                $message = 'Successfully Inserted';
            } else {
                $ID = 0;
                $message = $model->errors;
            }
            return array('ID' => $ID, 'message' => $message);
        }

        /**
         * Returns the static model of the specified AR class.
         * @return Customers the static model class
         */
        public static function model($className = __CLASS__) {
            return parent::model($className);
        }

        public static function model_getAllData_byDeleted($isDeleted) {
            return self::model()->findAll('is_deleted = :isDeleted', array(':isDeleted' => $isDeleted));
        }

        function getIsDeleted() {
            return Utilities::get_ActiveSelect($this->is_deleted);
        }

        public function getLnameFname() {
            return Settings::setCapitalAll($this->lastname) . ', ' . Settings::setCapitalFirst($this->firstname) . ' ' . Settings::setCapitalFirst(substr($this->middlename, 0, 1)) . '.';
        }

        public function getName() {
            return Settings::setCapitalFirst($this->firstname) . ' ' . Settings::setCapitalFirst($this->lastname);
        }

        public static function sql_getFullName($id) {
            $cnn = Utilities::createConnection();
            $sql = 'select firstname from ' . self::tbl() . ' where id = :id limit 1';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':id', $id, PDO::PARAM_INT);
            $fname = $command->queryScalar();

            $sql = 'select middlename from ' . self::tbl() . ' where id = :id limit 1';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':id', $id, PDO::PARAM_INT);
            $mname = $command->queryScalar();

            $sql = 'select lastname from ' . self::tbl() . ' where id = :id limit 1';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':id', $id, PDO::PARAM_INT);
            $lname = $command->queryScalar();

            $mi = substr($mname, 0, 1);

            // return  $fname . ' ' . $mi . ' ' . $lname;
            return Settings::setCapitalAll($lname) . ', ' . Settings::setCapitalFirst($fname) . ' ' . Settings::setCapitalFirst($mname);
        }

        public function getCmdActivateBtn() {
            if ($this->is_activated == 1) {
                $activated = 'Activated';
                return CHtml::link('<span class="badge bg-green">' . $activated . '</span>', '', array('disabled' => 'disabled', 'style' => 'width:100px;', 'id' => 'btnPayment'));
            } else {
                $activated = 'for Activation';
                return CHtml::link('<span class="badge bg-blue">' . $activated . '</span>', array('customerCards/create', 'custID' => $this->id), array('style' => 'width:100px;', 'id' => 'btnPayment'));
            }
        }

        public static function sql_addToken($id, $token, $field) {
            $cnn = Utilities::createConnection();
            $sql = 'UPDATE  ' . self::tbl() . ' set ' . $field . ' =  ' . $field . ' +  :token WHERE id = :ID limit 1';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':ID', $id, PDO::PARAM_INT);
            $command->bindValue(':token', $token, PDO::PARAM_INT);
            return $command->execute();
        }

        public static function sql_deductToken($id, $token, $field) {
            $cnn = Utilities::createConnection();
            $sql = 'UPDATE  ' . self::tbl() . ' set ' . $field . ' =  ' . $field . ' -  :token WHERE id = :ID limit 1';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':ID', $id, PDO::PARAM_INT);
            $command->bindValue(':token', $token, PDO::PARAM_INT);
            return $command->execute();
        }

        public static function sql_getToken($id, $field) {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT ' . $field . ' FROM ' . self::tbl() . ' WHERE id =:custID limit 1';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':custID', $id, PDO::PARAM_INT);
            return $command->queryScalar();
        }

        public static function sql_isExist_customer($firstname, $lastname) {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT count(id) FROM ' . self::tbl() . ' WHERE branch_id =:branchID AND   firstname =:firstname AND lastname = :lastname';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':firstname', $firstname, PDO::PARAM_STR);
            $command->bindValue(':lastname', $lastname, PDO::PARAM_STR);
            $command->bindValue(':branchID', Settings::get_BranchID(), PDO::PARAM_INT);
            return $command->queryScalar();
        }

        public static function sql_countCustomerBasedOnBranchIdAndDeleted($id, $date) {
            $criteria = new CDbCriteria;
            $criteria->select = 'DISTINCT firstname, lastname, middlename';
            $criteria->together = true;
            $criteria->condition = 'branch_id=:branch_id  AND  date(created_at) <= :date AND is_deleted = :isDeleted GROUP BY firstname,lastname,middlename';
            $criteria->params = array(':branch_id' => $id, ':date' => $date, ':isDeleted' => Utilities::NO);
            $model = Customers::model()->findAll($criteria);
            return count($model);
        }

        public static function sql_countNewCustomerBasedOnBranchIdAndDeleted($id, $date) {
            $criteria = new CDbCriteria;
            $criteria->select = 'DISTINCT firstname, lastname, middlename';
            $criteria->together = true;
            $criteria->condition = 'branch_id=:branch_id  AND  created_at > :date AND is_deleted = :isDeleted GROUP BY firstname,lastname,middlename';
            $criteria->params = array(':branch_id' => $id, ':date' => $date, ':isDeleted' => Utilities::NO);
            $model = Customers::model()->findAll($criteria);
            return count($model);
        }

        public static function sql_countOldCustomerBasedOnBranchIdAndDeleted($id, $date) {
            $criteria = new CDbCriteria;
            $criteria->select = 'DISTINCT firstname, lastname, middlename';
            $criteria->together = true;
            $criteria->condition = 'branch_id=:branch_id  AND  created_at < :date AND is_deleted = :isDeleted GROUP BY firstname,lastname,middlename';
            $criteria->params = array(':branch_id' => $id, ':date' => $date, ':isDeleted' => Utilities::NO);
            $model = Customers::model()->findAll($criteria);
            return count($model);
        }

        public static function model_getAllData_byDeletedCLientID($isDeleted, $clientID) {
            return self::model()->findAll('is_deleted = :isDeleted AND client_id = :clientID', array(':isDeleted' => $isDeleted, ':clientID' => $clientID));
        }

        public static function model_getAllData_byDeleted_isSync($isDeleted, $isSync) {
            return self::model()->findAll('is_deleted = :isDeleted  AND is_sync = :isSync', array(':isDeleted' => $isDeleted, ':isSync' => $isSync));
        }

        public static function model_getAllData_byDeletedCLientID_branchID($isDeleted, $clientID, $branchID) {
            return self::model()->findAll('is_sync = :isDeleted AND client_id = :clientID AND branch_id = :branchID', array(':isDeleted' => $isDeleted, ':clientID' => $clientID , ':branchID' => $branchID));
        }

    }
    