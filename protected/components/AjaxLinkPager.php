<?php

class AjaxLinkPager extends CLinkPager
{
  public $target = '#content';
  public $type = 'link';
  public $count = '#content';
  public $url_append = '';

  public function init() {
    parent::init();
    //CHtml::$count = 60;
  }

  protected function createPageButtons()
  {
    return parent::createPageButtons();
  }
  
	protected function createPageButton($label,$page,$class,$hidden,$selected)
	{
		if($hidden || $selected)
			$class.=' '.($hidden ? self::CSS_HIDDEN_PAGE : self::CSS_SELECTED_PAGE);
    return '<li class="'.$class.'">'.CHtml::ajaxLink($label, $this->createPageUrl($page).$this->url_append, array('update'=>$this->target), array('onclick'=>'ajaxLoader();')).'</li>';
	}

  public function run()
  {
		if($this->nextPageLabel===null)
			$this->nextPageLabel=Yii::t('yii','&gt;');
		if($this->prevPageLabel===null)
			$this->prevPageLabel=Yii::t('yii','&lt;');
		if($this->firstPageLabel===null)
			$this->firstPageLabel=Yii::t('yii','&lt;&lt;');
		if($this->lastPageLabel===null)
			$this->lastPageLabel=Yii::t('yii','&gt;&gt;');
		if($this->header===null)
			$this->header=Yii::t('site','Go to page: ')."<br /><br />";

		$buttons=$this->createPageButtons();

		if(empty($buttons))
			return;

		$this->registerClientScript();

		$htmlOptions=$this->htmlOptions;
		if(!isset($htmlOptions['id']))
			$htmlOptions['id']=$this->getId();
		if(!isset($htmlOptions['class']))
			$htmlOptions['class']='yiiPager';
		echo $this->header;
		echo CHtml::tag('ul',$htmlOptions,implode("\n",$buttons));
		echo $this->footer;

    /*
    if ($this->type == 'link')
    {
      parent::run();
    }
    else if ($this->type == 'dropdown')
    {
      $this->dropDownPager();
    }
    */
  }

  protected function dropDownPager() {

  }
}
