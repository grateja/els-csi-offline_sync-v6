<?php

    class PosTransactionsController extends BackOfficeController {
        /**
         * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
         * using two-column layout. See 'protected/views/layouts/column2.php'.
         */

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
                array('allow', // allow authenticated user to perform 'create' and 'update' actions
                    'actions' => array(
                        'create',
                        'update',
                        'delete',
                        'admin',
                        'view',
                        'saveInventoryTransaction',
                        'appendTransaction',
                        'searchTransactions',
                        'deleteInventory',
                        'getDiscountType',
                        'saveTransactions',
                        'submitPayment',
                        'printReceipt',
                        'getUnsavedTransactions',
                        'adminTransactionLists',
                        'adminUnpaidTransactions',
                        'generateTransactionReport',
                        'printReport',
                        'print',
                        'getPesoValue',
                        'syncRecords'
                    ),
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
            $model = new PosTransactions;

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (isset($_POST['PosTransactions'])) {
                $model->attributes = $_POST['PosTransactions'];
                $model->created_at = Settings::get_DateTime();
                $model->updated_at = Settings::get_DateTime();

                if ($model->validate()) {
                    $model->save();
                    Utilities::set_Flash(Utilities::FLASH_SUCCESS, 'New PosTransactions Successfully Created.');
                    $this->redirect(array('view', 'id' => $model->id));
                } else {
                    Utilities::set_Flash(Utilities::FLASH_ERROR, Utilities::get_ModelErrors($model->errors));
                    $this->gotoCreate();
                }
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

            if (isset($_POST['PosTransactions'])) {
                $model->attributes = $_POST['PosTransactions'];
                $model->updated_at = Settings::get_DateTime();

                if ($model->validate()) {
                    $model->save();
                    Utilities::set_Flash(Utilities::FLASH_SUCCESS, 'PosTransactions Successfully Updated');
                    $this->redirect(array('view', 'id' => $model->id));
                } else {
                    Utilities::set_Flash(Utilities::FLASH_ERROR, Utilities::get_ModelErrors($model->errors));
                }
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
            $model = new PosTransactions;

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
            $dataProvider = new CActiveDataProvider('PosTransactions');
            $this->render('index', array(
                'dataProvider' => $dataProvider,
            ));
        }

        /**
         * Manages all models.
         */
        public function actionAdmin() {
            unset($_SESSION[$_SESSION['lastSession']]);
            Utilities::setMenuActive_Siteadmin(Settings::get_ControllerID(), 'PosTransactions::tbl()', Settings::get_ActionID());
            $model = new PosTransactions('search');
            $model->unsetAttributes();  // clear any default values
            if (isset($_GET['PosTransactions']))
                $model->attributes = $_GET['PosTransactions'];
            $model->is_deleted = Utilities::NO;
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
                    $this->_model = PosTransactions::model()->findbyPk($_GET['id']);
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
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'pos-transactions-form') {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
        }

        public function gotoCreate() {
            $this->redirect($this->createUrl('posTransactions/create'));
        }

        public function actionSaveInventoryTransaction() {
            $model = new PosTransactions();
            $modelInventories = new Inventories();
            $modelLoyalty = new LoyaltySettings();

            $modelLoyalty = LoyaltySettings::sql_getData_byBranchID(Settings::get_BranchID(), Utilities::NO);
            $loyaltyPercentage = ($modelLoyalty['percentage'] / 100);

            $isError = 0;
            $message = NULL;

            $custID = $_GET['custID'];
            $invID = $_GET['inventoryID'];
            $refNOte = $_GET['refNOte'];
            $quantity = $_GET['quantity'];

            $modelInventories = Inventories::model_getData_byID($invID, Utilities::NO, Settings::get_BranchID());

            if ($modelInventories->category_id != InventoryCategories::INVENTORY_TYPE_SERVICES) {
                if ($quantity > $modelInventories->qty_stock) {
                    $isError = Utilities::YES;
                    $message = 'Stock(s) not available!.';
                }
                if ($modelInventories->qty_stock == 0) {

                    $isError = Utilities::YES;
                    $message = 'Stock(s) not available!.';
                }
            }

            if (!$modelInventories) {
                $isError = Utilities::YES;
                $message = 'Item cannot be fond on our database!';
            }

            if ($message == NULL) {
                $isError = Utilities::NO;
            }
            if ($isError == Utilities::NO) {
                $cnn = Utilities::createConnection();
                $trans = $cnn->beginTransaction();

                try {
                    $model->created_at = Settings::get_DateTime();
                    $model->updated_at = Settings::get_DateTime();
                    $model->trans_date = Settings::get_Date();
                    $model->ref_no = PosTransactions::generateRefNo();
                    $model->branch_id = Settings::get_BranchID();
                    $model->client_id = Settings::get_ClientID();
                    $model->remarks = $refNOte;
                    $model->cust_id = $custID;
                    $model->inv_id = $modelInventories->id;
                    $model->transaction_id = 1;
                    $model->transaction_name = $modelInventories->name;
                    $model->qty = $quantity;
                    $model->price = $modelInventories->price;
                    $model->amount_net = $modelInventories->price * $model->qty;
                    $model->balance = $model->amount_net;
                    $model->user_id = Settings::get_UserID();
                    $model->is_fully_paid = Utilities::NO;
                    $model->is_inventory = Utilities::YES;
                    $model->is_deleted = Utilities::NO;
                    $model->deleted_by = NULL;
                    $model->inventory_type_id = $modelInventories->category_id;
                    $model->service_type_id = $modelInventories->service_type_id;
                    $model->points = ($loyaltyPercentage * $model->amount_net);
                    $model->percentage = $loyaltyPercentage;

                    $modelArr = $model->addRecord();

                    if ($modelArr[0] != 0) {

                        if ($modelInventories->category_id != InventoryCategories::INVENTORY_TYPE_SERVICES) {
                            Inventories::sql_deductQtyStock($invID, $quantity);
                        }

                        $modelTransactionID = $modelArr[0];
                        $trans->commit();
                        $message = 'Order Successfully Saved!';
                    } else {
                        $message = 'Failed to save order!';
                        $isError = 1;
                    }
                } catch (Exception $ex) {
                    $message = 'Failed to save order!';
                    $isError = 1;
                    $trans->rollback();
                }
            }

            $resultArr['error'] = $isError;
            $resultArr['message'] = $message;
            $resultArr['transactionID'] = $modelTransactionID;

            print json_encode($resultArr);
        }

        public function actionAppendTransaction() {
            $transactionID = $_GET['transactionID'];
            $transaction = PosTransactions::sql_getAllData_byID($transactionID);
            print json_encode($transaction);
        }

        public function actionSearchTransactions() {
            $model = new PosTransactions();
            $custID = $_GET['custID'];
            $model = PosTransactions::sql_getAllData_byDeletedCustIDandIsFullypaid($custID, Utilities::NO, Utilities::NO);

            print json_encode($model);
        }

        public function actionDeleteInventory() {
            $model = new PosTransactions();
            $inventory = new Inventories();
            $id = $_GET['transationID'];

            $model = Utilities::model_getByID(PosTransactions::model(), $id);
            $inventory = Utilities::model_getByID(Inventories::model(), $model->inv_id);

            if ($model->is_saved == Utilities::YES) {
                $isError = 1;
                $message = 'Cannot delete saved transaction!;';
            } else {
                $model->deleted_by = Settings::get_UserID();
                $model->is_deleted = Utilities::YES;

                if ($model->save()) {
                    Inventories::sql_addQtyStock($inventory->id, $model->qty);
                }

                $isError = 0;
                $message = 'Transaction Successfully Deleted!;';
            }

            $messageArr['isError'] = $isError;
            $messageArr['message'] = $message;

            print json_encode($messageArr);
        }

        public static function actionGetDiscountType() {
            $model = new Discounts;
            $id = $_GET['id'];

            $model = Discounts::sql_getAllData_byID($id);

            print json_encode($model);
        }

        public static function actionSaveTransactions() {
            $mdoel = new PosTransactions();
            $inventory = new Inventories();
            $modelCustomer = new Customers();

            $custID = $_GET['custID'];

            $isError = NULL;
            $message = NULL;
            $model = PosTransactions::model_getAllData_byDeletedCustIDand_IsSaved($custID, Utilities::NO, Utilities::NO);
            $modelCustomer = Utilities::model_getByID(Customers::model(), $custID);


            if ($custID == '') {
                $isError = Utilities::YES;
                $message = 'Please select Customer!.';
            }
            if (!$model) {
                $isError = Utilities::YES;
                $message = 'Transaction(s) already saved!.';
            }

            if ($isError == Utilities::NO) {

                foreach ($model as $transactions) {
                    $inventory = Utilities::model_getByID(Inventories::model(), $transactions->inv_id);
                    $points = $transactions->points;

                    if ($inventory->service_type_id == 1) {
                        $field = "token_wash";
                    }

                    if ($inventory->service_type_id == 2) {
                        $field = "token_dry";
                    }

                    if ($inventory->service_type_id == 3) {
                        $field = "token_titan";
                    }

                    if ($inventory->service_type_id != 0) {
                        $totalToken = ($transactions->qty * $inventory->token);

                        if ($modelCustomer->is_activated == Utilities::YES) {
                            if ($inventory->service_type_id != 4) {
                                Customers::sql_addToken($custID, $totalToken, $field);
                            }
                        } else {
                            $card = new CustomerCards();
                            $card = CustomerCards::model_getData_byEmployeeID(Settings::get_EmployeeID());

                            if ($inventory->service_type_id != 4) {
                                Customers::sql_addToken($card->customer_id, $totalToken, $field);
                            }
                        }
                    }

                    PosTransactions::sql_updateIsSavedTransactions($transactions->id, Utilities::YES);

                    $field = 'points';
                    if ($inventory->service_type_id != 4) {
                        Customers::sql_addToken($transactions->cust_id, $points, $field);
                    }
                }

                $message = 'Transactions Successfully saved!.';
            }
            $messageArr['isError'] = $isError;
            $messageArr['message'] = $message;

            print json_encode($messageArr);
        }

        public function actionSubmitPayment() {
            $model = new PosPaymentHeaders();
            $modelDetails = new PosPaymentDetails();
            $modelTransactions = new PosTransactions();
            $modelCustomerTransactions = new CustomerTransactions();
            $modelCustomer = new Customers();

            $isError = 0;
            $message = NULL;

            $remarks = $_GET['remarks'];
            $discount = $_GET['discount'];
            $custID = $_GET['custID'];
            $count = $_GET['count'];
            $payable = $_GET['payable'];
            $amountPaidCash = ($_GET['amountPaid'] != '') ? $_GET['amountPaid'] : 0;
            $amountPaidTotal = ($_GET['totalAmountPaid'] != '') ? $_GET['totalAmountPaid'] : 0;
            $amountPaidCard = ($_GET['cardAmountPaid'] != '') ? $_GET['cardAmountPaid'] : 0;
            $amountInPeso = ($_GET['amountInPeso'] != '') ? $_GET['amountInPeso'] : 0;
            $amountChange = ($_GET['amountChange'] != '') ? $_GET['amountChange'] : 0;
            $points = ($_GET['points'] != '') ? $_GET['points'] : 0;
            $totalAmountNet = $amountPaidTotal;



            $modelTransactions = PosTransactions::model_getAllData_byDeletedCustIDandIsFullypaid($custID, Utilities::NO, Utilities::NO);
            $modelCustomer = Utilities::model_getByID(Customers::model(), $custID);
            $modelCustomerCard = CustomerCards::model_getData_byCustomerID($modelCustomer->id);

            if ($message != "") {
                $isError = Utilities::YES;
            }

            if ($isError == 0) {
                $cnn = Utilities::createConnection();
                $trans = $cnn->beginTransaction();
                try {

                    $model->created_at = Settings::get_DateTime();
                    $model->updated_at = Settings::get_DateTime();
                    $model->date = Settings::get_Date();
                    $model->payment_type_id = 1;
                    $model->ref_no = PosPaymentHeaders::generateRefNo();
                    $model->or_no = PosPaymentHeaders::generateOR();
                    $model->branch_id = Settings::get_BranchID();
                    $model->client_id = Settings::get_clientID();
                    $model->employee_id = Settings::get_EmployeeID();
                    $model->customer_id = $custID;
                    $model->quantity = $count;
                    $model->payable = $payable;
                    $model->amount_cash = $amountPaidCash;
                    $model->amount_card = $amountPaidCard;
                    $model->amount_points = $amountInPeso;
                    $model->points = $points;
                    $model->discount = $discount;
                    $model->tax = 0;
                    $model->amount_net = $totalAmountNet;
                    $model->is_email_sent = Utilities::NO;
                    $model->is_sync = Utilities::NO;
                    $model->is_deleted = Utilities::NO;
                    $modelArr = $model->addRecord();
                    $headerID = $modelArr[0];

                    if ($modelArr[0] != 0) {

                        foreach ($modelTransactions as $transaction) {

                            if ($amountPaidTotal > 0) {
                                $amountPayable = $transaction->balance;
                                $amountbalance = $amountPayable - $amountPaidTotal;
                                $amountPaid = $amountPaidTotal + $amountbalance;

                                if (number_format($amountbalance) <= 0) {
                                    $modelDetails->created_at = Settings::get_DateTime();
                                    $modelDetails->updated_at = Settings::get_DateTime();
                                    $modelDetails->header_id = $modelArr[0];
                                    $modelDetails->transaction_id = $transaction->id;
                                    $modelDetails->inventory_id = $transaction->inv_id;
                                    $modelDetails->qty = $transaction->qty;
                                    $modelDetails->price = $transaction->price;
                                    $modelDetails->amount_paid = $amountPaid;
                                    $modelDetails->is_deleted = Utilities::NO;
                                    $modelDetailsArr = $modelDetails->addRecord();
                                    PosTransactions::sql_updateIsFullyPaid($transaction->id, Utilities::YES);
                                    PosTransactions::sql_updateAmountBalance($transaction->id, 0);
                                } else {
                                    $modelDetails->created_at = Settings::get_DateTime();
                                    $modelDetails->updated_at = Settings::get_DateTime();
                                    $modelDetails->header_id = $modelArr[0];
                                    $modelDetails->transaction_id = $transaction->id;
                                    $modelDetails->inventory_id = $transaction->inv_id;
                                    $modelDetails->qty = $transaction->qty;
                                    $modelDetails->price = $transaction->price;
                                    $modelDetails->amount_paid = $amountPaid;
                                    $modelDetails->is_deleted = Utilities::NO;
                                    $modelDetailsArr = $modelDetails->addRecord();
                                    PosTransactions::sql_updateIsFullyPaid($transaction->id, Utilities::NO);
                                    PosTransactions::sql_updateAmountBalance($transaction->id, $amountbalance);
                                }
                            }
                            $amountPaidTotal -= $amountPayable;
                        }
                        if ($amountPaidTotal > 0) {
                            $isError = 0;
                        }
                        if ($isError == Utilities::NO) {

                            /* deduct to customer points */
                            $field = 'points';
                            Customers::sql_deductToken($custID, $points, $field);

                            if ($amountPaidCard > 0) {
                                $modelCustomerCardTransactions = new CustomerCardTransactions;
                                $modelCustomerCardTransactions->created_at = Settings::get_DateTime();
                                $modelCustomerCardTransactions->updated_at = Settings::get_DateTime();
                                $modelCustomerCardTransactions->branch_id = Settings::get_BranchID();
                                $modelCustomerCardTransactions->client_id = Settings::get_ClientID();
                                $modelCustomerCardTransactions->customer_id = $modelCustomer->id;
                                $modelCustomerCardTransactions->transaction_id = Transactions::TRANSACTION_CARD_PAYMENT;

                                $credited = 0;
                                $debited = $amountPaidCard;
                                $remarks = 'Payment  of ';

                                $modelCustomerCardTransactions->card_id = $modelCustomerCard->id;
                                $modelCustomerCardTransactions->card_no = $modelCustomerCard->rf_id;
                                $modelCustomerCardTransactions->credited = $credited;
                                $modelCustomerCardTransactions->debited = $debited;
                                $modelCustomerCardTransactions->balance = 0;
                                $modelCustomerCardTransactions->user_id = Settings::get_UserID();
                                $modelCustomerCardTransactions->remarks = $remarks . $model->customers->lnameFname;
                                $modelCustomerCardTransactions->is_deleted = Utilities::NO;
                                $modelArr = $modelCustomerCardTransactions->addRecord();
                            }

                            if (Utilities::get_isOnline() == Utilities::YES) {
                                if ($modelCustomer->email != '') {
                                   $this->sendMail($custID, $headerID);
                                }
                            }


                            $trans->commit();
                            $message = 'Payment Transaction Successfully Saved!';
                        }
                    } else {

                        $isError = 1;
                        $message = $modelArr[1];
                    }
                } catch (Exception $ex) {
                    $isError = 1;
                    $message = "Payment Transaction Failed";
                    $trans->rollback();
                }

                $messageArr['isError'] = $isError;
                $messageArr['message'] = $message;
                $messageArr['headerID'] = $modelArr[0];

                print json_encode($messageArr);
            }
        }

        public function actionPrintReceipt() {
            $model = new PosPaymentHeaders();
            $modelDetails = new PosPaymentDetails();
            $headerID = $_GET['headerID'];
            $model = Utilities::model_getByID(PosPaymentHeaders::model(), $headerID);
            $modelDetails = PosPaymentDetails::model()->findAll('header_id = :headerID group by inventory_id order by created_at  ASC', array(':headerID' => $headerID));
            // Utilities::debug($modelDetails, 'test');exit();
            print $this->renderPartial('../default/printResult', array('model' => $model, 'modelDetails' => $modelDetails));
        }

        public function actionGetPesoValue() {
            $model = new LoyaltySettings();
            $model = LoyaltySettings::sql_getData_byBranchID(Settings::get_BranchID(), Utilities::NO);

            print $model['value'];
        }

        public function actionGetUnsavedTransactions() {
            $model = new PosTransactions();
            $custID = $_GET['custID'];

            $model = PosTransactions::model_getAllData_byDeletedCustIDand_IsSaved($custID, Utilities::NO, Utilities::NO);

            print count($model);
        }

        public function actionAdminTransactionLists() {

            $endDate = $_GET['toDate'];
            $startDate = $_GET['fromDate'];

            $filtersForm = new FiltersForm;
            if (isset($_GET['FiltersForm']))
                $filtersForm->filters = $_GET['FiltersForm'];

            $rawData = PosTransactions::model()->findAll(' is_deleted = :isDeleted AND date(trans_date) between :startDate AND :endDate AND branch_id = :branchID    order by  cust_id, updated_at DESC', array(
                'isDeleted' => Utilities::NO,
                'branchID' => Settings::get_BranchID(),
                'endDate' => $endDate,
                'startDate' => $startDate,
            ));
            $filteredData = $filtersForm->filter($rawData);

            $result = new CArrayDataProvider($filteredData, array(
                'pagination' => array(
                    'pageSize' => 10000,
                ),
            ));
            $this->render('adminTransactionLists', array(
                'result' => $result,
                'filtersForm' => $filtersForm,
            ));
        }

        public function actionAdminUnpaidTransactions() {
            $filtersForm = new FiltersForm;
            if (isset($_GET['FiltersForm']))
                $filtersForm->filters = $_GET['FiltersForm'];

            $rawData = PosTransactions::model()->findAll(' is_deleted = :isDeleted AND branch_id = :branchID  AND is_fully_paid =:isFullyPaid order by cust_id', array(
                'isDeleted' => Utilities::NO,
                'isFullyPaid' => Utilities::NO,
                'branchID' => Settings::get_BranchID(),
            ));
            $filteredData = $filtersForm->filter($rawData);

            $result = new CArrayDataProvider($filteredData, array(
                'pagination' => array(
                    'pageSize' => 10000,
                ),
            ));
            $this->render('adminUnpaidTransactions', array(
                'result' => $result,
                'filtersForm' => $filtersForm,
            ));
        }

        public function sendMail($custID, $headerID) {

            Yii::import('ext.yii-mail.YiiMailMessage');
            $message = new YiiMailMessage;

            $model = new PosPaymentHeaders();
            $modelDetails = new PosPaymentDetails();
            $modelCustomer = new Customers();

            $model = Utilities::model_getByID(PosPaymentHeaders::model(), $headerID);
            $modelDetails = PosPaymentDetails::model()->findAll('header_id = :headerID group by inventory_id order by created_at  ASC', array(':headerID' => $model->id));
            $modelCustomer = Utilities::model_getByID(Customers::model(), $custID);

            $message->setBody($this->renderPartial('../default/printResult', array(
                    'model' => $model,
                    'modelDetails' => $modelDetails,
                    )
                    , true
                ), 'text/html', 'utf8');

            $message->subject = $model->customers->lnameFname . ' OR NO.:' . $model->or_no;
            $message->addTo($modelCustomer->email);
            $message->from = Yii::app()->params['adminEmail'];


            if (Yii::app()->mail->send($message)) {
                return 1;
            } else {
                return 0;
            }
        }

        public function actionPrintReport() {
            $model = new PosTransactions();
            $isError = 0;
            $reportType = $_POST['txtReportType'];
            unset($_SESSION[PosTransactions::tbl()]['report_type']);
            if ($reportType == '') {
                $isError = Utilities::YES;
                $message .= 'Report Type cannot be blank.' . "<br />";
            }


            if (isset($_POST['PosTransactions'])) {
                $model->attributes = $_POST['PosTransactions'];
                $model->updated_at = $_POST['PosTransactions']['updated_at'];

                $_SESSION[PosTransactions::tbl()]['report_type'] = $reportType;
                $_SESSION[PosTransactions::tbl()]['created_at'] = $model->created_at;
                $_SESSION[PosTransactions::tbl()]['updated_at'] = $model->updated_at;

                if ($reportType == Utilities::YES) {
                    $date = new DateTime('now');
                    $date->format('Y-m-d');
                    $endDate = Settings::get_Date();

                    $datestart = new DateTime('now');
                    $datestart->format('Y-m-d');
                    $startDate = Settings::get_Date();
                } else {

                    if ($model->created_at == '' || $model->updated_at == '') {

                        $isError = Utilities::YES;
                        $message .= 'Please select Date Range.' . "<br />";
                    } else {
                        $startDate = $model->created_at;
                        $endDate = $model->updated_at;
                    }
                }

                if ($isError == 1) {
                    $returnMsg['message'] = $message;
                    Utilities::set_Flash(Utilities::FLASH_ERROR, $returnMsg['message']);
                } else {
                    $this->redirect($this->createUrl('posTransactions/adminTransactionLists', array(
                            'fromDate' => $startDate,
                            'toDate' => $endDate,
                            )
                    ));
                }
            } else {
                $model->created_at = $_SESSION[PosTransactions::tbl()]['created_at'];
                $model->updated_at = $_SESSION[PosTransactions::tbl()]['updated_at'];
            }

            $this->render('printReport', array(
                'model' => $model,
                )
            );
        }

        public function actionPrint() {
            $modelTransactions = new PosTransactions('search');
            $modelTransactions->unsetAttributes();  // clear any default values
            $endDate = $_GET['toDate'];
            $startDate = $_GET['fromDate'];

            if (isset($_GET['PosTransactions']))
                $modelTransactions->attributes = $_GET['PosTransactions'];


            $this->render('print', array(
                'modelTransactions' => $modelTransactions,
                'startDate' => $startDate,
                'endDate' => $endDate,
            ));
        }

        public function actionProfitAndLoss() {
            $this->render(
                'profitAndLost'
            );
        }
 public function actionSyncRecords() {
//
//            $transactions = array();
//            for ($x = 0; $x < 1; $x++) {
//                $transactions[$x]['name'] = 'PosTransactions';
//                $transactions[$x]['value'] = $this->getPosTransactions(Settings::get_BranchID(), Utilities::NO, Utilities::NO);
//            }
//            $transactionsArr = Utilities::syncPOSTransactions(json_encode($transactions));
//


            $data = array();
            for ($x = 0; $x < 4; $x++) {

                $data[1]['name'] = 'Inventories';
                $data[1]['value'] = $this->getInventories(Settings::get_BranchID(), Utilities::NO, Utilities::NO);


                $data[2]['name'] = 'Customers';
                $data[2]['value'] = $this->getCustomers(Settings::get_BranchID(), Utilities::NO, Utilities::NO);

                $data[3]['name'] = 'Expenses';
                $data[3]['value'] = $this->getExpenses(Settings::get_BranchID(), Utilities::NO, Utilities::NO);
            }
            $dataArr = Utilities::syncCustomers(json_encode($data));

//            Utilities::debug($data,  $caption);
            Utilities::debug($data, $caption);
            exit();
        }

        public function getCustomers($branchID, $isSync, $isDeleted) {
            $models = Customers::model_getAllData_byDeletedBranchID_isSync($branchID, $isSync, $isDeleted);

            $rows = array();
            for ($x = 0; $x < count($models); $x++) {
                $rows[$x]['created_at'] = $models[$x]['created_at'];
                $rows[$x]['updated_at'] = $models[$x]['updated_at'];
                $rows[$x]['branch_id'] = $models[$x]['branch_id'];
                $rows[$x]['client_id'] = $models[$x]['client_id'];
                $rows[$x]['firstname'] = $models[$x]['firstname'];
                $rows[$x]['middlename'] = $models[$x]['middlename'];
                $rows[$x]['lastname'] = $models[$x]['lastname'];
                $rows[$x]['company_name'] = $models[$x]['company_name'];
                $rows[$x]['address'] = $models[$x]['address'];
                $rows[$x]['email'] = $models[$x]['email'];
                $rows[$x]['mobile'] = $models[$x]['mobile'];
                $rows[$x]['phone'] = $models[$x]['phone'];
                $rows[$x]['is_sync'] = $models[$x]['is_sync'];
                $rows[$x]['is_deleted'] = $models[$x]['is_deleted'];
                $rows[$x]['birthdate'] = $models[$x]['birthdate'];
                $rows[$x]['token_wash'] = $models[$x]['token_wash'];
                $rows[$x]['token_dry'] = $models[$x]['token_dry'];
                $rows[$x]['token_titan'] = $models[$x]['token_titan'];
                $rows[$x]['is_activated'] = $models[$x]['is_activated'];
                $rows[$x]['transactions'] = $this->getPosTransactions($branchID, $isSync, $isDeleted, $models[$x]['id']);
                $rows[$x]['paymentHeaders'] = $this->getPayments($branchID, $isSync, $isDeleted, $models[$x]['id']);
            }
            return $rows;
        }

        public function getPosTransactions($branchID, $isSync, $isDeleted, $custID) {
            $models = PosTransactions::model_getAllData_byDeletedBranchID_isSync($branchID, $isSync, $isDeleted, $custID);

            $rows = array();
            for ($x = 0; $x < count($models); $x++) {
                $rows[$x]['created_at'] = $models[$x]['created_at'];
                $rows[$x]['updated_at'] = $models[$x]['updated_at'];
                $rows[$x]['trans_date'] = $models[$x]['trans_date'];
                $rows[$x]['branch_id'] = $models[$x]['branch_id'];
                $rows[$x]['client_id'] = $models[$x]['client_id'];
                $rows[$x]['ref_no'] = $models[$x]['ref_no'];
                $rows[$x]['remarks'] = $models[$x]['remarks'];
                $rows[$x]['cust_id'] = $models[$x]['cust_id'];
                $rows[$x]['inv_id'] = $models[$x]['inv_id'];
                $rows[$x]['transaction_id'] = $models[$x]['transaction_id'];
                $rows[$x]['transaction_name'] = $models[$x]['transaction_name'];
                $rows[$x]['qty'] = $models[$x]['qty'];
                $rows[$x]['price'] = $models[$x]['price'];
                $rows[$x]['amount_net'] = $models[$x]['amount_net'];
                $rows[$x]['balance'] = $models[$x]['balance'];
                $rows[$x]['is_fully_paid'] = $models[$x]['is_fully_paid'];
                $rows[$x]['user_id'] = $models[$x]['user_id'];
                $rows[$x]['is_inventory'] = $models[$x]['is_inventory'];
                $rows[$x]['inventory_type_id'] = $models[$x]['inventory_type_id'];
                $rows[$x]['service_type_id'] = $models[$x]['service_type_id'];
                $rows[$x]['is_deleted'] = $models[$x]['is_deleted'];
                $rows[$x]['deleted_by'] = $models[$x]['deleted_by'];
            }
            return $rows;
        }

        public function getPayments($branchID, $isSync, $isDeleted, $custID) {
            $models = PosPaymentHeaders::model_getAllData_byDeletedBranchID_isSync($branchID, $isSync, $isDeleted, $custID);

            $rows = array();
            for ($x = 0; $x < count($models); $x++) {
                $rows[$x]['created_at'] = $models[$x]['created_at'];
                $rows[$x]['updated_at'] = $models[$x]['updated_at'];
                $rows[$x]['date'] = $models[$x]['date'];
                $rows[$x]['payment_type_id'] = $models[$x]['payment_type_id'];
                $rows[$x]['ref_no'] = $models[$x]['ref_no'];
                $rows[$x]['or_no'] = $models[$x]['or_no'];
                $rows[$x]['branch_id'] = $models[$x]['branch_id'];
                $rows[$x]['client_id'] = $models[$x]['client_id'];
                $rows[$x]['employee_id'] = $models[$x]['employee_id'];
                $rows[$x]['customer_id'] = $models[$x]['customer_id'];
                $rows[$x]['quantity'] = $models[$x]['quantity'];
                $rows[$x]['payable'] = $models[$x]['payable'];
                $rows[$x]['amount_cash'] = $models[$x]['amount_cash'];
                $rows[$x]['amount_card'] = $models[$x]['amount_card'];
                $rows[$x]['discount'] = $models[$x]['discount'];
                $rows[$x]['tax'] = $models[$x]['tax'];
                $rows[$x]['amount_net'] = $models[$x]['amount_net'];
                $rows[$x]['is_email_sent'] = $models[$x]['is_email_sent'];
                $rows[$x]['is_sync'] = $models[$x]['is_sync'];
                $rows[$x]['is_deleted'] = $models[$x]['is_deleted'];
                $rows[$x]['paymentDetails'] = $this->getPaymentDetails($models[$x]['id']);
            }
            return $rows;
        }

        public function getPaymentDetails($headerID) {
            $models = PosPaymentDetails::model_getAllData_byDeletedHeaderID($headerID, Utilities::NO);

            $rows = array();
            for ($x = 0; $x < count($models); $x++) {
                $rows[$x]['created_at'] = $models[$x]['created_at'];
                $rows[$x]['updated_at'] = $models[$x]['updated_at'];
                $rows[$x]['header_id'] = $models[$x]['header_id'];
                $rows[$x]['transaction_id'] = $models[$x]['transaction_id'];
                $rows[$x]['inventory_id'] = $models[$x]['inventory_id'];
                $rows[$x]['qty'] = $models[$x]['qty'];
                $rows[$x]['price'] = $models[$x]['price'];
                $rows[$x]['amount_paid'] = $models[$x]['amount_paid'];
                $rows[$x]['is_deleted'] = $models[$x]['is_deleted'];
            }
            return $rows;
        }

        public function getInventories($branchID, $isSync, $isDeleted) {
            $models = Inventories::model_getAllData_byDeletedBranchID_isSync($branchID, $isSync, $isDeleted);

            $rows = array();
            for ($x = 0; $x < count($models); $x++) {
                $rows[$x]['created_at'] = $models[$x]['created_at'];
                $rows[$x]['updated_at'] = $models[$x]['updated_at'];
                $rows[$x]['branch_id'] = $models[$x]['branch_id'];
                $rows[$x]['client_id'] = $models[$x]['client_id'];
                $rows[$x]['name'] = $models[$x]['name'];
                $rows[$x]['bar_code'] = $models[$x]['bar_code'];
                $rows[$x]['category_id'] = $models[$x]['category_id'];
                $rows[$x]['price'] = $models[$x]['price'];
                $rows[$x]['cost'] = $models[$x]['cost'];
                $rows[$x]['tax'] = $models[$x]['tax'];
                $rows[$x]['margin'] = $models[$x]['margin'];
                $rows[$x]['qty_stock'] = $models[$x]['qty_stock'];
                $rows[$x]['qty_reorder'] = $models[$x]['qty_reorder'];
                $rows[$x]['file_path'] = $models[$x]['file_path'];
                $rows[$x]['file_pics'] = $models[$x]['file_pics'];
                $rows[$x]['is_sync'] = $models[$x]['is_sync'];
                $rows[$x]['topup_amount'] = $models[$x]['topup_amount'];
                $rows[$x]['token'] = $models[$x]['token'];
                $rows[$x]['service_type_id'] = $models[$x]['service_type_id'];
                $rows[$x]['is_deleted'] = $models[$x]['is_deleted'];
                $rows[$x]['group_id'] = $models[$x]['group_id'];
                $rows[$x]['desc'] = $models[$x]['desc'];
                $rows[$x]['color'] = $models[$x]['color'];
            }
            return $rows;
        }

        public function getExpenses($branchID, $isSync, $isDeleted) {
            $models = Expenses::model_getAllData_byDeletedBranchID_isSync($branchID, $isSync, $isDeleted);

            $rows = array();
            for ($x = 0; $x < count($models); $x++) {
                $rows[$x]['created_at'] = $models[$x]['created_at'];
                $rows[$x]['updated_at'] = $models[$x]['updated_at'];
                $rows[$x]['date'] = $models[$x]['date'];
                $rows[$x]['ref_no'] = $models[$x]['ref_no'];
                $rows[$x]['branch_id'] = $models[$x]['branch_id'];
                $rows[$x]['client_id'] = $models[$x]['client_id'];
                $rows[$x]['expenses_type_id'] = $models[$x]['expenses_type_id'];
                $rows[$x]['title'] = $models[$x]['title'];
                $rows[$x]['amount'] = $models[$x]['amount'];
                $rows[$x]['remarks'] = $models[$x]['remarks'];
                $rows[$x]['is_sync'] = $models[$x]['is_sync'];
                $rows[$x]['is_deleted'] = $models[$x]['is_deleted'];
                $rows[$x]['emp_id'] = $models[$x]['emp_id'];
                $rows[$x]['id'] = $models[$x]['id'];
                $rows[$x]['purchases'] = $this->getPurchases($models[$x]['id']);
            }
            return $rows;
        }

        public function getPurchases($expensesID) {
            $models = Purchases::model_getAllData_byDeletedExpensesID($expensesID, Utilities::NO);
            $rows = array();
            for ($x = 0; $x < count($models); $x++) {
                $rows[$x]['created_at'] = $models[$x]['created_at'];
                $rows[$x]['updated_at'] = $models[$x]['updated_at'];
                $rows[$x]['date'] = $models[$x]['date'];
                $rows[$x]['supplier_id'] = $models[$x]['supplier_id'];
                $rows[$x]['received_by_empid'] = $models[$x]['received_by_empid'];
                $rows[$x]['user_id'] = $models[$x]['user_id'];
                $rows[$x]['inv_id'] = $models[$x]['inv_id'];
                $rows[$x]['qty'] = $models[$x]['qty'];
                $rows[$x]['price'] = $models[$x]['price'];
                $rows[$x]['expenses_id'] = $models[$x]['expenses_id'];
                $rows[$x]['is_deleted'] = $models[$x]['is_deleted'];
                $rows[$x]['client_id'] = $models[$x]['client_id'];
                $rows[$x]['branch_id'] = $models[$x]['branch_id'];
            }
            return $rows;
        }

    }
    