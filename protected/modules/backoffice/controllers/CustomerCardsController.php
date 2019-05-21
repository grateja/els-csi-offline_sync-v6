<?php

    class CustomerCardsController extends BackOfficeController {
        /**
         * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
         * using two-column layout. See 'protected/views/layouts/column2.php'.
         */
//	public $layout='//layouts/column2';

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
                    'actions' => array('create', 'view', 'delete', 'admin', 'update', 'activate', 'adminLoading', 'createLoading', 'paymentHistorySelect', 'topup'),
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

        public function validateCardRegistration($custID, $detailID, $cardNo) {
            if (RewardCardsCreatedDetails::sql_isExists($cardNo) == Utilities::NO) {
                Utilities::set_FlashError('Card No ' . $cardNo . ' doest not exists.');
                $this->gotoCreate($custID, $detailID);
            }
        }

        public function gotoCreate($custID, $detailID) {
            $this->redirect($this->createUrl('customerCards/create', array('custID' => $custID, 'detailID' => $detailID)));
        }

        public function validateCardDetails($custID, $detailID, $cardNo) {
            if (RewardCardsCreatedDetails::sql_isAvailable_byCardNo($cardNo) == Utilities::NO) {
                Utilities::set_FlashError('Invalid Card No.');
                $this->gotoCreate($custID, $detailID);
            }
        }

        /**
         * Creates a new model.
         * If creation is successful, the browser will be redirected to the 'view    
         */
        public function actionCreate() {
            $model = new CustomerCards;
            $customers = new Customers();
            $branchID = Settings::get_BranchID();

            if ($_GET['custID'] == '') {
                $this->redirect($this->createUrl('customers/admin'));
                throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
            }


            $customers = Utilities::model_getByID(Customers::model(), $_GET['custID']);


            if (isset($_POST['CustomerCards'])) {
                $model->attributes = $_POST['CustomerCards'];
                $model->rf_id = Utilities::setLowerAll($model->rf_id);


                $_SESSION[CustomerCards::tbl()]['reg_date'] = $model->reg_date;
                $_SESSION[CustomerCards::tbl()]['rf_id'] = $model->rf_id;
                $_SESSION[CustomerCards::tbl()]['card_no'] = $model->rf_id;


                $model->created_at = Settings::get_DateTime();
                $model->updated_at = Settings::get_DateTime();
                $model->reg_date = Settings::get_DateTime();
                $model->last_trans_date = Settings::get_Date();
                $model->exp_date = date('Y-m-d', Utilities::addDays(Settings::get_Date(), Settings::sql_getValue_byID(Settings::CONFIG_CARD_EXPIRATION_DAYS)));
                $model->card_id = 1;
                $model->customer_id = $_GET['custID'];
                $model->user_id = Settings::get_UserID();
                $model->emp_id = Settings::get_EmployeeID();
                $model->is_sales = Utilities::YES;
                $model->is_activated = ($model->rf_id != '') ? Utilities::YES : Utilities::NO;
                $model->is_deleted = Utilities::NO;
                $model->card_no = $model->rf_id;
                $model->branch_id = Settings::get_BranchID();
                $model->client_id = Settings::get_ClientID();
                if ($model->card_type_id != Utilities::REGULAR_CARD) {
                    Employees::sql_updateIsWithCard($model->card_user_id, Utilities::YES);
                }

                if ($model->validate()) {
                    $model->save();
                    $customers->is_activated = Utilities::YES;
                    $customers->save();
                    Utilities::set_Flash(Utilities::FLASH_SUCCESS, 'Customer Cards Successfully Created');
                    CustomerCards::clearSessions();
                    $this->redirect($this->createUrl('customers/admin'));
                } else {
                    Utilities::set_Flash(Utilities::FLASH_ERROR, Utilities::get_ModelErrors($model->errors));
                    $this->gotoCreate($_GET['custID'], $_GET['detailID']);
                }
            } else {
                $model->reg_date = ($_SESSION[CustomerCards::tbl()]['reg_date'] != '') ? $_SESSION[CustomerCards::tbl()]['reg_date'] : Settings::get_Date();
                $model->card_no = $_SESSION[CustomerCards::tbl()]['card_no'];
                $model->rf_id = $_SESSION[CustomerCards::tbl()]['rf_id'];
                $model->laundry_shop_id = $_SESSION[CustomerCards::tbl()]['laundry_shop_id'];
            }

            $this->render('create', array(
                'model' => $model,
                'customers' => $customers
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

            if (isset($_POST['CustomerCards'])) {
                $model->attributes = $_POST['CustomerCards'];
                $model->updated_at = Settings::get_DateTime();
                if ($model->validate()) {
                    $model->save();
                    Utilities::set_Flash(Utilities::FLASH_SUCCESS, 'Customer Cards Successfully Updated');
                } else {
                    Utilities::set_Flash(Utilities::FLASH_ERROR, Utilities::get_ModelErrors($model->errors));
                }
                $this->redirect(array('view', 'id' => $model->id));
            }

            $this->render('update', array(
                'model' => $model,
            ));
        }

        /**
         * Deletes a particular model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         */
        public function actionDelete() {
            $model = new CustomerCards();
            if (Yii::app()->request->isPostRequest) {
                // we only allow deletion via POST request
                $model = Utilities::model_getByID($model, $_GET['id']);
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
            $dataProvider = new CActiveDataProvider('CustomerCards');
            $this->render('index', array(
                'dataProvider' => $dataProvider,
            ));
        }

        /**
         * Manages all models.
         */
        public function actionAdmin() {
            $model = new CustomerCards('searchStoreOIC');
            $customers = new Customers();
            $model->unsetAttributes();  // clear any default values


            if ($_GET['custID'] != '') {
                $customers = Utilities::model_getByID(Customers::model(), $_GET['custID']);
            }

            if (isset($_GET['CustomerCards'])) {
                $model->attributes = $_GET['CustomerCards'];
            } else {
                if ($_GET['custID'] != '') {
                    $model->customer_id = $_GET['custID'];
                    $model->is_activated = Utilities::YES;
                    $model->branch_id = Settings::get_BranchID();
                }
            }

            $this->render('admin', array(
                'model' => $model,
                'customers' => $customers
            ));
        }

        /**
         * Returns the data model based on the primary key given in the GET variable.
         * If the data model is not found, an HTTP exception will be raised.
         */
        public function loadModel() {
            if ($this->_model === null) {
                if (isset($_GET['id']))
                    $this->_model = CustomerCards::model()->findbyPk($_GET['id']);
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
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'customer-cards-form') {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
        }

        public function actionActivate() {
            $model = new customerCards();
            $customerCardID = $_GET['customerCardID'];

            $model = Utilities::model_getByID(CustomerCards::model(), $customerCardID);

            if (isset($_POST['CustomerCards'])) {
                $model->attributes = $_POST['CustomerCards'];
                $model->updated_at = Settings::get_DateTime();
                $model->is_activated = Utilities::YES;
                $model->rf_id = $_POST['CustomerCards']['rf_id'];
                if ($model->validate()) {
                    $model->save();
                    Utilities::set_Flash(Utilities::FLASH_SUCCESS, 'Customer Cards Successfully Activated');
                } else {
                    Utilities::set_Flash(Utilities::FLASH_ERROR, Utilities::get_ModelErrors($model->errors));
                }
                $this->redirect(array('view', 'id' => $model->id));
            }

            $this->render('activate', array(
                'model' => $model,
            ));
        }

        public function actionAdminLoading() {
            $model = new CustomerCards('searchLoading');
            $model->unsetAttributes();  // clear any default values


            MenuStoreoic::clearMenu();
            MenuStoreoic::setMenuClassActive(MenuStoreoic::MENU_STOREOIC_LOADING, Utilities::YES);
            if (isset($_GET['CustomerCards']))
                $model->attributes = $_GET['CustomerCards'];
            $model->is_activated = Utilities::YES;
            $model->branch_id = Settings::get_BranchID();

            $this->render('adminLoading', array(
                'model' => $model,
            ));
        }

        public function actionCreateLoading() {
            $model = new CustomerTransactions;
            $modelCustomer = new Customers();
            $modelCards = new CustomerCards();
            $userWalletModel = new UsersWalletTransactions();

            $customerCardID = $_GET['customerCardID'];
            $modelCards = Utilities::model_getByID(CustomerCards::model(), $customerCardID);
            $modelCustomer = Utilities::model_getByID(Customers::model(), $modelCards->customer_id);

            if (isset($_POST['CustomerTransactions'])) {

                $cnn = Utilities::createConnection();
                $trans = $cnn->beginTransaction();
                try {

                    $model->attributes = $_POST['CustomerTransactions'];

                    if ($model->credited <= 0 || $model->credited == '') {
                        Utilities::set_Flash(Utilities::FLASH_ERROR, 'Amount should be greater than zero.');
                        $this->gotoCreateLoading($customerCardID);
                    }

                    $result = CustomerTransactions::insertRecord(Settings::get_DateTime(), $branchID = 0, Transactions::TRANSACTION_TOPUP, $machineID = 0, $modelCards->rf_id, CustomerTransactions::TRANS_TYPE_CREDIT, $model->credited);

                    if ($result->status == Utilities::STATUS_SUCCESS) {

                        $userWalletModel->created_at = Settings::get_DateTime();
                        $userWalletModel->updated_at = Settings::get_DateTime();
                        $userWalletModel->branch_id = $modelCards->branch_id;
                        $userWalletModel->trans_type = Transactions::TRANSACTION_TOPUP;
                        $userWalletModel->credited = $model->credited;
                        $userWalletModel->debited = Utilities::NO;
                        $userWalletModel->balance = CustomerTransactions::sql_getTotalBalance_byCardID($modelCards->id);
                        $userWalletModel->client_user_id = Settings::get_ClientID();
                        $userWalletModel->loadto_card_id = $modelCards->id;
                        $userWalletModel->loadto_user_id = $modelCustomer->id;
                        $userWalletModel->loadfrom_user_id = Settings::get_UserID();
                        $userWalletModel->remarks = $model->remarks;
                        $userWalletModel->is_deleted = Utilities::NO;
                        $userWalletModelArr = $userWalletModel->addRecord();

                        if ($userWalletModelArr->id != 0) {

                            CustomerCards::clearSessions();
                            Utilities::set_Flash(Utilities::FLASH_SUCCESS, 'Customer Transaction Successfully Created');
                            $trans->commit();
                        } else {
                            $isError = 1;
                            Utilities::set_Flash(Utilities::FLASH_ERROR, $userWalletModelArr[1]);
                        }
                    } else {
                        $isError = 1;
                        Utilities::set_Flash(Utilities::FLASH_ERROR, Utilities::get_ModelErrors($model->errors));
                    }
                } catch (Exception $ex) {
                    $trans->rollback();
                    Utilities::set_Flash(Utilities::FLASH_ERROR, $ex->getMessage());
                }
            } else {
                $model->customer_id = $_SESSION[CustomerCards::tbl()]['customer_id'];
                $model->machine_id = $_SESSION[CustomerCards::tbl()]['machine_id'];
                $model->transaction_id = $_SESSION[CustomerCards::tbl()]['transaction_id'];
                $model->credited = $_SESSION[CustomerCards::tbl()]['credited'];
            }

            $this->render('createLoading', array(
                'model' => $model,
                'modelCards' => $modelCards,
                'modelCustomer' => $modelCustomer,
            ));
        }

        public function gotoCreateLoading($custID) {
            $this->redirect($this->createUrl('customerCards/createLoading', array('customerCardID' => $custID)));
        }

        public function actionPaymentHistorySelect() {
            $model = new CustomerCards('searchStoreOIC');
            $customers = new Customers();
            $model->unsetAttributes();  // clear any default values

            MenuStoreoic::clearMenu();
            MenuStoreoic::setMenuClassActive(MenuStoreoic::MENU_STOREOIC_CUSTOMERCARDS, Utilities::YES);

            if ($_GET['custID'] != '') {
                $customers = Utilities::model_getByID(Customers::model(), $_GET['custID']);
            }

            if (isset($_GET['CustomerCards'])) {
                $model->attributes = $_GET['CustomerCards'];
            } else {
                if ($_GET['custID'] != '') {
                    $model->customer_id = $_GET['custID'];
                    $model->is_activated = Utilities::YES;
                }
            }

            $this->render('paymentHistorySelect', array(
                'model' => $model,
                'customers' => $customers
            ));
        }

        public function actionTopup() {
            $model = new CustomerCardTransactions;
            $modelCustomer = new Customers();
            $modelCards = new CustomerCards();


            $customerCardID = $_GET['customerID'];
            $amount = $_GET['transAmount'];
            $transactionType = $_GET['transactionType'];

            $isError = 0;
            $message = NULL;

            $modelCards = Utilities::model_getByID(CustomerCards::model(), $customerCardID);
            $modelCustomer = Utilities::model_getByID(Customers::model(), $modelCards->customer_id);

            if ($customerCardID == '') {
                $isError = Utilities::YES;
                $message = 'Please select a customer!.';
            }
            if ($amount == '' || $amount == 0) {

                $isError = Utilities::YES;
                $message = 'Please input a valid amount!.';
            }
            if ($isError == Utilities::NO) {

                $cnn = Utilities::createConnection();
                $trans = $cnn->beginTransaction();

                try {

                    $model->created_at = Settings::get_DateTime();
                    $model->updated_at = Settings::get_DateTime();
                    $model->branch_id = Settings::get_BranchID();
                    $model->client_id = Settings::get_ClientID();
                    $model->customer_id = $modelCustomer->id;
                    $model->transaction_id = Transactions::TRANSACTION_TOPUP;

                    if ($transactionType == CustomerCardTransactions::TRANS_TYPE_CREDIT) {
                        $credited = $amount;
                        $debited = 0;
                        $remarks = 'Topup of ';
                    } else {
                        $credited = 0;
                        $debited = $amount;
                        $remarks = 'Topdown of ';
                    }

                    $model->card_id = $modelCards->id;
                    $model->card_no = $modelCards->rf_id;
                    $model->credited = $credited;
                    $model->debited = $debited;
                    $model->balance = 0;
                    $model->user_id = Settings::get_UserID();
                    $model->remarks = $remarks . $modelCustomer->lnameFname;
                    $model->is_deleted = Utilities::NO;
                    $modelArr = $model->addRecord();

                    if ($modelArr[0] != 0) {
                        $trans->commit();
                        CustomerTransactions::clearSessions();
                        $message = 'Customer Transaction Successfully Created';
                    } else {
                        $message = Utilities::get_ModelErrors($model->errors);
                    }
                } catch (Exception $ex) {
                    $message = $ex->getMessage();
                    $isError = 1;
                    $trans->rollback();
                }
            }


            $resultArr['isError'] = $isError;
            $resultArr['message'] = $message;

            print json_encode($resultArr);
        }

    }
    