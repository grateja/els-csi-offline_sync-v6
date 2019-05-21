<?php

class PaymentTypesTest extends WebTestCase
{
	public $fixtures=array(
		'paymentTypes'=>'PaymentTypes',
	);

	public function testShow()
	{
		$this->open('?r=paymentTypes/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=paymentTypes/create');
	}

	public function testUpdate()
	{
		$this->open('?r=paymentTypes/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=paymentTypes/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=paymentTypes/index');
	}

	public function testAdmin()
	{
		$this->open('?r=paymentTypes/admin');
	}
}
