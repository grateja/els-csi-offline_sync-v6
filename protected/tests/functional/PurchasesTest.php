<?php

class PurchasesTest extends WebTestCase
{
	public $fixtures=array(
		'purchases'=>'Purchases',
	);

	public function testShow()
	{
		$this->open('?r=purchases/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=purchases/create');
	}

	public function testUpdate()
	{
		$this->open('?r=purchases/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=purchases/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=purchases/index');
	}

	public function testAdmin()
	{
		$this->open('?r=purchases/admin');
	}
}
