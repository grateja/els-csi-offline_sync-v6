<?php

class ServicesTypesTest extends WebTestCase
{
	public $fixtures=array(
		'servicesTypes'=>'ServicesTypes',
	);

	public function testShow()
	{
		$this->open('?r=servicesTypes/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=servicesTypes/create');
	}

	public function testUpdate()
	{
		$this->open('?r=servicesTypes/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=servicesTypes/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=servicesTypes/index');
	}

	public function testAdmin()
	{
		$this->open('?r=servicesTypes/admin');
	}
}
