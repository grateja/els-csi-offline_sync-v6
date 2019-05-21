
<script src="../adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<?php

    error_reporting(E_ALL);
    date_default_timezone_set('Asia/Manila');
    include_once('Api.class.php');

    $transType = ($_REQUEST['transType'] != '') ? $_REQUEST['transType'] : 0;
    $transactionID = ($_REQUEST['transactionID'] != '') ? $_REQUEST['transactionID'] : 0;
    $rfID = $_REQUEST['rfID'];
    $machineIP = ($_REQUEST['machineIP'] != '') ? $_REQUEST['machineIP'] : 0;

    if ($transType > 0) {
        if ($transType == 1) {
            logs("Balance Inquiry", $rfID);
            retrieveBalance($rfID);
        } elseif ($transType == 2) {
            $remarks = "RF ID: " . $rfID;
            logs("Activate", $remarks);
            transactionDebit($rfID, $machineIP);
        } elseif ($transType == 4) { // param => branchID, machineIP
            logs("Price Inquiry", $rfID);
            retrievePrice($branchID, $transactionID);
        } elseif ($transType == 5) {
            $machineStatus = $_GET['machineStatus'];
            $remarks = "Machine IP: " . $machineIP;
            logs("Set Machine Status", $remarks);
            setMachineStatus($machineIP, $machineStatus);
        }
    }

//retrieveTransactionPrice($branchID, $transactionID);
//transactionDebit($branchID, $transactionID, $rfID);
    function setMachineStatus($machineIP, $machineStatusID) {
        //machineStatus
        // 1 = started
        // 2 = paused
        // 3 = finished
        $obj = new Api();
        $result = $obj->setMachineStatus($machineIP, $machineStatusID);
        print $result['message'];
    }

    function retrievePrintOnly() {
        print 25;
    }

    function retrieveTransactionPrice($branchID, $transactionID) {
        $obj = new Api();
        $result = $obj->getTransactionPrice($branchID, $transactionID);
        print 'is ' . $result['price'];
    }

    function retrieveBalance($rfID) {
        $obj = new Api();
        $result = $obj->getBalance($rfID);
        print 'Message: ' . $result['message'] . '<Br/>';
        print 'Bal: ' . number_format($result['balance'], 0);
    }

    function transactionDebit($rfID, $machineIP) {
        $obj = new Api();

        $result = $obj->setTransaction_Debit($rfID, $machineIP);

        print $result;
    }

    function retrievePulse($branchID, $transactionID, $rfID, $machineIP) {
        $obj = new Api();

        $result = $obj->getPulse($branchID, $transactionID, $rfID, $machineIP);
        //$result['machineIpActivator']
        print $result['pulse'];
    }

    function checkDomainStatus() {
        $header_check = get_headers("http://www.google.com");
        $response_code = $header_check[0];
        print 'Stat: ' . $response_code;
    }

    function phpMachineActivator() {
        
    }

    function retrievePrice($branchID, $transactionID) {
        $obj = new Api();

        $result = $obj->getPrice($branchID, $transactionID);
        print number_format($result['price'], 0);
    }

    function activateMachine($urlActivator, $balance) {
        $useragent = " Laundry CSI";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
        curl_setopt($ch, CURLOPT_URL, $urlActivator);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_exec($ch);
        curl_close($ch);
        return false;
    }

    function logs($transaction, $remarks) {
        $dateTime = '[' . date('Y-m-d H:i:s') . ']';
        $filename = "c:\\temp\\rfid.txt";
        $file = fopen($filename, "a");
        $data = $dateTime . ' - ' . $transaction . ' - ' . $remarks . "\r\n";
        fwrite($file, $data);
        fclose($file);
    }
?>