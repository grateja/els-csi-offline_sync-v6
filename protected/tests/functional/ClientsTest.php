<?php

class ClientsTest extends WebTestCase
{
	public $fixtures=array(
		'clients'=>'Clients',
	);

	public function testShow()
	{
		$this->open('?r=clients/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=clients/create');
	}

	public function testUpdate()
	{
		$this->open('?r=clients/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=clients/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=clients/index');
	}

	public function testAdmin()
	{
		$this->open('?r=clients/admin');
	}
}
