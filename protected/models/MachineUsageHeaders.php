<?php

    /**
     * This is the model class for table "machine_usage_headers".
     *
     * The followings are the available columns in table 'machine_usage_headers':
     * @property integer $id
     * @property string $created_at
     * @property string $updated_at
     * @property integer $customer_card_id
     * @property integer $rf_id
     * @property integer $branch_id
     * @property integer $customer_id
     * @property integer $machine_id
     * @property string $start_datetime
     * @property string $end_datetime
     * @property integer $total_minutes
     * @property integer $user_id
     * @property integer $is_deleted
     */
    class MachineUsageHeaders extends CActiveRecord {

        /**
         * @return string the associated database table name
         */
        public function tableName() {
            return 'machine_usage_headers';
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

        public function clearSessions() {
            unset($_SESSION[self::tbl()]);
        }

        /**
         * @return array validation rules for model attributes.
         */
        public function rules() {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('created_at, customer_card_id, rf_id, branch_id, customer_id, machine_id, start_datetime, end_datetime, total_minutes, user_id', 'required'),
                array('branch_id, customer_id, machine_id, total_minutes, user_id, is_deleted', 'numerical', 'integerOnly' => true),
                array('updated_at, end_datetime', 'safe'),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, created_at, updated_at, branch_id, customer_id, machine_id, start_datetime, end_datetime, total_minutes, user_id, is_deleted', 'safe', 'on' => 'search'),
            );
        }

        /**
         * @return array relational rules.
         */
        public function relations() {
            // NOTE: you may need to adjust the relation name and the related
            // class name for the relations automatically generated below.
            return array(
                'machineUsageDetails' => array(self::HAS_MANY, 'MachineUsageDetails', 'header_id')
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
                'branch_id' => 'Branch',
                'customer_id' => 'Customer',
                'machine_id' => 'Machine',
                'start_datetime' => 'Start Datetime',
                'end_datetime' => 'End Datetime',
                'total_minutes' => 'Total Minutes',
                'user_id' => 'User',
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

            $criteria->compare('customer_card_id', $this->customer_card_id);

            $criteria->compare('rf_id', $this->rf_id);

            $criteria->compare('branch_id', $this->branch_id);

            $criteria->compare('customer_id', $this->customer_id);

            $criteria->compare('machine_id', $this->machine_id);

            $criteria->compare('start_datetime', $this->start_datetime, true);

            $criteria->compare('end_datetime', $this->end_datetime, true);

            $criteria->compare('total_minutes', $this->total_minutes);

            $criteria->compare('user_id', $this->user_id);

            $criteria->compare('is_deleted', $this->is_deleted);

            return new CActiveDataProvider('MachineUsageHeaders', array(
                'criteria' => $criteria,
            ));
        }

        /**
         * Returns the static model of the specified AR class.
         * @return MachineUsageHeaders the static model class
         */
        public static function model($className = __CLASS__) {
            return parent::model($className);
        }

        public static function insertRecord($dateTime, $customerTransactionID, $customerID, $branchID, $rfID = 0, $transactionID, $machineID, $totalMinutes) {
            $model = new MachineUsageHeaders();
            $model->created_at = $dateTime;
            $model->updated_at = $dateTime;
            $model->customer_card_id = CustomerCards::sql_getCardID_byRfID($rfID);
            $model->rf_id = $rfID;
            $model->branch_id = $branchID;
            $model->customer_id = $customerID;
            $model->machine_id = $machineID;
            $model->start_datetime = $dateTime;
            $model->end_datetime = date('Y-m-d H:i:s', Utilities::addMinutes($model->start_datetime, $totalMinutes));
            $model->total_minutes = $totalMinutes;
            $model->user_id = 0;
            $model->is_deleted = 0;

            $result = $model->addRecord();

            if ($result->status == Utilities::STATUS_SUCCESS) {
                MachineUsageDetails::insertRecord($result->id, $customerTransactionID, $dateTime, $customerID, $rfID, $transactionID, $machineID, $totalMinutes);
            }
        }

        public function addRecord() {
            $model = new MachineUsageHeaders();
            $model->created_at = $this->created_at;
            $model->updated_at = $this->updated_at;
            $model->customer_card_id = $this->customer_card_id;
            $model->rf_id = $this->rf_id;
            $model->branch_id = $this->branch_id;
            $model->customer_id = $this->customer_id;
            $model->machine_id = $this->machine_id;
            $model->start_datetime = $this->start_datetime;
            $model->end_datetime = $this->end_datetime;
            $model->total_minutes = $this->total_minutes;
            $model->user_id = $this->user_id;
            $model->is_deleted = $this->is_deleted;

            if ($model->validate()) {
                $model->save();
                $messageArr = array('id' => $model->id, 'status' => Utilities::STATUS_SUCCESS, 'message' => 'Machine Usage Successfully Saved.');
            } else {
                $messageArr = array('status' => Utilities::STATUS_FAILED, 'message' => Utilities::get_ModelErrors($model->errors));
            }

            return json_decode(json_encode($messageArr));
        }

        public static function sql_getLastID_byMachineID($machineID) {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT id FROM ' . self::tbl() . ' WHERE machine_id = :machineID ORDER BY id desc limit 1';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':machineID', $machineID, PDO::PARAM_INT);
            return $command->queryScalar();
        }

        public static function sql_updateStartTime_byID($headerID, $startTime) {
            $cnn = Utilities::createConnection();
            $sql = 'UPDATE ' . self::tbl() . ' SET start_datetime = :startDateTime WHERE id = :headerID';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':headerID', $headerID, PDO::PARAM_INT);
            $command->bindValue(':startDateTime', $startTime, PDO::PARAM_STR);
            $command->execute();
        }

        public static function sql_getTotalMinutes_byID($ID) {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT total_minutes FROM ' . self::tbl() . ' WHERE id = :headerID limit 1';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':headerID', $ID, PDO::PARAM_INT);
            return $command->queryScalar();
        }

        public static function sql_updateEndTime_byID($headerID, $endTime) {
            $cnn = Utilities::createConnection();
            $sql = 'UPDATE ' . self::tbl() . ' SET end_datetime = :endDateTime WHERE id = :headerID';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':headerID', $headerID, PDO::PARAM_INT);
            $command->bindValue(':endDateTime', $endTime, PDO::PARAM_STR);
            $command->execute();
        }

        public static function sql_updateTotalMinutes_byID($headerID, $totalMinutes) {
            $cnn = Utilities::createConnection();
            $sql = 'UPDATE ' . self::tbl() . ' SET total_minutes = :totalMinutes WHERE id = :headerID';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':headerID', $headerID, PDO::PARAM_INT);
            $command->bindValue(':totalMinutes', $totalMinutes, PDO::PARAM_STR);
            $command->execute();
        }

        public static function sql_getTotalMinutes_byMachineID($machineID) {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT sum(total_minutes) FROM ' . self::tbl() . ' WHERE machine_id = :machineID';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':machineID', $machineID, PDO::PARAM_INT);
            $totalMinutes = $command->queryScalar();
            return ($totalMinutes > 0) ? $totalMinutes : 0;
        }

        public static function sql_getTotalMinutes_byMachineID_Date($date, $machineID) {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT sum(total_minutes) FROM ' . self::tbl() . ' WHERE machine_id = :machineID AND DATE(created_at) = :toDate';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':toDate', $date, PDO::PARAM_INT);
            $command->bindValue(':machineID', $machineID, PDO::PARAM_INT);
            $totalMinutes = $command->queryScalar();
            return ($totalMinutes > 0) ? $totalMinutes : 0;
        }

        public static function sql_getEndDateTime_byID($machineHeaderID) {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT end_datetime FROM ' . self::tbl() . ' WHERE id = :machineHeaderID limit 1';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':machineHeaderID', $machineHeaderID, PDO::PARAM_INT);
            return $command->queryScalar();
        }

        public static function sql_updateIsRunningCompleted($headerID, $value) {
            $cnn = Utilities::createConnection();
            $sql = 'UPDATE ' . self::tbl() . ' SET is_running_completed = :isRunningCompleted WHERE id = :headerID';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':headerID', $headerID, PDO::PARAM_INT);
            $command->bindValue(':isRunningCompleted', $value, PDO::PARAM_INT);
            $command->execute();
        }

        public static function model_getAllData_byDeletedCLientID_branchID($isDeleted, $branchID) {
            return self::model()->findAll('is_sync = :isDeleted AND  branch_id = :branchID ', array(':isDeleted' => $isDeleted, ':branchID' => $branchID));
        }

        public static function model_getAllData_byCLientID_branchID($branchID) {
            return self::model()->findAll('branch_id = :branchID ', array(':branchID' => $branchID));
        }

    }
    