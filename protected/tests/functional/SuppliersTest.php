<?php

class SuppliersTest extends WebTestCase
{
	public $fixtures=array(
		'suppliers'=>'Suppliers',
	);

	public function testShow()
	{
		$this->open('?r=suppliers/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=suppliers/create');
	}

	public function testUpdate()
	{
		$this->open('?r=suppliers/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=suppliers/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=suppliers/index');
	}

	public function testAdmin()
	{
		$this->open('?r=suppliers/admin');
	}
}
