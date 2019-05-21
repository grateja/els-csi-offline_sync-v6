<?php

class LoyaltySettingsTest extends WebTestCase
{
	public $fixtures=array(
		'loyaltySettings'=>'LoyaltySettings',
	);

	public function testShow()
	{
		$this->open('?r=loyaltySettings/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=loyaltySettings/create');
	}

	public function testUpdate()
	{
		$this->open('?r=loyaltySettings/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=loyaltySettings/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=loyaltySettings/index');
	}

	public function testAdmin()
	{
		$this->open('?r=loyaltySettings/admin');
	}
}
