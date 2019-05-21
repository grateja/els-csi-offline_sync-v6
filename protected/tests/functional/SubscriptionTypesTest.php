<?php

class SubscriptionTypesTest extends WebTestCase
{
	public $fixtures=array(
		'subscriptionTypes'=>'SubscriptionTypes',
	);

	public function testShow()
	{
		$this->open('?r=subscriptionTypes/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=subscriptionTypes/create');
	}

	public function testUpdate()
	{
		$this->open('?r=subscriptionTypes/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=subscriptionTypes/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=subscriptionTypes/index');
	}

	public function testAdmin()
	{
		$this->open('?r=subscriptionTypes/admin');
	}
}
