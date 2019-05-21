<?php

    class PosPaymentHeadersController extends ClientController {
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
                    'actions' => array('create', 'update', 'delete', 'admin', 'view', 'adminUnpaidTransactions','adminReceipts'),
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
            
            $model = new PosPaymentHeaders();
            $id = $_GET['id'];
            
            $model = Utilities::model_getByID(PosPaymentHeaders::model(), $id);
             $filtersForm = new FiltersForm;
            if (isset($_GET['FiltersForm']))
                $filtersForm->filters = $_GET['FiltersForm'];

            $rawData = PosPaymentDetails::model()->findAll(' is_deleted = :isDeleted AND header_id = :headerID', array(
                'isDeleted' => Utilities::NO,
                'headerID' => $id,
            ));
            $filteredData = $filtersForm->filter($rawData);

            $result = new CArrayDataProvider($filteredData, array(
                'pagination' => array(
                    'pageSize' => 10000,
                ),
            ));
            $this->render('view', array(
                'model' => $model,
                'result' => $result,
                'modelDetails' => $rawData,
            ));
        }

        /**
         * Creates a new model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         */
        public function actionCreate() {
            $model = new PosPaymentHeaders;

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (isset($_POST['PosPaymentHeaders'])) {
                $model->attributes = $_POST['PosPaymentHeaders'];
                $model->created_at = Settings::get_DateTime();
                $model->updated_at = Settings::get_DateTime();

                if ($model->validate()) {
                    $model->save();
                    Utilities::set_Flash(Utilities::FLASH_SUCCESS, 'New PosPaymentHeaders Successfully Created.');
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

            if (isset($_POST['PosPaymentHeaders'])) {
                $model->attributes = $_POST['PosPaymentHeaders'];
                $model->updated_at = Settings::get_DateTime();

                if ($model->validate()) {
                    $model->save();
                    Utilities::set_Flash(Utilities::FLASH_SUCCESS, 'PosPaymentHeaders Successfully Updated');
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
            $model = new PosPaymentHeaders;

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
            $dataProvider = new CActiveDataProvider('PosPaymentHeaders');
            $this->render('index', array(
                'dataProvider' => $dataProvider,
            ));
        }

        /**
         * Manages all models.
         */
        public function actionAdmin() {
            unset($_SESSION[$_SESSION['lastSession']]);
            Utilities::setMenuActive_Siteadmin(Settings::get_ControllerID(), 'PosPaymentHeaders::tbl()', Settings::get_ActionID());
            $model = new PosPaymentHeaders('search');
            $model->unsetAttributes();  // clear any default values
            if (isset($_GET['PosPaymentHeaders']))
                $model->attributes = $_GET['PosPaymentHeaders'];
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
                    $this->_model = PosPaymentHeaders::model()->findbyPk($_GET['id']);
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
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'pos-payment-headers-form') {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
        }

        public function gotoCreate() {
            $this->redirect($this->createUrl('posPaymentHeaders/create'));
        }


        
         public function actionAdminUnpaidTransactions() {
            unset($_SESSION[$_SESSION['lastSession']]);
            Utilities::setMenuActive_Siteadmin(Settings::get_ControllerID(), 'PosPaymentHeaders::tbl()', Settings::get_ActionID());
            $model = new PosPaymentHeaders('search');
            $model->unsetAttributes();  // clear any default values
            if (isset($_GET['PosPaymentHeaders']))
                $model->attributes = $_GET['PosPaymentHeaders'];
            $model->is_deleted = Utilities::NO;
            $model->client_id = Settings::get_ClientID();

            $this->render('admin', array(
                'model' => $model,
            ));
        }
        
        public function actionAdminReceipts(){
             $filtersForm = new FiltersForm;
            if (isset($_GET['FiltersForm']))
                $filtersForm->filters = $_GET['FiltersForm'];

            $rawData = PosPaymentHeaders::model()->findAll(' is_deleted = :isDeleted  AND client_id = :clientID  order by or_no DESC', array(
                'isDeleted' => Utilities::NO,
                'clientID' => Settings::get_ClientID(),
            ));
            $filteredData = $filtersForm->filter($rawData);

            $result = new CArrayDataProvider($filteredData, array(
                'pagination' => array(
                    'pageSize' => 10000,
                ),
            ));
            $this->render('adminReceipts', array(
                'result' => $result,
                'filtersForm' => $filtersForm,
            ));
        }

    }
    