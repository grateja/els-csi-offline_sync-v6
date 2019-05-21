<?php

    class PurchasesController extends SiteAdminController {
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
                    'actions' => array('create', 'update', 'delete', 'admin', 'view'),
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
            $model = new Purchases;

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (isset($_POST['Purchases'])) {
                $model->attributes = $_POST['Purchases'];
                $_SESSION[Expenses::tbl()]['date'] = $model->date;
                $model->created_at = Settings::get_DateTime();
                $model->updated_at = Settings::get_DateTime();
                $model->date = Settings::get_Date();
                $model->user_id = Settings::get_UserID();
                $model->branch_id = Settings::get_BranchID();
                $model->client_id = Settings::get_ClientID();
                $model->expenses_id = ExpensesTypes::EXPENSES_TYPE_PURCHASES;

                if ($model->validate()) {

                    $cnn = Utilities::createConnection();
                    $trans = $cnn->beginTransaction();
                    try {
                        $modelEpenses = new Expenses();
                        $modelEpenses->created_at = Settings::get_DateTime();
                        $modelEpenses->updated_at = Settings::get_DateTime();
                        $modelEpenses->date = Settings::get_Date();
                        $modelEpenses->ref_no = Expenses::createNewRefNo();
                        $modelEpenses->expenses_type_id = $model->expenses_id;
                        $modelEpenses->title = $modelEpenses->expensesTypes->name;
                        $modelEpenses->amount = $model->total;
                        $modelEpenses->remarks = 'Purchase of ' . $model->inventories->name;
                        $modelEpenses->client_id = Settings::get_ClientID();
                        $modelEpenses->branch_id = Settings::get_BranchID();
                        $modelEpensesArr = $modelEpenses->addRecord();
                        if ($modelEpensesArr[0] != 0) {
                            $model->expenses_id = $modelEpensesArr[0];
                            $model->save();
                            Inventories::sql_addQtyStock($model->inv_id, $model->qty);
                            Inventories::sql_updateCost($model->inv_id, $model->price);
                            $trans->commit();
                            Utilities::set_Flash(Utilities::FLASH_SUCCESS, 'Records successfully saved.');
                            $this->redirect(array('admin'));
                        }
                    } catch (Exception $e) {
                        $trans->rollBack();
                        $isError = Utilities::YES;
                        Utilities::set_Flash(Utilities::FLASH_ERROR, 'Failed to create Expenses Journal Entry.');
                    }
                } else {
                    Utilities::set_Flash(Utilities::FLASH_ERROR, Utilities::get_ModelErrors($model->errors));
                    $this->gotoCreate();
                }
            } else {

                $model->date = $_SESSION[Expenses::tbl()]['date'];
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

            if (isset($_POST['Purchases'])) {
                $model->attributes = $_POST['Purchases'];
                $model->updated_at = Settings::get_DateTime();

                if ($model->validate()) {
                    $model->save();
                    Utilities::set_Flash(Utilities::FLASH_SUCCESS, 'Purchases Successfully Updated');
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
            $model = new Purchases;

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
            $dataProvider = new CActiveDataProvider('Purchases');
            $this->render('index', array(
                'dataProvider' => $dataProvider,
            ));
        }

        /**
         * Manages all models.
         */
        public function actionAdmin() {

            $model = new Purchases('search');
            $model->unsetAttributes();  // clear any default values
            if (isset($_GET['Purchases']))
                $model->attributes = $_GET['Purchases'];
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
                    $this->_model = Purchases::model()->findbyPk($_GET['id']);
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
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'purchases-form') {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
        }

        public function gotoCreate() {
            $this->redirect($this->createUrl('purchases/create'));
        }

    }
    