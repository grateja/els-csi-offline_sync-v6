<?php

class ServicesTest extends WebTestCase
{
	public $fixtures=array(
		'services'=>'Services',
	);

	public function testShow()
	{
		$this->open('?r=services/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=services/create');
	}

	public function testUpdate()
	{
		$this->open('?r=services/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=services/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=services/index');
	}

	public function testAdmin()
	{
		$this->open('?r=services/admin');
	}
}
