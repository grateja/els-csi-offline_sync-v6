<?php

class BranchesTest extends WebTestCase
{
	public $fixtures=array(
		'branches'=>'Branches',
	);

	public function testShow()
	{
		$this->open('?r=branches/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=branches/create');
	}

	public function testUpdate()
	{
		$this->open('?r=branches/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=branches/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=branches/index');
	}

	public function testAdmin()
	{
		$this->open('?r=branches/admin');
	}
}
