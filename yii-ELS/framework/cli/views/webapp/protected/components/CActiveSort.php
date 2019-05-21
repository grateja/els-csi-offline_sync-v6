<?php
/**
 * Description from forum:

After wasting a lot of time trying to get CSort to do what I wanted, I finally backed up and wrote my own class, for a couple of reasons:

1. CSort does not behave well when used with relational queries.
2. CSort does not allow you to create complex sorts (for example, when you have a user table with first_name and last_name, and wish to sort by both using a single alias)

and perhaps most importantly:

3. Sorting logic does not belong in the controller - it should be embedded in the model.

 * @author: mindplay <http://mindplay.dk> <http://www.yiiframework.com/forum/index.php?/user/2328-mindplay/>
 * @source: http://www.yiiframework.com/forum/index.php?/topic/4183-my-gripes-with-csort-and-solution/
 * 
 */

class CActiveSort extends CComponent {

  public $separator = '-';
  public $paramName = 'sort';
  public $route = '';

  protected $aliases;
  protected $model;

  protected $current, $current_ascend = true;

  public function __construct($modelName) {

    $this->model = CActiveRecord::model($modelName);

    $this->aliases = is_callable(array($this->model, 'sorts')) ? $this->model->sorts() : array();

    if (isset($_GET['sort'])) {
      $bits = explode($this->separator, $_GET['sort']);
      if ($this->getAlias($bits[0])) $this->current = $bits[0];
      if (isset($bits[1]) && $bits[1] == 'desc') $this->current_ascend = false;
    }

  }

  protected function getAlias($alias) {

    if (!isset($this->aliases[$alias])) {
      $attributes = $this->model->attributeNames();
      if (in_array($alias, $attributes)) {
        $this->aliases[$alias] = $alias;
      } else {
        return null;
      }
    }

    $config = $this->aliases[$alias];

    if (is_string($config)) {
      $this->aliases[$alias] = array(
        'asc'=>$config.' asc',
        'desc'=>$config.' desc'
      );
    }

    return $config;

  }

  public function applyOrderTo($criteria) {

    $config = $this->getAlias($this->current);
    if (!$config) return;

    $criteria->order = $config[$this->current_ascend ? 'asc' : 'desc'];

  }

  public function link($alias, $label=null, $htmlOptions=array()) {

    if (is_null($label))
      $label = $this->model->getAttributeLabel($alias);

    $config = $this->getAlias($alias);

    if (!$config)
      return CHtml::encode($label); # non-sortable

    $controller = Yii::app()->getController();

    $ascend = ( $alias != $this->current ? false : $this->current_ascend );

    $params = $_GET;
    $params[$this->paramName] = $alias . $this->separator . ($ascend ? 'desc' : 'asc');
    $sort_image = ($alias == $this->current ? ($ascend ? 'sort-asc' : 'sort-desc') : 'sort-none');

    $url = $controller->createUrl($this->route, $params);

    $class = $alias == $this->current ? ($ascend ? 'sort-asc' : 'sort-desc') : 'sort-none';
    $htmlOptions['class'] = (isset($htmlOptions['class']) ? $htmlOptions['class'].' ' : '') . $class;

    $sort_image_tag = ($sort_image=='sort-none' ? CHtml::image(Yii::app()->request->baseUrl.'/images/sort_none.png') : CHtml::image(Yii::app()->request->baseUrl.'/images/'.($sort_image=='sort-asc' ? 'up' : 'down' ).'.png') );

    if (isset($htmlOptions['ajax']))
    {
      $ajaxOptions = $htmlOptions['ajax'];
      unset($htmlOptions['ajax']);
      return CHtml::ajaxLink($label.$sort_image_tag, $url, $ajaxOptions, $htmlOptions);
    }
    
    return CHtml::link($label.$sort_image_tag, $url, $htmlOptions);
  }

}