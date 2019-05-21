<?php

    class InventoriesController extends ClientController {
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
                        'addPhotoSubmit',
                        'test',
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
            $model = new Inventories;
            $modelType = new InventoryCategories();
            $categoryID = $_GET['categoryID'];

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (isset($_POST['Inventories'])) {
                $model->attributes = $_POST['Inventories'];
                $model->created_at = Settings::get_DateTime();
                $model->updated_at = Settings::get_DateTime();
                $model->client_id = Settings::get_ClientID();
                $model->category_id = $categoryID;
                $model->branch_id = $_POST['Inventories']['branch_id'];

                //For Image Upload
                $fileExtension = pathinfo($_SESSION[Inventories::tbl()]['filename'], PATHINFO_EXTENSION);
                $newFilename = Settings::setLowerlAll(str_replace(' ', '_', $model->name)) . "." . $fileExtension;

                $model->file_path = 'images/inventories/';
                $model->file_pics = $newFilename;

                if ($model->validate()) {
                    $source = YiiBase::getPathOfAlias('webroot') . '/' . $_SESSION[Inventories::tbl()]['path'] . "/" . $_SESSION[Inventories::tbl()]['filename'];
                    $destination = YiiBase::getPathOfAlias('webroot') . '/' . $model->file_path . $newFilename;
                    rename($source, $destination);

                    $model->save();
                    Utilities::set_Flash(Utilities::FLASH_SUCCESS, 'New Inventories Successfully Created.');
                    $this->redirect(array('view', 'id' => $model->id));
                } else {
                    Utilities::set_Flash(Utilities::FLASH_ERROR, Utilities::get_ModelErrors($model->errors));
                    $this->gotoCreate();
                }
            }

            $this->render('create', array(
                'model' => $model,
                'categoryID' => $categoryID,
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

            if (isset($_POST['Inventories'])) {
                $model->attributes = $_POST['Inventories'];
                $model->updated_at = Settings::get_DateTime();

                //For Image Upload
                $fileExtension = pathinfo($_SESSION[Inventories::tbl()]['filename'], PATHINFO_EXTENSION);
                if ($fileExtension != NULL) {
                    $newFilename = Settings::setLowerlAll(str_replace(' ', '_', $model->name)) . "." . $fileExtension;
                } else {
                    $newFilename = $model->file_pics;
                }

                $model->file_path = 'images/inventories/';
                $model->file_pics = $newFilename;

                if ($model->validate()) {
                    $source = YiiBase::getPathOfAlias('webroot') . '/' . $_SESSION[Inventories::tbl()]['path'] . "/" . $_SESSION[Inventories::tbl()]['filename'];
                    $destination = YiiBase::getPathOfAlias('webroot') . '/' . $model->file_path . $newFilename;
                    rename($source, $destination);

                    $model->save();
                    Utilities::set_Flash(Utilities::FLASH_SUCCESS, 'Inventories Successfully Updated');
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
            $model = new Inventories;

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
            $dataProvider = new CActiveDataProvider('Inventories');
            $this->render('index', array(
                'dataProvider' => $dataProvider,
            ));
        }

        /**
         * Manages all models.
         */
        public function actionAdmin() {
            Utilities::clearSessions(Inventories::tbl());
            unset($_SESSION[$_SESSION['lastSession']]);
            Utilities::setMenuActive_Siteadmin(Settings::get_ControllerID(), 'Inventories::tbl()', Settings::get_ActionID());


            $model = new Inventories('searchClient');
            $model->unsetAttributes();  // clear any default values
            if (isset($_GET['Inventories'])) {
                $model->attributes = $_GET['Inventories'];
                $model->is_deleted = Utilities::NO;
            }
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
                    $this->_model = Inventories::model()->findbyPk($_GET['id']);
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
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'inventories-form') {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
        }

        public function gotoCreate() {
            $this->redirect($this->createUrl('inventories/create'));
        }

        public function actionAddPhotoSubmit() {


            Yii::import("ext.EAjaxUpload.qqFileUploader");

            $path = 'images/inventories/tmp';
            $_SESSION[Inventories::tbl()]['path'] = $path;
            $allowedExtensions = array("jpg", "jpeg", "png"); //array("jpg","jpeg","gif","exe","mov" and etc...
            $sizeLimit = 10 * 1024 * 1024; // maximum file size in bytes
            $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
            $result = $uploader->handleUpload($path . '/');
            $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
            $fileName = $result['filename']; //GETTING FILE NAME
            $_SESSION[Inventories::tbl()]['filename'] = $fileName;

            echo $return; // it's array           
        }

        public function actionTest() {
            print 1;
        }

        public function actionPrintReport() {
            $model = new Inventories();
            $isError = 0;
            $reportType = $_POST['txtReportType'];
            unset($_SESSION[Inventories::tbl()]['report_type']);
            if ($reportType == '') {
                $isError = Utilities::YES;
                $message .= 'Report Type cannot be blank.' . "<br />";
            }


            if (isset($_POST['Inventories'])) {
                $model->attributes = $_POST['Inventories'];
                $model->updated_at = $_POST['Inventories']['updated_at'];

                $_SESSION[Inventories::tbl()]['report_type'] = $reportType;
                $_SESSION[Inventories::tbl()]['created_at'] = $model->created_at;
                $_SESSION[Inventories::tbl()]['updated_at'] = $model->updated_at;

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
                    $this->redirect($this->createUrl('inventories/adminReports', array(
                            'fromDate' => $startDate,
                            'toDate' => $endDate,
                            )
                    ));
                }
            } else {
                $model->created_at = $_SESSION[Inventories::tbl()]['created_at'];
                $model->updated_at = $_SESSION[Inventories::tbl()]['updated_at'];
            }

            $this->render('printReport', array(
                'model' => $model,
                )
            );
        }

        public function actionPrint() {
            $modelTransactions = new Inventories('search');
            $modelTransactions->unsetAttributes();  // clear any default values
            $endDate = $_GET['toDate'];
            $startDate = $_GET['fromDate'];

            if (isset($_GET['Inventories']))
                $modelTransactions->attributes = $_GET['Inventories'];

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

            $rawData = Inventories::model()->findAll(' is_deleted = :isDeleted AND client_id = :branchID  AND date(updated_at) between :startDate AND :endDate  order by   updated_at DESC', array(
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