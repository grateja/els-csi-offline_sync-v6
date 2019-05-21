<?php

class DiscountsTest extends WebTestCase
{
	public $fixtures=array(
		'discounts'=>'Discounts',
	);

	public function testShow()
	{
		$this->open('?r=discounts/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=discounts/create');
	}

	public function testUpdate()
	{
		$this->open('?r=discounts/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=discounts/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=discounts/index');
	}

	public function testAdmin()
	{
		$this->open('?r=discounts/admin');
	}
}
