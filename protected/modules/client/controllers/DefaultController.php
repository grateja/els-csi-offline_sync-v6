<?php

class DefaultController extends ClientController
{

    public function actionIndex()
    {
        $posTransactions = new PosTransactions();
        $paymentHeades = new PosPaymentHeaders();
        
        $modelMachine = new Machines('searchMachines');
        $modelMachine->unsetAttributes();
        if (isset($_GET['Machines']))
            $modelMachine->attributes = $_GET['Machines'];


        $modelCustomer = new Customers('search');
        $modelCustomer->unsetAttributes();
        if (isset($_GET['Customers']))
            $modelCustomer->attributes = $_GET['Customers'];
            $modelCustomer->is_deleted = Utilities::NO;

    
        $customers = Customers::model_getAllData_byDeleted(Utilities::NO);

        $customerList = null;
        foreach ($customers as $customer)
        {
            $customerList .= '[' . $customer->id . ' ' . $customer->lnameFname . ']';
        }

        $customerList = substr($customerList, 0, strlen($customerList));


        $this->render('index', array(
            'modelMachine' => $modelMachine,
            'modelCustomer' => $modelCustomer,
            'customerList' => $customerList,
            'paymentHeades' => $paymentHeades,
            'posTransactions' => $posTransactions,
        ));
    }

    public function actionSetActiveTab()
    {

        $sessionID = $_GET['sessionID'];
        $_SESSION['Default']['session-none'] = $sessionID;

        if ($sessionID == 1) {
            $_SESSION['Default']['demo-lft-tab-1'] = 'active in';
            $_SESSION['Default']['demo-lft-tab-2'] = NULL;
            $_SESSION['Default']['demo-lft-tab-3'] = NULL;
        } else if ($sessionID == 2) {

            $_SESSION['Default']['demo-lft-tab-1'] = NULL;
            $_SESSION['Default']['demo-lft-tab-2'] = 'active in';
            $_SESSION['Default']['demo-lft-tab-3'] = NULL;
        } else {
            $_SESSION['Default']['demo-lft-tab-1'] = NULL;
            $_SESSION['Default']['demo-lft-tab-2'] = NULL;
            $_SESSION['Default']['demo-lft-tab-3'] = 'active in';
        }
        print $_SESSION['Default']['session-none'];
    }

    public function actionDailySales()
    {

        $filtersForm = new FiltersForm;
        if (isset($_GET['FiltersForm']))
            $filtersForm->filters = $_GET['FiltersForm'];

        $rawData = CustomerPosTransactions::model()->findAll('date(created_at) = :createdAt  AND is_deleted = :isDeleted order by created_at  ASC ', array(
            'createdAt' => Settings::get_Date(),
            'isDeleted' => Utilities::NO,
        ));
        $filteredData = $filtersForm->filter($rawData);

        $result = new CArrayDataProvider($filteredData, array(
            'pagination' => array(
                'pageSize' => 10000,
            ),
        ));
        $this->render('_dailySales', array(
            'result' => $result,
            'filtersForm' => $filtersForm,
        ));
    }

    public function actionSetMenuActive()
    {
        $tabID = $_GET['tabID'];
        if ($tabID == 'washer') {
            $_SESSION['Dashboard']['washer'] = "active";
            $_SESSION['Dashboard']['dryer'] = NULL;
        } else if ($tabID == 'dryer') {
            $_SESSION['Dashboard']['washer'] = NULL;
            $_SESSION['Dashboard']['dryer'] = "active";
        }
    }

    public function actionView(){
        $headerID = $_GET['id'];
        $filtersForm = new FiltersForm;
        if (isset($_GET['FiltersForm']))
            $filtersForm->filters = $_GET['FiltersForm'];

        $rawData = PosPaymentDetails::model()->findAll('header_id = :headerID  AND is_deleted = :isDeleted order by created_at  ASC ', array(
            'headerID' =>$headerID,
            'isDeleted' => Utilities::NO,
        ));
        $filteredData = $filtersForm->filter($rawData);

        $result = new CArrayDataProvider($filteredData, array(
            'pagination' => array(
                'pageSize' => 10000,
            ),
        ));
        $this->render('_details', array(
            'result' => $result,
            'filtersForm' => $filtersForm,
        ));
    }
}
