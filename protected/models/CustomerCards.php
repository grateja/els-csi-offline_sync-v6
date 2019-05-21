<?php

    /**
     * This is the model class for table "customer_cards".
     *
     * The followings are the available columns in table 'customer_cards':
     * @property integer $id
     * @property string $created_at
     * @property string $updated_at
     * @property string $reg_date
     * @property string $last_trans_date
     * @property string $exp_date
     * @property integer $card_id
     * @property integer $card_no
     * @property integer $rf_id
     * @property integer $customer_id
     * @property integer $client_id
     * @property integer $laundry_shop_id
     * @property integer $branch_id
     * @property integer $user_id
     * @property integer $emp_id
     * @property integer $is_sales
     * @property integer $amount
     * @property integer $point
     * @property integer $is_activated
     * @property integer $card_user_id
     * @property integer $card_type_id
     * @property integer $is_deleted
     */
    class CustomerCards extends CActiveRecord {

        public $firstname, $lastname, $customer, $employee, $store;
        protected $oldAttributes;

        /**
         * @return string the associated database table name
         */
        public function tableName() {
            return 'customer_cards';
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

        /**
         * @return array validation rules for model attributes.
         */
        public function rules() {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('created_at, reg_date, rf_id, customer_id, branch_id', 'required'),
                array('customer_id, is_activated, is_deleted, branch_id, point, card_user_id, card_type_id', 'numerical', 'integerOnly' => true),
                array('updated_at', 'safe'),
                array('card_no', 'length', 'max' => 12),
                array('rf_id', 'length', 'max' => 15),
                //array('card_no', 'validateNumeric'),
                array('card_no', 'unique'),
                array('rf_id', 'unique'),
                array('last_trans_date, exp_date, rf_id, is_sales', 'safe'),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, created_at, updated_at, reg_date, last_trans_date, exp_date, card_id, card_no, rf_id, customer_id, client_id, laundry_shop_id, user_id, emp_id, is_sales, is_activated, is_deleted, branch_id, amount, point, card_user_id, card_type_id', 'safe', 'on' => 'search'),
                array('id, created_at, updated_at, reg_date, last_trans_date, exp_date, card_id, card_no, rf_id, customer_id, client_id, laundry_shop_id, user_id, emp_id, is_sales, is_activated, is_deleted, branch_id, amount, point, card_user_id, card_type_id', 'safe', 'on' => 'searchReport'),
                array('id, created_at, updated_at, reg_date, last_trans_date, exp_date, card_id, card_no, rf_id, customer_id, client_id, laundry_shop_id, user_id, emp_id, is_sales, is_activated, is_deleted, branch_id, amount, point, card_user_id, card_type_id', 'safe', 'on' => 'searchStoreOIC'),
                array('id, created_at, updated_at, reg_date, last_trans_date, exp_date, card_id, card_no, rf_id, customer_id, client_id, laundry_shop_id, user_id, emp_id, is_sales, is_activated, is_deleted, branch_id, amount, point, card_user_id, card_type_id', 'safe', 'on' => 'searchLoading'),
                array('id, created_at, updated_at, reg_date, last_trans_date, exp_date, card_id, card_no, rf_id, customer_id, client_id, laundry_shop_id, user_id, emp_id, is_sales, is_activated, is_deleted, branch_id, amount, point, card_user_id, card_type_id', 'safe', 'on' => 'searchByCustomer'),
                array('id, created_at, updated_at, reg_date, last_trans_date, exp_date, card_id, card_no, rf_id, customer_id, client_id, laundry_shop_id, user_id, emp_id, is_sales, is_activated, is_deleted, branch_id, amount, point, card_user_id, card_type_id', 'safe', 'on' => 'searchCustomerCards'),
            );
        }

        public function validateNumeric() {
            if (is_numeric($this->card_no) == false) {
                $this->addError('card_no', 'Card No. should be numeric.');
            }
        }

        /**
         * @return array relational rules.
         */
        public function relations() {
            // NOTE: you may need to adjust the relation name and the related
            // class name for the relations automatically generated below.
            return array(
                'customers' => array(self::BELONGS_TO, 'Customers', 'customer_id'),
                'laundryShops' => array(self::BELONGS_TO, 'LaundryShops', 'laundry_shop_id'),
                'branches' => array(self::BELONGS_TO, 'Branches', 'branch_id'),
                'employees' => array(self::BELONGS_TO, 'Employees', 'emp_id'),
                'users' => array(self::BELONGS_TO, 'Users', 'user_id'),
                'cardUsers' => array(self::BELONGS_TO, 'Users', 'card_user_id'),
                'clients' => array(self::BELONGS_TO, 'Clients', 'client_id'),
                //'laundryShops' => array(self::BELONGS_TO, 'LaundryShops', 'laundry_shop_id'),
            );
        }

        /**
         * @return array customized attribute labels (name=>label)
         */
        public function attributeLabels() {
            return array(
                'id' => 'Id',
                'created_at' => 'Created At',
                'updated_at' => 'Updated At',
                'reg_date' => 'Reg Date',
                'last_trans_date' => 'Last Transaction Date',
                'exp_date' => 'Expiration Date',
                'card_no' => 'Card No',
                'rf_id' => 'RF ID',
                'card_id' => 'Card ID',
                'customer_id' => 'Customer',
                'client_id' => 'Client',
                'laundry_shop_id' => 'Laundry Shop',
                'branch_id' => 'Branch',
                'user_id' => 'User',
                'emp_id' => 'Employee',
                'is_sales' => 'Generate Sales?',
                'amount' => 'Amount',
                'point' => 'Points Earned',
                'is_activated' => 'Is Activated',
                'card_type_id' => 'Card Type',
                'card_user_id' => 'Card User',
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
        public function search() {
            // Warning: Please modify the following code to remove attributes that
            // should not be searched.

            $criteria = new CDbCriteria;

            $criteria->with = array('customers');

            $criteria->compare('t.id', $this->id);

            $criteria->compare('t.created_at', $this->created_at, true);

            $criteria->compare('t.updated_at', $this->updated_at, true);

            $criteria->compare('t.reg_date', $this->reg_date, true);

            $criteria->compare('t.last_trans_date', $this->last_trans_date, true);

            $criteria->compare('t.exp_date', $this->exp_date, true);

            $criteria->compare('t.card_id', $this->card_id);

            $criteria->compare('t.card_no', $this->card_no);

            $criteria->compare('t.customer_id', $this->customer_id);

            $criteria->compare('t.client_id', $this->client_id);

            $criteria->compare('t.laundry_shop_id', $this->laundry_shop_id);

            $criteria->compare('t.branch_id', $this->branch_id);

            $criteria->compare('t.user_id', $this->user_id);

            $criteria->compare('t.emp_id', $this->emp_id);

            $criteria->compare('t.is_sales', $this->is_sales);

            $criteria->compare('t.is_activated', $this->is_activated);

            $criteria->compare('t.card_user_id', $this->card_user_id);

            $criteria->compare('t.card_type_id', $this->card_type_id);

            $criteria->compare('t.amount', $this->amount);

            $criteria->compare('t.point', $this->point);

            $criteria->compare('t.is_deleted', $this->is_deleted);

            $criteria->order = 't.id desc';

            return new CActiveDataProvider('CustomerCards', array(
                'criteria' => $criteria,
            ));
        }

        public function searchStoreOIC() {
            // Warning: Please modify the following code to remove attributes that
            // should not be searched.

            $criteria = new CDbCriteria;

            $criteria->with = array('customers');

            $criteria->compare('t.id', $this->id);

            $criteria->compare('t.created_at', $this->created_at, true);

            $criteria->compare('t.updated_at', $this->updated_at, true);

            $criteria->compare('t.reg_date', $this->reg_date, true);

            $criteria->compare('t.last_trans_date', $this->last_trans_date, true);

            $criteria->compare('t.exp_date', $this->exp_date, true);

            $criteria->compare('t.card_id', $this->card_id);

            $criteria->compare('t.card_no', $this->card_no);

            $criteria->compare('t.customer_id', $this->customer_id);

            $criteria->compare('t.client_id', $this->client_id);

            $criteria->compare('t.laundry_shop_id', $this->laundry_shop_id);

            $criteria->compare('t.branch_id', $this->branch_id);

            $criteria->compare('t.user_id', $this->user_id);

            $criteria->compare('t.emp_id', $this->emp_id);

            $criteria->compare('t.is_sales', $this->is_sales);

            $criteria->compare('t.is_activated', $this->is_activated);

            $criteria->compare('t.card_user_id', $this->card_user_id);

            $criteria->compare('t.card_type_id', $this->card_type_id);

            $criteria->compare('t.is_deleted', $this->is_deleted);

            return new CActiveDataProvider('CustomerCards', array(
                'criteria' => $criteria,
            ));
        }

        public function searchByCustomer() {
            // Warning: Please modify the following code to remove attributes that
            // should not be searched.

            $criteria = new CDbCriteria;

            $criteria->with = array('customers');

            $criteria->compare('t.id', $this->id);

            $criteria->compare('t.created_at', $this->created_at, true);

            $criteria->compare('t.updated_at', $this->updated_at, true);

            $criteria->compare('t.reg_date', $this->reg_date, true);

            $criteria->compare('t.last_trans_date', $this->last_trans_date, true);

            $criteria->compare('t.exp_date', $this->exp_date, true);

            $criteria->compare('t.card_id', $this->card_id);

            $criteria->compare('t.card_no', $this->card_no);

            $criteria->compare('t.customer_id', $this->customer_id);

            $criteria->compare('t.client_id', $this->client_id);

            $criteria->compare('t.laundry_shop_id', $this->laundry_shop_id);

            $criteria->compare('t.branch_id', $this->branch_id);

            $criteria->compare('t.user_id', $this->user_id);

            $criteria->compare('t.emp_id', $this->emp_id);

            $criteria->compare('t.is_sales', $this->is_sales);

            $criteria->compare('t.is_activated', $this->is_activated);

            $criteria->compare('t.card_user_id', $this->card_user_id);

            $criteria->compare('t.card_type_id', $this->card_type_id);

            $criteria->compare('t.is_deleted', $this->is_deleted);

            return new CActiveDataProvider('CustomerCards', array(
                'criteria' => $criteria,
            ));
        }

        public function searchLoading() {
            // Warning: Please modify the following code to remove attributes that
            // should not be searched.

            $criteria = new CDbCriteria;

            $criteria->with = array('customers');

            $criteria->compare('t.id', $this->id);

            $criteria->compare('t.created_at', $this->created_at, true);

            $criteria->compare('t.updated_at', $this->updated_at, true);

            $criteria->compare('t.reg_date', $this->reg_date, true);

            $criteria->compare('t.last_trans_date', $this->last_trans_date, true);

            $criteria->compare('t.exp_date', $this->exp_date, true);

            $criteria->compare('t.card_id', $this->card_id);

            $criteria->compare('t.card_no', $this->card_no);

            $criteria->compare('t.customer_id', $this->customer_id);

            $criteria->compare('t.client_id', $this->client_id);

            $criteria->compare('t.laundry_shop_id', $this->laundry_shop_id);

            $criteria->compare('t.branch_id', $this->branch_id);

            $criteria->compare('t.user_id', $this->user_id);

            $criteria->compare('t.emp_id', $this->emp_id);

            $criteria->compare('t.is_sales', $this->is_sales);

            $criteria->compare('t.is_activated', $this->is_activated);

            $criteria->compare('t.card_user_id', $this->card_user_id);

            $criteria->compare('t.card_type_id', $this->card_type_id);

            $criteria->compare('t.is_deleted', $this->is_deleted);

            return new CActiveDataProvider('CustomerCards', array(
                'criteria' => $criteria,
            ));
        }

        public function searchReport() {
            // Warning: Please modify the following code to remove attributes that
            // should not be searched.

            $criteria = new CDbCriteria;

            $criteria->with = array('customers');

            $criteria->compare('t.id', $this->id);

            $criteria->compare('t.created_at', $this->created_at, true);

            $criteria->compare('t.updated_at', $this->updated_at, true);

            $criteria->compare('t.reg_date', $this->reg_date, true);

            $criteria->compare('t.last_trans_date', $this->last_trans_date, true);

            $criteria->compare('t.exp_date', $this->exp_date, true);

            $criteria->compare('t.card_id', $this->card_id);

            $criteria->compare('t.card_no', $this->card_no);

            $criteria->compare('t.customer_id', $this->customer_id);

            $criteria->compare('t.client_id', $this->client_id);

            $criteria->compare('t.laundry_shop_id', $this->laundry_shop_id);

            $criteria->compare('t.branch_id', $this->branch_id);

            $criteria->compare('t.user_id', $this->user_id);

            $criteria->compare('t.emp_id', $this->emp_id);

            $criteria->compare('t.is_sales', $this->is_sales);

            $criteria->compare('t.is_activated', $this->is_activated);

            $criteria->compare('t.card_user_id', $this->card_user_id);

            $criteria->compare('t.card_type_id', $this->card_type_id);

            $criteria->compare('t.is_deleted', $this->is_deleted);

            return new CActiveDataProvider('CustomerCards', array(
                'criteria' => $criteria,
            ));
        }

        public function searchCustomerCards() {
            // Warning: Please modify the following code to remove attributes that
            // should not be searched.

            $criteria = new CDbCriteria;

            $criteria->with = array('customers');

            $criteria->compare('t.id', $this->id);

            $criteria->compare('t.created_at', $this->created_at, true);

            $criteria->compare('t.updated_at', $this->updated_at, true);

            $criteria->compare('t.reg_date', $this->reg_date, true);

            $criteria->compare('t.last_trans_date', $this->last_trans_date, true);

            $criteria->compare('t.exp_date', $this->exp_date, true);

            $criteria->compare('t.card_id', $this->card_id);

            $criteria->compare('t.card_no', $this->card_no);

            $criteria->compare('t.customer_id', $this->customer_id);

            $criteria->compare('t.client_id', $this->client_id);

            $criteria->compare('t.laundry_shop_id', $this->laundry_shop_id);

            $criteria->compare('t.branch_id', $this->branch_id);

            $criteria->compare('t.user_id', $this->user_id);

            $criteria->compare('t.emp_id', $this->emp_id);

            $criteria->compare('t.is_sales', $this->is_sales);

            $criteria->compare('t.is_activated', $this->is_activated);

            $criteria->compare('t.card_user_id', $this->card_user_id);

            $criteria->compare('t.card_type_id', $this->card_type_id);

            $criteria->compare('t.is_deleted', $this->is_deleted);

            return new CActiveDataProvider('CustomerCards', array(
                'criteria' => $criteria,
            ));
        }

        /**
         * Returns the static model of the specified AR class.
         * @return RewardCards the static model class
         */
        public static function model($className = __CLASS__) {
            return parent::model($className);
        }

        public function addRecord() {
            $model = new CustomerCards();
            $model->created_at = $this->created_at;
            $model->updated_at = $this->updated_at;
            $model->reg_date = $this->reg_date;
            $model->last_trans_date = $this->last_trans_date;
            $model->exp_date = $this->exp_date;
            $model->card_id = $this->card_id;
            $model->card_no = $this->card_no;
            $model->rf_id = Settings::setLowerlAll($this->rf_id);
            $model->customer_id = $this->customer_id;
            $model->client_id = $this->client_id;
            $model->laundry_shop_id = $this->laundry_shop_id;
            $model->branch_id = $this->branch_id;
            $model->user_id = $this->user_id;
            $model->emp_id = $this->emp_id;
            $model->is_sales = $this->is_sales;
            $model->is_activated = $this->is_activated;
            $model->card_user_id = $this->card_user_id;
            $model->card_type_id = $this->card_type_id;
            $model->is_deleted = $this->is_deleted;

            if ($model->validate()) {
                $model->save();
                $messageArr = array('id' => $model->id, 'status' => Utilities::STATUS_SUCCESS, 'message' => 'Customer Card Successfully Saved.');
            } else {
                $messageArr = array('status' => Utilities::STATUS_FAILED, 'message' => Utilities::get_ModelErrors($model->errors));
            }

            return json_decode(json_encode($messageArr));
        }

        public static function clearSessions() {
            unset($_SESSION[self::tbl()]);
        }

        public static function model_getData_byCardNo($cardNo) {
            $crit = new CDbCriteria();
            $crit->condition = 'card_no = :cardNo';
            $crit->params = array(':cardNo' => $cardNo);
            return self::model()->find($crit);
        }

        public static function sql_isExists($cardNo) {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT count(*) FROM ' . self::tbl() . ' WHERE card_no = :cardNo';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':cardNo', $cardNo, PDO::PARAM_STR);
            $count = $command->queryScalar();
            return ($count != Utilities::NO) ? Utilities::YES : Utilities::NO;
        }

        function getIsDeleted() {
            return Utilities::get_ActiveSelect($this->is_deleted);
        }

        function getIsActivated() {
            return Utilities::get_ActiveSelect($this->is_activated);
        }

        public static function sql_getCardID_byCarNo($cardNo) {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT id FROM ' . self::tbl() . ' WHERE card_no = :cardNo limit 1';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':cardNo', $cardNo, PDO::PARAM_STR);
            return $command->queryScalar();
        }

        public static function sql_getCardID_byRfID($rfID) {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT `id` FROM ' . self::tbl() . ' WHERE `rf_id` = :rfID limit 1';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':rfID', $rfID, PDO::PARAM_STR);
            $cardID = $command->queryScalar();
            return ($cardID > 0) ? $cardID : 0;
        }

        public static function sql_updateLastTransactionDate($id, $date) {
            $cnn = Utilities::createConnection();
            $sql = 'UPDATE ' . self::tbl() . ' SET last_trans_date = :lastTransDate WHERE id = :ID';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':ID', $id, PDO::PARAM_INT);
            $command->bindValue(':lastTransDate', $date, PDO::PARAM_STR);
            return $command->execute();
        }

        public static function sql_updateExpDate($id, $date) {
            $cnn = Utilities::createConnection();
            $sql = 'UPDATE ' . self::tbl() . ' SET exp_date = :expDate WHERE id = :ID';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':ID', $id, PDO::PARAM_INT);
            $command->bindValue(':expDate', $date, PDO::PARAM_STR);
            return $command->execute();
        }

        public static function updateTransactionDates($id, $date) {
            self::sql_updateLastTransactionDate($id, $date);

            $totalDays = Settings::sql_getValue_byID(Settings::CONFIG_TOTALDAYS_EXP);
            $expDate = date('Y-m-d', Utilities::addDays($date, $totalDays));
            self::sql_updateExpDate($id, $expDate);
        }

        public static function sql_getExpDate_byCardNo($cardNo) {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT exp_date FROM ' . self::tbl() . ' WHERE card_no = :cardNo limit 1';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':cardNo', $cardNo, PDO::PARAM_STR);
            return $command->queryScalar();
        }

        public static function model_getData_byCustomerID($customerID) {
            $crit = new CDbCriteria();
            $crit->condition = 'customer_id = :customerID AND is_deleted = 0 order by id desc ';
            $crit->params = array(':customerID' => $customerID);
            return self::model()->find($crit);
        }

        public static function sql_getCustomerID_byRfID($rfID) {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT customer_id FROM ' . self::tbl() . ' WHERE rf_id = :rfID limit 1';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':rfID', $rfID, PDO::PARAM_STR);
            $customerID = $command->queryScalar();
            return ($customerID > 0) ? $customerID : 0;
        }

        public static function model_getData_byRfID($rfID) {
            $crit = new CDbCriteria();
            $crit->condition = 'rf_id = :rfID';
            $crit->params = array(':rfID' => $rfID);
            return self::model()->find($crit);
        }

        public static function sql_getBranchID_byRfID($rfID) {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT branch_id FROM ' . self::tbl() . ' WHERE rf_id = :rfID limit 1';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':rfID', $rfID, PDO::PARAM_STR);
            $branchID = $command->queryScalar();
            return ($branchID > 0) ? $branchID : 0;
        }

        public static function model_getAllData_byDeleted($isDeleted) {
            return self::model()->findAll('is_deleted = :isDeleted', array(':isDeleted' => $isDeleted));
        }

        public function getDataByCustomerID($customerID) {
            return self::model()->findAll('customer_id = :customerID', array(':customerID' => $customerID));
        }

        public function getCmdBtnTopUp() {
            return CHtml::link('<i class="fa fa-plus-circle">' . ' Top Up</i>', array('customerTransactions/create', 'customerCardID' => $this->id, 'transType' => CustomerTransactions::TRANS_TYPE_CREDIT), array('class' => 'btn btn-primary btn-sm', 'style' => 'width:100px;', 'id' => 'btnPayment'));
        }

        public function getCmdBtnTopDown() {
            return CHtml::link('<i class="fa fa-plus-circle">' . ' Top Down</i>', array('customerTransactions/create', 'customerCardID' => $this->id, 'transType' => CustomerTransactions::TRANS_TYPE_DEBIT), array('class' => 'btn btn-primary btn-sm', 'style' => 'width:100px;', 'id' => 'btnPayment'));
        }

        public function getCmdBtnTransactions() {
            return CHtml::link('<i class="fa fa-plus-circle">' . ' View</i>', array('customerTransactions/admin', 'cardID' => $this->id), array('class' => 'btn btn-success btn-sm', 'style' => 'width:100px;', 'id' => 'btnPayment'));
        }

        public function getCardBalance() {
            return CustomerCardTransactions::sql_getTotalBalance_byCardID($this->id);
        }

        public static function sql_getTotalCards($custID) {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT count(*) FROM ' . self::tbl() . ' WHERE customer_id = :custID limit 1';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':custID', $custID, PDO::PARAM_INT);
            return $command->queryScalar();
        }

        public static function sql_getTotalCardsActive($custID) {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT count(*) FROM ' . self::tbl() . ' WHERE customer_id = :custID AND is_activated = :isActivated AND is_deleted = :isDeleted limit 1';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':custID', $custID, PDO::PARAM_INT);
            $command->bindValue(':isActivated', Utilities::YES, PDO::PARAM_INT);
            $command->bindValue(':isDeleted', Utilities::NO, PDO::PARAM_INT);
            return $command->queryScalar();
        }

        public static function model_getData_byID($id) {
            return self::model()->find('id = :id', array(':id' => $id));
        }

        function getIsSales() {
            return Utilities::get_ActiveSelect($this->is_sales);
        }

        function getName() {
            return $this->rf_id . ' - ' . $this->customers->lnameFname;
        }

        public static function model_getAllData_byClientID($isDeleted) {
            return self::model()->findAll('client_id = :clientID AND is_deleted = :isDeleted', array(':clientID' => Settings::get_ClientID(), ':isDeleted' => $isDeleted));
        }

        public static function model_getData_byEmployeeID($empID) {
            $crit = new CDbCriteria();
            $crit->condition = 'card_user_id = :empID AND is_deleted = 0 order by id desc';
            $crit->params = array(':empID' => $empID);
            return self::model()->find($crit);
        }

        
        public static function model_getAllData_byDeletedCLientID_branchID($isDeleted, $clientID, $branchID) {
            return self::model()->findAll('is_sync = :isDeleted AND client_id = :clientID AND branch_id = :branchID ', array(':isDeleted' => $isDeleted, ':clientID' => $clientID , ':branchID' => $branchID));
        }

    }
    