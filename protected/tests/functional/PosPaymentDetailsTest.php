<?php

class PosPaymentDetailsTest extends WebTestCase
{
	public $fixtures=array(
		'posPaymentDetails'=>'PosPaymentDetails',
	);

	public function testShow()
	{
		$this->open('?r=posPaymentDetails/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=posPaymentDetails/create');
	}

	public function testUpdate()
	{
		$this->open('?r=posPaymentDetails/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=posPaymentDetails/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=posPaymentDetails/index');
	}

	public function testAdmin()
	{
		$this->open('?r=posPaymentDetails/admin');
	}
}
