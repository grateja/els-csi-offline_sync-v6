<?php

class DealersTest extends WebTestCase
{
	public $fixtures=array(
		'dealers'=>'Dealers',
	);

	public function testShow()
	{
		$this->open('?r=dealers/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=dealers/create');
	}

	public function testUpdate()
	{
		$this->open('?r=dealers/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=dealers/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=dealers/index');
	}

	public function testAdmin()
	{
		$this->open('?r=dealers/admin');
	}
}
