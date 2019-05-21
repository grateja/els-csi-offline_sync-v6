<?php

class RfidPriceSettingsTest extends WebTestCase
{
	public $fixtures=array(
		'rfidPriceSettings'=>'RfidPriceSettings',
	);

	public function testShow()
	{
		$this->open('?r=rfidPriceSettings/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=rfidPriceSettings/create');
	}

	public function testUpdate()
	{
		$this->open('?r=rfidPriceSettings/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=rfidPriceSettings/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=rfidPriceSettings/index');
	}

	public function testAdmin()
	{
		$this->open('?r=rfidPriceSettings/admin');
	}
}
