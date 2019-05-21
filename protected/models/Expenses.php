<?php

    /**
     * This is the model class for table "expenses".
     *
     * The followings are the available columns in table 'expenses':
     * @property integer $id
     * @property string $created_at
     * @property string $updated_at
     * @property string $date
     * @property string $ref_no
     * @property integer $branch_id
     * @property integer $client_id
     * @property integer $expenses_type_id
     * @property string $title
     * @property string $amount
     * @property string $remarks
     * @property integer $is_sync
     * @property integer $is_deleted
     * @property integer $emp_id
     */
    class Expenses extends CActiveRecord {

        /**
         * @return string the associated database table name
         */
        public function tableName() {
            return 'expenses';
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
                array('created_at, date, ref_no , remarks,expenses_type_id', 'required'),
                array('branch_id, client_id, expenses_type_id, is_sync, is_deleted, emp_id', 'numerical', 'integerOnly' => true),
                array('ref_no, title', 'length', 'max' => 20),
                array('amount', 'length', 'max' => 12),
                array('remarks', 'length', 'max' => 500),
                array('updated_at', 'safe'),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, created_at, updated_at, date, ref_no, branch_id, client_id, expenses_type_id, amount, remarks, is_sync, is_deleted, emp_id', 'safe', 'on' => 'search'),
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
                'expensesTypes' => array(self::BELONGS_TO, 'ExpensesTypes', 'expenses_type_id'),
                'employees' => array(self::BELONGS_TO, 'Employees', 'emp_id'),
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
                'ref_no' => 'Ref No',
                'branch_id' => 'Branch',
                'client_id' => 'Client',
                'expenses_type_id' => 'Expenses Type',
                'title' => 'Expense Type',
                'amount' => 'Amount',
                'remarks' => 'Remarks',
                'is_sync' => 'Is Sync',
                'is_deleted' => 'Is Deleted',
                'emp_id' => 'Employee Name',
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

            $criteria->compare('ref_no', $this->ref_no, true);

            $criteria->compare('branch_id', $this->branch_id);

            $criteria->compare('client_id', $this->client_id);

            $criteria->compare('expenses_type_id', $this->expenses_type_id);

            $criteria->compare('title', $this->title, true);

            $criteria->compare('amount', $this->amount, true);

            $criteria->compare('remarks', $this->remarks, true);

            $criteria->compare('is_sync', $this->is_sync);

            $criteria->compare('is_deleted', $this->is_deleted);

            $criteria->compare('emp_id', $this->emp_id);

            $criteria->order = 'created_at DESC';

            return new CActiveDataProvider('Expenses', array(
                'criteria' => $criteria,
            ));
        }

        /**
         * Returns the static model of the specified AR class.
         * @return Expenses the static model class
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

        public static function createNewRefNo() {
            $refNo = self::sql_getLastRefNo() + 1;
            if ($refNo == 1) {
                return date('y') . date('m') . Utilities::formatCode(1, 6);
            } else {
                return Utilities::formatCode($refNo, 10);
            }
        }

        public static function sql_getLastRefNo() {
            $cnn = Utilities::createConnection();
            $yearMonth = date('Y') . '-' . date('m');
            $sql = 'SELECT ref_no FROM ' . self::tbl() . ' WHERE `date` LIKE :yearMonth ORDER BY ref_no desc';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':yearMonth', $yearMonth . '%', PDO::PARAM_STR);
            return $command->queryScalar();
        }

        public function addRecord() {
            $model = new Expenses();
            $model->created_at = $this->created_at;
            $model->updated_at = $this->updated_at;
            $model->date = $this->date;
            $model->ref_no = $this->ref_no;
            $model->branch_id = $this->branch_id;
            $model->client_id = $this->client_id;
            $model->expenses_type_id = $this->expenses_type_id;
            $model->title = $this->title;
            $model->amount = $this->amount;
            $model->remarks = $this->remarks;
            $model->is_sync = $this->is_sync;
            $model->is_deleted = $this->is_deleted;
            $model->emp_id = $this->emp_id;

            if ($model->validate()) {
                $model->save();
                $message[0] = $model->id;
                $message[1] = 'Expense  Successfully Created.';
            } else {
                $message[0] = 0;
                $message[1] = Utilities::get_ModelErrors($model->errors);
            }

            //Utilities::debug($model,'adfasdf');
            return $message;
        }

        public static function sql_getTotalExpensesBasedOnDate($id, $date) {
            $criteria = new CDbCriteria;
            $criteria->select = 'SUM(amount) as amount';
            $criteria->together = true;
            $criteria->condition = 'branch_id=:branch_id AND  date <= :date AND is_deleted = :isDeleted';
            $criteria->params = array(':branch_id' => $id, ':date' => $date, ':isDeleted' => Utilities::NO);
            $models = Expenses::model()->find($criteria);


            return ($models->amount != '') ? $models->amount : 0;
        }

        public static function sql_getTotalExpensesTypeIDBasedOnDate($id, $date, $expensesTypeID) {
            $criteria = new CDbCriteria;
            $criteria->select = 'SUM(amount) as amount';
            $criteria->together = true;
            $criteria->condition = 'expenses_type_id=:expensesTypeID AND branch_id=:branch_id AND  date <= :date AND is_deleted = :isDeleted';
            $criteria->params = array(':expensesTypeID' => $expensesTypeID, ':branch_id' => $id, ':date' => $date, ':isDeleted' => Utilities::NO);
            $models = Expenses::model()->find($criteria);


            return ($models->amount != '') ? $models->amount : 0;
        }

        public static function model_getAllData_byDeletedCLientID_branchID($isDeleted, $clientID, $branchID) {
            return self::model()->findAll('is_sync = :isDeleted AND client_id = :clientID AND branch_id = :branchID ', array(':isDeleted' => $isDeleted, ':clientID' => $clientID, ':branchID' => $branchID));
        }

    }
    