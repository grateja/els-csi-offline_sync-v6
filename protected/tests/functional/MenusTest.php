<?php

class MenusTest extends WebTestCase
{
	public $fixtures=array(
		'menuses'=>'Menus',
	);

	public function testShow()
	{
		$this->open('?r=menus/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=menus/create');
	}

	public function testUpdate()
	{
		$this->open('?r=menus/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=menus/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=menus/index');
	}

	public function testAdmin()
	{
		$this->open('?r=menus/admin');
	}
}
