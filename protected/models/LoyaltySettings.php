<?php

    /**
     * This is the model class for table "loyalty_settings".
     *
     * The followings are the available columns in table 'loyalty_settings':
     * @property integer $id
     * @property string $created_at
     * @property string $updated_at
     * @property integer $client_id
     * @property integer $branch_id
     * @property integer $loyalty_type_id
     * @property string $value
     * @property integer $is_sync
     * @property integer $is_deleted
     * @property integer $percentage
     * @property string $name
     */
    class LoyaltySettings extends CActiveRecord {

        /**
         * @return string the associated database table name
         */
        public function tableName() {
            return 'loyalty_settings';
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
                array('created_at, name , value, percentage', 'required'),
                array('client_id, branch_id, loyalty_type_id, is_sync, is_deleted, ', 'numerical', 'integerOnly' => true),
                array('value, percentage', 'length', 'max' => 12),
                array('updated_at', 'safe'),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, created_at, updated_at, client_id, branch_id, loyalty_type_id, value, is_sync, is_deleted, percentage, name', 'safe', 'on' => 'search'),
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
                'loyaltyTypes' => array(self::BELONGS_TO, 'LoyaltyTypes', 'loyalty_type_id'),
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
                'loyalty_type_id' => 'Loyalty Type',
                'value' => 'Value',
                'is_sync' => 'Is Sync',
                'is_deleted' => 'Is Deleted',
                'percentage' => 'Percentage',
                'name' => 'Name'
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

            $criteria->compare('loyalty_type_id', $this->loyalty_type_id);

            $criteria->compare('value', $this->value, true);

            $criteria->compare('is_sync', $this->is_sync);

            $criteria->compare('is_deleted', $this->is_deleted);

            $criteria->compare('percentage', $this->percentage);

            $criteria->compare('name', $this->name);

            $criteria->order = 'created_at DESC';

            return new CActiveDataProvider('LoyaltySettings', array(
                'criteria' => $criteria,
                'pagination' => array(
                    'pageSize' => Utilities::PAGE_SIZE,
                )
            ));
        }

        /**
         * Returns the static model of the specified AR class.
         * @return LoyaltySettings the static model class
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

        public static function model_getAllData_byBranchIDIsDeleted($branchID, $isDeleted) {
            return self::model()->findAll('branch_id = :branchID AND is_deleted = :isDeleted', array(':isDeleted' => $isDeleted, ':branchID' => $branchID));
        }

        public static function sql_updateIsDeleted($id, $isDeleted) {
            $cnn = Utilities::createConnection();
            $sql = 'UPDATE  ' . self::tbl() . ' set is_deleted = :isDeleted WHERE id = :ID limit 1';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':isDeleted', $isDeleted, PDO::PARAM_INT);
            $command->bindValue(':ID', $id, PDO::PARAM_INT);
            return $command->execute();
        }
        

        
                
        public static function sql_getData_byBranchID($branchID, $isDeleted)
        {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT value, percentage FROM ' . self::tbl().' WHERE branch_id = :branchID AND is_deleted = :isDeleted limit 1';
            $command = $cnn->createCommand($sql); 
            $command->bindValue(':branchID', $branchID, PDO::PARAM_INT);
            $command->bindValue(':isDeleted', $isDeleted, PDO::PARAM_INT);
            return $command->queryRow();
        }   
    }
    