<?php

    class UsersController extends ClientController {
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
                array('allow', // allow all users to perform 'index' and 'view' actions
                    'actions' => array('create', 'view', 'update', 'admin', 'delete', 'reset', 'changePassword', 'ajaxSumbitUserAccess'),
                    'users' => array('@'),
                ),
                array('deny', // deny all users
                    'users' => array('*'),
                ),
            );
        }

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        public function actionView() {
            $model = new Users();
            $modelEmployee = new Employees();
            $id = $_GET['id'];
            if ($id == '') {
                throw new CHttpException(404, 'Requested page does not exists');
            }
            $model = Utilities::model_getByID(Users::model(), $id);
            $this->render('view', array(
                'model' => $model,
            ));
        }

        /**
         * Creates a new model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         */
        public function actionCreate() {
            $model = new Users();
            $model->scenario = 'createUser';
            Utilities::setMenuActive_Siteadmin(Settings::get_ControllerID(), Settings::get_ActionID());
            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (isset($_POST['Users'])) {
                
                $model->attributes = $_POST['Users'];
                $model->created_at = Settings::get_DateTime();
                $model->updated_at = Settings::get_DateTime();
                $model->is_active = Utilities::YES;
                $model->pword_hash = md5($model->confirm_password);
                $model->client_id = Settings::get_ClientID();
                $model->branch_id =  $_POST['Users']['branch_id'];
                $model->is_employee = Utilities::YES;
                $model->role = ($model->role == Roles::ROLE_STAFF)?Roles::ROLE_STAFF:Roles::ROLE_MANAGER;

                if ($model->validate()) {
                    $model->save();
                    Employees::sql_updateIsAccountCreated($model->emp_id, Utilities::YES);
                    Utilities::set_Flash(Utilities::FLASH_SUCCESS, 'Account successfully created.');
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

        public function gotoCreate() {
            $this->redirect($this->createUrl('users/create'));
        }

        /**
         * Updates a particular model.
         * If update is successful, the browser will be redirected to the 'view' page.
         */
        public function actionUpdate() {
            $model = new Users();
            $model->unsetAttributes();  // clear any default values

            $model = Utilities::model_getByID(Users::model(), $_GET['id']);

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);
            if (isset($_POST['Users'])) {
                
                $model->attributes = $_POST['Users'];
               //s $model->scenario = 'updateChangePassword';
                if ($model->validate()) {
                    $model->updated_at = Settings::get_DateTime(); 
                    $model->new_password = $_POST['Users']['new_password'];
                    $model->confirm_password = $_POST['Users']['confirm_password'];
                    $model->role = $model->role;
                    $model->pword_hash = ($_POST['Users']['new_password'] != '') ? md5($_POST['Users']['new_password']) : $model->pword_hash;
                 

                    $model->save();
                    Utilities::set_Flash(Utilities::FLASH_SUCCESS, 'Users successfully updated.');
                    $this->redirect(array('view', 'id' => $model->id));
                } else {
                    Utilities::set_Flash(Utilities::FLASH_ERROR, Utilities::get_ModelErrors($model->errors));
                }
            }

            $this->render('update', array(
                'model' => $model,
                'modelUpdate' => $modelUpdate,
            ));
        }

        /**
         * Deletes a particular model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         */
        public function actionDelete() {
            $model = new Users();
            if (Yii::app()->request->isPostRequest) {
                // we only allow deletion via POST request
                $model = Utilities::model_getByID(Users::model(), $_GET['id']);
                $model->is_active = Utilities::NO;

                $model->save();

                Employees::sql_updateIsAccountCreated($model->emp_id, Utilities::NO);
                $this->redirect(array('admin'));
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
            $dataProvider = new CActiveDataProvider('Users');
            $this->render('index', array(
                'dataProvider' => $dataProvider,
            ));
        }

        /**
         * Manages all models.
         */
        public function actionAdmin() {


            unset($_SESSION[$_SESSION['lastSession']]);
            Utilities::setMenuActive_Siteadmin(Settings::get_ControllerID(), 'Users::tbl()', Settings::get_ActionID());
            $model = new Users('searchUsers');
            $model->unsetAttributes();  // clear any default values
            
//            Utilities::debug(Settings::get_ClientID(), $caption);exit();
            if (isset($_GET['Users'])) 
                $model->attributes = $_GET['Users'];
                $model->client_id = Settings::get_ClientID();
                $model->is_employee = Utilities::YES;
                $model->is_active = Utilities::YES;
            

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
                    $this->_model = Users::model()->findbyPk($_GET['id']);
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
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'users-form') {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
        }

        public function actionReset() {
            $model = new Users();
            $id = $_GET['id'];

            if ($id == '') {
                throw new CHttpException(404, 'Requested pag e does not exists.');
            }

            $model = Utilities::model_getByID(Users::model(), $id);

            if (isset($_POST['Users'])) {
                $model->attributes = $_POST['Users'];

                if ($model->pword_hash == md5($_POST['Users']['old_password'])) {
                    if ($_POST['Users']['old_password'] != $_POST['Users']['new_password']) {
                        if ($model->validate()) {
                            $model->updated_at = Settings::get_DateTime();
                            $model->pword_hash = md5($_POST['Users']['new_password']);

                            $model->save();
                            Utilities::set_Flash(Utilities::FLASH_SUCCESS, 'Users successfully Change.');
                            $this->redirect(array('view', 'id' => $model->id));
                        } else {
                            Utilities::set_Flash(Utilities::FLASH_ERROR, Utilities::get_ModelErrors($model->errors));
                        }
                    } else {
                        Utilities::set_Flash(Utilities::FLASH_ERROR, 'New password cannot be the same as the Old password.');
                    }
                } else {
                    Utilities::set_Flash(Utilities::FLASH_ERROR, 'Incorrect old password.');
                }
            }

            $this->render('update', array(
                'model' => $model,
            ));
        }

        public function actionChangePassword() {
            $model = new Users();
            $model = Utilities::model_getByID(Users::model(), Settings::get_UserID());
            $model->scenario = 'changePassword';
            Utilities::setMenuActive_SiteAdmin(Settings::get_ControllerID(), Settings::get_ActionID());

            if (isset($_POST['Users'])) {
                $model->attributes = $_POST['Users'];
                $model->updated_at = Settings::get_DateTime();
                $model->pword_hash = md5($model->new_password);

                if ($model->validate()) {
                    $model->save();
                    Utilities::set_Flash(Utilities::FLASH_SUCCESS, 'Password Successfully Changed.');
                    $this->redirect(array('/site/login'));
                } else {
                    Utilities::set_Flash(Utilities::FLASH_ERROR, Utilities::get_ModelErrors($model->errors));
                }
            }
            $this->render('changePassword', array(
                'model' => $model,
            ));
        }

        public function actionAjaxSumbitUserAccess() {

            $model = new Menus();
            $modelUserAccess = new UserBasedAccess();
            $modelUsers = new Users();

            $userAccount = $_POST['userAccount'];
            $selected = $_POST['selected'];
            $unselected = $_POST['unselected'];


            $valueSelected = explode(',', rtrim($selected, ','));
            $arrayCountSelected = count($valueSelected);
            $valueUnselected = explode(',', rtrim($unselected, ','));
            $arrayCountUnselected = count($valueUnselected);
            // Utilities::debug($selected, $caption);exit();
            $isError = 0;
            $message = NULL;

            $modelUsers = Utilities::model_getByID(Users::model(), $userAccount);

            if (count($modelUsers) == 0) {
                $message = "User Account field cannot be blank";
                $isError = Utilities::YES;
            }

            if ($isError == 0) {
                $cnn = Utilities::createConnection();
                $trans = $cnn->beginTransaction();

                try {

                    for ($index = 0; $index < $arrayCountSelected; $index++) {

                        $model = Menus::model_getRowData_byID($valueSelected[$index]);
                        $modelUserSubModuleAccess = UserBasedAccess::model_getByMenuIDUserID($model->id, $userAccount);

                        if ($model->parent_id != 0) {

                            $modelParent = Menus::model_getRowData_byID($model->parent_id);
                            $modelUserParentModuleAccess = UserBasedAccess::model_getByMenuIDUserID($modelParent->id, $userAccount);

                            if ($modelUserParentModuleAccess->id != 0 || $modelUserParentModuleAccess->id != "")
                                UserBasedAccess::sql_updateIsAccessible_byMenuIDUserID($modelUserParentModuleAccess->menu_id, $modelUserParentModuleAccess->user_id, Utilities::YES);
                            else
                                $this->addRecord($modelParent, $modelUsers->id);
                        }

                        if ($modelParent->parent_id != 0) {

                            $modelParentParent = Menus::model_getRowData_byID($modelParent->parent_id);
                            $modelParentParentModuleAccess = UserBasedAccess::model_getByMenuIDUserID($modelParentParent->id, $userAccount);

                            if ($modelParentParentModuleAccess->id != 0 || $modelParentParentModuleAccess->id != "")
                                UserBasedAccess::sql_updateIsAccessible_byMenuIDUserID($modelParentParentModuleAccess->menu_id, $modelParentParentModuleAccess->user_id, Utilities::YES);
                            else
                                $this->addRecord($modelParentParent, $modelUsers->id);
                        }

                        if ($modelUserSubModuleAccess->id != 0 || $modelUserSubModuleAccess->id != "")
                            UserBasedAccess::sql_updateIsAccessible_byMenuIDUserID($modelUserSubModuleAccess->menu_id, $modelUserSubModuleAccess->user_id, Utilities::YES);
                        else
                            $this->addRecord($model, $modelUsers->id);
                    }
                    for ($indexUnselected = 0; $indexUnselected < $arrayCountUnselected; $indexUnselected++) {
                        $modelUnselected = Menus::model_getRowData_byID($valueUnselected[$indexUnselected]);

                        $modelUserSubModuleUnselected = UserBasedAccess::model_getByMenuIDUserID($modelUnselected->id, $userAccount);
                        $modelParentUnselected = Menus::model_getRowData_byID($modelUnselected->parent_id);
                        $modelUserParentModuleAccessUnselected = UserBasedAccess::model_getByMenuIDUserID($modelParentUnselected->id, $userAccount);
                        $modelParentParentUnselected = Menus::model_getRowData_byID($modelParentUnselected->parent_id);
                        $modelParentParentModuleAccessUnselected = UserBasedAccess::model_getByMenuIDUserID($modelParentParentUnselected->id, $userAccount);

                        if ($modelUserSubModuleUnselected->id != 0 || $modelUserSubModuleUnselected->id != "") {
                            UserBasedAccess::sql_updateIsAccessible_byMenuIDUserID($modelUserSubModuleUnselected->menu_id, $modelUserSubModuleUnselected->user_id, Utilities::NO);
                        }
                        if ($modelUserParentModuleAccessUnselected->id != 0 || $modelUserParentModuleAccessUnselected->id != "") {
                            $children = UserBasedAccess::model_getChildrenByParentIDUserID($modelParentUnselected->id, $userAccount, Utilities::YES);

                            if (count($children) == 0)
                                UserBasedAccess::sql_updateIsAccessible_byMenuIDUserID($modelUserParentModuleAccessUnselected->menu_id, $modelUserParentModuleAccessUnselected->user_id, Utilities::NO);
                        }
                        if ($modelParentParentModuleAccessUnselected->id != 0 || $modelParentParentModuleAccessUnselected->id != "") {
                            $parentChildren = UserBasedAccess::model_getChildrenByParentIDUserID($modelParentParentUnselected->id, $userAccount, Utilities::YES);
                            if (count($parentChildren) == 0)
                                UserBasedAccess::sql_updateIsAccessible_byMenuIDUserID($modelParentParentModuleAccessUnselected->menu_id, $modelParentParentModuleAccessUnselected->user_id, Utilities::NO);
                        }
                    }
                    if ($isError == Utilities::NO) {
                        Users::sql_updateIsOverrideUserAccess($userAccount, Utilities::YES);
                        $message = "User Access Role successfully updated.";
                        $trans->commit();
                    }
                } catch (Exception $e) {
                    $trans->rollBack();
                    $isError = Utilities::YES;
                    $message = 'Failed to setup User Access Role(s).';
                }
            }

            $returnMsg['isError'] = $isError;
            $returnMsg['message'] = $message;

            print json_encode($returnMsg);
        }

        public function addRecord($modelData, $userID) {
            $model = new UserBasedAccess();
            $model->updated_at = Settings::get_DateTime();
            $model->created_at = Settings::get_DateTime();
            $model->module_id = $modelData->module_id;
            $model->menu_id = $modelData->id;
            $model->user_id = $userID;
            $model->controller_id = $modelData->controller_id;
            $model->controller_name = $modelData->controller_name;
            $model->action_id = $modelData->action_id;
            $model->action_name = $modelData->action_name;
            $model->is_accesible = Utilities::YES;
            $model->parent_id = $modelData->parent_id;
            $model->is_deleted = Utilities::NO;
            $modelArr = $model->addRecord();
        }

    }
    