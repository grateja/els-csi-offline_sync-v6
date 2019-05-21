<?php

class TaxSettingsTest extends WebTestCase
{
	public $fixtures=array(
		'taxSettings'=>'TaxSettings',
	);

	public function testShow()
	{
		$this->open('?r=taxSettings/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=taxSettings/create');
	}

	public function testUpdate()
	{
		$this->open('?r=taxSettings/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=taxSettings/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=taxSettings/index');
	}

	public function testAdmin()
	{
		$this->open('?r=taxSettings/admin');
	}
}
