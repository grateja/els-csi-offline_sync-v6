<?php

    class ExpensesController extends ClientController {
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
                        'salaries',
                        'printReport',
                        'print',
                        'adminReports'
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
            $model = new Expenses;
            unset($_SESSION[Expenses::tbl()]);
            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (isset($_POST['Expenses'])) {
                $model->attributes = $_POST['Expenses'];
                $_SESSION[Expenses::tbl()]['expenses_type_id'] = $model->expenses_type_id;
                $model->created_at = Settings::get_DateTime();
                $model->updated_at = Settings::get_DateTime();
                $model->client_id = Settings::get_ClientID();
                $model->title = $model->expensesTypes->name;
                $model->date = date('Y-m-d', strtotime($model->date));
                $model->ref_no = Expenses::createNewRefNo();

                if ($model->validate()) {
                    $model->save();
                    Utilities::set_Flash(Utilities::FLASH_SUCCESS, 'New Expenses Successfully Created.');
                    $this->redirect(array('admin'));
                } else {
                    Utilities::set_Flash(Utilities::FLASH_ERROR, Utilities::get_ModelErrors($model->errors));
                    $this->gotoCreate();
                }
            } else {

                $model->expenses_type_id = $_SESSION[Expenses::tbl()]['expenses_type_id'];
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

            if (isset($_POST['Expenses'])) {
                $model->attributes = $_POST['Expenses'];
                $model->updated_at = Settings::get_DateTime();

                if ($model->validate()) {
                    $model->save();
                    Utilities::set_Flash(Utilities::FLASH_SUCCESS, 'Expenses Successfully Updated');
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
            $model = new Expenses;

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
            $dataProvider = new CActiveDataProvider('Expenses');
            $this->render('index', array(
                'dataProvider' => $dataProvider,
            ));
        }

        /**
         * Manages all models.
         */
        public function actionAdmin() {
            unset($_SESSION[$_SESSION['lastSession']]);
            Utilities::setMenuActive_Siteadmin(Settings::get_ControllerID(), 'Expenses::tbl()', Settings::get_ActionID());
            $model = new Expenses('search');
            $model->unsetAttributes();  // clear any default values
            if (isset($_GET['Expenses']))
                $model->attributes = $_GET['Expenses'];
            $model->is_deleted = Utilities::NO;
            $model->client_id = Settings::get_ClientID();

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
                    $this->_model = Expenses::model()->findbyPk($_GET['id']);
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
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'expenses-form') {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
        }

        public function gotoCreate() {
            $this->redirect($this->createUrl('expenses/create'));
        }

        public function actionSalaries() {
            $model = new Expenses;

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);
            if (isset($_POST['Expenses'])) {
                $model->attributes = $_POST['Expenses'];
                $_SESSION[Expenses::tbl()]['expenses_type_id'] = ExpensesTypes::EXPENSES_TYPE_SALARIES;
                $model->created_at = Settings::get_DateTime();
                $model->updated_at = Settings::get_DateTime();
                $model->client_id = Settings::get_ClientID();
                $model->title = $model->expensesTypes->name;
                $model->date = date('Y-m-d', strtotime($model->date));
                $model->ref_no = Expenses::createNewRefNo();

                if ($model->validate()) {
                    $model->save();
                    Utilities::set_Flash(Utilities::FLASH_SUCCESS, 'New Expenses Successfully Created.');
                    $this->redirect(array('admin'));
                } else {
                    Utilities::set_Flash(Utilities::FLASH_ERROR, Utilities::get_ModelErrors($model->errors));
                    $this->gotoCreate();
                }
            } else {

                $model->expenses_type_id = $_SESSION[Expenses::tbl()]['expenses_type_id'];
            }

            $this->render('salaries', array(
                'model' => $model,
            ));
        }

   public function actionPrintReport() {
            $model = new Expenses();
            $isError = 0;
            $reportType = $_POST['txtReportType'];
            unset($_SESSION[Expenses::tbl()]['report_type']);
            if ($reportType == '') {
                $isError = Utilities::YES;
                $message .= 'Report Type cannot be blank.' . "<br />";
            }


            if (isset($_POST['Expenses'])) {
                $model->attributes = $_POST['Expenses'];
                $model->updated_at = $_POST['Expenses']['updated_at'];

                $_SESSION[Expenses::tbl()]['report_type'] = $reportType;
                $_SESSION[Expenses::tbl()]['created_at'] = $model->created_at;
                $_SESSION[Expenses::tbl()]['updated_at'] = $model->updated_at;

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
                    $this->redirect($this->createUrl('expenses/adminReports', array(
                            'fromDate' => $startDate,
                            'toDate' => $endDate,
                            )
                    ));
                }
            } else {
                $model->created_at = $_SESSION[Expenses::tbl()]['created_at'];
                $model->updated_at = $_SESSION[Expenses::tbl()]['updated_at'];
            }

            $this->render('printReport', array(
                'model' => $model,
                )
            );
        }

        public function actionPrint() {
            $modelTransactions = new Expenses('search');
            $modelTransactions->unsetAttributes();  // clear any default values
            $endDate = $_GET['toDate'];
            $startDate = $_GET['fromDate'];

            if (isset($_GET['Expenses']))
                $modelTransactions->attributes = $_GET['Expenses'];

            $this->render('print', array(
                'modelTransactions' => $modelTransactions,
                'startDate' => $startDate,
                'endDate' => $endDate,
            ));
        }
        
        
        public function actionAdminReports() {

            $endDate = $_GET['toDate'];
            $startDate = $_GET['fromDate'];
            $filtersForm = new FiltersForm;
            if (isset($_GET['FiltersForm']))
                $filtersForm->filters = $_GET['FiltersForm'];

            $rawData = Expenses::model()->findAll(' is_deleted = :isDeleted AND client_id = :branchID  AND date(date) between :startDate AND :endDate  order by   updated_at DESC', array(
                'endDate' => $endDate,
                'startDate' => $startDate,
                'isDeleted' => Utilities::NO,
                'branchID' => Settings::get_ClientID(),
            ));
            $filteredData = $filtersForm->filter($rawData);

            $result = new CArrayDataProvider($filteredData, array(
                'pagination' => array(
                    'pageSize' => 10000,
                ),
            ));
            $this->render('adminReports', array(
                'result' => $result,
                'filtersForm' => $filtersForm,
            ));
        }
    }