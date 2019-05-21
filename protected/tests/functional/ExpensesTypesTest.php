<?php

class ExpensesTypesTest extends WebTestCase
{
	public $fixtures=array(
		'expensesTypes'=>'ExpensesTypes',
	);

	public function testShow()
	{
		$this->open('?r=expensesTypes/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=expensesTypes/create');
	}

	public function testUpdate()
	{
		$this->open('?r=expensesTypes/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=expensesTypes/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=expensesTypes/index');
	}

	public function testAdmin()
	{
		$this->open('?r=expensesTypes/admin');
	}
}
