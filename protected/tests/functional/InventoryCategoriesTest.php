<?php

class InventoryCategoriesTest extends WebTestCase
{
	public $fixtures=array(
		'inventoryCategories'=>'InventoryCategories',
	);

	public function testShow()
	{
		$this->open('?r=inventoryCategories/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=inventoryCategories/create');
	}

	public function testUpdate()
	{
		$this->open('?r=inventoryCategories/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=inventoryCategories/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=inventoryCategories/index');
	}

	public function testAdmin()
	{
		$this->open('?r=inventoryCategories/admin');
	}
}
