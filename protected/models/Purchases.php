<?php

    /**
     * This is the model class for table "purchases".
     *
     * The followings are the available columns in table 'purchases':
     * @property integer $id
     * @property string $created_at
     * @property string $updated_at
     * @property string $date
     * @property integer $supplier_id
     * @property string $received_by_empid
     * @property integer $user_id
     * @property integer $inv_id
     * @property integer $qty
     * @property string $price
     * @property string $total
     * @property integer $expenses_id
     * @property integer $is_deleted
     * @property integer $client_id
     * @property integer $branch_id
     */
    class Purchases extends CActiveRecord {

        /**
         * @return string the associated database table name
         */
        public function tableName() {
            return 'purchases';
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
                array('created_at, qty, price, total, expenses_id', 'required'),
                array('supplier_id, user_id, inv_id, qty, expenses_id, is_deleted, client_id, branch_id', 'numerical', 'integerOnly' => true),
                array('received_by_empid', 'length', 'max' => 11),
                array('price, total', 'length', 'max' => 12),
                array('updated_at, date', 'safe'),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, created_at, updated_at, date, supplier_id, received_by_empid, user_id, inv_id, qty, price, total, expenses_id, is_deleted, client_id, branch_id', 'safe', 'on' => 'search'),
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
                'branches' => array(self::BELONGS_TO, 'Branches', 'branch_id'),
                'inventories' => array(self::BELONGS_TO, 'Inventories', 'inv_id'),
                'suppliers' => array(self::BELONGS_TO, 'Suppliers', 'supplier_id'),
                'users' => array(self::BELONGS_TO, 'Users', 'user_id'),
                'expenses' => array(self::BELONGS_TO, 'Expenses', 'expenses_id'),
                'employees' => array(self::BELONGS_TO, 'Employees', 'received_by_empid'),
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
                'date' => 'Date',
                'supplier_id' => 'Supplier',
                'received_by_empid' => 'Received By Empid',
                'user_id' => 'User',
                'inv_id' => 'Inv',
                'qty' => 'Qty',
                'price' => 'Price',
                'total' => 'Total',
                'expenses_id' => 'Expenses',
                'is_deleted' => 'Is Deleted',
                'client_id' => 'Client',
                'branch_id' => 'Branch',
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

            $criteria->compare('t.date', $this->date, true);

            $criteria->compare('t.supplier_id', $this->supplier_id);

            $criteria->compare('t.received_by_empid', $this->received_by_empid, true);

            $criteria->compare('t.user_id', $this->user_id);

            $criteria->compare('t.inv_id', $this->inv_id);

            $criteria->compare('t.qty', $this->qty);

            $criteria->compare('t.price', $this->price, true);

            $criteria->compare('t.total', $this->total, true);

            $criteria->compare('t.expenses_id', $this->expenses_id);

            $criteria->compare('t.is_deleted', $this->is_deleted);

            $criteria->compare('t.client_id', $this->client_id);

            $criteria->compare('t.branch_id', $this->branch_id, true);

            $criteria->order = 'created_at DESC';

            return new CActiveDataProvider('Purchases', array(
                'criteria' => $criteria,
                'pagination' => array(
                    'pageSize' => Utilities::PAGE_SIZE,
                )
            ));
        }

        /**
         * Returns the static model of the specified AR class.
         * @return Purchases the static model class
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
        
        
        public static function model_getAllData_byDeletedCLientID_branchID($isDeleted, $clientID, $branchID) {
            return self::model()->findAll('is_sync = :isDeleted AND client_id = :clientID AND branch_id = :branchID ', array(':isDeleted' => $isDeleted, ':clientID' => $clientID, ':branchID' => $branchID));
        }

    }
    