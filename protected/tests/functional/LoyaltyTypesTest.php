<?php

class LoyaltyTypesTest extends WebTestCase
{
	public $fixtures=array(
		'loyaltyTypes'=>'LoyaltyTypes',
	);

	public function testShow()
	{
		$this->open('?r=loyaltyTypes/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=loyaltyTypes/create');
	}

	public function testUpdate()
	{
		$this->open('?r=loyaltyTypes/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=loyaltyTypes/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=loyaltyTypes/index');
	}

	public function testAdmin()
	{
		$this->open('?r=loyaltyTypes/admin');
	}
}
