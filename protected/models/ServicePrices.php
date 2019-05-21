<?php

    /**
     * This is the model class for table "service_prices".
     *
     * The followings are the available columns in table 'service_prices':
     * @property integer $id
     * @property string $created_at
     * @property string $updated_at
     * @property integer $client_id
     * @property integer $laundry_shop_id
     * @property integer $transaction_id
     * @property integer $pulse
     * @property string $price
     * @property integer $is_deleted
     * @property integer $branch_id
     * @property integer $inv_id
     */
    class ServicePrices extends CActiveRecord {

        /**
         * @return string the associated database table name
         */
        public function tableName() {
            return 'service_prices';
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
                array('created_at, transaction_id, branch_id, price', 'required'),
                array('client_id, laundry_shop_id, transaction_id, pulse, is_deleted, branch_id ,inv_id', 'numerical', 'integerOnly' => true),
                array('price', 'length', 'max' => 12),
                array('updated_at', 'safe'),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, created_at, updated_at, client_id, laundry_shop_id, transaction_id, price, pulse, is_deleted, branch_id, inv_id', 'safe', 'on' => 'search'),
            );
        }

        /**
         * @return array relational rules.
         */
        public function relations() {
            // NOTE: you may need to adjust the relation name and the related
            // class name for the relations automatically generated below.
            return array(
                'clients' => array(self::BELONGS_TO, 'Clients', 'client_id'),
                'laundryShops' => array(self::BELONGS_TO, 'LaundryShops', 'laundry_shop_id'),
                'branches' => array(self::BELONGS_TO, 'Branches', 'branch_id'),
                'transactions' => array(self::BELONGS_TO, 'Transactions', 'transaction_id'),
                'inventories' => array(self::BELONGS_TO, 'Inventories', 'inv_id')
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
                'client_id' => 'Client',
                'laundry_shop_id' => 'Laundry Shop',
                'transaction_id' => 'Transaction',
                'pulse' => 'Pulse',
                'price' => 'Price',
                'is_deleted' => 'Is Deleted',
                'branch_id' => 'Branch',
                'inv_id' => 'Item'
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

            $criteria->compare('client_id', $this->client_id);

            $criteria->compare('laundry_shop_id', $this->laundry_shop_id);

            $criteria->compare('transaction_id', $this->transaction_id);

            $criteria->compare('price', $this->price, true);

            $criteria->compare('pulse', $this->pulse);

            $criteria->compare('is_deleted', $this->is_deleted);

            $criteria->compare('branch_id', $this->branch_id);

            $criteria->compare('inv_id', $this->inv_id);


            return new CActiveDataProvider('ServicePrices', array(
                'criteria' => $criteria,
            ));
        }

        /**
         * Returns the static model of the specified AR class.
         * @return ServicePrices the static model class
         */
        public static function model($className = __CLASS__) {
            return parent::model($className);
        }

        public static function model_getAllData_byIsDeleted($isDeleted) {
            return self::model()->findAll('is_deleted = :isDeleted', array(':isDeleted' => $isDeleted));
        }

        public function getIsDeleted() {
            return Utilities::get_ActiveSelect($this->is_deleted);
        }

        public static function sql_getPriceNoPromo_byBranchID($branchID, $transactionID) {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT  price FROM ' . self::tbl() . ' WHERE branch_id = :branchID AND transaction_id = :transactionID AND is_deleted = :isDeleted limit 1';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':branchID', $branchID, PDO::PARAM_INT);
            $command->bindValue(':transactionID', $transactionID, PDO::PARAM_INT);
            $command->bindValue(':isDeleted', Utilities::NO, PDO::PARAM_INT);
            return $command->queryScalar();
        }

        public static function sql_getPriceNoPromo_byBranchLaundryShopID($branchID, $transactionID, $laundryShopID = 0) {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT  price FROM ' . self::tbl() . ' WHERE branch_id = :branchID AND transaction_id = :transactionID AND laundry_shop_id = :laundryShopID limit 1';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':branchID', $branchID, PDO::PARAM_INT);
            $command->bindValue(':laundryShopID', $laundryShopID, PDO::PARAM_INT);
            $command->bindValue(':transactionID', $transactionID, PDO::PARAM_INT);
            return $command->queryScalar();
        }

        public static function sql_getPrice_byBranchID($branchID, $transactionID, $date) {

            $price = self::sql_getPriceNoPromo_byBranchID($branchID, $transactionID);

            return ($price != '') ? $price : 0;
        }

        public static function sql_deactivateBranchTransactioID($branchID, $transactionID) {
            $cnn = Utilities::createConnection();
            $sql = 'UPDATE ' . self::tbl() . ' SET is_deleted = :isDeleted WHERE branch_id = :branchID AND transaction_id = :transactionID AND is_deleted = :isNotDeleted limit 1';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':branchID', $branchID, PDO::PARAM_INT);
            $command->bindValue(':transactionID', $transactionID, PDO::PARAM_INT);
            $command->bindValue(':isNotDeleted', Utilities::NO, PDO::PARAM_INT);
            $command->bindValue(':isDeleted', Utilities::YES, PDO::PARAM_INT);
            $command->execute();
        }

        public static function sql_getPulseNoPromo_byBranchID($branchID, $transactionID) {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT  pulse FROM ' . self::tbl() . ' WHERE branch_id = :branchID AND transaction_id = :transactionID AND is_deleted = :isDeleted limit 1';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':branchID', $branchID, PDO::PARAM_INT);
            $command->bindValue(':transactionID', $transactionID, PDO::PARAM_INT);
            $command->bindValue(':isDeleted', Utilities::NO, PDO::PARAM_INT);
            return $command->queryScalar();
        }

        public static function sql_getPulse_byBranchID($branchID, $transactionID, $date) {
            if (ServicePromos::sql_isPromo_byBranchID($branchID, $transactionID, $date) == Utilities::YES) {
                $pulse = ServicePromos::sql_getPulse_byBranch($branchID, $transactionID, $date);
            } else {
                $pulse = self::sql_getPulseNoPromo_byBranchID($branchID, $transactionID);
            }

            return ($pulse != '') ? $pulse : 0;
        }

        public static function model_getAllData_byBranchIDTransactionID($isDeleted, $branchID, $transactionID) {
            return self::model()->find('is_deleted = :isDeleted AND branch_id = :branchID  AND transaction_id = :transactionID ', array(':isDeleted' => $isDeleted,':branchID' => $branchID,':transactionID' => $transactionID));
        }

    }
    