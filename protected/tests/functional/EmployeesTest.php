<?php

class EmployeesTest extends WebTestCase
{
	public $fixtures=array(
		'employees'=>'Employees',
	);

	public function testShow()
	{
		$this->open('?r=employees/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=employees/create');
	}

	public function testUpdate()
	{
		$this->open('?r=employees/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=employees/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=employees/index');
	}

	public function testAdmin()
	{
		$this->open('?r=employees/admin');
	}
}
