<?php

    class RestController extends Controller {

        public function filters() {
            return array(
                'accessControl', // perform access control for CRUD operations
                'postOnly + create',
                'putOnly + update',
                'deleteOnly + delete',
            );
        }

        public function actionAuthenticate() {
            if (!isset($_GET['username']) && !isset($_GET['password'])) {
                $this->_sendResponse(401, $this->createResponse(401, null, "provide username and password"));
            } else {
                $user = new Users();
                $userID = Users::sql_validateAccount_byRoleID($_GET['username'], $_GET['password'], Roles::ROLE_CLIENT);
                $modelUser = Utilities::model_getByID(Users::model(), $userID);

                $identity = new UserIdentity($_GET['username'], $_GET['password']);
                Yii::app()->user->login($identity);
                $sessionID = Yii::app()->session->sessionID;
                if ($modelUser) {
                    $autokenModel = AuthToken::model_getData_byUserID($userID);
                    if ($autokenModel == null) {
                        $autokenModel = new AuthToken();
                        $autokenModel->userId = $userID;
                    }
                    $autokenModel->token = $sessionID;
                    $autokenModel->save();

                    $responseObject = (object) ['userDetails' => $modelUser, 'token' => $sessionID, 'clientName' => $modelUser->clients->fullName];
                    $this->_sendResponse(200, $this->createResponse(200, $responseObject, "successfully login"));
                } else {
                    $this->_sendResponse(401, $this->createResponse(401, null, "wrong username/passoword"));
                }
            }
        }

        public function actionLogout() {
            $identity = new UserIdentity($_GET['username'], $_GET['password']);
            Yii::app()->user->logout($identity);
            $this->_sendResponse(200, $this->createResponse(200, null, "Successfully logout"));
        }

        private function createResponse($status, $data, $message) {
            return CJSON::encode([
                    'status' => $status,
                    'data' => $data,
                    'message' => $message,
            ]);
        }

        public function actionList() {
            if ($_GET['authToken']) {
                $autokenModel = AuthToken::model()->findByAttributes(array(
                    'token' => $_GET['authToken'],
                ));
                if (empty($autokenModel)) {
                    $this->_sendResponse(401, null, sprintf('Unauthorized Access'));
                } else {
                    $userID = $autokenModel->userId;
                    $modelUser = Utilities::model_getByID(Users::model(), $userID);
                    $listOfBranches = Branches::model_getAllData_byClientId($modelUser->client_id);
//                             Utilities::debug($listOfBranches, $caption);exit();
                    $previousDate = new DateTime();
                    $previousDate->modify("last day of previous month");
                    $previousMOnth = $previousDate->format("Y/m/d");

                    $rows = array();
                    for ($x = 0; $x < count($listOfBranches); $x++) {
                        $rows[$x]['name'] = $listOfBranches[$x]->name;
                        $rows[$x]['address'] = $listOfBranches[$x]->address;
                        $rows[$x]['city'] = preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities($listOfBranches[$x]->municipalities->name));

                        $rows[$x]['revenue']['current_month'] = (float) PosTransactions::sql_getTotalRevenueBasedOnDate($listOfBranches[$x]->id, date('Y/m/d'));
                        $rows[$x]['revenue']['previous_month'] = (float) PosTransactions::sql_getTotalRevenueBasedOnDate($listOfBranches[$x]->id, $previousMOnth);
                        $rows[$x]['revenue']['charts'] = $this->getPostTransactions($listOfBranches[$x]->id, Settings::get_DateTime(), 1);

                        $rows[$x]['expenses']['current_month'] = (float) Expenses::sql_getTotalExpensesBasedOnDate($listOfBranches[$x]->id, date('Y/m/d'));
                        $rows[$x]['expenses']['previous_month'] = (float) Expenses::sql_getTotalExpensesBasedOnDate($listOfBranches[$x]->id, $previousMOnth);
                        $rows[$x]['expenses']['charts'] = $this->getExpenses($listOfBranches[$x]->id, Settings::get_DateTime());

                        $rows[$x]['customers']['current_month'] = (int) Customers::sql_countCustomerBasedOnBranchIdAndDeleted($listOfBranches[$x]->id, date('Y/m/d'));
                        $rows[$x]['customers']['previous_month'] = (int) Customers::sql_countCustomerBasedOnBranchIdAndDeleted($listOfBranches[$x]->id, $previousMOnth);
                        $rows[$x]['customers']['charts'] = $this->getCustomers($listOfBranches[$x]->id, date('Y/m/d'));

                        $rows[$x]['account_receivables']['current_month'] = (float) PosTransactions::sql_getTotalAccountReceivablesOnDate($listOfBranches[$x]->id, date('Y/m/d'));
                        $rows[$x]['account_receivables']['previous_month'] = (float) PosTransactions::sql_getTotalAccountReceivablesOnDate($listOfBranches[$x]->id, $previousMOnth);
                        $rows[$x]['account_receivables']['charts'] = $this->getPostTransactions($listOfBranches[$x]->id, Settings::get_DateTime(), 0);

                        $rows[$x]['volume']['current_month'] = (float) PosTransactions::sql_getVolumeOnDateByServiceType($listOfBranches[$x]->id, date('Y/m/d'));
                        $rows[$x]['volume']['previous_month'] = (float) PosTransactions::sql_getVolumeOnDateByServiceType($listOfBranches[$x]->id, $previousMOnth);
                        $rows[$x]['volume']['charts'] = $this->getVolumes($listOfBranches[$x]->id, Settings::get_DateTime(), 0);

                        $rows[$x]['P&L']['current_month'] = (float) PosTransactions::sql_getPandLOnDate($listOfBranches[$x]->id, date('Y/m/d'));
                        $rows[$x]['P&L']['previous_month'] = (float) PosTransactions::sql_getPandLOnDate($listOfBranches[$x]->id, $previousMOnth);
                        $rows[$x]['P&L']['charts'] = $this->getPandL($listOfBranches[$x]->id, date('Y/m/d'));

                        $rows[$x]['customer_visits']['current_month'] = (float) PosTransactions::sql_getCustomerTotalVisitsByDate($listOfBranches[$x]->id, date('Y/m/d'));
                        $rows[$x]['customer_visits']['previous_month'] = (float) PosTransactions::sql_getCustomerTotalVisitsByDate($listOfBranches[$x]->id, $previousMOnth);
                        $rows[$x]['customer_visits']['charts'] = $this->getCustomerVisits($listOfBranches[$x]->id, Settings::get_DateTime(), 0);
                    }

                    $this->_sendResponse(200, CJSON::encode($rows));
                }
            }
        }

        public function getExpenses($id, $lastSync) {

            $models = ExpensesTypes::model_getAllData_byDeleted(Utilities::NO);
            $rows = array();
            for ($x = 0; $x < count($models); $x++) {
                $rows[$x]['expense_type'] = $models[$x]['name'];
                $rows[$x]['value'] = (float) Expenses::sql_getTotalExpensesTypeIDBasedOnDate($id, $lastSync, $models[$x]['id']);
            }
            return $rows;
        }

        public function getPostTransactions($id, $lastSync, $isFullyPaid) {
            $models = InventoryCategories::model_getProductAndServices_byDeleted(Utilities::NO);
            $rows = array();
            for ($x = 0; $x < count($models); $x++) {
                $rows[$x]['item'] = $models[$x]['name'];
                $rows[$x]['value'] = (float) PosTransactions::sql_getTotalProductRevenueBasedOnDate($id, $lastSync, $models[$x]['id'], $isFullyPaid);
            }
            return $rows;
        }

        public function getCustomers($id, $lastSync) {
            $criteria = new CDbCriteria;
            $criteria->select = 'COUNT(cust_id) as numberOfTransactions, trans_date, cust_id';
            $criteria->together = true;
            $criteria->condition = 'branch_id=:branch_id  AND updated_at < :updatedAt AND is_deleted = :isDeleted GROUP BY branch_id,trans_date,transaction_name';
            $criteria->params = array(':branch_id' => $id, ':updatedAt' => date("Y-m-d H:i:s", strtotime($lastSync)), ':isDeleted' => Utilities::NO);

            $models = PosTransactions::model()->findAll($criteria);


            $yesterday = date("Y/m/j", strtotime('-1 days'));
            //Utilities::debug($lastSync, $caption);exit();
            $rows = array();
            for ($x = 0; $x < 1; $x++) {
                $rows[$x]['New'] = (float) Customers::sql_countNewCustomerBasedOnBranchIdAndDeleted($id, $yesterday);
                $rows[$x]['Old'] = (float) Customers::sql_countOldCustomerBasedOnBranchIdAndDeleted($id, $yesterday);
            }
            return $rows;
        }

        public function getVolumes($id, $lastSync) {
            $criteria = new CDbCriteria;
            $criteria->select = 'sum(qty) as numberOfTransactions, trans_date, cust_id';
            $criteria->together = true;
            $criteria->condition = 'branch_id=:branch_id  AND updated_at < :updatedAt AND inventory_type_id = 2 AND is_deleted = :isDeleted GROUP BY branch_id,trans_date,transaction_name';
            $criteria->params = array(':branch_id' => $id, ':updatedAt' => date("Y-m-d H:i:s", strtotime($lastSync)), ':isDeleted' => Utilities::NO);

            $models = PosTransactions::model()->findAll($criteria);

            $previousDate = new DateTime();
            $previousDate->modify("last day of previous month");
            $previousMOnth = $previousDate->format("Y/m/d");

            $rows = array();
            for ($x = 0; $x < 1; $x++) {
                $rows[$x]['Washer'] = (float) PosTransactions::sql_getVolumeOnDateServiceTypeID($id, date("Y-m-d H:i:s", strtotime($lastSync)), 1);
                $rows[$x]['Dryer'] = (float) PosTransactions::sql_getVolumeOnDateServiceTypeID($id, date("Y-m-d H:i:s", strtotime($lastSync)), 2);
            }
            return $rows;
        }

        public function getPandL($id, $lastSync) {
            $revenue = PosTransactions::sql_getTotalRevenueBasedOnDate($id, date("Y-m-d H:i:s", strtotime($lastSync)), 1);
            $expenses = Expenses::sql_getTotalExpensesBasedOnDate($id, date("Y-m-d H:i:s", strtotime($lastSync)));
            $receivables = PosTransactions::sql_getTotalAccountReceivablesOnDate($id, date("Y-m-d H:i:s", strtotime($lastSync)), 0);
            $profit = $revenue - $expenses;
            $rows = array();
            for ($x = 0; $x < 1; $x++) {
                $rows[$x]['revenue'] = (float) $revenue;
                $rows[$x]['expenses'] = (float) $expenses;
                $rows[$x]['profit'] = (float) $profit;
            }
            return $rows;
        }

        public function getCustomerVisits($id, $lastSync) {

            $month = date('Y-m-01', strtotime($lastSync));
            $week = date("Y-m-d", strtotime('monday this week', strtotime($lastSync)));

            $previousDate = new DateTime();
            $previousDate->modify("last day of previous month");
            $previousMOnth = $previousDate->format("Y/m/d");


            $rows = array();
            for ($x = 0; $x < 1; $x++) {
                $rows[$x]['New'] = (float) PosTransactions::sql_getNewCustomerVisitsByDate($id, $lastSync);
                $rows[$x]['Old'] = (float) PosTransactions::sql_getCustomerVisitsByDate($id, date("Y-m-d H:i:s", strtotime($previousMOnth)));
                //  $rows[$x]['current_month'] = (int) PosTransactions::sql_getCustomerVisitsByDate($id, $month);
            }
            return $rows;
        }

        private
            function _sendResponse($status = 200, $body = '', $content_type = 'json') {
            // set the status
            $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
            header($status_header);
            // and the content type
            header('Content-type: ' . $content_type);

            // pages with body are easy
            if ($body != '') {
                // send the body
                echo $body;
            } // we need to create the body if none is passed
            else {
                // create some body messages
                $message = '';

                // this is purely optional, but makes the pages a little nicer to read
                // for your users.  Since you won't likely send a lot of different status codes,
                // this also shouldn't be too ponderous to maintain
                switch ($status) {
                    case 401:
                        $message = 'You must be authorized to view this page.';
                        break;
                    case 404:
                        $message = 'The requested URL ' . $_SERVER['REQUEST_URI'] . ' was not found.';
                        break;
                    case 500:
                        $message = 'The server encountered an error processing your request.';
                        break;
                    case 501:
                        $message = 'The requested method is not implemented.';
                        break;
                }

                // servers don't always have a signature turned on
                // (this is an apache directive "ServerSignature On")
                $signature = ($_SERVER['SERVER_SIGNATURE'] == '') ? $_SERVER['SERVER_SOFTWARE'] . ' Server at ' . $_SERVER['SERVER_NAME'] . ' Port ' . $_SERVER['SERVER_PORT'] : $_SERVER['SERVER_SIGNATURE'];

                // this should be templated in a real-world solution
                $body = '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="json; charset=iso-8859-1">
    <title>' . $status . ' ' . $this->_getStatusCodeMessage($status) . '</title>
</head>
<body>
    <h1>' . $this->_getStatusCodeMessage($status) . '</h1>
    <p>' . $message . '</p>
    <hr />
    <address>' . $signature . '</address>
</body>
</html>';

                echo $body;
            }
            Yii::app()->end();
        }

        private
            function _getStatusCodeMessage($status) {
            // these could be stored in a .ini file and loaded
            // via parse_ini_file()... however, this will suffice
            // for an example
            $codes = Array(
                200 => 'OK',
                400 => 'Bad Request',
                401 => 'Unauthorized',
                402 => 'Payment Required',
                403 => 'Forbidden',
                404 => 'Not Found',
                500 => 'Internal Server Error',
                501 => 'Not Implemented',
            );
            return (isset($codes[$status])) ? $codes[$status] : '';
        }

        private function regenerateSessionID() {
            Yii::app()->session->regenerateID();
            Yii::app()->session->sessionID;
        }

    }
    