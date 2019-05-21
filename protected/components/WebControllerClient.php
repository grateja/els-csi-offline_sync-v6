<?php
class WebPortalController extends CController
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
  }

  public function checkUser()
  {
      if(!isset(Yii::app()->user->username) || !isset(Yii::app()->user->password)) {
          throw new CHttpException(404, 'The requested page does not exist.');
      } else {
        if(Users::sql_validateAccount_byAccountType(Yii::app()->user->username, Yii::app()->user->password, AccountTypes::ACCOUNT_TYPE_ADMIN) == Utilities::NO) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
      }
  }


  public function isMethod($request)
  {
    $request = strtolower($request);
    $current_request_method = strtolower($_SERVER["REQUEST_METHOD"]);

    return ($current_request_method == $request);
  }

}
