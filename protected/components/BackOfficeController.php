<?php
class BackOfficeController extends CController
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
        
        Yii::app()->getClientScript()->registerCoreScript('jquery');
        $this->checkUser();
  }

    public function checkUser()
    {
        if(!isset(Yii::app()->user->username) || !isset(Yii::app()->user->password)) {
               $this->redirect('index.php?r=site/accessError');
        }
        
        if(Users::sql_validateAccount_byAccountType(Yii::app()->user->username, Yii::app()->user->password, AccountTypes::USER_ADMIN) == Utilities::NO) {
              $this->redirect('index.php?r=site/accessError');
        }
    }


  public function isMethod($request)
  {
    $request = strtolower($request);
    $current_request_method = strtolower($_SERVER["REQUEST_METHOD"]);

    return ($current_request_method == $request);
  }

}
