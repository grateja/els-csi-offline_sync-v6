<?php

    /**
     * This is the model class for table "machine_usage_details".
     *
     * The followings are the available columns in table 'machine_usage_details':
     * @property integer $id
     * @property string $created_at
     * @property string $updated_at
     * @property integer $header_id
     * @property integer $customer_transaction_id
     * @property integer $customer_id
     * @property integer $machine_id
     * @property string $rf_id
     * @property integer $transaction_id
     * @property string $start_datetime
     * @property string $end_datetime
     * @property integer $total_minutes
     * @property integer $is_deleted
     */
    class MachineUsageDetails extends CActiveRecord {

        /**
         * @return string the associated database table name
         */
        public function tableName() {
            return 'machine_usage_details';
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
                array('created_at, header_id, customer_transaction_id, customer_id, machine_id, rf_id, transaction_id, start_datetime, total_minutes', 'required'),
                array('header_id, customer_id, machine_id, transaction_id, total_minutes, is_deleted', 'numerical', 'integerOnly' => true),
                array('updated_at, end_datetime', 'safe'),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, created_at, updated_at, header_id, customer_transaction_id, customer_id, machine_id, transaction_id, start_datetime, end_datetime, total_minutes, is_deleted', 'safe', 'on' => 'search'),
            );
        }

        /**
         * @return array relational rules.
         */
        public function relations() {
            // NOTE: you may need to adjust the relation name and the related
            // class name for the relations automatically generated below.
            return array(
                'machineUsageHeaders' => array(self::BELONGS_TO, 'MachineUsageHeaders', 'header_id')
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
                'header_id' => 'Header',
                'customer_transaction_id' => 'Customer Transaction',
                'customer_id' => 'Customer',
                'machine_id' => 'Machine',
                'rf_id' => 'RF ID',
                'transaction_id' => 'Transaction',
                'start_datetime' => 'Start Datetime',
                'end_datetime' => 'End Datetime',
                'total_minutes' => 'Total Minutes',
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

            $criteria->compare('header_id', $this->header_id);

            $criteria->compare('customer_transaction_id', $this->customer_transaction_id);

            $criteria->compare('customer_id', $this->customer_id);

            $criteria->compare('machine_id', $this->machine_id);

            $criteria->compare('rf_id', $this->rf_id);

            $criteria->compare('transaction_id', $this->transaction_id);

            $criteria->compare('start_datetime', $this->start_datetime, true);

            $criteria->compare('end_datetime', $this->end_datetime, true);

            $criteria->compare('total_minutes', $this->total_minutes);

            $criteria->compare('is_deleted', $this->is_deleted);

            return new CActiveDataProvider('MachineUsageDetails', array(
                'criteria' => $criteria,
            ));
        }

        /**
         * Returns the static model of the specified AR class.
         * @return MachineUsageDetails the static model class
         */
        public static function model($className = __CLASS__) {
            return parent::model($className);
        }

        public static function insertRecord($headerID, $customerTransactionID, $dateTime, $customerID, $rfID = 0, $transactionID, $machineID, $totalMinutes) {
            $model = new MachineUsageDetails();
            $model->created_at = $dateTime;
            $model->updated_at = $dateTime;
            $model->header_id = $headerID;
            $model->customer_transaction_id = $customerTransactionID;
            $model->customer_id = $customerID;
            $model->machine_id = $machineID;
            $model->rf_id = $rfID;
            $model->transaction_id = $transactionID;
            $model->start_datetime = $dateTime;
            $model->end_datetime = date('Y-m-d H:i:s', Utilities::addMinutes($model->start_datetime, $totalMinutes));
            $model->total_minutes = $totalMinutes;
            $model->is_deleted = 0;

            $result = $model->addRecord();
        }

        public function addRecord() {
            $model = new MachineUsageDetails();
            $model->created_at = $this->created_at;
            $model->updated_at = $this->updated_at;
            $model->header_id = $this->header_id;
            $model->customer_transaction_id = $this->customer_transaction_id;
            $model->customer_id = $this->customer_id;
            $model->machine_id = $this->machine_id;
            $model->rf_id = $this->rf_id;
            $model->transaction_id = $this->transaction_id;
            $model->start_datetime = $this->start_datetime;
            $model->end_datetime = $this->end_datetime;
            $model->total_minutes = $this->total_minutes;
            $model->is_deleted = $this->is_deleted;

            if ($model->validate()) {
                $model->save();
                $messageArr = array('id' => $model->id, 'status' => Utilities::STATUS_SUCCESS, 'message' => 'Machine Usage Successfully Saved.');
            } else {
                $messageArr = array('status' => Utilities::STATUS_FAILED, 'message' => Utilities::get_ModelErrors($model->errors));
            }

            return json_decode(json_encode($messageArr));
        }

        public static function model_getAllData_byDeletedCLientID_branchID($isSync) {
            return self::model()->findAll('is_sync = :isSync', array(':isSync' => $isSync));
        }

    }
    