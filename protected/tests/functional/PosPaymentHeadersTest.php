<?php

class PosPaymentHeadersTest extends WebTestCase
{
	public $fixtures=array(
		'posPaymentHeaders'=>'PosPaymentHeaders',
	);

	public function testShow()
	{
		$this->open('?r=posPaymentHeaders/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=posPaymentHeaders/create');
	}

	public function testUpdate()
	{
		$this->open('?r=posPaymentHeaders/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=posPaymentHeaders/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=posPaymentHeaders/index');
	}

	public function testAdmin()
	{
		$this->open('?r=posPaymentHeaders/admin');
	}
}
