<?php

class SettingsController extends SiteAdminController {
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
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array(
                    'create',
                    'update',
                    'delete',
                    'admin',
                    'view',
                    'setSessionData',
                    'setSessionDataDetails',
                    'setSessionDataWithPeso',
                    'outputFile',
                    'addFiles',
                    'addFilesMultiple',
                    'retrieveSessionDataUrl'
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
    public function actionView()
    {
        $this->render('view', array(
            'model' => $this->loadModel(),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {

        unset($_SESSION[$_SESSION['lastSession']]);
        Utilities::setMenuActive_Siteadmin(Settings::get_ControllerID(), 'Settings::tbl()', Settings::get_ActionID());
        $model = new Settings;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Settings'])) {
            $model->attributes = $_POST['Settings'];
            $model->created_at = Settings::get_DateTime();
            $model->updated_at = Settings::get_DateTime();
            $model->is_deleted = Utilities::NO;

            if ($model->validate()) {
                $model->save();
                Utilities::set_Flash(Utilities::FLASH_SUCCESS, 'New Settings Successfully Created.');
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
    public function actionUpdate()
    {
        $model = $this->loadModel();

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Settings'])) {
            $model->attributes = $_POST['Settings'];
            $model->updated_at = Settings::get_DateTime();

            if ($model->validate()) {
                $model->save();
                Utilities::set_Flash(Utilities::FLASH_SUCCESS, 'Settings Successfully Updated');
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
    public function actionDelete()
    {
        $model = new Settings;

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
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Settings');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        unset($_SESSION[$_SESSION['lastSession']]);
        Utilities::setMenuActive_Siteadmin(Settings::get_ControllerID(), 'Settings::tbl()', Settings::get_ActionID());
        $model = new Settings('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Settings']))
            $model->attributes = $_GET['Settings'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     */
    public function loadModel()
    {
        if ($this->_model === null) {
            if (isset($_GET['id']))
                $this->_model = Settings::model()->findbyPk($_GET['id']);
            if ($this->_model === null)
                throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $this->_model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'settings-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function gotoCreate()
    {
        $this->redirect($this->createUrl('Settings/create'));
    }

    public function actionSetSessionData()
    {
        $value = $_GET['value'];
        $_SESSION[$_GET['controllerID']::tbl()][$_GET['fieldID']] = $value;
        print $value;
    }

    public function actionSetSessionDataDetails()
    {
        $value = $_GET['value'];
        $_SESSION[$_GET['controllerID']::tbl()][$_GET['rowID']][$_GET['fieldID']] = $value;

        print $value;
    }

    public function actionSetSessionDataWithPeso()
    {
        $value = $_GET['value'];
        $_SESSION[$_GET['controllerID']::tbl()][$_GET['fieldID']] = '₱ ' . Settings::setNumberFormat($value, 2);
        print '₱ ' . Settings::setNumberFormat($value, 2);
    }

//    public function actionOutputFile($outputFileName, $content, $mimeType, $terminate)
    public function actionOutputFile()
    {
        $name = $_GET['fileName'];
        $path = $_GET['content'];

        $dir_path = Yii::getPathOfAlias('webroot') . '/' . $path;

        $fileName = $dir_path . "$name";

        if (file_exists($fileName))
            return Yii::app()->getRequest()->sendFile($name, @file_get_contents($fileName));
        else
            throw new CHttpException(404, 'The requested page does not exist.');
    }

    public function actionAddFiles()
    {

        Yii::import("ext.EAjaxUpload.qqFileUploader");
        if ($_SESSION[Settings::tbl()]['filePath'] != '') {
            $this->recursiveRemoveDirectory($_SESSION[Settings::tbl()]['filePath']);
        }
        $path = $_GET['path'];
        $_SESSION[Settings::tbl()]['path'] = $path;
        $allowedExtensions = array("pdf", "docx", "xlsx", "csv");
        $sizeLimit = 5 * 1024 * 1024; // maximum file size in bytes
        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload($path . '/');
        $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
        $fileName = $result['filename']; //GETTING FILE NAME
        $_SESSION[Settings::tbl()]['filename'] = $fileName;

        echo $return; // it's array           
    }

    public function actionAddFilesMultiple()
    {
        $path = $_GET['path'];
        $fieldID = $_GET['fieldID'];

        Yii::import("ext.EAjaxUpload.qqFileUploader");
        if ($_SESSION[Settings::tbl()][$fieldID]['filePath'] != '') {
            $this->recursiveRemoveDirectory($_SESSION[Settings::tbl()][$fieldID]['filePath']);
        }
        $_SESSION[Settings::tbl()][$fieldID]['path'] = $path;
        $allowedExtensions = array("pdf", "docx", "xlsx", "csv");
        $sizeLimit = 5 * 1024 * 1024; // maximum file size in bytes
        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload($path . '/');
        $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
        $fileName = $result['filename']; //GETTING FILE NAME
        $_SESSION[Settings::tbl()][$fieldID]['filename'] = $fileName;

        echo $return; // it's array           
    }

    public function actionRetrieveSessionDataUrl()
    {
        print Settings::sessionDataUrl();
    }

}
