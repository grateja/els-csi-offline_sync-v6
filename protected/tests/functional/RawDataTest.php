<?php

class RawDataTest extends WebTestCase
{
	public $fixtures=array(
		'rawDatas'=>'RawData',
	);

	public function testShow()
	{
		$this->open('?r=rawData/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=rawData/create');
	}

	public function testUpdate()
	{
		$this->open('?r=rawData/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=rawData/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=rawData/index');
	}

	public function testAdmin()
	{
		$this->open('?r=rawData/admin');
	}
}
