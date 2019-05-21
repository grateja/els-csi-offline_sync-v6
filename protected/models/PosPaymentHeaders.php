<?php

    /**
     * This is the model class for table "pos_payment_headers".
     *
     * The followings are the available columns in table 'pos_payment_headers':
     * @property integer $id
     * @property string $created_at
     * @property string $updated_at
     * @property string $date
     * @property integer $payment_type_id
     * @property string $ref_no
     * @property string $or_no
     * @property integer $branch_id
     * @property integer $client_id
     * @property integer $employee_id
     * @property integer $customer_id
     * @property integer $quantity
     * @property string $payable
     * @property string $amount_cash
     * @property string $amount_card
     * @property string $amount_points
     * @property string $discount
     * @property string $points
     * @property string $tax
     * @property string $amount_net
     * @property integer $is_email_sent
     * @property integer $is_sync
     * @property integer $is_deleted
     */
    class PosPaymentHeaders extends CActiveRecord {
        public $amount_change;

        /**
         * @$return string the associated database table name
         */
        public function tableName() {
            return 'pos_payment_headers';
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

        /**
         * @return array validation rules for model attributes.
         */
        public function rules() {
// NOTE: you should only define rules for those attributes that
// will receive user inputs.
            return array(
                array('created_at, date, ref_no, or_no, branch_id, client_id, amount_net, customer_id', 'required'),
                array('payment_type_id, branch_id, client_id, employee_id, customer_id, quantity, is_email_sent, is_sync, is_deleted', 'numerical', 'integerOnly' => true),
                array('ref_no, or_no', 'length', 'max' => 20),
                array('payable, amount_cash, discount, tax, amount_net, amount_card, amount_points, points', 'length', 'max' => 20),
                array('updated_at, amount_change', 'safe'),
// The following rule is used by search().
// Please remove those attributes that should not be searched.
                array('id, created_at, updated_at, date, payment_type_id, ref_no, or_no, branch_id, client_id, employee_id, customer_id, quantity, payable, amount_card, amount_cash, discount, tax, amount_net, is_email_sent, is_sync, is_deleted, points, amount_points', 'safe', 'on' => 'search'),
            );
        }

        /**
         * @return array relational rules.
         */
        public function relations() {
// NOTE: you may need to adjust the relation name and the related
// class name for the relations automatically generated below.
            return array(
                
                'branches' => array(self::BELONGS_TO, 'Branches', 'branch_id'),
                'clients' => array(self::BELONGS_TO, 'Clients', 'client_id'),
                'employees' => array(self::BELONGS_TO, 'Employees', 'employee_id'),
                'customers' => array(self::BELONGS_TO, 'Customers', 'customer_id'),
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
                'date' => 'Date',
                'payment_type_id' => 'Payment Type',
                'ref_no' => 'Ref No',
                'or_no' => 'Or No',
                'branch_id' => 'Branch',
                'client_id' => 'Client',
                'employee_id' => 'Employee',
                'customer_id' => 'Customer',
                'quantity' => 'Quantity',
                'payable' => 'Payable',
                'amount_cash' => 'Cash',
                'amount_card' => 'Card',
                'amount_points' => 'Point Amount',
                'points' => 'Points',
                'discount' => 'Discount',
                'tax' => 'Tax',
                'amount_net' => 'Amount Net',
                'is_email_sent' => 'Is Email Sent',
                'is_sync' => 'Is Sync',
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

            $criteria->compare('date', $this->date, true);

            $criteria->compare('payment_type_id', $this->payment_type_id);

            $criteria->compare('ref_no', $this->ref_no, true);

            $criteria->compare('or_no', $this->or_no, true);

            $criteria->compare('branch_id', $this->branch_id);

            $criteria->compare('client_id', $this->client_id);

            $criteria->compare('employee_id', $this->employee_id);

            $criteria->compare('customer_id', $this->customer_id);

            $criteria->compare('quantity', $this->quantity);

            $criteria->compare('payable', $this->payable, true);

            $criteria->compare('amount_cash', $this->amount_cash, true);

            $criteria->compare('amount_card', $this->amount_card, true);

            $criteria->compare('amount_points', $this->amount_points, true);

            $criteria->compare('points', $this->points);

            $criteria->compare('discount', $this->discount, true);

            $criteria->compare('tax', $this->tax, true);

            $criteria->compare('amount_net', $this->amount_net, true);

            $criteria->compare('amount_change', $this->amount_change, true);

            $criteria->compare('is_email_sent', $this->is_email_sent);

            $criteria->compare('is_sync', $this->is_sync);

            $criteria->compare('is_deleted', $this->is_deleted);

            $criteria->order = 'created_at DESC';

            return new CActiveDataProvider('PosPaymentHeaders', array(
                'criteria' => $criteria,
            ));
        }

        /**
         * Returns the static model of the specified AR class.
         * @return PosPaymentHeaders the static model class
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

        public function addRecord() {
            $model = new PosPaymentHeaders();

            $model->created_at = $this->created_at;
            $model->updated_at = $this->updated_at;
            $model->date = $this->date;
            $model->payment_type_id = $this->payment_type_id;
            $model->ref_no = $this->ref_no;
            $model->or_no = $this->or_no;
            $model->branch_id = $this->branch_id;
            $model->client_id = $this->client_id;
            $model->employee_id = $this->employee_id;
            $model->customer_id = $this->customer_id;
            $model->quantity = $this->quantity;
            $model->payable = $this->payable;
            $model->amount_cash = $this->amount_cash;
            $model->amount_card = $this->amount_card;
            $model->amount_points = $this->amount_points;
            $model->points = $this->points;
            $model->discount = $this->discount;
            $model->tax = $this->tax;
            $model->amount_net = $this->amount_net;
            $model->is_email_sent = $this->is_email_sent;
            $model->is_sync = $this->is_sync;
            $model->is_deleted = $this->is_deleted;

            $model->validate();
            if ($model->save()) {
                $messageArr[0] = $model->id;
                $messageArr[1] = 'Customer  transaction  Successfully Added.';
            } else {
                $messageArr[0] = 0;
                $messageArr[1] = Utilities::get_ModelErrors($model->errors);
            }
            return $messageArr;
        }

        public function generateRefNo() {
            $length = 7;
            $refNO = self::getLastInsertedRefNo() + 1;
            return sprintf("%0" . $length . "d", $refNO);
        }

        public function getLastInsertedRefNo() {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT ref_no FROM ' . self::tbl() . ' ORDER BY id DESC limit 1';
            $command = $cnn->createCommand($sql);
            return $command->queryScalar();
        }

        public function generateOR() {
            $length = 4;
            $refNO = self::getLastInsertedOR() + 1;
            return sprintf("%0" . $length . "d", $refNO);
        }

        public function getLastInsertedOR() {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT or_no FROM ' . self::tbl() . ' WHERE branch_id = :branchID ORDER BY id DESC limit 1';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':branchID', Settings::get_BranchID(), PDO::PARAM_INT);
            return $command->queryScalar();
        }

        public static function sql_getTotalBalance_byCustIDDateFrom($custID, $dateFrom) {

            $dateTo = Settings::get_Date();
            $cnn = Utilities::createConnection();
            $sql = 'SELECT sum(amount_net) FROM ' . self::tbl() . ' WHERE date(created_at)= :dateFrom  AND cust_id = :custID';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':dateFrom', $dateFrom, PDO::PARAM_STR);
            $command->bindValue(':custID', $custID, PDO::PARAM_INT);
            return $command->queryScalar();
        }
        
        public function getChange(){
            $totalChange = (($this->amount_cash + $this->amount_card + $this->discount) - $this->payable);
            if (number_format($totalChange) >= 0){
                $change = Settings::setNumberFormat($totalChange, 2);
            }else{
                $change = '0.00';
            }
            
            return $change;
        }

        public static function model_getAllData_byDeletedCLientID_branchID($isDeleted, $clientID, $branchID) {
            return self::model()->findAll('is_sync = :isDeleted AND client_id = :clientID AND branch_id = :branchID ', array(':isDeleted' => $isDeleted, ':clientID' => $clientID, ':branchID' => $branchID));
        }
        
        
        public static function model_getAllData_byCLientID_branchID($clientID, $branchID) {
            return self::model()->findAll('client_id = :clientID AND branch_id = :branchID ', array(':clientID' => $clientID, ':branchID' => $branchID));
        }
        
   
    }
    