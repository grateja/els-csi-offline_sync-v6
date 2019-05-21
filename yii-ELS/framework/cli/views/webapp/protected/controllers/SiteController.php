<?php

class SiteController extends FrontController
{

    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $this->render('index');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact()
    {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                    "Reply-To: {$model->email}\r\n" .
                    "MIME-Version: 1.0\r\n" .
                    "Content-type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
      public function actionLogin()
    {
        $model = new LoginForm;
        $accountTypes = new AccountTypes();

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate()) {
                $accountTypes = Utilities::model_getByID($accountTypes, Settings::get_AccountTypeID());
                $this->redirect($this->createUrl($accountTypes->landing_module . '/' . $accountTypes->landing_controller . '/' . $accountTypes->landing_action));
            } else {
                Utilities::set_Flash(Utilities::FLASH_ERROR, 'Incorrect username or password.');
            }
        }
        $this->render('login', array('model' => $model));
    }
    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionTest()
    {

        $CustomerPaymentHeaders = $_SESSION[Settings::tbl()];
        Utilities::debug($CustomerPaymentHeaders, '$CustomerPaymentHeaders');
        exit();
    }

    public function retrieveInvID()
    {
        print 'Total Rows: ' . $_SESSION[PropertiesRequisitionDetails::tbl()]['totalRows'] . '<br/>';
        for ($index = 0; $index < $_SESSION[PropertiesRequisitionDetails::tbl()]['totalRows']; $index++)
        {
            print 'InventoryID: ' . $_SESSION[PropertiesRequisitionDetails::tbl()][$index + 1]['inv_id'] . '<br/>';
        }
    }

    public function ajaxSubmitData()
    {
        $isError = 0;
        $message = null;

        $cnn = Utilities::createConnection();

        $_SESSION[SuppliesRequisitionDetails::tbl()]['is_success'] = Utilities::NO;


        /* Payment Details */
        $isDetails = Utilities::NO;

        print 'Rows: ' . $_SESSION[SuppliesRequisitionDetails::tbl()]['totalRows'] . '<br/>';
        for ($index = 1; $index <= $_SESSION[SuppliesRequisitionDetails::tbl()]['totalRows']; $index++)
        {
            print 'InvID: ' . $_SESSION[SuppliesRequisitionDetails::tbl()][$index]['inv_id'] . '<br>';
            if ($_SESSION[SuppliesRequisitionDetails::tbl()][$index]['is_deleted'] == Utilities::NO) {
                $isDetails = Utilities::YES;
                $message = null;
                if ($_SESSION[SuppliesRequisitionDetails::tbl()][$index]['inv_id'] == '') {
                    $message .= 'Inventory should not be blank.';
                }
                if ($_SESSION[SuppliesRequisitionDetails::tbl()][$index]['quantity'] == '') {
                    $message .= '<br/>Quantity should not be blank';
                }
                if ($_SESSION[SuppliesRequisitionDetails::tbl()][$index]['quantity'] <= 0) {
                    $message .= '<br/>Quantity should be greater than 0';
                }
            }
        }

        if ($isDetails == Utilities::NO) {
            $isError = Utilities::YES;
            $message .= 'Please select/enter atleast 1 Inventory.';
        }

        if ($message != '') {
            $isError = 1;
        }

        if ($isError == Utilities::NO) {

            $cnn = Utilities::createConnection();
            $trans = $cnn->beginTransaction();

            try {

                $isError = Utilities::NO;

                $headerArr = SuppliesRequisitionHeaders::addRecord_bySessions();
                $headerID = $headerArr[0];
                print 'HeaderID: ' . $headerID . '<br>';
                if ($headerID != 0) {
                    $_SESSION[SuppliesRequisitionHeaders::tbl()]['id'] = $headerID;
                    $isDetailSuccess = SuppliesRequisitionDetails::addRecord_bySessions($headerID);
                    $_SESSION[SuppliesRequisitionHeaders::tbl()]['is_success'] = Utilities::NO;

                    if ($isDetailSuccess == Utilities::YES) {

                        $isError = Utilities::NO;
                        $_SESSION[SuppliesRequisitionHeaders::tbl()]['is_success'] = Utilities::YES;
                        $message = 'Supplies Requisition Successfully Created';
                        $trans->commit();
                    } else {
                        $isError = Utilities::YES;
                        $message = $detailsArr[1];
                        $trans->rollBack();
                    }
                } else {
                    $isError = 1;
                    $message = $headerArr[1];
                }
            } catch (Exception $e) {

                Utilities::debug($e, 'debug');
                $trans->rollBack();

                $isError = Utilities::YES;
                $message = 'Supplies Requisition Failed';
            }
        }


        $returnMsg['isError'] = $isError;
        $returnMsg['message'] = $message;

        print $isError . '=' . $message;
        //print json_encode($returnMsg);
    }

}
