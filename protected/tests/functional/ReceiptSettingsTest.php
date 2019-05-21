<?php

class ReceiptSettingsTest extends WebTestCase
{
	public $fixtures=array(
		'receiptSettings'=>'ReceiptSettings',
	);

	public function testShow()
	{
		$this->open('?r=receipt_settings/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=receipt_settings/create');
	}

	public function testUpdate()
	{
		$this->open('?r=receipt_settings/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=receipt_settings/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=receipt_settings/index');
	}

	public function testAdmin()
	{
		$this->open('?r=receipt_settings/admin');
	}
}
