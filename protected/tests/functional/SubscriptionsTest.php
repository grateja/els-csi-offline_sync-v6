<?php

class SubscriptionsTest extends WebTestCase
{
	public $fixtures=array(
		'subscriptions'=>'Subscriptions',
	);

	public function testShow()
	{
		$this->open('?r=subscriptions/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=subscriptions/create');
	}

	public function testUpdate()
	{
		$this->open('?r=subscriptions/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=subscriptions/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=subscriptions/index');
	}

	public function testAdmin()
	{
		$this->open('?r=subscriptions/admin');
	}
}
