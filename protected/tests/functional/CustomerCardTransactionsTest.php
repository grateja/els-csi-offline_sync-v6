<?php

class CustomerCardTransactionsTest extends WebTestCase
{
	public $fixtures=array(
		'customerCardTransactions'=>'CustomerCardTransactions',
	);

	public function testShow()
	{
		$this->open('?r=customerCardTransactions/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=customerCardTransactions/create');
	}

	public function testUpdate()
	{
		$this->open('?r=customerCardTransactions/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=customerCardTransactions/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=customerCardTransactions/index');
	}

	public function testAdmin()
	{
		$this->open('?r=customerCardTransactions/admin');
	}
}
