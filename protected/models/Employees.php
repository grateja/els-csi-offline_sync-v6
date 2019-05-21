<?php

    /**
     * This is the model class for table "employees".
     *
     * The followings are the available columns in table 'employees':
     * @property integer $id
     * @property string $created_at
     * @property string $updated_at
     * @property string $employee_no
     * @property string $firstname
     * @property string $middlename
     * @property string $lastname
     * @property string $mobile
     * @property string $phone
     * @property string $email
     * @property string $birthdate
     * @property integer $civil_status_id
     * @property string $address1
     * @property string $address2
     * @property integer $region_id
     * @property integer $province_id
     * @property integer $municipality_id
     * @property integer $barangay_id
     * @property integer $office_id
     * @property integer $citizenship_id
     * @property integer $branch_id
     * @property integer $client_id
     * @property integer $contact_person_id
     * @property integer $occupation_id
     * @property integer $department_id
     * @property integer $manager_id
     * @property integer $location_id
     * @property string $date_endo
     * @property integer $is_agent
     * @property integer $is_active
     * @property integer $is_deleted
     * @property integer $is_account_created
     * @property integer $is_owner
     * @property integer $is_with_card
     */
    class Employees extends CActiveRecord {

        protected $oldAttributes;

        /**
         * @return string the associated database table name
         */
        const CIVIL_STATUS_SINGLE = 1;
        const CIVIL_STATUS_MARRIED = 2;
        const CIVIL_STATUS_WIDOW = 3;

        public function tableName() {
            return 'employees';
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

            foreach ($changedArray as $key => $value) {
                if (strcmp($key, 'updated_at'))
                    AuditTrails::newRecord(AuditTrails::TRANS_TYPE_UPDATE, self::tbl(), $key, $this->attributes['id'], $this->oldAttributes[$key], $value, Settings::get_UserID(), Settings::get_EmployeeID());
            }

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
                array('created_at, employee_no, firstname, lastname, birthdate, branch_id, client_id', 'required'),
                array('civil_status_id, region_id, province_id, municipality_id, barangay_id, office_id, citizenship_id, branch_id, contact_person_id, occupation_id, department_id, manager_id, is_agent, is_active, is_deleted, location_id, client_id,employee_no, is_account_created, is_owner, is_with_card', 'numerical', 'integerOnly' => true),
                array('employee_no, phone', 'length', 'max' => 20),
                array('firstname, middlename, lastname, address1, address2', 'length', 'max' => 255),
                array('mobile', 'length', 'max' => 11),
                array('updated_at', 'safe'),
                array('email', 'email'),
                array('date_endo', 'required', 'on' => 'updateEmployee'),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, created_at, updated_at, employee_no, firstname, middlename, lastname, mobile, phone, email, birthdate, civil_status_id, address1, address2, region_id, province_id, municipality_id, barangay_id, office_id, citizenship_id, branch_id, contact_person_id, occupation_id, department_id, manager_id, location_id, date_endo, is_agent, is_active, is_deleted, is_account_created, is_owner, is_with_card', 'safe', 'on' => 'search'),
            );
        }

        /**
         * @return array relational rules.
         */
        public function relations() {
            // NOTE: you may need to adjust the relation name and the related
            // class name for the relations automatically generated below.
            return array(
                'departments' => array(self::BELONGS_TO, 'Departments', 'department_id'),
                'regions' => array(self::BELONGS_TO, 'Regions', 'region_id'),
                'provinces' => array(self::BELONGS_TO, 'Provinces', 'province_id'),
                'municipalities' => array(self::BELONGS_TO, 'Municipalities', 'municipality_id'),
                'barangays' => array(self::BELONGS_TO, 'Barangays', 'barangay_id'),
                'citizenships' => array(self::BELONGS_TO, 'Citizenships', 'citizenship_id'),
                'occupations' => array(self::BELONGS_TO, 'Occupations', 'occupation_id'),
                'employees' => array(self::HAS_MANY, 'Employees', 'emp_id'),
                'clients' => array(self::BELONGS_TO, 'Clients', 'client_id'),
                'branches' => array(self::BELONGS_TO, 'Branches', 'branch_id'),
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
                'employee_no' => 'Employee No',
                'firstname' => 'Firstname',
                'middlename' => 'Middlename',
                'lastname' => 'Lastname',
                'mobile' => 'Mobile',
                'phone' => 'Phone',
                'email' => 'Email',
                'birthdate' => 'Birthdate',
                'civil_status_id' => 'Civil Status',
                'address1' => 'Address 1',
                'address2' => 'Address 2',
                'region_id' => 'Region',
                'province_id' => 'Province',
                'municipality_id' => 'Municipality',
                'barangay_id' => 'Barangay',
                'office_id' => 'Office',
                'citizenship_id' => 'Citizenship',
                'branch_id' => 'Branch',
                'client_id' => 'Client',
                'contact_person_id' => 'Contact Person',
                'occupation_id' => 'Occupation',
                'department_id' => 'Department',
                'manager_id' => 'Manager',
                'location_id' => 'Location',
                'is_agent' => 'Agent',
                'is_active' => 'Active',
                'is_deleted' => 'Deleted',
                'is_account_created' => 'Account Created',
                'is_owner' => 'Is Owner',
                'is_with_card' => 'Is With Card'
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

            $criteria->compare('employee_no', $this->employee_no, true);

            $criteria->compare('firstname', $this->firstname, true);

            $criteria->compare('middlename', $this->middlename, true);

            $criteria->compare('lastname', $this->lastname, true);

            $criteria->compare('mobile', $this->mobile, true);

            $criteria->compare('phone', $this->phone, true);

            $criteria->compare('email', $this->email, true);

            $criteria->compare('birthdate', $this->birthdate, true);

            $criteria->compare('civil_status_id', $this->civil_status_id);

            $criteria->compare('address1', $this->address1, true);

            $criteria->compare('address2', $this->address2, true);

            $criteria->compare('region_id', $this->region_id);

            $criteria->compare('province_id', $this->province_id);

            $criteria->compare('municipality_id', $this->municipality_id);

            $criteria->compare('barangay_id', $this->barangay_id);

            $criteria->compare('office_id', $this->office_id);

            $criteria->compare('citizenship_id', $this->citizenship_id);

            $criteria->compare('branch_id', $this->branch_id);

            $criteria->compare('client_id', $this->client_id);

            $criteria->compare('contact_person_id', $this->contact_person_id);

            $criteria->compare('occupation_id', $this->occupation_id);

            $criteria->compare('department_id', $this->department_id);

            $criteria->compare('manager_id', $this->manager_id);

            $criteria->compare('location_id', $this->location_id);

            $criteria->compare('is_agent', $this->is_agent);

            $criteria->compare('is_active', $this->is_active);

            $criteria->compare('is_deleted', $this->is_deleted);

            $criteria->compare('is_account_created', $this->is_account_created);

            $criteria->compare('is_owner', $this->is_owner);

            $criteria->compare('is_with_card', $this->is_with_card);

            $criteria->order = 't.created_at DESC';

            return new CActiveDataProvider('Employees', array(
                'criteria' => $criteria,
                'pagination' => array(
                    'pageSize' => 15,
                )
            ));
        }

        /**
         * Returns the static model of the specified AR class.
         * @return Employees the static model class
         */
        public static function model($className = __CLASS__) {
            return parent::model($className);
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

        public static function model_getAllData_byDeleted($isDeleted) {
            $crit = new CDbCriteria();
            $crit->condition = 'is_deleted = :isDeleted';
            $crit->params = array(':isDeleted' => Utilities::NO);
            //        $crit->order = 'lastname asc';
            return self::model()->findAll($crit);
        }

        public function getLnameFname() {
            return $this->lastname . ', ' . $this->firstname;
        }

        public function getCodeStandardName() {
            return $this->employee_no . ' - ' . $this->lnameFname;
        }

        public static function sql_getDeptID_byID($id) {
            $cnn = Utilities::createConnection();
            $sql = 'select department_id from ' . self::tbl() . ' where id = :employeeID limit 1';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':employeeID', $id, PDO::PARAM_INT);
            return $command->queryScalar();
        }

        public static function sql_getEmpNo_byID($id) {
            $cnn = Utilities::createConnection();
            $sql = 'select employee_no from ' . self::tbl() . ' where id = :employeeID limit 1';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':employeeID', $id, PDO::PARAM_INT);

            $empNo = $command->queryScalar();
            return ($empNo) ? $empNo : 0;
        }

        public static function sql_getLocationID_byID($id) {
            $cnn = Utilities::createConnection();
            $sql = 'select location_id from ' . self::tbl() . ' where id = :employeeID limit 1';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':employeeID', $id, PDO::PARAM_INT);
            return $command->queryScalar();
        }

        public static function sql_getFullName($id) {
            $cnn = Utilities::createConnection();
            $sql = 'select firstname from ' . self::tbl() . ' where id = :emp_id limit 1';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':emp_id', $id, PDO::PARAM_INT);
            $fname = $command->queryScalar();

            $sql = 'select middlename from ' . self::tbl() . ' where id = :emp_id limit 1';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':emp_id', $id, PDO::PARAM_INT);
            $mname = $command->queryScalar();

            $sql = 'select lastname from ' . self::tbl() . ' where id = :emp_id limit 1';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':emp_id', $id, PDO::PARAM_INT);
            $lname = $command->queryScalar();

            $mi = substr($mname, 0, 1);

            return $fname . ' ' . $mi . '. ' . $lname;
        }

        public static function sql_getFirstName($id) {
            $cnn = Utilities::createConnection();
            $sql = 'select firstname from ' . self::tbl() . ' where id = :emp_id limit 1';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':emp_id', $id, PDO::PARAM_INT);
            $fname = $command->queryScalar();

            $sql = 'select middlename from ' . self::tbl() . ' where id = :emp_id limit 1';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':emp_id', $id, PDO::PARAM_INT);
            $mname = $command->queryScalar();

            $sql = 'select lastname from ' . self::tbl() . ' where id = :emp_id limit 1';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':emp_id', $id, PDO::PARAM_INT);
            $lname = $command->queryScalar();

            $mi = substr($mname, 0, 1);

            return $fname;
        }

        function getIsDeleted() {
            return Utilities::get_ActiveSelect($this->is_deleted);
        }

        public function getIsActive() {
            if ($this->is_active == Utilities::YES) {
                $color = 'label-primary';
            } else {
                $color = 'label-danger';
            }
            return '<div class="label label-table ' . $color . ' " style="border-radius: none !important; font-size: 10px; text-align: center; font-weight: bold; text-transform: uppercase; padding: 2px 8px !important;"><span">' . Utilities::get_ActiveStatus($this->is_active) . '</span></div>';
        }

        function getCivilStatus() {
            return $this->getActiveSelectCivilStatus($this->civil_status_id);
        }

        public static function getActiveSelectCivilStatus($id = null) {
            $status = array(1 => 'Single', 2 => 'Married', 3 => 'Widowed');
            if (is_null($id))
                return $status;
            else
                return $status[$id];
        }

        public static function generateEmployeeNo() {
            $customerNum = 5;
            $custID = self::getLastInsertedEmpNo() + 1;
            return sprintf("%0" . $customerNum . "d", $custID);
        }

        public static function getLastInsertedEmpNo() {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT employee_no FROM ' . self::tbl() . ' where client_id = :clientID ORDER BY id DESC limit 1';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':clientID', Settings::get_ClientID(), PDO::PARAM_INT);
            return $command->queryScalar();
        }

        public function addRecord() {
            $model = new Employees();
            $model->created_at = $this->created_at;
            $model->updated_at = $this->updated_at;
            $model->employee_no = $this->employee_no;
            $model->firstname = $this->firstname;
            $model->middlename = $this->middlename;
            $model->lastname = $this->lastname;
            $model->mobile = $this->mobile;
            $model->phone = $this->phone;
            $model->email = $this->email;
            $model->birthdate = $this->birthdate;
            $model->civil_status_id = $this->civil_status_id;
            $model->address1 = $this->address1;
            $model->address2 = $this->address2;
            $model->region_id = $this->region_id;
            $model->province_id = $this->province_id;
            $model->municipality_id = $this->municipality_id;
            $model->barangay_id = $this->barangay_id;
            $model->office_id = $this->office_id;
            $model->citizenship_id = $this->citizenship_id;
            $model->branch_id = $this->branch_id;
            $model->contact_person_id = $this->contact_person_id;
            $model->occupation_id = $this->occupation_id;
            $model->department_id = $this->department_id;
            $model->manager_id = $this->manager_id;
            $model->location_id = $this->location_id;
            $model->is_active = $this->is_active;
            $model->is_with_card = $this->is_with_card;
            $model->is_deleted = $this->is_deleted;

            if ($model->validate()) {
                $model->save();
                $message[0] = $model->id;
                $message[1] = 'Employee Successfully Created.';
            } else {
                $message[0] = 0;
                $message[1] = Utilities::get_ModelErrors($model->errors);
            }

            return $message;
        }

        public static function model_getAllData_bySalesAgent($isAgent) {
            return self::model()->findAll('is_agent = :isAgent', array(':isAgent' => $isAgent));
        }

        public function getIsAgent() {
            if ($this->is_agent == Utilities::YES) {
                $color = 'label-primary';
            } else {
                $color = 'label-danger';
            }
            return '<div class="label label-table ' . $color . ' " style="border-radius: none !important; font-size: 10px; text-align: center; font-weight: bold; text-transform: uppercase; padding: 2px 8px !important;"><span">' . Utilities::get_ActiveSelect($this->is_agent) . '</span></div>';
        }

        public function getFullname() {
            $fullname = Settings::setCapitalAll($this->lastname) . ', ' . Settings::setCapitalFirst($this->firstname) . ' ' . Settings::setCapitalFirst(substr($this->middlename, 0, 1)) . '.';

            return $fullname;
        }

        //upon creation of user account
        public static function sql_updateIsAccountCreated($userID, $isAccountCreated) {
            $cnn = Utilities::createConnection();
            $sql = 'UPDATE  ' . self::tbl() . ' set is_account_created = :isAccountCreated WHERE id = :empID limit 1';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':empID', $userID, PDO::PARAM_INT);
            $command->bindValue(':isAccountCreated', $isAccountCreated, PDO::PARAM_INT);
            return $command->execute();
        }

        public static function model_getAllData_byIsAccountCreated($isDeleted, $isAccountCreated) {
            return self::model()->findAll('is_deleted = :isDeleted AND is_account_created = :isAccountCreated', array(':isDeleted' => $isDeleted, ':isAccountCreated' => $isAccountCreated));
        }

        //upon creation of user account
        public static function sql_updateIsWithCard($empID, $isWithCard) {
            $cnn = Utilities::createConnection();
            $sql = 'UPDATE  ' . self::tbl() . ' set is_with_card = :isWithCard WHERE id = :empID limit 1';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':empID', $empID, PDO::PARAM_INT);
            $command->bindValue(':isWithCard', $isWithCard, PDO::PARAM_INT);
            return $command->execute();
        }

        public static function model_getAllData_byIsWithCard_andIsDeleted($isWithCard, $isDeleted) {
            return self::model()->findAll('is_with_card = :isWithCard AND is_deleted = :isDeleted AND client_id = :clientID', array(':isWithCard' => $isWithCard, ':isDeleted' => $isDeleted, ':clientID' => Settings::get_ClientID()));
        }

        public static function model_getAllData_byIsAccountCreatedClientID($isDeleted, $isAccountCreated, $cleintID) {
            return self::model()->findAll('is_deleted = :isDeleted AND is_account_created = :isAccountCreated AND client_id = :clientID', array(':isDeleted' => $isDeleted, ':isAccountCreated' => $isAccountCreated, ':clientID' => $cleintID));
        }

        public static function model_getAllData_byIsClientID($isDeleted, $cleintID) {
            return self::model()->findAll('is_deleted = :isDeleted AND client_id = :clientID', array(':isDeleted' => $isDeleted, ':clientID' => $cleintID));
        }

        public static function model_getAllData_byDeletedClientID($isDeleted, $cleintID) {
            return self::model()->findAll('is_deleted = :isDeleted AND client_id = :clientID', array(':isDeleted' => $isDeleted, ':clientID' => $cleintID));
        }


        public static function model_getAllData_byDeletedCLientID_branchID($isDeleted, $clientID, $branchID) {
            return self::model()->findAll('is_sync = :isDeleted AND client_id = :clientID AND branch_id = :branchID', array(':isDeleted' => $isDeleted, ':clientID' => $clientID , ':branchID' => $branchID));
        }


    }
    