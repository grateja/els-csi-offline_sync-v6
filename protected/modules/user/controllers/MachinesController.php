<?php

    class MachinesController extends UserController {
        /**
         * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
         * using two-column layout. See 'protected/views/layouts/column2.php'.
         */
        //public $layout='//layouts/column2';

        /**
         * @var CActiveRecord the currently loaded data model instance.
         */
        private $_model;

        /**
         * @return array action filters
         */
        public function filters() {
            return array(
                'accessControl', // perform access control for CRUD operations
            );
        }

        /**
         * Specifies the access control rules.
         * This method is used by the 'accessControl' filter.
         * @return array access control rules
         */
        public function accessRules() {
            return array(
                array('allow', // allow all users to perform 'index' and 'view' actions
                    //'actions'=>array('create','view','admin','create','update','createTransaction','selectCustomer', 'removeCustomer'),
                    'actions' => array('create', 'admin', 'create', 'update', 'createTransaction', 'selectCustomer', 'removeCustomer', 'remoteActivation', 'remoteActivationSubmit', 'getTotalMinutes'),
                    'users' => array('@'),
                ),
                array('deny', // deny all users
                    'users' => array('*'),
                ),
            );
        }

        /**
         * Displays a particular model.
         */
        public function actionView() {
            $this->render('view', array(
                'model' => $this->loadModel(),
            ));
        }

        /**
         * Creates a new model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         */
        public function actionCreate() {
            $model = new Machines;
            $modelBranch = new Branches();
            Utilities::setMenuActive_Siteadmin(Settings::get_ControllerID(), Settings::get_ActionID());
            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (isset($_POST['Machines'])) {
                $model->attributes = $_POST['Machines'];

                $branchID = Settings::get_BranchID();
                $modelBranch = Utilities::model_getByID($modelBranch, $branchID);

                $_SESSION[Machines::tbl()]['branch_id'] = $model->branch_id;
                $_SESSION[Machines::tbl()]['ip_address'] = $model->ip_address;
                $_SESSION[Machines::tbl()]['name'] = $model->name;
                $_SESSION[Machines::tbl()]['machine_type_id'] = $model->machine_type_id;

                $model->scenario = 'newRecord';
                $model->user_id = Settings::get_UserID();
                $model->created_at = Settings::get_DateTime();
                $model->updated_at = Settings::get_DateTime();
                $model->client_id = $modelBranch->client_id;
                $model->laundry_shop_id = 0;
                $model->branch_id = $branchID;
                $model->is_deleted = Utilities::NO;
                $model->machine_status_id = MachineStatuses::STATUS_IDLE;
                $model->minutes_per_washdry = MachineTypes::sql_getMinutePerUsage($model->machine_type_id);
                $model->minutes_per_cycle = MachineTypes::sql_getMinutePerCycle($model->machine_type_id);

                if ($model->validate()) {
                    $model->save();
                    Machines::clearSessions();
                    Utilities::set_Flash(Utilities::FLASH_SUCCESS, 'New Machine has been successfully added.');
                    $this->redirect(array('admin'));
                } else {
                    Utilities::set_Flash(Utilities::FLASH_ERROR, Utilities::get_ModelErrors($model->errors));
                }
            } else {

                $model->ip_address = $_SESSION[Machines::tbl()]['ip_address'];
                $model->name = $_SESSION[Machines::tbl()]['name'];
                $model->machine_type_id = $_SESSION[Machines::tbl()]['machine_type_id'];
            }

            $this->render('create', array(
                'model' => $model,
            ));
        }

        /**
         * Updates a particular model.
         * If update is successful, the browser will be redirected to the 'view' page.
         */
        public function actionUpdate() {
            $model = $this->loadModel();

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (isset($_POST['Machines'])) {
                $model->attributes = $_POST['Machines'];
                $model->updated_at = Settings::get_DateTime();

                if ($model->validate()) {
                    $model->save();
                    Utilities::set_Flash(Utilities::FLASH_SUCCESS, 'Machine Successfully Updated');
                    $this->redirect(array('admin'));
                } else {
                    Utilities::set_Flash(Utilities::FLASH_ERROR, Utilities::get_ModelErrors($model->errors));
                }
            }

            $this->render('update', array(
                'model' => $model,
            ));
        }

        public function gotoUpdate($id) {
            $this->redirect($this->createUrl('machines/update', array('id' => $id)));
        }

        public function gotoAdmin() {
            $this->redirect($this->createUrl('machines/admin'));
        }

        /**
         * Deletes a particular model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         */
        public function actionDelete() {
            $model = new Machines();
            $id = $_GET['id'];


            if (Yii::app()->request->isPostRequest) {
                // we only allow deletion via POST request
                $model = Utilities::model_getByID(Machines::model(), $id);
                $model->is_deleted = Utilities::YES;
                $model->save();
                // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                if (!isset($_GET['ajax']))
                    $this->redirect(array('index'));
            } else
                throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }

        /**
         * Lists all models.
         */
        public function actionIndex() {
            $dataProvider = new CActiveDataProvider('Machines');
            $this->render('index', array(
                'dataProvider' => $dataProvider,
            ));
        }

        /**
         * Manages all models.
         */
        public function actionAdmin() {
            $model = new Machines('searchMachines');
            $model->unsetAttributes();  // clear any default values  

            if (isset($_GET['Machines']))
                $model->attributes = $_GET['Machines'];
                $model->branch_id = Settings::get_BranchID();
            
            $this->render('admin', array(
                'model' => $model,
            ));
        }

        /**
         * Returns the data model based on the primary key given in the GET variable.
         * If the data model is not found, an HTTP exception will be raised.
         */
        public function loadModel() {
            if ($this->_model === null) {
                if (isset($_GET['id']))
                    $this->_model = Machines::model()->findbyPk($_GET['id']);
                if ($this->_model === null)
                    throw new CHttpException(404, 'The requested page does not exist.');
            }
            return $this->_model;
        }

        /**
         * Performs the AJAX validation.
         * @param CModel the model to be validated
         */
        protected function performAjaxValidation($model) {
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'machines-form') {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
        }

        public function actionSetSessionData() {
            $value = $_GET['value'];
            $_SESSION[Machines::tbl()][$_GET['rowID']][$_GET['fieldID']] = $value;

            print $value;
        }

        public function actionUpdateStatus() {

            $machineID = $_GET['rowID'];
            $val = $_GET['value'];
            $model = Machines::sql_updateStatus_byId($machineID, $val);
            print $val;
        }

        public function actionretReiveSessionChecked() {

            $model = new Machines();
            $model = $model->model_getAllData_byDeleted(Utilities::NO);

            foreach ($model as $machine) {
                $machineLists .= '{"machineID":"' . $machine->id . '","statusID":"' . $machine->status_id . '"},';
            }

            $result = "[" . rtrim($machineLists, ',') . "]";
            $rtnResult['data'] = $result;
            $rtnResult['count'] = count($model);


            print json_encode($rtnResult);
        }

        public function actionCreateTransaction() {

            $model = new Machines();
            $modeltransactions = new CustomerTransactions();
            $modelCustomer = new Customers();
            $transaction = new Transactions();
            $modelCustomerCards = new CustomerCards();
            $modelCards = new CustomerCards('searchCustomerCards');
            $modelCards->unsetAttributes();  // clear any default values
            $machineID = $_GET['machineID'];

            $model = Utilities::model_getByID(Machines::model(), $machineID);

            if (isset($_GET['CustomerCards'])) {
                $modelCards->attributes = $_GET['CustomerCards'];
            }
            $modelCards->is_activated = Utilities::YES;

            $isError = 0;
            $message = NULL;

            if (isset($_POST['CustomerTransactions'])) {
                $modeltransactions->attributes = $_POST['CustomerTransactions'];

                if ($_SESSION[CustomerCards::tbl()]['customer_id'] == '') {
                    Utilities::set_Flash(Utilities::FLASH_ERROR, "Please select customer");
                    $this->gotoCreateTransaction($machineID);
                    exit(1);
                }

                if ($modeltransactions->transaction_id == '') {
                    Utilities::set_Flash(Utilities::FLASH_ERROR, "Please select transaction");
                    $this->gotoCreateTransaction($machineID);
                    exit(1);
                }

                $modeltransactions->customer_id = $_SESSION[CustomerCards::tbl()]['customer_id'];
                $transaction = Utilities::model_getByID(Transactions::model(), $modeltransactions->transaction_id);
                $modelCustomerCards = CustomerCards::model_getData_byID($modeltransactions->customer_id);
                $sevicePrice = ServicePrices::sql_getPrice_byBranchID($model->branch_id, $transaction->id, Settings::get_Date());

                // jaz 20180125 $modelBalance = CustomerTransactions::sql_getTotalBalance_byCardID($modelCustomerCards->id);
                if (Settings::sql_getValue_byID(Settings::CONFIG_ENVIRONMENT_SETUP) == Settings::ENVIRONMENT_SETUP_PRODUCTION) {
                    $url = 'http://' . $model->ip_address . '/?addtime=appWard2018&rfID=' . $modelCustomerCards->rf_id;

                    $useragent = "Laundry CSI";
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                    $result = curl_exec($ch);
                    curl_close($ch);
                } else {
                    $result = 1;
                    Machines::activateDebit($modelCustomerCards->rf_id, $model->ip_address);
                }

                if ($result) {
                    if ($message != "")
                        $isError = Utilities::YES;

                    if ($isError == 0) {
                        $cnn = Utilities::createConnection();
                        $trans = $cnn->beginTransaction();
                        try {
                            $modelBalance = CustomerTransactions::sql_getTotalBalance_byCardID($modelCustomerCards->id);
                            if ($modelBalance >= $sevicePrice) {

                                $isError = Utilities::NO;
                                $trans->commit();
                                Utilities::set_Flash(Utilities::FLASH_SUCCESS, 'Transaction to ' . $model->name . ' Successful.');
                                $this->gotoDashboard();
                            } else {
                                Utilities::set_Flash(Utilities::FLASH_ERROR, $modelCustomer->clientName . ' has an insufficient fund kindly reload a minimum amount of  <b > PHP ' . Settings::setNumberFormat($minumumAmount, 2) . '</b> before continuing with this transaction.');
                                $this->gotoCreateTransaction($machineID);
                            }
                        } catch (Exception $ex) {
                            $isError = 1;
                            Utilities::set_Flash(Utilities::FLASH_ERROR, "Transaction Failed");
                            $trans->rollback();
                        }
                    } else {
                        $isError = Utilities::YES;
                        Utilities::set_Flash(Utilities::FLASH_ERROR, "Transaction Failed");
                    }
                } else {
                    $isError = Utilities::YES;
                    Utilities::set_Flash(Utilities::FLASH_ERROR, "Error Connecting to " . $model->name);
                }
            }


            $this->render('createTransaction', array(
                'modeltransactions' => $modeltransactions,
                'model' => $model,
                'modelCards' => $modelCards,
            ));
        }

        public function gotoDashboard() {

            $this->redirect($this->createUrl('dashboard/index'));
        }

        public function actionSelectCustomer() {

            $model = new CustomerCards();
            $custCardID = $_GET['custCardID'];
            $machineID = $_GET['machineID'];
            $model = Utilities::model_getByID(CustomerCards::model(), $custCardID);


            if ($_SESSION[CustomerCards::tbl()]['customer_id'] != '' || $_SESSION[CustomerCards::tbl()]['customer_id'] != 0) {

                Utilities::set_Flash(Utilities::FLASH_ERROR, "Customer Card already selected.");
                $this->redirect($this->createUrl('machines/createTransaction', array('machineID' => $machineID)));
            }

            $_SESSION[CustomerCards::tbl()]['firstname'] = $model->customers->firstname;
            $_SESSION[CustomerCards::tbl()]['lastname'] = $model->customers->lastname;
            $_SESSION[CustomerCards::tbl()]['rfid'] = $model->rf_id;
            $_SESSION[CustomerCards::tbl()]['customer_id'] = $model->id;

            $this->redirect($this->createUrl('machines/createTransaction', array('machineID' => $machineID)));
        }

        public function actionRemoveCustomer() {
            unset($_SESSION[CustomerCards::tbl()]);
            $machineID = $_GET['machineID'];
            $this->redirect($this->createUrl('machines/createTransaction', array('machineID' => $machineID)));
        }

        public function gotoCreateTransaction($machineID) {

            $this->redirect($this->createUrl('machines/createTransaction', array('machineID' => $machineID)));
        }

        public function updateMachineStatus() {

            $machines = new Machines();
            $crit = new CDbCriteria();
            $crit->condition = 'machine_status_id != :machineStatusID';
            $crit->params = array(':machineStatusID' => MachineStatuses::STATUS_IDLE);
            $crit->order = 'id asc';

            $machines = Machines::model()->findAll($crit);
            foreach ($machines as $machines) {
                $machineUsages = new CustomerMachineUsages();
                $minutesPerUsage = MachineTypes::sql_getMinutePerUsage($machines->machine_type_id);


                $critMachineUsages = new CDbCriteria();
                $critMachineUsages->condition = 'machine_id = :machineID AND start_machine_status = :startMachineStatus AND end_machine_status = :endMachineStatus';
                $critMachineUsages->params = array(':machineID' => $machines->id, ':startMachineStatus' => MachineStatuses::STATUS_RUNNING, ':endMachineStatus' => 0);

                $machineUsages = CustomerMachineUsages::model()->find($critMachineUsages);
                $currentDateTime = Settings::get_DateTime();

                $startDateTime = ($machineUsages->start_datetime);
                $endDateTime = date('Y-m-d H:i:s', strtotime('+' . $minutesPerUsage . ' minutes', strtotime($startDateTime)));

                // Utilities::debug($minutesPerUsage, '$caption');exit();
                if ($endDateTime > $currentDateTime) {
                    CustomerMachineUsages::sql_updateEndDateTime($machines->id, $endDateTime);
                    CustomerMachineUsages::sql_updateEndMachineStatus($machines->id, MachineStatuses::STATUS_IDLE);
                    Machines::sql_updateStatus_byId($machines->id, MachineStatuses::STATUS_IDLE);
                } else {
                    CustomerMachineUsages::sql_updateEndDateTime($machines->id, $endDateTime);
                }
            }
        }

        public function actionRemoteActivation() {
            $this->updateMachineStatus();

            Machines::sp_updateMachineStatuses();

            $this->render('remoteActivation');
        }

        public function actionRemoteActivationSubmit() {

            $model = new Machines();
            $modeltransactions = new CustomerTransactions();
            $modelCustomer = new Customers();
            $transaction = new Transactions();
            $machineID = $_GET['machineID'];
            $custID = $_GET['custID'];
            $model = Utilities::model_getByID(Machines::model(), $machineID);
            $isError = 0;
            $message = NULL;

            if (Machines::sql_getMachineTypeID_byID($machineID) == MachineTypes::MACHINE_TYPE_WASHER) {
                $transactionID = 1; // wash
            } else if (Machines::sql_getMachineTypeID_byID($machineID) == MachineTypes::MACHINE_TYPE_DRYER) {
                $transactionID = 2; // dry
            } else {
                $transactionID = 3;
            }

            $transaction = Utilities::model_getByID(Transactions::model(), $transactionID);
            $sevicePrice = ServicePrices::sql_getPrice_byBranchID($model->branch_id, $transaction->id, Settings::get_Date());


            if ($message != "")
                $isError = Utilities::YES;

            if ($isError == 0) {

                $cnn = Utilities::createConnection();
                $trans = $cnn->beginTransaction();

                try {

                   
                    $result = Machines::activateDebit($custID, $model->ip_address);

                    if ($result != 0) {
                        $activationURL = $this->activateMachine($model);
                        $isError = Utilities::NO;
                        $trans->commit();
                        $message = $model->name . ' successfully activated';
                   
                    } else {

                        $isError = 1;
                        $message = "Transaction Failed";
                    }
                } catch (Exception $ex) {

                    $isError = 1;
                    $message = "Transaction Failed";
                    $trans->rollback();
                }
            } else {

                $isError = Utilities::YES;
                $message = "Transaction Failed";
            }
//       

            $resultArr['isError'] = $isError;
            $resultArr['message'] = $message;
            $resultArr['url'] = $activationURL;

            print json_encode($resultArr);
        }

        
        public function activateMachine($model){
            $url = 'http://' . $model->ip_address . '/' . Utilities::YES;
            // $useragent = "Laundry CSI";
            // $ch = curl_init();
            // curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
            // curl_setopt($ch, CURLOPT_URL, $url);
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            // $result = curl_exec($ch);
            // curl_close($ch);
           return $url;
        }
        public function actionGetTotalMinutes() {

            $model = new MachineUsageHeaders();
            $modelMachines = new Machines();


            $modelMachines = Utilities::model_getByID($modelMachines, $_GET['machineID']);
            $machineUsageHeaderID = MachineUsageHeaders::sql_getLastID_byMachineID($modelMachines->id);
            $model = Utilities::model_getByID($model, $machineUsageHeaderID);

            if ($modelMachines->machine_status_id == 2) {
                $sDate1 = $model->end_datetime;
                $sDate2 = Settings::get_DateTime();
                $dateInterval = Settings::model()->DateDiffInterval($sDate1, $sDate2, $sUnit = 'M');
            } else {
                $dateInterval = 0;
            }

            print $dateInterval;
        }

    }
    