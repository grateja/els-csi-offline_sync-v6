<?php

    /**
     * This is the model class for table "customer_transactions".
     *
     * The followings are the available columns in table 'customer_transactions':
     * @property integer $id
     * @property string $created_at
     * @property string $updated_at
     * @property integer $machine_id
     * @property integer $rf_id
     * @property integer $customer_id
     * @property integer $customer_card_id
     * @property integer $card_no
     * @property integer $transaction_id
     * @property string $credited
     * @property string $debited
     * @property string $balance
     * @property integer $user_id
     * @property string $remarks
     * @property integer $is_sales
     * @property integer $is_deleted
     * @property integer $client_id
     * #@property integer $branch_id
     */
    class CustomerTransactions extends CActiveRecord {

        const REPORT_TYPE_CURRENT = 1;
        const REPORT_TYPE_RANGE = 2;
        const TRANSACTION_MEDIUM_RFID = 1;
        const TRANSACTION_MEDIUM_MANUAL = 2;

        public $client;
        public $clientName;

        /**
         * @return string the associated database table name
         */
        public function tableName() {
            return 'customer_transactions';
        }

        public static function tbl() {
            return self::tableName();
        }

        public function beforeSave() {
            if ($this->isNewRecord)
                $this->created_at = Settings::get_DateTime();
            else
                $this->updated_at = Settings::get_DateTime();

            return parent::beforeSave();
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
                array('created_at, customer_id, transaction_id, credited, debited, balance, user_id', 'required'),
                array('machine_id, customer_id, transaction_id, user_id, is_deleted, branch_id, client_id', 'numerical', 'integerOnly' => true),
                //array('customer_no', 'length', 'max'=>50),	
                array('credited, debited, balance', 'length', 'max' => 12),
                array('updated_at, is_sales', 'safe'),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, created_at, updated_at, machine_id, rf_id, customer_id, customer_card_id, card_no, transaction_id, credited, debited, balance, user_id, is_deleted, remarks, is_sales, client_id, branch_id', 'safe', 'on' => 'search'),
                array('id, created_at, updated_at, machine_id, rf_id, customer_id, customer_card_id, card_no, transaction_id, credited, debited, balance, user_id, is_deleted, remarks, is_sales, client_id, branch_id', 'safe', 'on' => 'searchActiveTransactions'),
            );
        }

        /**
         * @return array relational rules.
         */
        public function relations() {
            // NOTE: you may need to adjust the relation name and the related
            // class name for the relations automatically generated below.
            return array(
                'machines' => array(self::BELONGS_TO, 'Machines', 'machine_id'),
                'customers' => array(self::BELONGS_TO, 'Customers', 'customer_id'),
                'transactions' => array(self::BELONGS_TO, 'Transactions', 'transaction_id'),
                'users' => array(self::BELONGS_TO, 'Users', 'user_id'),
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
                'machine_id' => 'Machine',
                'rf_id' => 'Card (RF ID)',
                'customer_id' => 'Customer ID',
                'customer_card_id' => 'Customer Card ID',
                'card_no' => 'Card No.',
                'transaction_id' => 'Transaction',
                'credited' => 'Credited',
                'debited' => 'Debited',
                'balance' => 'Balance',
                'user_id' => 'Users',
                'remarks' => 'Remarks',
                'is_sales' => 'Generate Sales',
                'client_id' => 'Generate Sales',
                'branch_id' => 'Generate Sales',
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

            $criteria->compare('id', $this->id);

            $criteria->compare('created_at', $this->created_at, true);

            $criteria->compare('updated_at', $this->updated_at, true);

            $criteria->compare('machine_id', $this->machine_id);

            $criteria->compare('rf_id', $this->rf_id);

            $criteria->compare('customer_id', $this->customer_id);

            $criteria->compare('customer_card_id', $this->customer_card_id);

            $criteria->compare('card_no', $this->card_no, true);

            $criteria->compare('transaction_id', $this->transaction_id);

            $criteria->compare('credited', $this->credited, true);

            $criteria->compare('debited', $this->debited, true);

            $criteria->compare('balance', $this->balance, true);

            $criteria->compare('user_id', $this->user_id);

            $criteria->compare('remarks', $this->remarks);

            $criteria->compare('is_sales', $this->is_sales);

            $criteria->compare('client_id', $this->client_id);

            $criteria->compare('branch_id', $this->branch_id);

            $criteria->compare('is_deleted', $this->is_deleted);

            $criteria->order = "id desc";

            return new CActiveDataProvider('CustomerTransactions', array(
                'criteria' => $criteria,
            ));
        }

        public function searchActiveTransactions() {
            // Warning: Please modify the following code to remove attributes that
            // should not be searched.

            $criteria = new CDbCriteria;

            $criteria->compare('t.id', $this->id);

            $criteria->compare('t.created_at', $this->created_at, true);

            $criteria->compare('t.updated_at', $this->updated_at, true);

            $criteria->compare('t.machine_id', $this->machine_id);

            $criteria->compare('t.rf_id', $this->rf_id);

            $criteria->compare('t.customer_id', $this->customer_id);

            $criteria->compare('t.card_no', $this->card_no, true);

            $criteria->compare('t.transaction_id', $this->transaction_id);

            $criteria->compare('t.credited', $this->credited, true);

            $criteria->compare('t.debited', $this->debited, true);

            $criteria->compare('t.balance', $this->balance, true);

            $criteria->compare('t.user_id', $this->user_id);

            $criteria->compare('t.remarks', $this->remarks);

            $criteria->compare('is_sales', $this->is_sales);

            $criteria->compare('t.client_id', $this->client_id);

            $criteria->compare('t.branch_id', $this->branch_id);

            $criteria->compare('t.is_deleted', $this->is_deleted);

            $criteria->order = 'id desc';

            return new CActiveDataProvider('CustomerTransactions', array(
                'criteria' => $criteria,
            ));
        }

        /**
         * Returns the static model of the specified AR class.
         * @return CustomerTransactions the static model class
         */
        public static function model($className = __CLASS__) {
            return parent::model($className);
        }

        public static function model_getAllData_byIsDeleted($isDeleted) {
            return self::model()->findALl('is_deleted = :isDeleted', array(':isDeleted' => $isDeleted));
        }

        public function getIsActive() {
            return Utilities::get_ActiveSelect($this->is_active);
        }

        public function getIsDeleted() {
            return Utilities::get_ActiveSelect($this->is_deleted);
        }

        public static function model_findAllStatementofAccount($newcustomerID, $toDate) {
            return self::model()->findAll(array('order' => 'customer_id ASC', 'condition' => 'customer_id IN(' . $newcustomerID . ') AND created_at <= :toDate GROUP BY cust_id', 'params' => array(':toDate' => $toDate)));
        }

        public static function sql_getConsumed($custID) {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT debited FROM ' . self::tbl() . ' WHERE customer_id = :custID ORDER BY id DESC limit 1';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':custID', $custID, PDO::PARAM_INT);
            return $command->queryScalar();
        }

        public static function sql_findTotalConsumed($custID, $billingStartDate, $billingDate) {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT DISTINCT(customer_id), SUM(debited) as consumed, id,  customer_id FROM customer_transactions WHERE created_at BETWEEN :billingStartDate AND :billingDate AND cust_id = :custID GROUP BY cust_id';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':custID', $custID, PDO::PARAM_INT);
            $command->bindValue(':billingStartDate', $billingStartDate, PDO::PARAM_STR);
            $command->bindValue(':billingDate', $billingDate, PDO::PARAM_STR);
            return $command->queryAll();
        }

        public function getTransactionMedium() {
            return ($this->transaction_medium_id == Utilities::YES) ? "rfid" : "manual";
        }

        public function sql_getTotalBalance_byCustomerID($custID) {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT SUM(credited) - SUM(debited) FROM ' . self::tbl() . ' WHERE customer_id = :custID';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':custID', $custID, PDO::PARAM_INT);
            return $command->queryScalar();
        }

        public function sql_getTotalAmountLoaded_byCustomerID($custID) {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT SUM(credited) FROM ' . self::tbl() . ' WHERE customer_id = :custID';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':custID', $custID, PDO::PARAM_INT);
            return $command->queryScalar();
        }

        const TRANS_TYPE_CREDIT = 1;
        const TRANS_TYPE_DEBIT = 2;

        public static function insertRecord($dateTime, $branchID, $transactionID, $machineID = 0, $custID = 0, $transType = self::TRANS_TYPE_CREDIT, $amount = 0, $userID = 0, $remarks = null) {
            $model = new CustomerTransactions();
            $transactions = new Transactions();
            $customerCards = new CustomerCards();
            $customers =  new Customers();

            $branchID = Settings::get_BranchID();
            $transactions = Utilities::model_getByID(Transactions::model(), $transactionID);
     
            $customers = Utilities::model_getByID(customers::model(), $custID);

            if ($transType == self::TRANS_TYPE_CREDIT) {
                $credited = $amount;
                $debited = 0;
            } else {
                $credited = 0;
                $debited = $amount;
            }
            $rfID = 0;
            $model->created_at = $dateTime;
            $model->updated_at = $dateTime;
            $model->machine_id = $machineID;
            $model->rf_id = $rfID;
            $model->customer_id = $customers->id;
            $model->customer_card_id = 0;
            $model->card_no = 0;
            $model->transaction_id = $transactionID;
            $model->credited = $credited;
            $model->debited = $debited;
            $model->balance = 0;
            $model->user_id = $userID;
            $model->remarks = $remarks;
            $model->branch_id = Settings::get_BranchID();
            $model->client_id = Settings::get_ClientID();
            $model->is_sales = 0;
            $model->is_deleted = Utilities::NO;

            $result = $model->addRecord();
            if ($result->status == Utilities::STATUS_SUCCESS) {
              //  self::sql_updateBalance_byCardID($result->id, $customerCards->id);

                
                if ($transactions->is_services == Utilities::YES) {
                    $totalMinutes = Machines::getTotalMinutesPerTransaction($branchID, $transactionID, $machineID);


                    if ($totalMinutes > 0) {
                        $machineStatusID = Machines::sql_getMachineStatusID_byID($model->machine_id);
                        if ($machineStatusID == MachineStatuses::STATUS_IDLE) {
                            MachineUsageHeaders::insertRecord($dateTime, $result->id, $model->customer_id, $branchID, $custID, $transactionID, $machineID, $totalMinutes);
                        } elseif ($machineStatusID == MachineStatuses::STATUS_RUNNING) {

                            $machineUsageHeaderID = MachineUsageHeaders::sql_getLastID_byMachineID($model->machine_id);

                            $previousMinutes = MachineUsageHeaders::sql_getTotalMinutes_byID($machineUsageHeaderID);
                            MachineUsageHeaders::sql_updateStartTime_byID($machineUsageHeaderID, $dateTime);

                            $newEndDateTime = date('Y-m-d H:i:s', Utilities::addMinutes($dateTime, $previousMinutes + $totalMinutes));
                            $newTotalMinutes = $previousMinutes + $totalMinutes;

                            MachineUsageHeaders::sql_updateEndTime_byID($machineUsageHeaderID, $newEndDateTime);
                            MachineUsageHeaders::sql_updateTotalMinutes_byID($machineUsageHeaderID, $newTotalMinutes);

                            MachineUsageDetails::insertRecord($machineUsageHeaderID, $result->id, $dateTime, $model->customer_id, $rfID= 0, $transactionID, $machineID, $totalMinutes);
                        }
                    }
                }
            }
            return $result;
        }

        public function addRecord() {
            $model = new CustomerTransactions();

            $model->created_at = $this->created_at;
            $model->updated_at = $this->updated_at;
            $model->machine_id = $this->machine_id;
            $model->rf_id = $this->rf_id;
            $model->customer_id = $this->customer_id;
            $model->customer_card_id = $this->customer_card_id;
            $model->card_no = $this->card_no;
            $model->transaction_id = $this->transaction_id;
            $model->credited = $this->credited;
            $model->debited = $this->debited;
            $model->balance = $this->balance;
            $model->user_id = $this->user_id;
            $model->remarks = $this->remarks;
            $model->is_sales = $this->is_sales;
            $model->branch_id = $this->branch_id;
            $model->client_id = $this->client_id;
            $model->is_deleted = $this->is_deleted;

            if ($model->validate()) {
                $model->save();
                $messageArr = array('id' => $model->id, 'status' => Utilities::STATUS_SUCCESS, 'message' => 'Transaction Successfully Saved.');
            } else {
                $messageArr = array('status' => Utilities::STATUS_FAILED, 'message' => Utilities::get_ModelErrors($model->errors));
            }

            return json_decode(json_encode($messageArr));
        }

        public function sql_getTotalAmountLoaded() {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT SUM(credited) FROM ' . self::tbl();
            $command = $cnn->createCommand($sql);
            return $command->queryScalar();
        }

        public function sql_getTotalAmountConsumed() {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT SUM(debited) FROM ' . self::tbl();
            $command = $cnn->createCommand($sql);
            return $command->queryScalar();
        }

        public function sql_getTotalAmountConsumed_byType($transactionTypeID) {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT SUM(debited) FROM ' . self::tbl() . ' WHERE transaction_id = :transactionTypeID';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':transactionTypeID', $transactionTypeID, PDO::PARAM_INT);
            return $command->queryScalar();
        }

        public function sql_getTotalAmountLoaded_byDate($dateFrom) {
            $dateTo = Settings::get_Date();
            $cnn = Utilities::createConnection();
            $sql = 'SELECT SUM(credited) FROM ' . self::tbl() . ' WHERE date(created_at) BETWEEN :dateFrom AND :dateTo';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':dateFrom', $dateFrom, PDO::PARAM_STR);
            $command->bindValue(':dateTo', $dateTo, PDO::PARAM_STR);
            return $command->queryScalar();
        }

        public function sql_getTotalAmountLoaded_byDateFromTo($dateFrom, $dateTO) {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT SUM(credited) FROM ' . self::tbl() . ' WHERE date(created_at) BETWEEN :dateFrom AND :dateTo';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':dateFrom', $dateFrom, PDO::PARAM_STR);
            $command->bindValue(':dateTo', $dateTO, PDO::PARAM_STR);
            return $command->queryScalar();
        }

        public function sql_getTotalAmountConsumed_byDate($dateFrom) {
            $dateTo = Settings::get_Date();
            $cnn = Utilities::createConnection();
            $sql = 'SELECT SUM(debited) FROM ' . self::tbl() . ' WHERE date(created_at)BETWEEN :dateFrom AND :dateTo';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':dateFrom', $dateFrom, PDO::PARAM_STR);
            $command->bindValue(':dateTo', $dateTo, PDO::PARAM_STR);
            return $command->queryScalar();
        }

        public function sql_getTotalAmountConsumed_byTypeDateFromTo($transactionTypeID, $dateFrom) {
            $dateTo = Settings::get_Date();
            $cnn = Utilities::createConnection();
            $sql = 'SELECT SUM(debited) FROM ' . self::tbl() . ' WHERE transaction_id = :transctionsTypeID AND date(created_at) BETWEEN :dateFrom AND :dateTo';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':transctionsTypeID', $transactionTypeID, PDO::PARAM_INT);
            $command->bindValue(':dateFrom', $dateFrom, PDO::PARAM_STR);
            $command->bindValue(':dateTo', $dateTo, PDO::PARAM_STR);
            return $command->queryScalar();
        }

        public function getBalance() {
            return self::sql_getTotalBalance_byCustomerID($this->customer_id);
        }

        public static function model_getLastTrans_byDate($date, $limit = 30) {
            $crit = new CDbCriteria();
            $crit->select = 'distinct(created_at), debited';
            $crit->condition = 'date(created_at) <= :toDate AND is_deleted = :isDeleted';
            $crit->params = array(':toDate' => $date, ':isDeleted' => Utilities::NO);
            $crit->order = 'id asc';
            return self::model()->findAll($crit);
        }

        public function sql_getTotalAmountConsumedByDate($dateFrom, $dateTo) {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT SUM(debited) FROM ' . self::tbl() . ' WHERE date(created_at) BETWEEN :dateFrom AND :dateTo AND is_sales = :isSales';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':dateFrom', $dateFrom, PDO::PARAM_STR);
            $command->bindValue(':dateTo', $dateTo, PDO::PARAM_STR);
            $command->bindValue(':isSales', Utilities::YES, PDO::PARAM_INT);
            return $command->queryScalar();
        }

        public static function sql_updateBalance_byCardID($customerTransID, $cardID) {
            $cnn = Utilities::createConnection();
            $sql = 'UPDATE ' . self::tbl() . ' SET balance = :cardBalance WHERE id = :custTransID limit 1';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':custTransID', $customerTransID, PDO::PARAM_INT);
            $command->bindValue(':cardBalance', self::sql_getTotalBalance_byCardID($cardID), PDO::PARAM_INT);
            $command->execute();
        }

        public static function sql_getTotalBalance_byCardID($cardID) {
            return self::sql_getTotalCredited_byCardID($cardID) - self::sql_getTotalDebited_byCardID($cardID);
        }

        public static function sql_getTotalCredited_byCardID($cardID) {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT sum(credited) FROM ' . self::tbl() . ' WHERE customer_card_id = :cardID';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':cardID', $cardID, PDO::PARAM_INT);
            return $command->queryScalar();
        }

        public static function sql_getTotalDebited_byCardID($cardID) {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT sum(debited) FROM ' . self::tbl() . ' WHERE customer_card_id = :cardID';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':cardID', $cardID, PDO::PARAM_INT);
            return $command->queryScalar();
        }

        public static function sql_getTotalConsumed_byCustID($custID) {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT sum(credited) FROM ' . self::tbl() . ' WHERE customer_id =:custID ';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':custID', $custID, PDO::PARAM_INT);
            return $command->queryScalar();
        }

        public function sql_getTotalCredit_byDate($dateFrom, $custID) {
            $dateTo = Settings::get_Date();
            $cnn = Utilities::createConnection();
            $sql = 'SELECT SUM(credited) FROM ' . self::tbl() . ' WHERE date(created_at)BETWEEN :dateFrom AND :dateTo AND customer_id = :custID';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':dateFrom', $dateFrom, PDO::PARAM_STR);
            $command->bindValue(':dateTo', $dateTo, PDO::PARAM_STR);
            $command->bindValue(':custID', $custID, PDO::PARAM_INT);
            return $command->queryScalar();
        }

        public static function get_ActiveReportType($id = null) {
            $reportType = array(
                self::REPORT_TYPE_CURRENT => 'Current',
                self::REPORT_TYPE_RANGE => 'Range'
            );

            if ($id != null) {
                return $reportType[$id];
            } else {
                return $reportType;
            }
        }

        public static function sql_getLastID_byMachineID($machineID) {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT id FROM ' . self::tbl() . ' WHERE machine_id = :machineID ORDER BY id desc limit 1 ';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':machineID', $machineID, PDO::PARAM_INT);
            return $command->queryScalar();
        }

        public static function sql_countTotalCycles_byDate($date, $isDeleted, $machineID) {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT count(*) FROM ' . self::tbl() . ' WHERE machine_id = :machineID AND DATE(created_at) = :date AND is_deleted = :isDeleted';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':machineID', $machineID, PDO::PARAM_INT);
            $command->bindValue(':date', $date, PDO::PARAM_STR);
            $command->bindValue(':isDeleted', $isDeleted, PDO::PARAM_INT);
            return $command->queryScalar();
        }

        public static function sql_getTotalAmountConsumedByDateTransID($dateFrom, $dateTo, $transactionID) {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT SUM(debited) FROM ' . self::tbl() . ' WHERE DATE(created_at) BETWEEN :dateFrom AND :dateTo AND transaction_id = :transactionID AND is_sales = :isSales';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':dateFrom', $dateFrom, PDO::PARAM_STR);
            $command->bindValue(':dateTo', $dateTo, PDO::PARAM_STR);
            $command->bindValue(':transactionID', $transactionID, PDO::PARAM_INT);
            $command->bindValue(':isSales', Utilities::YES, PDO::PARAM_INT);
            return $command->queryScalar();
        }

        public static function sql_countDistinctCustomer() {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT count(distinct(customer_id)) FROM ' . self::tbl() . '';
            $command = $cnn->createCommand($sql);
            return $command->queryScalar();
        }

    }
    