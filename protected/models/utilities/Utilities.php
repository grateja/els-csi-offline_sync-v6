<?php

    class Utilities {

        const YES = 1;
        const NO = 0;
        const FLASH_ERROR = 'error';
        const FLASH_SUCCESS = 'success';
        const FLASH_NOTICE = 'notice';
        const CLASS_ACTIVE = 'active';
        const CLASS_OPEN = 'open';
        CONST JV_TRANSTAT_CREATED = 1;
        CONST JV_TRANSTAT_CHECKED_MODIFICATIONS_YES = 2;
        CONST JV_TRANSTAT_CHECKED_MODIFICATIONS_NO = 3;
        CONST JV_TRANSTAT_APPROVED = 5;
        const TRANSCR_ID_JV = 1; // Journal
        const TRANSCR_ID_CV = 2; // Check    
        CONST STATUS_FAILED = 0;
        CONST STATUS_SUCCESS = 1;
        const PAGE_SIZE = 15;
        const SELF_SERVICE = 1;
        const FULL_SERVICE = 2;

        public static function get_ActiveSelect($id = null) {
            $active = array(
                self::YES => 'Yes',
                self::NO => 'No',
            );
            if (is_null($id))
                return $active;
            else
                return $active[$id];
        }

        public static function get_ActiveServiceTypes($id = null) {
            $active = array(
                self::SELF_SERVICE => 'Self Service',
                self::FULL_SERVICE => 'Full Service',
            );
            if (is_null($id))
                return $active;
            else
                return $active[$id];
        }

        public static function clearSessions($tableName) {
            unset($_SESSION[$tableName]);
        }

        public static function debug($a, $caption) {
            print $caption;
            print '<pre>';
            print_r($a);
            print '</pre>';
        }

        public static function set_Flash($status, $message) {
            Yii::app()->user->setFlash($status, $message);
        }

        public static function set_FlashSuccess($message) {
            Yii::app()->user->setFlash(self::FLASH_SUCCESS, $message);
        }

        public static function set_FlashError($message) {
            Yii::app()->user->setFlash(self::FLASH_ERROR, $message);
        }

        public static function set_FlashNotice($message) {
            Yii::app()->user->setFlash(self::FLASH_NOTICE, $message);
        }

        public static function get_Action() {
            return Yii::app()->controller->getAction()->getId();
        }

        public static function get_UserIp() {
            return Yii::app()->request->userHostAddress;
        }

        public static function createConnection() {
            return Yii::app()->db;
        }

        public static function remove_CoreScripts($remove_all = false) {
            if ($remove_all) {
                Yii::app()->clientScript->reset();
            }

            $language = Yii::app()->session['_lang'];

            $scripts = array(
                'idle-timer.js' => false,
                'main.js' => false,
                'jquery.js' => false,
                'jquery.min.js' => false,
                'jquery.yii.js' => false,
                'jquery.ajaxqueue.js' => false,
                'jquery.metadata.js' => false,
                // FIXME: determine if this scripts have collisions with some codes
                'jquery.autocomplete.js' => false,
                'jquery.bgiframe.js' => false,
                'jquery.dimensions.js' => false,
                'jquery-ui-1.7.1.custom.js' => false,
                'jquery-ui-1.7.1.custom.packed.js' => false,
                'jquery-ui-1.7.1.custom.min.js' => false,
                //      'ui.datepicker-'.$language.'.js'   => false,
                'formplugin.js' => false,
                'jquery.tipsy.js' => false,
                'tipsy.css' => false,
                'jquery-ui-1.7.1.custom.css' => false,
                'jquery.calculator.min.js' => false,
                'jquery.calculator.alt.css' => false,
            );

            Yii::app()->clientScript->scriptMap = $scripts;
        }

        public static function get_ModelErrors($modelErrors) {
            $errorMsg = NULL;
            foreach ($modelErrors as $modelErrors) {
                foreach ($modelErrors as $messages) {
                    $errorMsg .= $messages . '<br />';
                }
            }
            return $errorMsg;
        }

        public static function model_getByID($model, $id) {
            return $model->model()->findByPk($id);
        }

        /*
          Created By          :   Jaz Jazmin
          Date/Time Created   :   2014-10-09 20:47
          Description         :   DAO get all data in a row
         */

        /*
          $id = ID
          $tableName = name of the table
         */

        public static function sql_getDataRow_ByID($id, $tableName) {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT * FROM :tableName WHERE id = :id limit 1';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':tableName', $tableName, PDO::PARAM_STR);
            $command->bindValue(':id', $id, PDO::PARAM_INT);

            return $command->queryRow();
        }

        /*
          Created By          :   Jaz Jazmin
          Date/Time Created   :   2014-10-09 20:57
          Description         :   DAO get all data in a row
         */

        /*
          $id = ID
          $tableName = name of the table
          $fieldName = name of the field/attributes
         */

        public static function sql_getDataField_ByID($id, $tableName, $fieldName) {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT :fieldName FROM :tableName WHERE id = :id limit 1';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':id', $id, PDO::PARAM_INT);
            $command->bindValue(':tableName', $tableName, PDO::PARAM_STR);
            $command->bindValue(':fieldName', $fieldName, PDO::PARAM_STR);
            return $command->queryScalar();
        }

        /*
          Created By          :   Jaz Jazmin
          Date/Time Created   :   2014-10-09 20:57
          Description         :   DAO get all data in a row
         */

        /*
          $id = ID
          $tableName = name of the table
          $fieldName = name of the field/attributes
         */

        public static function sql_getTotalCount($tableName) {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT count(*) FROM :tableName';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':tableName', $tableName, PDO::PARAM_STR);
            return $command->queryScalar();
        }

        public static function setMenuActive_Siteadmin($menu, $action = null) {
            
        }

        public static function generateRandomNumbers($length) {
            $max = 0;
            for ($x = 0; $x < $length; $x++) {
                $max .= '9';
            }
            $studentNo = rand(1, $max);
            $studentNoLength = strlen($studentNo);

            $zeroes = null;
            if ($studentNoLength != $length) {

                $lenDiff = $length - $studentNoLength;
                for ($x = 0; $x < $lenDiff; $x++) {
                    $zeroes .= '0';
                }
                $studentNo = $zeroes . $studentNo;
            }
            return $studentNo;
        }

        public static function setCapitalFirst($string) {
            return ucwords(strtolower($string));
        }

        public static function setCapitalAll($string) {
            return strtoupper($string);
        }

        public static function setLowerAll($string) {
            return strtolower($string);
        }

        public static function removeCoreScripts($remove_all = false) {
            if ($remove_all) {
                Yii::app()->clientScript->reset();
            }

            $language = Yii::app()->session['_lang'];

            $scripts = array(
                'jquery.js' => false,
                'jquery.yii.js' => false,
                'jquery-ui.min.js' => false,
                'jquery-ui-i18n.min.js' => false,
            );


            Yii::app()->clientScript->scriptMap = $scripts;
        }

        public static function setRandom_Numbers($min = 1, $max, $len = 1) {
            $randNos = rand($min, $max);

            $zeroes = 0;
            for ($x = 0; $x < $len; $x++) {
                $zeroes .= $zeroes;
            }
            $diffLen = $len - strlen($randNos);
            return substr($zeroes, 0, $diffLen) . $randNos;
        }

        public static function formatCode($codeInt, $length) {
            $codeLen = strlen($codeInt);

            for ($x = 0; $x < $length; $x++) {
                $code .= '0';
            }
            $code = substr($code, 0, ($length - $codeLen));

            return $code . $codeInt;
        }

        public static function get_ActiveStatus($id = null) {
            $active = array(
                self::YES => 'Active',
                self::NO => 'Inactive',
            );
            if (is_null($id))
                return $active;
            else
                return $active[$id];
        }

        public static function valueCleanser($params) {
            $return_val = trim($params, " \t\n\r\0\x0B");

            $return_val = strip_tags($return_val);

            return htmlentities($return_val, ENT_QUOTES, "UTF-8");
        }

        public static function generateReferenceNumber($lenght, $text) {
            return $text . self::generateRandomNumbers($lenght);
        }

        public static function cleanNumber($a) {

            if (is_numeric($a)) {
                $a = preg_replace('/[^0-9,]/s', '', $a);
            }

            return $a;
        }

        public static function turn_negative($num) {
            return $num - $num * 2;
        }

        public static function computeNumberOfDays($date, $num_days) {
            return date('Y-m-d', strtotime($date . $num_days . ' days'));
        }

        public static function turn_positive($negative_num) {
            return ($negative_num * -2) - $negative_num;
        }

        public static function getIsDeleted($isDeleted) {
            if ($isDeleted == self::NO) {
                $color = 'label-success';
            } else {
                $color = 'label-danger';
            }

            return '<div class="label label-table ' . $color . '" style="font-size: 10px;text-align: center;"><span style="width: 100px !important;">' . Utilities::get_ActiveSelect($isDeleted) . '</span></div>';
        }

        public static function getIsActive($isActive) {
            if ($isActive == self::YES) {
                $color = 'label-success';
            } else {
                $color = 'label-danger';
            }

            return '<div class="label label-table ' . $color . '" style="font-size: 10px;text-align: center;"><span style="width: 100px !important;">' . Utilities::get_ActiveStatus($isActive) . '</span></div>';
        }

        public static function postToGLTrans($srCode, $refNo, $refDate, $refItem, $glCode, $ccCode, $amount, $remarks) {
            $wsdlClient = Yii::app()->wsdlClient;
            return ($wsdlClient->call('WebController.insertGLTrans', array($srCode, $refNo, $refDate, $refItem, $glCode, $ccCode, $amount, $remarks)));
        }

        public static function postToJVHeaders($refNo, $crtDate, $desc, $preparedByID, $checkedByID, $approvedByID, $transcrID, $tranStatID, $customerTransactionID) {
            $wsdlClient = Yii::app()->wsdlClient;
            return ($wsdlClient->call('WebController.insertJournalVoucherHeaders', array($refNo, $crtDate, $desc, $preparedByID, $checkedByID, $approvedByID, $transcrID, $tranStatID, $customerTransactionID)));
        }

        public static function postToJVDetails($wsdlJvHeaderID, $GLCode1, $costCenterCode, $cashAmountDebit, $cashAmountCredit, $details, $refItem) {
            $wsdlClient = Yii::app()->wsdlClient;
            return ($wsdlClient->call('WebController.insertJournalVoucherDetails', array($wsdlJvHeaderID, $GLCode1, $costCenterCode, $cashAmountDebit, $cashAmountCredit, $details, $refItem)));
        }

        public static function addDays($date, $days) {
            return strtotime('+' . $days . ' days', strtotime($date));
        }

        public static function get_LastAccountActivity() {
            date_default_timezone_set('Asia/Manila');
            $time_ago = strtotime(Settings::get_LastLogin());
            $current_time = strtotime(Settings::get_DateTime());
            $time_difference = $current_time - $time_ago;
            $seconds = $time_difference;
            $minutes = round($seconds / 60);           // value 60 is seconds  
            $hours = round($seconds / 3600);           //value 3600 is 60 minutes * 60 sec  
            $days = round($seconds / 86400);          //86400 = 24 * 60 * 60;  
            $weeks = round($seconds / 604800);          // 7*24*60*60;  
            $months = round($seconds / 2629440);     //((365+365+365+365+366)/5/12)*24*60*60  
            $years = round($seconds / 31553280);     //(365+365+365+365+366)/5 * 24 * 60 * 60

            if ($seconds <= 60) {
                return "Just Now";
            } else if ($minutes <= 60) {
                if ($minutes == 1) {
                    return "one minute ago";
                } else {
                    return "$minutes minutes ago";
                }
            } else if ($hours <= 24) {
                if ($hours == 1) {
                    return "an hour ago";
                } else {
                    return "$hours hrs ago";
                }
            } else if ($days <= 7) {
                if ($days == 1) {
                    return "yesterday";
                } else {
                    return "$days days ago";
                }
            } else if ($weeks <= 4.3) { //4.3 == 52/12  
                if ($weeks == 1) {
                    return "a week ago";
                } else {
                    return "$weeks weeks ago";
                }
            } else if ($months <= 12) {
                if ($months == 1) {
                    return "a month ago";
                } else {
                    return "$months months ago";
                }
            } else {
                if ($years == 1) {
                    return "one year ago";
                } else {
                    return "$years years ago";
                }
            }
        }

        public static function addMinutes($dateTime, $minutes) {
            return strtotime('+' . $minutes . ' minutes', strtotime($dateTime));
        }

        public static function minusDays($date, $days) {
            return strtotime('-' . $days . ' days', strtotime($date));
        }

        const REGULAR_CARD = 1;
        const MASTER_CARD = 2;

        public static function get_ActiveCardType($id = null) {
            $active = array(
                self::REGULAR_CARD => 'Regular',
                self::MASTER_CARD => 'Master',
            );
            if (is_null($id))
                return $active;
            else
                return $active[$id];
        }

        public static function get_isOnline() {
            $url = 'www.google.com';
            $useragent = "Google";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            $result = curl_exec($ch);
            if ($result) {
                return 1;
            } else {
                return 0;
            }
            curl_close($ch);
        }

        public static function sql_gettables_columnName($columnName, $databaseName) {
            $cnn = Utilities::createConnection();
            $sql = 'SELECT table_name, column_name from information_schema.columns WHERE column_name = "' . $columnName . '"  AND TABLE_SCHEMA="' . $databaseName . '"';
            $command = $cnn->createCommand($sql);
            return $command->queryAll();
        }

        public static function sql_updateTableColumn($id, $column, $talble, $value, $fieldID) {
            $cnn = Utilities::createConnection();
            $sql = 'UPDATE  ' . $talble . ' set ' . $column . ' = ' . $value . ' WHERE ' . $fieldID . ' = ' . $id . '';
            $command = $cnn->createCommand($sql);
            return $command->execute();
        }

        public static function insertClientRecord($data) {
            $wsdlClient = Yii::app()->wsdlClient;
            return ($wsdlClient->call('WebController.insertClientRecord', array($data)));
        }

        public static function insertBranchRecord($data) {
            $wsdlClient = Yii::app()->wsdlClient;
            return ($wsdlClient->call('WebController.insertBranchRecord', array($data)));
        }

        public static function insertCustomerRecord($data) {
            $wsdlClient = Yii::app()->wsdlClient;
            return ($wsdlClient->call('WebController.insertCustomerRecord', array($data)));
        }

        public static function insertEmployeeRecord($data) {
            $wsdlClient = Yii::app()->wsdlClient;
            return ($wsdlClient->call('WebController.insertEmployeeRecord', array($data)));
        }

        public static function insertUsersRecord($data) {
            $wsdlClient = Yii::app()->wsdlClient;
            return ($wsdlClient->call('WebController.insertUsersRecord', array($data)));
        }

        public static function insertCustomerCardsRecord($data) {
            $wsdlClient = Yii::app()->wsdlClient;
            return ($wsdlClient->call('WebController.insertCustomerCardsRecord', array($data)));
        }

        public static function insertInventoriesRecord($data) {
            $wsdlClient = Yii::app()->wsdlClient;
            return ($wsdlClient->call('WebController.insertInventoriesRecord', array($data)));
        }

        public static function insertCustomerCardTransactionsRecord($data) {
            $wsdlClient = Yii::app()->wsdlClient;
            return ($wsdlClient->call('WebController.insertCustomerCardTransactionsRecord', array($data)));
        }

        public static function insertMachinesRecord($data) {
            $wsdlClient = Yii::app()->wsdlClient;
            return ($wsdlClient->call('WebController.insertMachinesRecord', array($data)));
        }

        public static function insertExpensesRecord($data) {
            $wsdlClient = Yii::app()->wsdlClient;
            return ($wsdlClient->call('WebController.insertExpensesRecord', array($data)));
        }

        public static function insertPosTransactionsRecord($data) {
            $wsdlClient = Yii::app()->wsdlClient;
            return ($wsdlClient->call('WebController.insertPosTransactionsRecord', array($data)));
        }

        public static function insertPurchasesRecord($data) {
            $wsdlClient = Yii::app()->wsdlClient;
            return ($wsdlClient->call('WebController.insertPurchasesRecord', array($data)));
        }

        public static function insertPosPaymentHeadersRecord($data) {
            $wsdlClient = Yii::app()->wsdlClient;
            return ($wsdlClient->call('WebController.insertPosPaymentHeadersRecord', array($data)));
        }

        public static function insertPosPaymentDetailsRecord($data) {
            $wsdlClient = Yii::app()->wsdlClient;
            return ($wsdlClient->call('WebController.insertPosPaymentDetailsRecord', array($data)));
        }

        public static function insertMachineUsageHeadersRecord($data) {
            $wsdlClient = Yii::app()->wsdlClient;
            return ($wsdlClient->call('WebController.insertMachineUsageHeadersRecord', array($data)));
        }

        public static function insertMachineUsageDetailsRecord($data) {
            $wsdlClient = Yii::app()->wsdlClient;
            return ($wsdlClient->call('WebController.insertMachineUsageDetailsRecord', array($data)));
        }

        public static function sql_updateTableColumnTest($column, $talble, $value) {
            $cnn = Utilities::createConnection();
            $sql = 'UPDATE  ' . $talble . ' set ' . $column . ' = ' . $value . ' ';
            $command = $cnn->createCommand($sql);
            return $command->execute();
        }

    }
    