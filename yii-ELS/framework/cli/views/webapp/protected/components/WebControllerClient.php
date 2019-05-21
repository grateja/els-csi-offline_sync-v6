<?php

Yii::import('ext.GWebService.GSoapClient');


/**
 * This service use below complex types : 
 */
class WebControllerClient extends GSoapClient {

	public function __construct() {
		$this->wsdlUrl = "http://acct-api-yii.tranzend.com.ph/index.php?r=web/service";
	}

    /**
     * @param string $str
     * @return array string's structure
     */
	public function sayHello($str) {
		$params = array();
		$params['str'] = $str;
		return $this->call('WebController.sayHello', $params);
	}

}

