<?php

    /**
     * This is the model class for table "pos_transactions".
     *
     * The followings are the available columns in table 'pos_transactions':
     * @property integer $id
     * @property string $created_at
     * @property string $updated_at
     * @property string $trans_date
     * @property string $ref_no
     * @property integer $cust_id
     * @property integer $branch_id
     * @property integer $client_id
     * @property integer $inv_id
     * @property integer $transaction_id
     * @property string $transaction_name
     * @property integer $qty
     * @property string $price
     * @property string $amount_net
     * @property string $balance
     * @property integer $user_id
     * @property integer $is_fully_paid
     * @property integer $is_inventory
     * @property string $remarks
     * @property integer $is_deleted
     * @property integer $deleted_by
     * @property integer $service_type_id
     * @property integer $inventory_type_id
     * @property integer $points
     * @property integer $percentage
     */
    class PosTransactions extends CActiveRecord {

        /**
         * @return string the associated database table name
         */
        public function tableName() {
            return 'pos_transactions';
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
                array('created_at, trans_date, ref_no, cust_id, branch_id, inv_id, transaction_name, qty, price, amount_net, user_id', 'required'),
                array('cust_id, branch_id, client_id, inv_id, transaction_id, qty, user_id, is_fully_paid, is_inventory, is_deleted, deleted_by, service_type_id, inventory_type_id', 'numerical', 'integerOnly' => true),
                array('ref_no, remarks', 'length', 'max' => 100),
                array('transaction_name', 'length', 'max' => 255),
                array('price, amount_net, balance, points, percentage', 'length', 'max' => 20),
                array('updated_at', 'safe'),
// The following rule is used by search().
// Please remove those attributes that should not be searched.
                array('id, created_at, updated_at, trans_date, ref_no, cust_id, branch_id, client_id, inv_id, transaction_id, transaction_name, qty, price, amount_net, balance, user_id, is_fully_paid, is_inventory, remarks, is_deleted, deleted_by, service_type_id, inventory_type_id, points, percentage', 'safe', 'on' => 'search'),
            );
        }

        /**
         * @return array relational rules.
         */
        public function relations() {
// NOTE: you may need to adjust the relation name and the related
// class name for the relations automatically generated below.
            return array(
                'inventories' => array(self::BELONGS_TO, 'Inventories', 'inv_id'),
                'branches' => array(self::BELONGS_TO, 'Branches', 'branch_id'),
                'clients' => array(self::BELONGS_TO, 'Clients', 'client_id'),
                'customers' => array(self::BELONGS_TO, 'Customers', 'cust_id'),
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
                'trans_date' => 'Trans Date',
                'ref_no' => 'Ref No',
                'cust_id' => 'Cust',
                'branch_id' => 'Branch',
                'client_id' => 'Service',
                'inv_id' => 'Inv',
                'transaction_id' => 'Transaction',
                'transaction_name' => 'Transaction Name',
                'qty' => 'Qty',
                'price' => 'Price',
                'amount_net' => 'Amount Net',
                'balance' => 'Balance',
                'user_id' => 'User',
                'is_fully_paid' => 'Is Fully Paid',
                'is_inventory' => 'Is Inventory',
                'service_type_id' => 'Service Type',
                'inventory_type_id' => 'Category',
                'remarks' => 'Remarks',
                'is_deleted' => 'Is Deleted',
                'deleted_by' => 'Deleted By',
                'points' => 'Points',
                'percentage' => 'Percentage',
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

            $criteria->compare('t.trans_date', $this->trans_date, true);

            $criteria->compare('t.ref_no', $this->ref_no, true);

            $criteria->compare('t.cust_id', $this->cust_id);

            $criteria->compare('t.branch_id', $this->branch_id);

            $criteria->compare('t.client_id', $this->client_id);

            $criteria->compare('t.inv_id', $this->inv_id);

            $criteria->compare('t.transaction_id', $this->transaction_id);

            $criteria->compare('t.transaction_name', $this->transaction_name, true);

            $criteria->compare('t.qty', $this->qty);

            $criteria->compare('t.price', $this->price, true);

            $criteria->compare('t.amount_net', $this->amount_net, true);

            $criteria->compare('t.balance', $this->balance, true);

            $criteria->compare('t.user_id', $this->user_id);

            $criteria->compare('t.is_fully_paid', $this->is_fully_paid);

            $criteria->compare('t.is_inventory', $this->is_inventory);

            $criteria->compare('t.remarks', $this->remarks, true);

            $criteria->compare('t.is_deleted', $this->is_deleted);

            $criteria->compare('t.service_type_id', $this->service_type_id);

            $criteria->compare('t.inventory_type_id', $this->inventory_type_id);

            $criteria->compare('t.deleted_by', $this->deleted_by);

            $criteria->compare('t.points', $this->points);

            $criteria->compare('t.percentage', $this->percentage);

            $criteria->order = 't.created_at DESC';

            return new CActiveDataProvider('PosTransactions', array(
                'criteria' => $criteria,
            ));
        }

        /**
         * Returns the static model of the specified AR class.
         * @return PosTransactions the static model class
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

        public function generateRefNo() {
            $length = 4;
            $refNO = self::getLastInsertedRefNo() + 1;
            return sprintf("%0" . $length . "d", $refNO);
        }

        public function getLastInsertedRefNo() {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT ref_no FROM ' . self::tbl() . ' ORDER BY id DESC limit 1';
            $command = $cnn->createCommand($sql);
            return $command->queryScalar();
        }

        public function addRecord() {
            $model = new PosTransactions();

            $model->created_at = $this->created_at;
            $model->updated_at = $this->updated_at;
            $model->trans_date = $this->trans_date;
            $model->branch_id = $this->branch_id;
            $model->client_id = $this->client_id;
            $model->ref_no = $this->ref_no;
            $model->remarks = $this->remarks;
            $model->cust_id = $this->cust_id;
            $model->inv_id = $this->inv_id;
            $model->transaction_id = $this->transaction_id;
            $model->transaction_name = $this->transaction_name;
            $model->qty = $this->qty;
            $model->price = $this->price;
            $model->amount_net = $this->amount_net;
            $model->balance = $this->balance;
            $model->user_id = $this->user_id;
            $model->is_fully_paid = $this->is_fully_paid;
            $model->is_inventory = $this->is_inventory;
            $model->inventory_type_id = $this->inventory_type_id;
            $model->service_type_id = $this->service_type_id;
            $model->is_deleted = $this->is_deleted;
            $model->deleted_by = $this->deleted_by;
            $model->points = $this->points;
            $model->percentage = $this->percentage;

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

        public static function sql_getAllData_byID($transactionID) {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT id, qty, price,  amount_net,transaction_name, is_saved, balance, points  FROM ' . self::tbl() . ' WHERE id = :transactionID';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':transactionID', $transactionID, PDO::PARAM_INT);
            return $command->queryAll();
        }

        public static function sql_getAllData_byDeletedCustIDandIsFullypaid($custID, $isFullypaid, $isDeleted) {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT id, qty, price,  amount_net,transaction_name, is_saved, balance, points FROM ' . self::tbl() . ' WHERE cust_id = :custID AND is_fully_paid = :isFullyPaid AND is_deleted = :isDeleted';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':custID', $custID, PDO::PARAM_INT);
            $command->bindValue(':isFullyPaid', $isFullypaid, PDO::PARAM_INT);
            $command->bindValue(':isDeleted', $isDeleted, PDO::PARAM_INT);
            return $command->queryAll();
        }

        public static function sql_updateIsSavedTransactions($id, $isSaved) {
            $cnn = Utilities::createConnection();
            $sql = 'UPDATE  ' . self::tbl() . ' set is_saved = :issaved WHERE id = :ID limit 1';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':issaved', $isSaved, PDO::PARAM_INT);
            $command->bindValue(':ID', $id, PDO::PARAM_INT);
            return $command->execute();
        }

        public static function model_getAllData_byDeletedCustIDand_IsSaved($custID, $isDeleted, $isSaved) {
            return self::model()->findAll('cust_id =:custID AND is_deleted =:isDeleted AND is_saved =:isSaved', array(':custID' => $custID, ':isDeleted' => $isDeleted, ':isSaved' => $isSaved));
        }

        public static function model_getAllData_byDeletedCustIDandIsFullypaid($custID, $isFullyPaid, $isDeleted) {
            return self::model()->findAll('cust_id =:custID AND is_fully_paid =:isFullyPaid AND is_deleted =:isDeleted', array(':custID' => $custID, ':isFullyPaid' => $isFullyPaid, ':isDeleted' => $isDeleted));
        }

        public static function sql_updateIsFullyPaid($id, $isFullyPaid) {
            $cnn = Utilities::createConnection();
            $sql = 'UPDATE  ' . self::tbl() . ' set is_fully_paid =  :isFullyPaid WHERE id = :ID limit 1';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':isFullyPaid', $isFullyPaid, PDO::PARAM_INT);
            $command->bindValue(':ID', $id, PDO::PARAM_INT);
            return $command->execute();
        }

        public static function sql_updateAmountBalance($id, $balance) {
            $cnn = Utilities::createConnection();
            $sql = 'UPDATE  ' . self::tbl() . ' set balance =  :balance WHERE id = :ID limit 1';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':balance', $balance, PDO::PARAM_STR);
            $command->bindValue(':ID', $id, PDO::PARAM_INT);
            return $command->execute();
        }

        public static function sql_getTotalqauntity_byInvID($invID, $custID) {

            $dateTo = Settings::get_Date();
            $cnn = Utilities::createConnection();
            $sql = 'SELECT sum(qty) FROM ' . self::tbl() . ' WHERE  inv_id = :invID AND cust_id = :custID group by trans_date';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':invID', $invID, PDO::PARAM_INT);
            $command->bindValue(':custID', $custID, PDO::PARAM_INT);
            return $command->queryScalar();
        }

        public static function sql_getTotalAmmount_byInvID($invID, $custID) {

            $dateTo = Settings::get_Date();
            $cnn = Utilities::createConnection();
            $sql = 'SELECT sum(amount_net) FROM ' . self::tbl() . ' WHERE  inv_id = :invID AND cust_id = :custID group by trans_date';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':invID', $invID, PDO::PARAM_INT);
            $command->bindValue(':custID', $custID, PDO::PARAM_INT);
            return $command->queryScalar();
        }

        public function getQuantity() {
            return $this->sql_getTotalqauntity_byInvID($this->inv_id, $this->cust_id);
        }

        public function getTotalAmount() {
            return $this->sql_getTotalAmmount_byInvID($this->inv_id, $this->cust_id);
        }

        public static function sql_getTotalRevenueBasedOnDate($id, $date) {
            $criteria = new CDbCriteria;
            $criteria->select = 'SUM(amount_net) as amount_net';
            $criteria->together = true;
            $criteria->condition = 'branch_id=:branch_id AND is_fully_paid=:isFullyPaid AND trans_date <= :date AND is_deleted = :isDeleted';
            $criteria->params = array(':branch_id' => $id, ':isFullyPaid' => 1, ':date' => $date, ':isDeleted' => Utilities::NO);
            $model = PosTransactions::model()->find($criteria);

            return ($model->amount_net != '') ? $model->amount_net : 0;
        }

        public static function sql_getTotalAccountReceivablesOnDate($id, $date) {
            $criteria = new CDbCriteria;
            $criteria->select = 'SUM(amount_net) as amount_net';
            $criteria->together = true;
            $criteria->condition = 'branch_id=:branch_id AND is_fully_paid=:isFullyPaid AND trans_date <= :date AND is_deleted = :isDeleted';
            $criteria->params = array(':branch_id' => $id, ':isFullyPaid' => 0, ':date' => $date, ':isDeleted' => Utilities::NO);
            $model = PosTransactions::model()->find($criteria);

            return ($model->amount_net != '') ? $model->amount_net : 0;
        }

        public static function sql_getVolumeOnDate($id, $date) {
            $criteria = new CDbCriteria;
            $criteria->select = 'COUNT(cust_id) as numberOfTransactions';
            $criteria->together = true;
            $criteria->condition = 'service_type_id in(1,2) AND branch_id=:branch_id AND trans_date <= :date AND is_deleted = :isDeleted';
            $criteria->params = array(':branch_id' => $id, ':date' => $date, ':isDeleted' => Utilities::NO);
            $model = PosTransactions::model()->find($criteria);
            return $model->numberOfTransactions;
        }

        public function getQuantityPerDay() {
            return $this->sql_getTotalqauntity_byInvIDPerDay($this->inv_id, $this->cust_id, Settings::get_Date());
        }

        public static function sql_getTotalqauntity_byInvIDPerDay($invID, $custID, $date) {

            $dateTo = Settings::get_Date();
            $cnn = Utilities::createConnection();
            $sql = 'SELECT sum(qty) FROM ' . self::tbl() . ' WHERE  inv_id = :invID AND cust_id = :custID AND trans_date = :Date ';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':invID', $invID, PDO::PARAM_INT);
            $command->bindValue(':custID', $custID, PDO::PARAM_INT);
            $command->bindValue(':Date', $custID, PDO::PARAM_STR);
            return $command->queryScalar();
        }

        public static function sql_getPandLOnDate($id, $date) {
            $revenue = self::sql_getTotalRevenueBasedOnDate($id, $date);
            $expenses = Expenses::sql_getTotalExpensesBasedOnDate($id, $date);
            $receivables = self::sql_getTotalAccountReceivablesOnDate($id, $date);

            return $revenue - ($expenses + $receivables);
        }

        public static function sql_getNewCustomerVisitsByDate($id, $lastSync) {

            $criteria = new CDbCriteria;
            $criteria->select = '*';
            $criteria->together = true;
            $criteria->condition = 'branch_id=:branch_id  AND trans_date = :updatedAt  AND is_deleted = :isDeleted  GROUP BY cust_id';
            $criteria->params = array(':branch_id' => $id, ':updatedAt' => date("Y-m-d H:i:s", strtotime($lastSync)), ':isDeleted' => Utilities::NO);
            $models = PosTransactions::model()->findAll($criteria);

            return count($models);
        }

        public static function sql_getCustomerVisitsByDate($id, $lastSync) {

            $criteria = new CDbCriteria;
            $criteria->select = '*';
            $criteria->together = true;
            $criteria->condition = 'branch_id=:branch_id  AND trans_date < :updatedAt  AND is_deleted = :isDeleted  GROUP BY cust_id';
            $criteria->params = array(':branch_id' => $id, ':updatedAt' => date("Y-m-d H:i:s", strtotime($lastSync)), ':isDeleted' => Utilities::NO);
            $models = PosTransactions::model()->findAll($criteria);

            return count($models);
        }

        public static function sql_getCustomerTotalVisitsByDate($id, $lastSync) {

            $criteria = new CDbCriteria;
            $criteria->select = '*';
            $criteria->together = true;
            $criteria->condition = 'branch_id=:branch_id  AND trans_date < :updatedAt AND is_deleted = :isDeleted GROUP BY cust_id';
            $criteria->params = array(':branch_id' => $id, ':updatedAt' => date("Y-m-d H:i:s", strtotime($lastSync)), ':isDeleted' => Utilities::NO);

            $models = PosTransactions::model()->findAll($criteria);

            return count($models);
        }

        public function getIsFullyPaid() {
            return Utilities::get_ActiveSelect($this->is_fully_paid);
        }

        public static function sql_getTotalProductRevenueBasedOnDate($id, $date, $inventoryTypeID, $isFullyPaid) {
            $criteria = new CDbCriteria;
            $criteria->select = 'SUM(amount_net) as amount_net';
            $criteria->together = true;
            $criteria->condition = 'inventory_type_id =:inventoryTypeID AND branch_id=:branch_id AND is_fully_paid=:isFullyPaid AND trans_date <= :date AND is_deleted = :isDeleted';
            $criteria->params = array(':inventoryTypeID' => $inventoryTypeID, ':branch_id' => $id, ':isFullyPaid' => $isFullyPaid, ':date' => $date, ':isDeleted' => Utilities::NO);
            $model = PosTransactions::model()->find($criteria);

            return ($model->amount_net != '') ? $model->amount_net : 0;
        }

        public static function sql_getVolumeOnDateServiceTypeID($id, $date, $serviceTypeID) {
            $criteria = new CDbCriteria;
            $criteria->select = 'sum(qty) as numberOfTransactions';
            $criteria->together = true;
            $criteria->condition = 'service_type_id=:serviceTypeID AND branch_id=:branch_id AND trans_date <= :date AND is_deleted = :isDeleted';
            $criteria->params = array(':serviceTypeID' => $serviceTypeID, ':branch_id' => $id, ':date' => $date, ':isDeleted' => Utilities::NO);
            $model = PosTransactions::model()->find($criteria);
            return $model->numberOfTransactions;
        }

        public static function sql_getVolumeOnDateByServiceType($id, $date) {
            $washer = self:: sql_getVolumeOnDateServiceTypeID($id, $date, 1);
            $dryer = self:: sql_getVolumeOnDateServiceTypeID($id, $date, 2);

            $totalVolume = $washer + $dryer;

            return $totalVolume;
        }

        const REPORT_TYPE_CURRENT = 1;
        const REPORT_TYPE_RANGE = 2;

        public static function get_ActiveReportType($id = null) {
            $active = array(
                self::REPORT_TYPE_CURRENT => 'Current',
                self::REPORT_TYPE_RANGE => 'Select Range',
            );
            if (is_null($id))
                return $active;
            else
                return $active[$id];
        }

        public static function model_getAllData_byDeletedCLientID_branchID($isDeleted, $clientID, $branchID) {
            return self::model()->findAll('is_sync = :isDeleted AND client_id = :clientID AND branch_id = :branchID ', array(':isDeleted' => $isDeleted, ':clientID' => $clientID, ':branchID' => $branchID));
        }

    }
    