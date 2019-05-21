<?php

    /**
     * This is the model class for table "machines".
     *
     * The followings are the available columns in table 'machines':
     * @property integer $id
     * @property string $created_at
     * @property string $updated_at
     * @property integer $client_id
     * @property integer $laundry_shop_id
     * @property integer $branch_id
     * @property string $ip_address
     * @property string $name
     * @property integer $machine_type_id
     * @property integer $machine_status_id
     * @property string $url_machine_activator
     * @property integer $user_id
     * @property string $img_file_path
     * @property string $img_file
     * @property integer $minutes_per_washdry
     * @property integer $minutes_per_cycle
     * @property integer $is_deleted
     * @property integer $is_status_pending_approval
     */
    class Machines extends CActiveRecord {

        /**
         * @return string the associated database table name
         */
        public function tableName() {
            return 'machines';
        }

        public static function tbl() {
            return self::tableName();
        }

        public function beforeSave() {
            if ($this->isNewRecord)
                $model->created_at = Settings::get_DateTime();
            else
                $model->updated_at = Settings::get_DateTime();

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
                array('ip_address, name, branch_id, machine_type_id,  minutes_per_washdry, minutes_per_cycle', 'required', 'on' => 'newRecord'),
                array('machine_status_id', 'required', 'on' => 'updateStatus'),
                array('machine_status_id, user_id, is_deleted ,machine_type_id, is_status_pending_approval', 'numerical', 'integerOnly' => true),
                array('name, img_file_path, img_file , ip_address', 'length', 'max' => 255),
                array('serial_no', 'length', 'max' => 15),
                array('updated_at', 'safe'),
                // array('ip_address', 'unique'),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, created_at, updated_at, client_id, laundry_shop_id, branch_id, ip_address, name, machine_status_id, user_id, img_file_path, img_file, is_deleted, machine_type_id, url_machine_activator,serial_no', 'safe', 'on' => 'search'),
                array('id, created_at, updated_at, client_id, laundry_shop_id, branch_id, ip_address, name, machine_status_id, user_id, img_file_path, img_file, is_deleted, machine_type_id, url_machine_activator,serial_no', 'safe', 'on' => 'searchMachines'),
            );
        }

        /**
         * @return array relational rules.
         */
        public function relations() {
            // NOTE: you may need to adjust the relation name and the related
            // class name for the relations automatically generated below.
            return array(
                'machineTypes' => array(self::BELONGS_TO, 'MachineTypes', 'machine_type_id'),
                'machineStatuses' => array(self::BELONGS_TO, 'MachineStatuses', 'machine_status_id'),
                'branches' => array(self::BELONGS_TO, 'Branches', 'branch_id'),
                'users' => array(self::BELONGS_TO, 'Users', 'user_id'),
                //   'machineTransactionRuntime' => array(self::HAS_MANY, 'MachineTransactionRuntime', 'machine_id'),
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
                'laundry_shop_id' => 'Laundry Shop',
                'branch_id' => 'Branch',
                'ip_address' => 'IP Address',
                'name' => 'Machine Name',
                'machine_status_id' => 'Machine Status',
                'user_id' => 'User',
                'machine_type_id' => 'Machine Type',
                'url_machine_activator' => 'URL Activator',
                'img_file_path' => 'Img File Path',
                'img_file' => 'Img File',
                'minutes_per_washdry' => 'Minuets Per Wash/Dry',
                'minutes_per_cycle' => 'Minutes Per Cycle',
                'serial_no' => 'Serial Number',
                'is_deleted' => 'Is Deleted',
                'is_status_pending_approval' => 'Pending Approval',
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

            $criteria->compare('branch_id', $this->branch_id);

            $criteria->compare('ip_address', $this->ip_address);

            $criteria->compare('name', $this->name, true);

            $criteria->compare('machine_status_id', $this->machine_status_id);

            $criteria->compare('user_id', $this->user_id);

            $criteria->compare('machine_type_id', $this->machine_type_id);

            $criteria->compare('url_machine_activator', $this->url_machine_activator);

            $criteria->compare('img_file_path', $this->img_file_path, true);

            $criteria->compare('img_file', $this->img_file, true);

            $criteria->compare('minutes_per_washdry', $this->minutes_per_washdry, true);

            $criteria->compare('minutes_per_cycle', $this->minutes_per_cycle, true);

            $criteria->compare('serial_no', $this->serial_no);

            $criteria->compare('is_deleted', $this->is_deleted);

            return new CActiveDataProvider('Machines', array(
                'criteria' => $criteria,
            ));
        }

        public function searchMachines() {
            // Warning: Please modify the following code to remove attributes that
            // should not be searched.

            $criteria = new CDbCriteria;

            $criteria->compare('t.id', $this->id);

            $criteria->compare('t.created_at', $this->created_at, true);

            $criteria->compare('t.updated_at', $this->updated_at, true);

            $criteria->compare('t.ip_address', $this->ip_address);

            $criteria->compare('t.branch_id', $this->branch_id);

            $criteria->compare('t.client_id', $this->client_id);

            $criteria->compare('t.name', $this->name, true);

            $criteria->compare('t.machine_status_id', $this->machine_status_id);

            $criteria->compare('t.url_machine_activator', $this->url_machine_activator);

            $criteria->compare('t.user_id', $this->user_id);

            $criteria->compare('t.machine_type_id', $this->machine_type_id);

            $criteria->compare('t.img_file_path', $this->img_file_path, true);

            $criteria->compare('t.img_file', $this->img_file, true);

            $criteria->compare('t.minutes_per_washdry', $this->minutes_per_washdry, true);

            $criteria->compare('t.minutes_per_cycle', $this->minutes_per_cycle, true);

            $criteria->compare('t.serial_no', $this->serial_no);

            $criteria->compare('t.is_deleted', $this->is_deleted);

            $criteria->order = "machine_type_id ASC";

            return new CActiveDataProvider('Machines', array(
                'criteria' => $criteria,
                'pagination' => array(
                    'pageSize' => 30,
                ),
            ));
        }

        /**
         * Returns the static model of the specified AR class.
         * @return Machines the static model class
         */
        public static function model($className = __CLASS__) {
            return parent::model($className);
        }

        public static function model_getAllData_byDeleted($isDeleted) {
            return self::model()->findAll('is_deleted = :isDeleted', array(':isDeleted' => $isDeleted));
        }

        public function getIsDeleted() {
            return Utilities::get_ActiveSelect($this->is_deleted);
        }

        public static function model_getAllData_byID($id) {
            return self::model()->find('id = :id', array(':id' => $id));
        }

        public static function sql_updateStatus_byId($machineID, $machineStatusID) {
            $cnn = Utilities::createConnection();
            $sql = 'Update ' . self::tbl() . ' SET  machine_status_id = :machineStatusID WHERE id = :machineID';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':machineStatusID', $machineStatusID, PDO::PARAM_INT);
            $command->bindValue(':machineID', $machineID, PDO::PARAM_INT);
            $command->execute();
        }

        public function getImage() {
            return CHtml::image(Settings::get_baseUrl() . "/images/" . $this->img_file_path . "/" . $this->img_file, "", array("style" => "width:50px;height:50px;"));
        }

        public static function model_getAllData_byMachineTypeID($machineTypeID, $isDeleted, $branchID) {
            return self::model()->findAll('is_deleted = :isDeleted  AND machine_type_id = :nachineTypeID AND branch_id =:branchID ORDER by id ASC', array(':isDeleted' => $isDeleted, ':nachineTypeID' => $machineTypeID, ':branchID' => $branchID));
        }

        public function getTotalCycleCOunt() {
            //return 0;
            return self::sql_getTotalCycles($this->id);
        }

        public function getButtonLink() {
            if ($this->machine_type_id == Transactions::TRANSACTION_WASHER)
                return CHtml::link('Activate', YII::app()->createUrl('siteadmin/customerTransactions/createTransaction', array("machineID" => $this->id, "transctionID" => Transactions::TRANSACTION_WASHER)), array("class" => "btn btn-primary btn-sm"));
            else
                return CHtml::link('Activate', YII::app()->createUrl('siteadmin/customerTransactions/createTransaction', array("machineID" => $this->id, "transctionID" => Transactions::TRANSACTION_DRYER)), array("class" => "btn btn-primary btn-sm"));
        }

        public function getCustomers() {
            $model = new Customers();
            return CHtml::dropDownList('test', 'id', CHtml::listData(Customers::model_getAllData_byDeleted(Utilities::NO), 'id', 'lnameFname'), array('class' => '', 'prompt' => '--selelct--', 'onclick' => "js: getAction(this.value,'$this->id','$this->machine_type_id','$this->name')"));
        }

        public static function sql_getName_byID($id) {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT name FROM ' . self::tbl() . ' WHERE id = :machineID';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':machineID', $id, PDO::PARAM_INT);
            return $command->queryScalar();
        }

        public static function sql_updatePendingApproval($id, $isPendingApproval) {
            $cnn = Utilities::createConnection();
            $sql = 'UPDATE ' . self::tbl() . ' SET is_status_pending_approval = :isPendingApproval WHERE id = :machineID';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':machineID', $id, PDO::PARAM_INT);
            $command->bindValue(':isPendingApproval', $isPendingApproval, PDO::PARAM_INT);
            $command->execute();
        }

        public function getIsStatusPendingApproval() {
            return Utilities::get_ActiveSelect($this->is_status_pending_approval);
        }

        public static function getTotalMinutesPerTransaction($branchID = null, $transactionID, $machineID) {
            if ($branchID == null) {
                $branchID = Settings::get_BranchID();
            }

//            $totalMinutes = MachineTransactionRuntime::sql_getMinutes_byBranchTransIDMachineID($branchID, $transactionID, $machineID);
//            if ($totalMinutes == 0) {
            return $totalMinutes = Machines::sql_getTotalMinutesPerTransaction_byID($machineID);
//            }
        }

        public static function sql_getTotalMinutesPerTransaction_byID($machineID) {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT minutes_per_washdry FROM ' . self::tbl() . ' WHERE id = :machineID';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':machineID', $machineID, PDO::PARAM_INT);
            return $command->queryScalar();
        }

        public static function sql_getID_byBranchIDAndIP($branchID = NULL, $machineIP) {
            $cnn = Utilities::createConnection();

            if ($branchID == NULL)
                $branchID = Settings::get_BranchID();

            $sql = 'SELECT id FROM ' . self::tbl() . ' WHERE branch_id = :branchID AND ip_address = :machineIP AND is_deleted = :isDeleted limit 1';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':branchID', $branchID, PDO::PARAM_INT);
            $command->bindValue(':machineIP', $machineIP, PDO::PARAM_INT);
            $command->bindValue(':isDeleted', Utilities::NO, PDO::PARAM_INT);
            $totalMinutes = $command->queryScalar();
            return ($totalMinutes != '') ? $totalMinutes : 0;
        }

        public static function sql_getMachineTypeID_byID($id) {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT machine_type_id FROM ' . self::tbl() . ' WHERE id = :machineID';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':machineID', $id, PDO::PARAM_INT);
            return $command->queryScalar();
        }

        public function getStatusRemarks() {

            $remarks = MachineStatusApprovalDetails::sql_getMachineStatusRemarks_byID($this->id);
            if ($remarks)
                $result = $this->machineStatuses->name . ' - ' . $remarks;
            else
                $result = $this->machineStatuses->name;

            return $result;
        }

        public static function sql_getMachineStatusID_byID($id) {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT machine_status_id FROM ' . self::tbl() . ' WHERE id = :machineID';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':machineID', $id, PDO::PARAM_INT);
            return $command->queryScalar();
        }

        public static function sql_getMinutesPerCycle($machineID) {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT minutes_per_cycle FROM ' . self::tbl() . ' WHERE id = :machineID';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':machineID', $machineID, PDO::PARAM_INT);
            return $command->queryScalar();
        }

        public static function sql_getTotalCycles($machineID) {
            $totalMinutes = MachineUsageHeaders::sql_getTotalMinutes_byMachineID($machineID);
            $minutesPerCycle = Machines::sql_getMinutesPerCycle($machineID);
            $totalCycles = floor($totalMinutes / $minutesPerCycle);
            return ($totalCycles > 0) ? $totalCycles : 0;
        }

        public static function sp_updateMachineStatuses() {
            $cnn = Utilities::createConnection();
            $sql = 'call sp_updateMachineStatus();';
            $command = $cnn->createCommand($sql);
            $command->execute();
        }

        public static function activateDebit($custID, $machineIP) {

            $status = Utilities::STATUS_FAILED;
            $customerCards = new CustomerCards();
            $customerCardTransactions = new CustomerCardTransactions();
            $machineIpActivator = 0;

            $customerCards = CustomerCards::model_getData_byCustomerID($custID);

            $branchID = $customerCards->branch_id;
            $status = Utilities::STATUS_SUCCESS;
            $machineID = Machines::sql_getID_byBranchIDAndIP($branchID, $machineIP);

            $modelLoyalty = new LoyaltySettings();

            $modelLoyalty = LoyaltySettings::sql_getData_byBranchID(Settings::get_BranchID(), Utilities::NO);
            $loyaltyPercentage = ($modelLoyalty['percentage'] / 100);
            $percentage = ($loyaltyPercentage != 0) ? $loyaltyPercentage : 0;

            if (Machines::sql_getMachineTypeID_byID($machineID) == MachineTypes::MACHINE_TYPE_WASHER) {
                $transactionID = 1; // wash
                $field = "token_wash";
            } else if (Machines::sql_getMachineTypeID_byID($machineID) == MachineTypes::MACHINE_TYPE_DRYER) {
                $transactionID = 2; // dry
                $field = "token_dry";
            } else {
                $transactionID = 3;
                $field = "token_titan";
            }
            $token = Customers::sql_getToken($custID, $field);

            if ($custID != '' && $machineID != 0) {

                $balance = 0;
                $servicePrice = ServicePrices::model_getAllData_byBranchIDTransactionID(Utilities::NO, $branchID, $transactionID);
                $price = $servicePrice->price;

                $cardBalance = CustomerCardTransactions::sql_getTotalBalance_byCardID($customerCards->id);

                if ($cardBalance > $price) {

                    $result = CustomerTransactions::insertRecord(Settings::get_DateTime(), $branchID, $transactionID, $machineID, $custID, CustomerTransactions::TRANS_TYPE_DEBIT, $price);

                    Machines::sql_updateStatus_byId($machineID, MachineStatuses::STATUS_RUNNING);
                    $status = $result->status;

                    if ($result->status == Utilities::STATUS_SUCCESS) {
                        //Customers::sql_deductToken($custID, 1, $field);
                        $customerCardTransactions->created_at = Settings::get_DateTime();
                        $customerCardTransactions->updated_at = Settings::get_DateTime();
                        $customerCardTransactions->branch_id = $customerCards->branch_id;
                        $customerCardTransactions->client_id = $customerCards->client_id;
                        $customerCardTransactions->customer_id = $custID;
                        $customerCardTransactions->transaction_id = $transactionID;
                        $customerCardTransactions->credited = 0;
                        $customerCardTransactions->debited = $price;
                        $customerCardTransactions->balance = $cardBalance - $price;
                        $customerCardTransactions->user_id = Settings::get_UserID();
                        $customerCardTransactions->remarks = 'Transaction ' . $customerCardTransactions->transactions->name . ' of ' . $customerCardTransactions->customers->name;
                        $customerCardTransactions->card_id = $customerCards->id;
                        $customerCardTransactions->card_no = $customerCards->card_no;
                        $customerCardTransactions->is_deleted = Utilities::NO;
                        $customerCardTransactionsArr = $customerCardTransactions->addRecord();

                        if ($customerCardTransactionsArr[0] != 0) {
                            $posTransactions = new PosTransactions();
                            $posTransactions->created_at = Settings::get_DateTime();
                            $posTransactions->updated_at = Settings::get_DateTime();
                            $posTransactions->trans_date = Settings::get_Date();
                            $posTransactions->branch_id = $customerCards->branch_id;
                            $posTransactions->client_id = $customerCards->client_id;
                            $posTransactions->ref_no = PosTransactions::generateRefNo();
                            $posTransactions->remarks = 'RFID Transaction ' . $customerCardTransactions->transactions->name;
                            $posTransactions->cust_id = $custID;
                            $posTransactions->inv_id = $servicePrice->inv_id;
                            $posTransactions->transaction_id = $transactionID;
                            $posTransactions->transaction_name = $servicePrice->inventories->name;
                            $posTransactions->qty = 1;
                            $posTransactions->price = $servicePrice->price;
                            $posTransactions->amount_net = $servicePrice->price;
                            $posTransactions->balance = 0;
                            $posTransactions->user_id = Settings::get_UserID();
                            $posTransactions->is_fully_paid = Utilities::YES;
                            $posTransactions->is_inventory = $servicePrice->inv_id;
                            $posTransactions->inventory_type_id = $servicePrice->inventories->category_id;
                            $posTransactions->service_type_id = $servicePrice->inventories->service_type_id;
                            $posTransactions->is_deleted = Utilities::NO;
                            $posTransactions->deleted_by = NULL;
                            $posTransactions->points = ($percentage * $model->amount_net);
                            $posTransactions->percentage = $percentage;

                            $posTransactionsArr = $posTransactions->addRecord();
                            if ($posTransactionsArr[0] != 0) {

                                $machineIpActivator = 1;
                                $balance = 0; //Settings::setNumberFormat(CustomerTransactions::sql_getTotalBalance_byCardID($cardID), 2);
                                $message = 'Card Debited P' . Settings::setNumberFormat($price, 2);
                            } else {

                                $machineIpActivator = 0;
                                $message = $posTransactionsArr[1];
                            }
                        } else {
                            $machineIpActivator = 0;
                            $message = $customerCardTransactionsArr[1];
                        }
                    } else {
                        $machineIpActivator = 0;
                        $message = 'Transaction Failed.';
                    }
                } else {
                    $status = Utilities::STATUS_FAILED;
                    $machineIpActivator = 0;
                    $message = 'Insufficient Balance. RFID: ';
                    $price = 0;
                    $balance = 0;
                }
            } else {

                $machineIpActivator = 0;
                $status = Utilities::STATUS_FAILED;

                if ($cardID == '0') {
                    $message = 'RF ID does not exists';
                }

                if ($machineID == '0') {
                    $message .= '<br/>Machine does not exists';
                }
            }

            return $machineIpActivator;
        }

        public static function sql_getTotalCycles_byDateMachineID($date, $machineID) {
            $totalMinutes = MachineUsageHeaders::sql_getTotalMinutes_byMachineID_Date($date, $machineID);
            $minutesPerCycle = Machines::sql_getMinutesPerCycle($machineID);
            $totalCycles = floor($totalMinutes / $minutesPerCycle);
            return ($totalCycles > 0) ? $totalCycles : 0;
        }

        public static function sql_getTotalMinutes_byDateMachineID($date, $machineID) {
            $totalMinutes = MachineUsageHeaders::sql_getTotalMinutes_byMachineID_Date($date, $machineID);
            return ($totalMinutes > 0) ? $totalMinutes : 0;
        }

        public function getTotalCycleCOuntPerDay() {
            //return 0;
            return self::sql_getTotalCycles_byDateMachineID(Settings::get_Date(), $this->id);
        }

        public static function model_getAllData_byDeletedCLientID_branchID($isDeleted, $clientID, $branchID) {
            return self::model()->findAll('is_sync = :isDeleted AND client_id = :clientID AND branch_id = :branchID ', array(':isDeleted' => $isDeleted, ':clientID' => $clientID, ':branchID' => $branchID));
        }
       
         public static function model_getisExist_customerBranchID($ipAddress, $branchID, $name) {
            return self::model()->find('  ip_address = :ipAddress AND branch_id = :branchID AND name = :name', array(':ipAddress' => $ipAddress,':branchID' => $branchID, ':name' => $name));
         }
    }
    