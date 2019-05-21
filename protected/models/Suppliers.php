<?php

    /**
     * This is the model class for table "suppliers".
     *
     * The followings are the available columns in table 'suppliers':
     * @property integer $id
     * @property string $created_at
     * @property string $updated_at
     * @property integer $branch_id
     * @property integer $client_id
     * @property string $firstname
     * @property string $middlename
     * @property string $lastname
     * @property string $company_name
     * @property string $address
     * @property string $email
     * @property string $mobile
     * @property string $phone
     * @property integer $is_sync
     * @property integer $is_deleted
     */
    class Suppliers extends CActiveRecord {

        /**
         * @return string the associated database table name
         */
        public function tableName() {
            return 'suppliers';
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
                array('created_at, branch_id, client_id, firstname, lastname, company_name', 'required'),
                array('branch_id, client_id, is_sync, is_deleted', 'numerical', 'integerOnly' => true),
                array('firstname, middlename, lastname', 'length', 'max' => 50),
                array('company_name, address, email', 'length', 'max' => 100),
                array('mobile, phone', 'length', 'max' => 15),
                array('updated_at', 'safe'),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, created_at, updated_at, branch_id, client_id, firstname, middlename, lastname, company_name, address, email, mobile, phone, is_sync, is_deleted', 'safe', 'on' => 'search'),
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
                'branch_id' => 'Branch',
                'client_id' => 'Client',
                'firstname' => 'Firstname',
                'middlename' => 'Middlename',
                'lastname' => 'Lastname',
                'company_name' => 'Company Name',
                'address' => 'Address',
                'email' => 'Email',
                'mobile' => 'Mobile',
                'phone' => 'Phone',
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

            $criteria->compare('branch_id', $this->branch_id);

            $criteria->compare('client_id', $this->client_id);

            $criteria->compare('firstname', $this->firstname, true);

            $criteria->compare('middlename', $this->middlename, true);

            $criteria->compare('lastname', $this->lastname, true);

            $criteria->compare('company_name', $this->company_name, true);

            $criteria->compare('address', $this->address, true);

            $criteria->compare('email', $this->email, true);

            $criteria->compare('mobile', $this->mobile, true);

            $criteria->compare('phone', $this->phone, true);

            $criteria->compare('is_sync', $this->is_sync);

            $criteria->compare('is_deleted', $this->is_deleted);

            $criteria->order = 'created_at DESC';

            return new CActiveDataProvider('Suppliers', array(
                'criteria' => $criteria,
                'pagination' => array(
                    'pageSize' => Utilities::PAGE_SIZE,
                )
            ));
        }

        /**
         * Returns the static model of the specified AR class.
         * @return Suppliers the static model class
         */
        public static function model($className = __CLASS__) {
            return parent::model($className);
        }

        public static function model_getAllData_byDeleted($isDeleted) {
            return self::model()->findAll('is_deleted = :isDeleted', array(':isDeleted' => $isDeleted));
        }

        public static function model_getAllData_byDeletedClientID($isDeleted, $clientID) {
            return self::model()->findAll('client_id = :clientID AND is_deleted = :isDeleted', array(':clientID' => $clientID, ':isDeleted' => $isDeleted));
        }

        function getIsDeleted() {
            return Utilities::get_ActiveSelect($this->is_deleted);
        }

        public function getFullname() {
            $fullname = Settings::setCapitalAll($this->lastname) . ', ' . Settings::setCapitalFirst($this->firstname) . ' ' . Settings::setCapitalFirst(substr($this->middlename, 0, 1)) . '.';

            return $fullname;
        }

    }
    