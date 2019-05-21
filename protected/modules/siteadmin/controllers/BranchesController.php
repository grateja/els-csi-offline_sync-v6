<?php

    class BranchesController extends SiteAdminController {
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
                    'actions' => array('create', 'update', 'delete', 'admin', 'view', 'addPhotoSubmit'),
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
            $model = new Branches;

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (isset($_POST['Branches'])) {
                $model->attributes = $_POST['Branches'];
                $model->created_at = Settings::get_DateTime();
                $model->updated_at = Settings::get_DateTime();
                $model->user_id  = Settings::get_UserID();
                //For Image Upload
                $fileExtension = pathinfo($_SESSION[Branches::tbl()]['filename'], PATHINFO_EXTENSION);
                if ($fileExtension != NULL) {
                    $newFilename = Settings::setLowerlAll(str_replace(' ', '_', $model->name)) . "." . $fileExtension;
                } else {
                    $newFilename = $model->file_pics;
                }
                $model->file_path = 'images/';
                $model->file_pics = $newFilename;
                if ($model->validate()) {

                    $source = YiiBase::getPathOfAlias('webroot') . '/' . $_SESSION[Branches::tbl()]['path'] . "/" . $_SESSION[Branches::tbl()]['filename'];
                    $destination = YiiBase::getPathOfAlias('webroot') . '/' . $model->file_path . $newFilename;
//                    Utilities::debug($source, $caption);exit();
                    rename($source, $destination);
                    $model->save();

                    $field = 'value';
                    Settings::sql_updateRecord(Settings::CONFIG_BRANCH_NAME, $model->name, $field);
                    Utilities::set_Flash(Utilities::FLASH_SUCCESS, 'New Branches Successfully Created.');
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

            if (isset($_POST['Branches'])) {
                $model->attributes = $_POST['Branches'];
                $model->updated_at = Settings::get_DateTime();
                //For Image Upload
                $fileExtension = pathinfo($_SESSION[Branches::tbl()]['filename'], PATHINFO_EXTENSION);
                if ($fileExtension != NULL) {
                    $newFilename = Settings::setLowerlAll(str_replace(' ', '_', $model->name)) . "." . $fileExtension;
                } else {
                    $newFilename = $model->file_pics;
                }

                $model->file_path = 'images/';
                $model->file_pics = $newFilename;
                if ($model->validate()) {

                    $source = YiiBase::getPathOfAlias('webroot') . '/' . $_SESSION[Branches::tbl()]['path'] . "/" . $_SESSION[Branches::tbl()]['filename'];
                    $destination = YiiBase::getPathOfAlias('webroot') . '/' . $model->file_path . $newFilename;
//                    Utilities::debug($source, $caption);exit();
                    rename($source, $destination);

                    $model->save();

                    $field = 'value';
                    Settings::sql_updateRecord(Settings::CONFIG_BRANCH_NAME, $model->name, $field);
                    Utilities::set_Flash(Utilities::FLASH_SUCCESS, 'Branches Successfully Updated');
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
            $model = new Branches;

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
            $dataProvider = new CActiveDataProvider('Branches');
            $this->render('index', array(
                'dataProvider' => $dataProvider,
            ));
        }

        /**
         * Manages all models.
         */
        public function actionAdmin() {
            unset($_SESSION[$_SESSION['lastSession']]);
            Utilities::setMenuActive_Siteadmin(Settings::get_ControllerID(), 'Branches::tbl()', Settings::get_ActionID());
            $model = new Branches('search');
            $model->unsetAttributes();  // clear any default values
            if (isset($_GET['Branches']))
                $model->attributes = $_GET['Branches'];
            $model->is_deleted = Utilities::NO;

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
                    $this->_model = Branches::model()->findbyPk($_GET['id']);
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
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'branches-form') {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
        }

        public function gotoCreate() {
            $this->redirect($this->createUrl('branches/create'));
        }

        public function actionAddPhotoSubmit() {


            Yii::import("ext.EAjaxUpload.qqFileUploader");

            $path = 'images/employees/tmp';
            $_SESSION[Branches::tbl()]['path'] = $path;
            $allowedExtensions = array("jpg", "jpeg", "png"); //array("jpg","jpeg","gif","exe","mov" and etc...
            $sizeLimit = 10 * 1024 * 1024; // maximum file size in bytes
            $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
            $result = $uploader->handleUpload($path . '/');
            $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
            $fileName = $result['filename']; //GETTING FILE NAME
            $_SESSION[Branches::tbl()]['filename'] = $fileName;

            echo $return; // it's array           
        }

    }
    