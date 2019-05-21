<?php

    class CustomersController extends UserController {
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
                        'retrieveCustomerPoints',
                        'getTokens',
                        'ajaxCreate'
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

            $model = $this->loadModel();

            $modelCards = new CustomerCards('searchByCustomer');
            $modelCards->unsetAttributes();  // clear any default values


            $modelCards->attributes = $_GET['CustomerCards'];
            $modelCards->customer_id = $model->id;


            $this->render('view', array(
                'model' => $model,
                'modelCards' => $modelCards,
            ));
        }

        /**
         * Creates a new model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         */
        public function actionCreate() {
            $model = new Customers;

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (isset($_POST['Customers'])) {

                $model->attributes = $_POST['Customers'];
                $model->created_at = Settings::get_DateTime();
                $model->updated_at = Settings::get_DateTime();
                $model->branch_id = Settings::get_BranchID();
                $model->client_id = Settings::get_ClientID();

                $model->birthdate = date('Y-m-d', strtotime($model->birthdate));
                if (Customers::sql_isExist_customer($model->firstname, $model->lastname) > 0) {
                    Utilities::set_Flash(Utilities::FLASH_ERROR, 'Customer Name Already Exist!.');
                    $this->gotoCreate();
                } else {
                    if ($model->validate()) {
                        $model->save();
                        Utilities::set_Flash(Utilities::FLASH_SUCCESS, 'New Customers Successfully Created.');
                        $this->redirect(array('admin'));
                    } else {
                        Utilities::set_Flash(Utilities::FLASH_ERROR, Utilities::get_ModelErrors($model->errors));
                        $this->gotoCreate();
                    }
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

            if (isset($_POST['Customers'])) {
                $model->attributes = $_POST['Customers'];
                $model->updated_at = Settings::get_DateTime();

                if ($model->validate()) {
                    $model->save();
                    Utilities::set_Flash(Utilities::FLASH_SUCCESS, 'Customers Successfully Updated');
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
            $model = new Customers;
            $modelTransactions = new PosTransactions();


            if (Yii::app()->request->isPostRequest) {
                // we only allow deletion via POST request
                $model = Utilities::model_getByID($model, $_GET['id']);
                $modelTransactions = PosTransactions::model_getAllData_byDeletedCustIDandIsFullypaid($model->id, Utilities::NO, Utilities::NO);
                if (count($modelTransactions) == 0) {
                    $model->is_deleted = Utilities::YES;
                    $model->save();
                } else {

                    throw new CHttpException(400, "You cannot deleted customers with unpaid bills");
                }

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
            $dataProvider = new CActiveDataProvider('Customers');
            $this->render('index', array(
                'dataProvider' => $dataProvider,
            ));
        }

        /**
         * Manages all models.
         */
        public function actionAdmin() {

            $model = new Customers('search');
            $model->unsetAttributes();  // clear any default values
            if (isset($_GET['Customers']))
                $model->attributes = $_GET['Customers'];
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
                    $this->_model = Customers::model()->findbyPk($_GET['id']);
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
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'customers-form') {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
        }

        public function gotoCreate() {
            $this->redirect($this->createUrl('customers/create'));
        }

        public function actionRetrieveCustomerPoints() {
            $model = new Customers();
            $modelCustomerCards = new CustomerCards;
            $custID = $_GET['custID'];

            $model = Utilities::model_getByID(Customers::model(), $custID);
            $modelCustomerCards = CustomerCards::model_getData_byCustomerID($custID);
            $creditBalance = CustomerCardTransactions::sql_getTotalBalance_byCardID($modelCustomerCards->id);

            $returnMessage['points'] = $modelCustomerCards->point;
            $returnMessage['cust_balance'] = $creditBalance;
            print json_encode($returnMessage);
        }

        public function actionGetTokens() {

            $model = new Customers();
            $custID = $_GET['custID'];

            $model = Utilities::model_getByID(Customers::model(), $custID);

            $returnMessage['token_wash'] = $model->token_wash;
            $returnMessage['token_dry'] = $model->token_dry;
            $returnMessage['token_titan'] = $model->token_titan;

            print json_encode($returnMessage);
        }

        public function actionAjaxCreate() {

            $model = new Customers();

            $isError = 0;
            $message = null;
            $isExist = Customers::sql_isExist_customer($_POST['Customers']['firstname'], $_POST['Customers']['lastname']);
            if ($isExist) {
                $isError = 1;
                $message = "Customer already exist!";
            }
            $_SESSION[Customers::tbl()]['is_success'] = Utilities::NO;

            if ($message != '') {
                $isError = 1;
            }


            if ($isError != Utilities::YES) {
                if (isset($_POST['Customers'])) {

                    $cnn = Utilities::createConnection();
                    $transaction = $cnn->beginTransaction();
                    try {
                        $model->attributes = $_POST['Customers'];

                        $model->created_at = Settings::get_DateTime();
                        $model->updated_at = Settings::get_DateTime();
                        $model->branch_id = Settings::get_BranchID();
                        $model->client_id = Settings::get_ClientID();
                        $model->birthdate = date('Y-m-d', strtotime($model->birthdate));

                        $modelCustomerArr = $model->addRecord();
                        if ($modelCustomerArr[0] != Utilities::NO) {
                            $transaction->commit();

                            $message = 'Customer creation successful.';
                        } else {
                            $isError = 1;
                            $message = 'Customer creation Failed.';
                            $message = $modelCustomerArr[1];
                        }
                    } catch (Exception $ex) {
                        $isError = 1;
                        $transaction->rollback();
                        $message = 'Customer creation Failed.';
                        $this->gotoCreate();
                    }
                }
            }
            $returnMessage['error'] = $isError;
            $returnMessage['id'] = $modelCustomerArr[0];
            $returnMessage['name'] = $modelCustomerArr[2];
            $returnMessage['message'] = $message;

            print json_encode($returnMessage);
        }

    }
    