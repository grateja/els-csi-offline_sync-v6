<?php
class FrontController extends CController
{
  public $leftMenu;
  public $menu=array();
  public $breadcrumbs=array();
  public $layout='/layouts/main';
  
  public function init()
  {
      
        parent::init();
        $app = Yii::app();
        if (isset($_POST['_lang']))
        {
          $app->language = $_POST['_lang'];
          $app->session['_lang'] = $app->language;
        }
        else if (isset($app->session['_lang']))
        {
          $app->language = $app->session['_lang'];
        }
        else
        {
          $app->language = 'en';
        }
        
        $app->theme = 'smartadmin';
        Yii::app()->getClientScript()->registerCoreScript('jquery');
      //  $this->checkUser();
  }

  public function checkUser()
  {

      Utilities::debug(Settings::get_ControllerID(), Settings::get_ActionID());exit();
  }


  public function isMethod($request)
  {
    $request = strtolower($request);
    $current_request_method = strtolower($_SERVER["REQUEST_METHOD"]);

    return ($current_request_method == $request);
  }

}
