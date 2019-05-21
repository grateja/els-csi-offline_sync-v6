<?php

class CustomersTest extends WebTestCase
{
	public $fixtures=array(
		'customers'=>'Customers',
	);

	public function testShow()
	{
		$this->open('?r=customers/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=customers/create');
	}

	public function testUpdate()
	{
		$this->open('?r=customers/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=customers/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=customers/index');
	}

	public function testAdmin()
	{
		$this->open('?r=customers/admin');
	}
}
