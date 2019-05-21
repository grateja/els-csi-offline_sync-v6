<?php

    error_reporting(E_ALL & ~ E_NOTICE);

    include_once('nusoap/lib/nusoap.php');

    class Api {

        protected $accountDetails;
        protected $username;
        protected $password;

        const STATUS_FAILED = 0;
        const STATUS_SUCCESS = 1;
        const BRANCH_ID = 2;

        public function __construct() {
            // DEV
            $this->accountDetails = array(
                'username' => 'wservice.washndry',
                'password' => 'admin');
        }

        public function getTransactionPrice($branchID, $transactionID) {

            $this->client = new SoapClient('http://els.appward.net/els-csi/index.php?r=api/quote');
            try {
                $response = $this->client->retrieveTransactionPrice($this->accountDetails, $branchID, $transactionID);
                return $response;
            } catch (SoapFault $fault) {
                return array('status' => 0, 'message' => 'failed');
            }
        }

        public function getBalance($rfID) {


            $this->client = new SoapClient('http://els.appward.net/els-csi/index.php?r=api/quote');

            try {
                $response = $this->client->retrieveBalance($this->accountDetails, $rfID);
                return $response;
            } catch (SoapFault $fault) {
                return array('status' => 0, 'message' => $fault->getMessage());
            }
        }

        public function setTransaction_Debit($rfID, $machineIP) {
            $this->client = new SoapClient('http://els.appward.net/els-csi/index.php?r=api/quote');

            try {
                $response = $this->client->processTransaction_Debit($this->accountDetails, $rfID, $machineIP);
                return $response;
            } catch (SoapFault $fault) {
                return array('status' => 0, 'message' => $fault->getMessage());
            }
        }

        public function getPulse($branchID, $transactionID, $rfID, $machineIP) {


            $this->client = new SoapClient('http://els.appward.net/els-csi/index.php?r=api/quote');

            try {
                $response = $this->client->retrievePulse($this->accountDetails, $branchID, $transactionID, $rfID, $machineIP);
                return $response;
            } catch (SoapFault $fault) {
                return array('status' => 0, 'message' => 'failed');
            }
        }

        function checkOnline($domain) {
            //return false;
            $curlInit = curl_init($domain);
            curl_setopt($curlInit, CURLOPT_CONNECTTIMEOUT, 10);
            curl_setopt($curlInit, CURLOPT_HEADER, true);
            curl_setopt($curlInit, CURLOPT_NOBODY, true);
            curl_setopt($curlInit, CURLOPT_RETURNTRANSFER, true);

            //get answer
            $response = curl_exec($curlInit);

            curl_close($curlInit);
            if ($response)
                return true;
            return false;
        }

        public function getPrice($branchID, $transactionID) {


            $this->client = new SoapClient('http://els.appward.net/els-csi/index.php?r=api/quote');

            try {
                $response = $this->client->retrievePrice($this->accountDetails, $branchID, $transactionID);
                print_r($response);
            } catch (SoapFault $fault) {
                return array('status' => 0, 'message' => 'failed');
            }
        }

        public function setMachineStatus($machineIP, $machineStatusID) {

            $this->client = new SoapClient('http://els.appward.net/els-csi/index.php?r=api/quote');


            try {
                $response = $this->client->setMachineStatus($this->accountDetails, self::BRANCH_ID, $machineIP, $machineStatusID);
                return $response;
            } catch (SoapFault $fault) {
                return array('status' => 0, 'message' => $fault->getMessage());
            }
        }

    }

?>