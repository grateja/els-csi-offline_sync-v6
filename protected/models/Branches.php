<?php

    /**
     * This is the model class for table "branches".
     *
     * The followings are the available columns in table 'branches':
     * @property integer $id
     * @property string $created_at
     * @property string $updated_at
     * @property integer $client_id
     * @property string $address
     * @property double $latitude
     * @property double $longitude
     * @property integer $is_sync
     * @property integer $is_deleted
     * @property string $name
     * @property string $contact_no
     * @property string $header_rcpt_msg
     * @property string $footer_rcpt_msg
     * @property string $email_address
     * @property string $file_path
     * @property string $file_pics
     * @property integer $user_id
     * @property integer $city_id
     */
    class Branches extends CActiveRecord {

        /**
         * @return string the associated database table name
         */
        public function tableName() {
            return 'branches';
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
                array('created_at, name, address, city_id', 'required'),
                array('client_id, is_sync, is_deleted ,user_id, city_id', 'numerical', 'integerOnly' => true),
                array('latitude, longitude', 'numerical'),
                array('address, name, file_path, file_pics', 'length', 'max' => 100),
                array('updated_at', 'safe'),
                array(' contact_no, header_rcpt_msg, footer_rcpt_msg, email_address', 'length', 'max' => 255),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, created_at, updated_at, client_id, address, latitude, longitude, is_sync, is_deleted, name, contact_no, header_rcpt_msg, footer_rcpt_msg, email_address, file_path, file_pics, user_id, city_id', 'safe', 'on' => 'search'),
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
                'branches' => array(self::HAS_MANY, 'Branches', 'branch_id'),
                'users' => array(self::HAS_MANY, 'Users', 'user_id'),
                'municipalities' => array(self::BELONGS_TO, 'Municipalities', 'city_id'),
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
                'address' => 'Address',
                'latitude' => 'Latitude',
                'longitude' => 'Longitude',
                'is_sync' => 'Is Sync',
                'is_deleted' => 'Is Deleted',
                'name' => 'Shop Name',
                'contact_no' => 'Contact Number',
                'header_rcpt_msg' => 'Receipt Header',
                'footer_rcpt_msg' => 'Receipt Footer ',
                'email_address' => 'Email Address',
                'file_path' => 'Path',
                'file_pics' => 'File Name',
                'user_id' => 'Username',
                'city_id' => 'City',
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

            $criteria->compare('address', $this->address, true);

            $criteria->compare('latitude', $this->latitude);

            $criteria->compare('longitude', $this->longitude);

            $criteria->compare('is_sync', $this->is_sync);

            $criteria->compare('is_deleted', $this->is_deleted);

            $criteria->compare('name', $this->name, true);

            $criteria->compare('contact_no', $this->contact_no, true);

            $criteria->compare('header_rcpt_msg', $this->header_rcpt_msg, true);

            $criteria->compare('footer_rcpt_msg', $this->footer_rcpt_msg, true);

            $criteria->compare('email_address', $this->email_address, true);

            $criteria->compare('file_path', $this->file_path, true);

            $criteria->compare('file_pics', $this->file_pics, true);

            $criteria->compare('user_id', $this->user_id);

            $criteria->compare('city_id', $this->city_id);

            $criteria->order = 'created_at DESC';

            return new CActiveDataProvider('Branches', array(
                'criteria' => $criteria,
                'pagination' => array(
                    'pageSize' => Utilities::PAGE_SIZE,
                )
            ));
        }

        /**
         * Returns the static model of the specified AR class.
         * @return Branches the static model class
         */
        public static function model($className = __CLASS__) {
            return parent::model($className);
        }

        public static function model_getAllData_byDeleted($isDeleted) {
            return self::model()->findAll('is_deleted = :isDeleted', array(':isDeleted' => $isDeleted));
        }

        public static function model_getAllData_byClientId($clientId) {
            return self::model()->findAll('client_id = :clientID AND is_deleted = :isDeleted', array(':clientID' => $clientId, ':isDeleted' => Utilities::NO));
        }

        function getIsDeleted() {
            return Utilities::get_ActiveSelect($this->is_deleted);
        }

        public static function model_getValue_byID($id) {
            return self::model()->findByPk($id);
        }

        public static function model_getAllData_byClientId_isSync($clientId) {
            return self::model()->findAll('client_id = :clientID AND is_deleted = :isDeleted AND is_sync = :isSync', array(':clientID' => $clientId, ':isDeleted' => Utilities::NO, ':isSync' => Utilities::NO));
        }

        public static function model_getData_byDeletedEmailAddress($isDeleted, $name) {
            return self::model()->find('is_deleted = :isDeleted AND name = :name', array(':isDeleted' => $isDeleted, ':name' => $name));
        }
        
            
    public function addRecord()
        {
            $model = new Clients();
            $model->created_at = $this->created_at;
            $model->updated_at = $this->updated_at;
            $model->client_id = $this->client_id;
            $model->address = $this->address;
            $model->latitude = $this->latitude;
            $model->longitude = $this->longitude;
            $model->name = $this->name;
            $model->contact_no = $this->contact_no;
            $model->header_rcpt_msg = $this->header_rcpt_msg;
            $model->footer_rcpt_msg = $this->footer_rcpt_msg;
            $model->email_address = $this->email_address;
            $model->file_path = $this->file_path;
            $model->file_pics = $this->file_pics;
            $model->user_id = $this->user_id;
            $model->city_id = $this->city_id;
            $model->is_sync = $this->is_sync;
            $model->is_deleted = $this->is_deleted;
            
            
            $model->validate();
            if($model->save()) {
                $ID = $model->id;
                $message = 'Successfully Inserted';
            } else {
                $ID = 0;
                $message = 'Failed to Insert';
            }
            return array('ID' => $ID, 'message' => $message);
            
        }   

    }
    