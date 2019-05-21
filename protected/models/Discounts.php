<?php

    /**
     * This is the model class for table "discounts".
     *
     * The followings are the available columns in table 'discounts':
     * @property integer $id
     * @property string $created_at
     * @property string $updated_at
     * @property integer $client_id
     * @property integer $branch_id
     * @property string $name
     * @property integer $discount_type_id
     * @property string $value
     * @property integer $is_sync
     * @property integer $is_deleted
     */
    class Discounts extends CActiveRecord {

        /**
         * @return string the associated database table name
         */
        
        
        const   DISCOUNT_CASH = 1;
        const DISCOUNT_PERCENTAGE= 2;
        
        public static function get_type($id = null) {
            $active = array(
                self::DISCOUNT_CASH => 'Cash',
                self::DISCOUNT_PERCENTAGE => 'Percentage',
            );
            if (is_null($id))
                return $active;
            else
                return $active[$id];
        }

        public function tableName() {
            return 'discounts';
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
                array('created_at', 'required'),
                array('client_id, branch_id, discount_type_id, is_sync, is_deleted', 'numerical', 'integerOnly' => true),
                array('name', 'length', 'max' => 50),
                array('value', 'length', 'max' => 12),
                array('updated_at', 'safe'),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, created_at, updated_at, client_id, branch_id, name, discount_type_id, value, is_sync, is_deleted', 'safe', 'on' => 'search'),
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
                'client_id' => 'Client',
                'branch_id' => 'Branch',
                'name' => 'Name',
                'discount_type_id' => 'Discount Type',
                'value' => 'Value',
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

            $criteria->compare('client_id', $this->client_id);

            $criteria->compare('branch_id', $this->branch_id);

            $criteria->compare('name', $this->name, true);

            $criteria->compare('discount_type_id', $this->discount_type_id);

            $criteria->compare('value', $this->value, true);

            $criteria->compare('is_sync', $this->is_sync);

            $criteria->compare('is_deleted', $this->is_deleted);

            $criteria->order = 'created_at DESC';

            return new CActiveDataProvider('Discounts', array(
                'criteria' => $criteria,
                'pagination' => array(
                    'pageSize' => Utilities::PAGE_SIZE,
                )
            ));
        }

        /**
         * Returns the static model of the specified AR class.
         * @return Discounts the static model class
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

           public static function sql_getAllData_byID($discountID) {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT *   FROM ' . self::tbl() . ' WHERE id = :discountiD';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':discountiD', $discountID, PDO::PARAM_INT);
            return $command->queryRow();
        }
        
        
        public static function model_getAllData_byDeletedBranchID($isDeleted, $branchID) {
            return self::model()->findAll('is_deleted = :isDeleted AND branch_id = :branchID', array(':isDeleted' => $isDeleted, ':branchID' => $branchID));
        }
    }
    