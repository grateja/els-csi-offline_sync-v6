<?php

    class SyncController extends Controller {

        public function actions() {
            return array(
                'quote' => array(
                    'class' => 'CWebServiceAction',
                ),
            );
        }

        public function actionCreate() {
            $old = ini_set('memory_limit', '-1');
            $modelClients = Clients::model_getAllData_byDeleted(Utilities::NO);
            $rows = array();
            $isError = 0;
            $message = NULL;
            foreach ($modelClients as $client) {

                $rows['clients'] = $client->attributes;
                $clientID = Utilities::insertClientRecord(json_encode($rows));

                $columnName = "client_id";
                $dbName = "alarcon_live";
                $tablesWithClientID = Utilities::sql_gettables_columnName($columnName, $dbName);
                foreach ($tablesWithClientID as $tableWithClientID) {
                    Utilities::sql_updateTableColumn($client->id, $columnName, $tableWithClientID['table_name'], $clientID, $columnName);
                }

                $columnName = "id";
                $tableName = "clients";
                Utilities::sql_updateTableColumn($client->id, $columnName, $tableName, $clientID, $columnName);

                $this->saveBranchRecords($clientID, $dbName);
//                if($clientID != 0){
//                    $isError = 0;
//                    $message = "Records Successfully Sync to Cloud";
//                }
                return $clientID;
            }
        
        }

        public function saveBranchRecords($clientID, $dbName) {
            $models = new Branches();

            $models = Branches::model_getAllData_byClientId_isSync($clientID);
            $rows = array();

            if (count($models) != 0) {
                foreach ($models as $model) {

                    $rows['branches'] = $model->attributes;
                    $branchID = Utilities::insertBranchRecord(json_encode($rows));

                    $columnName = "branch_id";
                    $tablesWithClientID = Utilities::sql_gettables_columnName($columnName, $dbName);
                    foreach ($tablesWithClientID as $tableWithClientID) {
                        Utilities::sql_updateTableColumn($model->id, $columnName, $tableWithClientID['table_name'], $branchID, $columnName);
                    }

                    $columnName = "id";
                    $tableName = "branches";
                    Utilities::sql_updateTableColumn($model->id, $columnName, $tableName, $branchID, $columnName);


                    $columnName = "is_sync";
                    $tableName = "branches";
                    Utilities::sql_updateTableColumn($branchID, $columnName, $tableName, Utilities::YES, $columnName = "id");

                    $this->saveCustomerRecords($branchID, $clientID, $dbName);
                    
                }
            } else {
                $models = Branches::model_getAllData_byClientId($clientID);
                foreach ($models as $model) {
                    $this->saveCustomerRecords($model->id, $clientID, $dbName);
                   
                }
            }
        }

        public function saveCustomerRecords($branchID, $clientID, $dbName) {
            $models = new Customers();

            $models = Customers::model_getAllData_byDeletedCLientID_branchID(Utilities::NO, $clientID, $branchID);
            $rows = array();

            foreach ($models as $model) {

                $rows['customers'] = $model->attributes;
                $custID = Utilities::insertCustomerRecord(json_encode($rows));

                $columnName = "cust_id";
                $tablesWithClientID = Utilities::sql_gettables_columnName($columnName, $dbName);
                foreach ($tablesWithClientID as $tableWithClientID) {
                    Utilities::sql_updateTableColumn($model->id, $columnName, $tableWithClientID['table_name'], $custID, $columnName);
                }

                $columnName = "customer_id";
                $tablesWithClientID = Utilities::sql_gettables_columnName($columnName, $dbName);
                foreach ($tablesWithClientID as $tableWithClientID) {
                    Utilities::sql_updateTableColumn($model->id, $columnName, $tableWithClientID['table_name'], $custID, $columnName);
                }

                $columnName = "id";
                $tableName = "customers";
                Utilities::sql_updateTableColumn($model->id, $columnName, $tableName, $custID, $columnName);


                $columnName = "is_sync";
                $tableName = "customers";
                Utilities::sql_updateTableColumn($custID, $columnName, $tableName, Utilities::YES, $columnName = "id");
            }
            $this->saveEmployeesRecords($branchID, $clientID, $dbName);
            $this->saveUsersRecords($branchID, $clientID, $dbName);
            $this->saveCustomerCardsRecords($branchID, $clientID, $dbName);
            $this->saveInventoriesRecords($branchID, $clientID, $dbName);
            $this->saveCustomerCardTransactionsRecords($branchID, $clientID, $dbName);
            $this->saveMachinesRecords($branchID, $clientID, $dbName);
            $this->saveExpensesRecords($branchID, $clientID, $dbName);
            $this->savePurchasesRecords($branchID, $clientID, $dbName);
            $this->savePosTransactionsRecords($branchID, $clientID, $dbName);
            $this->savePosPaymentHeadersRecords($branchID, $clientID, $dbName);
            $this->savePosPaymentDetailsRecords($dbName);
            $this->saveMachineUsageHeadersRecords($branchID, $clientID, $dbName);
            $test = $this->saveMachineUsageDetailsRecords($dbName);
            return $test;
        }

        public function saveEmployeesRecords($branchID, $clientID, $dbName) {
            $models = new Employees();

            $models = Employees::model_getAllData_byDeletedCLientID_branchID(Utilities::NO, $clientID, $branchID);
            $rows = array();

            foreach ($models as $model) {

                $rows['employees'] = $model->attributes;
                $empID = Utilities::insertEmployeeRecord(json_encode($rows));


                $columnName = "emp_id";
                $tablesWithClientID = Utilities::sql_gettables_columnName($columnName, $dbName);

                foreach ($tablesWithClientID as $tableWithClientID) {
                    Utilities::sql_updateTableColumn($model->id, $columnName, $tableWithClientID['table_name'], $empID, $columnName);
                }

                $columnName = "employee_id";
                $tablesWithClientID = Utilities::sql_gettables_columnName($columnName, $dbName);
                foreach ($tablesWithClientID as $tableWithClientID) {
                    Utilities::sql_updateTableColumn($model->id, $columnName, $tableWithClientID['table_name'], $empID, $columnName);
                }

                $columnName = "card_user_id";
                $tablesWithClientID = Utilities::sql_gettables_columnName($columnName, $dbName);
                foreach ($tablesWithClientID as $tableWithClientID) {
                    Utilities::sql_updateTableColumn($model->id, $columnName, $tableWithClientID['table_name'], $empID, $columnName);
                }

                $columnName = "id";
                $tableName = "employees";
                Utilities::sql_updateTableColumn($model->id, $columnName, $tableName, $empID, $columnName);


                $columnName = "is_sync";
                $tableName = "employees";
                Utilities::sql_updateTableColumn($empID, $columnName, $tableName, Utilities::YES, $columnName = "id");
            }
            return $empID;
        }

        public function saveUsersRecords($branchID, $clientID, $dbName) {
            $models = new Users();

            $models = Users::model_getAllData_byDeletedCLientID_branchID(Utilities::NO, $clientID, $branchID);
            $rows = array();

            foreach ($models as $model) {

                $rows['users'] = $model->attributes;
                $empID = Utilities::insertUsersRecord(json_encode($rows));
                if($model->username == Settings::get_Username()){
                    
                    Yii::app()->user->setState('user_id',$empID);
                    Yii::app()->user->setState('username',$model->username);
                    Yii::app()->user->setState('emp_id', $model->emp_id);
                    Yii::app()->user->setState('client_id', $clientID);
                    Yii::app()->user->setState('branch_id', $branchID);
                }
                if ($empID != 0) {
                    $columnName = "user_id";
                    $tablesWithClientID = Utilities::sql_gettables_columnName($columnName, $dbName);
                    foreach ($tablesWithClientID as $tableWithClientID) {
                        Utilities::sql_updateTableColumn($model->id, $columnName, $tableWithClientID['table_name'], $empID, $columnName);
                    }

                    $columnName = "id";
                    $tableName = "users";
                    Utilities::sql_updateTableColumn($model->id, $columnName, $tableName, $empID, $columnName);


                    $columnName = "is_sync";
                    $tableName = "users";
                    Utilities::sql_updateTableColumn($empID, $columnName, $tableName, Utilities::YES, $columnName = "id");
                }
            
            }
        }

        public function saveCustomerCardsRecords($branchID, $clientID, $dbName) {
            $models = new CustomerCards();

            $models = CustomerCards::model_getAllData_byDeletedCLientID_branchID(Utilities::NO, $clientID, $branchID);
            $rows = array();

            foreach ($models as $model) {

                $rows['customer_card'] = $model->attributes;
                $empID = Utilities::insertCustomerCardsRecord(json_encode($rows));


                $columnName = "card_id";
                $tablesWithClientID = Utilities::sql_gettables_columnName($columnName, $dbName);

                foreach ($tablesWithClientID as $tableWithClientID) {
                    Utilities::sql_updateTableColumn($model->id, $columnName, $tableWithClientID['table_name'], $empID, $columnName);
                }

                $columnName = "customer_card_id";
                $tablesWithClientID = Utilities::sql_gettables_columnName($columnName, $dbName);
                foreach ($tablesWithClientID as $tableWithClientID) {
                    Utilities::sql_updateTableColumn($model->id, $columnName, $tableWithClientID['table_name'], $empID, $columnName);
                }

                $columnName = "id";
                $tableName = "customer_cards";
                Utilities::sql_updateTableColumn($model->id, $columnName, $tableName, $empID, $columnName);


                $columnName = "is_sync";
                $tableName = "customer_cards";
                Utilities::sql_updateTableColumn($empID, $columnName, $tableName, Utilities::YES, $columnName = "id");
            }
        }

        public function saveInventoriesRecords($branchID, $clientID, $dbName) {
            $models = new Inventories();

            $models = Inventories::model_getAllData_byDeletedCLientID_branchID(Utilities::NO, $clientID, $branchID);
            $rows = array();

            foreach ($models as $model) {

                $rows['inventories'] = $model->attributes;
                $empID = Utilities::insertInventoriesRecord(json_encode($rows));


                $columnName = "inv_id";
                $tablesWithClientID = Utilities::sql_gettables_columnName($columnName, $dbName);

                foreach ($tablesWithClientID as $tableWithClientID) {
                    Utilities::sql_updateTableColumn($model->id, $columnName, $tableWithClientID['table_name'], $empID, $columnName);
                }

                $columnName = "inventory_id";
                $tablesWithClientID = Utilities::sql_gettables_columnName($columnName, $dbName);
                foreach ($tablesWithClientID as $tableWithClientID) {
                    Utilities::sql_updateTableColumn($model->id, $columnName, $tableWithClientID['table_name'], $empID, $columnName);
                }

                $columnName = "id";
                $tableName = "inventories";
                Utilities::sql_updateTableColumn($model->id, $columnName, $tableName, $empID, $columnName);


                $columnName = "is_sync";
                $tableName = "inventories";
                Utilities::sql_updateTableColumn($empID, $columnName, $tableName, Utilities::YES, $columnName = "id");
            }
        }

        public function saveCustomerCardTransactionsRecords($branchID, $clientID, $dbName) {
            $models = new CustomerCardTransactions();

            $models = CustomerCardTransactions::model_getAllData_byDeletedCLientID_branchID(Utilities::NO, $clientID, $branchID);
            $rows = array();

            foreach ($models as $model) {

                $rows['customer_card_transactions'] = $model->attributes;
                $empID = Utilities::insertCustomerCardTransactionsRecord(json_encode($rows));

                $columnName = "id";
                $tableName = "customer_card_transactions";
                Utilities::sql_updateTableColumn($model->id, $columnName, $tableName, $empID, $columnName);


                $columnName = "is_sync";
                $tableName = "customer_card_transactions";
                Utilities::sql_updateTableColumn($empID, $columnName, $tableName, Utilities::YES, $columnName = "id");
            }
        }

        public function saveMachinesRecords($branchID, $clientID, $dbName) {
            $models = new Machines();

            $models = Machines::model_getAllData_byDeletedCLientID_branchID(Utilities::NO, $clientID, $branchID);
            $rows = array();

            foreach ($models as $model) {

                $rows['machines'] = $model->attributes;
                $machineID = Utilities::insertMachinesRecord(json_encode($rows));

                $columnName = "machine_id";
                $tablesWithClientID = Utilities::sql_gettables_columnName($columnName, $dbName);

                foreach ($tablesWithClientID as $tableWithClientID) {
                    Utilities::sql_updateTableColumn($model->id, $columnName, $tableWithClientID['table_name'], $machineID, $columnName);
                }

                $columnName = "id";
                $tableName = "machines";
                Utilities::sql_updateTableColumn($model->id, $columnName, $tableName, $machineID, $columnName);


                $columnName = "is_sync";
                $tableName = "machines";
                Utilities::sql_updateTableColumn($machineID, $columnName, $tableName, Utilities::YES, $columnName = "id");
            }
            return $machineID;
        }

        public function saveExpensesRecords($branchID, $clientID, $dbName) {
            $models = new Expenses();

            $models = Expenses::model_getAllData_byDeletedCLientID_branchID(Utilities::NO, $clientID, $branchID);
            $rows = array();

            foreach ($models as $model) {

                $rows['expenses'] = $model->attributes;
                $expensesID = Utilities::insertExpensesRecord(json_encode($rows));

                $columnName = "expenses_id";
                $tablesWithClientID = Utilities::sql_gettables_columnName($columnName, $dbName);

                foreach ($tablesWithClientID as $tableWithClientID) {
                    Utilities::sql_updateTableColumn($model->id, $columnName, $tableWithClientID['table_name'], $expensesID, $columnName);
                }

                $columnName = "id";
                $tableName = "expenses";
                Utilities::sql_updateTableColumn($model->id, $columnName, $tableName, $expensesID, $columnName);


                $columnName = "is_sync";
                $tableName = "expenses";
                Utilities::sql_updateTableColumn($expensesID, $columnName, $tableName, Utilities::YES, $columnName = "id");
            }
            return $expensesID;
        }

        public function savePosTransactionsRecords($branchID, $clientID, $dbName) {
            $models = new PosTransactions();

            $models = PosTransactions::model_getAllData_byDeletedCLientID_branchID(Utilities::NO, $clientID, $branchID);
            $rows = array();

            foreach ($models as $model) {

                $rows['pos_transactions'] = $model->attributes;
                $transID = Utilities::insertPosTransactionsRecord(json_encode($rows));

                $columnName = "transaction_id";
                $tableName = "pos_payment_details";
                Utilities::sql_updateTableColumn($model->id, $columnName, $tableName, $transID, $columnName);


                $columnName = "customer_transaction_id";
                $tablesWithClientID = Utilities::sql_gettables_columnName($columnName, $dbName);

                foreach ($tablesWithClientID as $tableWithClientID) {
                    Utilities::sql_updateTableColumn($model->id, $columnName, $tableWithClientID['table_name'], $transID, $columnName);
                }

                $columnName = "id";
                $tableName = "pos_transactions";
                Utilities::sql_updateTableColumn($model->id, $columnName, $tableName, $transID, $columnName);


                $columnName = "is_sync";
                $tableName = "pos_transactions";
                Utilities::sql_updateTableColumn($transID, $columnName, $tableName, Utilities::YES, $columnName = "id");
            }
            return $transID;
        }

        public function savePurchasesRecords($branchID, $clientID, $dbName) {
            $models = new Purchases();

            $models = Purchases::model_getAllData_byDeletedCLientID_branchID(Utilities::NO, $clientID, $branchID);
            $rows = array();

            foreach ($models as $model) {

                $rows['purchases'] = $model->attributes;
                $expensesID = Utilities::insertPurchasesRecord(json_encode($rows));

                $columnName = "id";
                $tableName = "purchases";
                Utilities::sql_updateTableColumn($model->id, $columnName, $tableName, $expensesID, $columnName);


                $columnName = "is_sync";
                $tableName = "purchases";
                Utilities::sql_updateTableColumn($expensesID, $columnName, $tableName, Utilities::YES, $columnName = "id");
            }
            return $expensesID;
        }

        public function savePosPaymentHeadersRecords($branchID, $clientID, $dbName) {
            $models = new PosPaymentHeaders();

            $models = PosPaymentHeaders::model_getAllData_byDeletedCLientID_branchID(Utilities::NO, $clientID, $branchID);
            $rows = array();
//            if (count($models) != 0) {

                foreach ($models as $model) {

                    $rows['pos_payment_headers'] = $model->attributes;
                    $expensesID = Utilities::insertPosPaymentHeadersRecord(json_encode($rows));

                    $columnName = "header_id";
                    $tableName = "pos_payment_details";
                    Utilities::sql_updateTableColumn($model->id, $columnName, $tableName, $expensesID, $columnName);

                    $columnName = "id";
                    $tableName = "pos_payment_headers";
                    Utilities::sql_updateTableColumn($model->id, $columnName, $tableName, $expensesID, $columnName);


                    $columnName = "is_sync";
                    $tableName = "pos_payment_headers";
                    Utilities::sql_updateTableColumn($expensesID, $columnName, $tableName, Utilities::YES, $columnName = "id");

                  $this->savePosPaymentDetailsRecords($headerID, $dbName);
                  
                }
//            } else {
//                $models = PosPaymentHeaders::model_getAllData_byCLientID_branchID($clientID, $branchID);
//                foreach ($models as $model) {
//                    $test = $this->savePosPaymentDetailsRecords($model->id, $dbName);
//                }
//                return $test;
//            }
        }

        public function savePosPaymentDetailsRecords($headerID, $dbName) {
            $models = new PosPaymentDetails();

            $models = PosPaymentDetails::model_getAllData_byDeletedCLientID_branchID(Utilities::NO);
            $rows = array();

            foreach ($models as $model) {

                $rows['pos_payment_details'] = $model->attributes;
                $expensesID = Utilities::insertPosPaymentDetailsRecord(json_encode($rows));


                $columnName = "id";
                $tableName = "pos_payment_details";
                Utilities::sql_updateTableColumn($model->id, $columnName, $tableName, $expensesID, $columnName);


                $columnName = "is_sync";
                $tableName = "pos_payment_details";
                Utilities::sql_updateTableColumn($expensesID, $columnName, $tableName, Utilities::YES, $columnName = "id");
            }
            return $expensesID;
        }

        public function saveMachineUsageHeadersRecords($branchID, $clientID, $dbName) {
            $models = new MachineUsageHeaders();

            $models = MachineUsageHeaders::model_getAllData_byDeletedCLientID_branchID(Utilities::NO, $branchID);

            $rows = array();

            foreach ($models as $model) {

                $rows['machine_usage_headers'] = $model->attributes;
                $headerID = Utilities::insertMachineUsageHeadersRecord(json_encode($rows));

                $columnName = "header_id";
                $tableName = "machine_usage_details";
                Utilities::sql_updateTableColumn($model->id, $columnName, $tableName, $headerID, $columnName);

                $columnName = "id";
                $tableName = "machine_usage_headers";
                $tes = Utilities::sql_updateTableColumn($model->id, $columnName, $tableName, $headerID, $columnName);


                $columnName = "is_sync";
                $tableName = "machine_usage_headers";
                Utilities::sql_updateTableColumn($headerID, $columnName, $tableName, Utilities::YES, $columnName = "id");
               
            }
            return $headerID;
        }

        public function saveMachineUsageDetailsRecords($dbName) {
            $models = new MachineUsageDetails();

            $models = MachineUsageDetails::model_getAllData_byDeletedCLientID_branchID(Utilities::NO);
           
            $rows = array();

            foreach ($models as $model) {

                $rows['machine_usage_details'] = $model->attributes;
                $detailID = Utilities::insertMachineUsageDetailsRecord(json_encode($rows));


                $columnName = "id";
                $tableName = "machine_usage_details";
                $test = Utilities::sql_updateTableColumn($model->id, $columnName, $tableName, $detailID, $columnName);


                $columnName = "is_sync";
                $tableName = "machine_usage_details";
                Utilities::sql_updateTableColumn($detailID, $columnName, $tableName, Utilities::YES, $columnName = "id");
            }
            return $detailID;
        }

    }
    