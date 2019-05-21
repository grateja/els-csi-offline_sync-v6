<?php

class PosTransactionsTest extends WebTestCase
{
	public $fixtures=array(
		'posTransactions'=>'PosTransactions',
	);

	public function testShow()
	{
		$this->open('?r=posTransactions/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=posTransactions/create');
	}

	public function testUpdate()
	{
		$this->open('?r=posTransactions/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=posTransactions/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=posTransactions/index');
	}

	public function testAdmin()
	{
		$this->open('?r=posTransactions/admin');
	}
}
