<?php

class InventoriesTest extends WebTestCase
{
	public $fixtures=array(
		'inventories'=>'Inventories',
	);

	public function testShow()
	{
		$this->open('?r=inventories/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=inventories/create');
	}

	public function testUpdate()
	{
		$this->open('?r=inventories/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=inventories/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=inventories/index');
	}

	public function testAdmin()
	{
		$this->open('?r=inventories/admin');
	}
}
