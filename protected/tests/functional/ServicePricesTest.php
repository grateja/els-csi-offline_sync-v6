<?php

class ServicePricesTest extends WebTestCase
{
	public $fixtures=array(
		'servicePrices'=>'ServicePrices',
	);

	public function testShow()
	{
		$this->open('?r=servicePrices/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=servicePrices/create');
	}

	public function testUpdate()
	{
		$this->open('?r=servicePrices/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=servicePrices/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=servicePrices/index');
	}

	public function testAdmin()
	{
		$this->open('?r=servicePrices/admin');
	}
}
