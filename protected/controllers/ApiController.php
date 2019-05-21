<?php
class ApiController extends CController
{
    
    public function actions()
    {
        return array(
            'quote'=>array(
                'class'=>'CWebServiceAction',
            ),
        );
    }
    
 
    function validateWebServiceAccount($username, $password)
    {
        $pwordHash = md5($password);
        $cnn = Utilities::createConnection();
        
        $sql = 'SELECT *  FROM ' . Users::tbl()  .' WHERE `username` = :username AND `pword_hash` = :pwordHash AND `account_type_id` = :accountType AND `is_active` = :isActive limit 1';
        $command = $cnn->createCommand($sql);
        $command->bindValue(':username', $username, PDO::PARAM_STR);
        $command->bindValue(':pwordHash', $pwordHash, PDO::PARAM_STR);
        $command->bindValue(':accountType', AccountTypes::ACCOUNT_TYPE_WEBSERVICE, PDO::PARAM_STR);
        $command->bindValue(':isActive', Utilities::YES, PDO::PARAM_INT);
        $result = $command->queryRow();
        
        if($result){
                    Yii::app()->user->setState('user_id',$result['id']);
                    Yii::app()->user->setState('username',$result['username']);
                    Yii::app()->user->setState('password', $result['password']);
                    Yii::app()->user->setState('pword_hash', $result['pword_hash']);
                    Yii::app()->user->setState('emp_id', $result['emp_id']);
                    Yii::app()->user->setState('client_id', $result['client_id']);
                    Yii::app()->user->setState('branch_id', $result['branch_id']);
                    Yii::app()->user->setState('is_password_changed', $result['is_password_changed']);
                    Yii::app()->user->setState('role', $result['role']);
        }
        return ($result) ? Utilities::YES : Utilities::NO;
    }    
    
    /**
     * @param array accountDetails
     * @param integer branchID
     * @param integer transactionID
     * @return array result
     * @soap
     */
    function retrieveTransactionPrice($accountDetails, $branchID, $transactionID)
    {
        $status = Utilities::STATUS_FAILED;
        
        if($this->validateWebServiceAccount($accountDetails['username'], $accountDetails['password']) == Utilities::YES) {
            $status = Utilities::STATUS_SUCCESS;
            $price = ServicePrices::sql_getPrice_byBranchID($branchID, $transactionID, Settings::get_Date());
            $message = 'Price Successfully Retrieved.';
        }  else {
            $message = $this->getMessage_AuthtenticationFailed();
            $price = 0;
        }
        $arr = array('status' => $status, 'message' => $message, 'price' => $price);
        return $arr;
    }
    
    /**
     * @param array accountDetails
     * @param string rfID
     * @return array result
     * @soap
     */
    function retrieveBalance($accountDetails, $rfID)
    {
        $status = Utilities::STATUS_FAILED;
        
        if($this->validateWebServiceAccount($accountDetails['username'], $accountDetails['password']) == Utilities::YES) {
            $status = Utilities::STATUS_SUCCESS;
            $cardID = CustomerCards::sql_getCardID_byRfID($rfID);
            //$balance = Utilities::setNumberFormat(CustomerTransactions::sql_getTotalBalance_byCardID($cardID), 2);
            $balance = CustomerTransactions::sql_getTotalBalance_byCardID($cardID);
            $message = $balance;
        }  else {
            $message = $this->getMessage_AuthtenticationFailed();
            $balance = 0;
        }
        $arr = array('status' => $status, 'message' => $message, 'balance' => $balance);
        return $arr;
    }    
    
/**
 * @param array accountDetails
 * @param string rfID
 * @param string machineIP
 * @return string result
 * @soap
 */    
    function processTransaction_Debit($accountDetails, $rfID, $machineIP)
    {
        $model = new Customers();
        $model = CustomerCards::model_getData_byRfID($rfID);
        if($this->validateWebServiceAccount($accountDetails['username'], $accountDetails['password']) == Utilities::YES) {
            $machineActivator = Machines::activateDebit($model->customer_id, $machineIP);
          
        } else {
            $machineActivator = 0;
            $message = $this->getMessage_AuthtenticationFailed();
        }
        return $machineActivator;
    }
    
    /**
     * @param array $accountDetails
     * @param integer $branchID
     * @param string $machineIP
     * @param integer $machineStatusID
     * @return array $result
     * @soap
     */    
    function setMachineStatus($accountDetails, $branchID, $machineIP, $machineStatusID)
    {
        $customerMachineUsages = new CustomerMachineUsages();
        
        if($branchID == 0)
            $branchID = Settings::get_BranchID();

        if($this->validateWebServiceAccount($accountDetails['username'], $accountDetails['password']) == Utilities::YES) {
            $status = Utilities::STATUS_SUCCESS;
            
            $machineID = Machines::sql_getID_byBranchIDAndIP($branchID, $machineIP);
            if($machineID != 0) {
                $lastCustomerTransID = CustomerTransactions::sql_getLastID_byMachineID($machineID);
                $lastID_CustomerMachineUsage = CustomerMachineUsages::sql_getLastID_byCustomerTransactionID($lastCustomerTransID);

                $customerMachineUsages = Utilities::model_getByID(CustomerMachineUsages::model(), $lastID_CustomerMachineUsage);

                if($customerMachineUsages->end_machine_status != CustomerMachineUsages::STATUS_COMPLETED) {
                    $startTime = $customerMachineUsages->start_datetime;
                    $endTime = Settings::get_DateTime();

                    $totalMinutes = round((strtotime($endTime) - strtotime($startTime)) / 60);
                    $machinePerMinutes = Machines::sql_getTotalMinutesPerTransaction_byID($machineID);
                    
                    CustomerMachineUsages::sql_updateEndDateTime($lastID_CustomerMachineUsage, $endTime);
                    CustomerMachineUsages::sql_updateEndMachineStatus($lastID_CustomerMachineUsage, $machineStatusID);
                    CustomerMachineUsages::sql_updateTotalMinutes($lastID_CustomerMachineUsage, $totalMinutes);

                    Machines::sql_updateStatus_byId($machineID, 1);
                    $machineStatus = CustomerMachineUsages::getStatus($machineStatusID);
                    $message = 'Machine status successfully set to ' . $machineStatusID;            
                } else {
                    $machineStatusID = 0;
                    $machineStatus = CustomerMachineUsages::getStatus($machineStatusID);  
                    $message = 'Machine status not change.'; 
                }             
                
                
            }
            
        } else {
            $status = Utilities::STATUS_FAILED;
            $message = $this->getMessage_AuthtenticationFailed();
        }
        $arr = array('status' => $status, 'message' => $message, 'machineStatusID' => $machineStatusID, 'totalMinutes' => $totalMinutes);
        return $arr;          
    }    
    
    public function getMessage_AuthtenticationFailed()
    {
        return 'Authentication Failed';
    }
    
/**
     * @param array accountDetails
     * @param integer branchID
     * @param integer transactionID
     * @return array result
     * @soap
     */    
    function retrievePrice($accountDetails, $branchID, $transactionID)
    {
        if($this->validateWebServiceAccount($accountDetails['username'], $accountDetails['password']) == Utilities::YES) {
            $status = Utilities::STATUS_SUCCESS;
            $price = Utilities::setNumberFormat(ServicePrices::sql_getPrice_byBranchID($branchID, $transactionID, Settings::get_Date()),2);
            $message = 'Price: ' . $price;
        } else {
            $status = Utilities::STATUS_FAILED;
            $message = $this->getMessage_AuthtenticationFailed();
            $price = 0;
        }
        $arr = array('status' => $status, 'message' => $message, 'price' => $price);
        return $arr;  
    }    
}