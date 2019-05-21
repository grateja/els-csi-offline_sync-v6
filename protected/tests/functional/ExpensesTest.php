<?php

class ExpensesTest extends WebTestCase
{
	public $fixtures=array(
		'expenses'=>'Expenses',
	);

	public function testShow()
	{
		$this->open('?r=expenses/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=expenses/create');
	}

	public function testUpdate()
	{
		$this->open('?r=expenses/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=expenses/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=expenses/index');
	}

	public function testAdmin()
	{
		$this->open('?r=expenses/admin');
	}
}
