<?php

class SalariesTest extends WebTestCase
{
	public $fixtures=array(
		'salaries'=>'Salaries',
	);

	public function testShow()
	{
		$this->open('?r=salaries/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=salaries/create');
	}

	public function testUpdate()
	{
		$this->open('?r=salaries/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=salaries/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=salaries/index');
	}

	public function testAdmin()
	{
		$this->open('?r=salaries/admin');
	}
}
