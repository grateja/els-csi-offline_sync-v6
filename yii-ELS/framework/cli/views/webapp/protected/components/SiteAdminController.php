<?php

class SiteAdminController extends CController
{

    public $leftMenu;
    public $menu = array();
    public $breadcrumbs = array();
    public $layout = '/layouts/main';

    public function init()
    {

        parent::init();
        $app = Yii::app();
        if (isset($_POST['_lang'])) {
            $app->language = $_POST['_lang'];
            $app->session['_lang'] = $app->language;
        } else if (isset($app->session['_lang'])) {
            $app->language = $app->session['_lang'];
        } else {
            $app->language = 'en';
        }

        $app->theme = 'smartadmin';
        Yii::app()->getClientScript()->registerCoreScript('jquery');
        $this->checkUser();
    }

    public function checkUser()
    {
        $model = new Users();
        $modelMenus = new menus();
        $userBasedAccess = new UserBasedAccess();
        $modelRoleBaseAccess = new RoleBasedAccess();
        
        $actual_link = "$_SERVER[REQUEST_URI]";
        $linkArray = split('/', $actual_link);
        $countArray = count($linkArray);
        $splitAction = split('&', $linkArray[($countArray - 1)]);
        $controller = Settings::get_ControllerID();
        $acion = $splitAction[0];
        $userID = Settings::get_UserID();
        $model = Utilities::model_getByID(Users::model(), $userID);
        $modelMenus = Menus::sql_getRowData_controllerNameActionName($controller , $acion);
        $menuID = NULL;
        if($model->is_override_useraccess = Utilities::YES){
            $userBasedAccess = UserBasedAccess::model_getByUserID_menuID($menuID,$userID, Utilities::NO);
        }else{
            
        }
      //  Utilities::debug($modelMenus, '$caption');exit();
        
       
        if (!isset(Yii::app()->user->username) || !isset(Yii::app()->user->password)) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }

        if (Users::sql_validateAccount_byAccountType(Yii::app()->user->username, Yii::app()->user->password, AccountTypes::USER_ADMIN) == Utilities::NO) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }

    public function isMethod($request)
    {
        $request = strtolower($request);
        $current_request_method = strtolower($_SERVER["REQUEST_METHOD"]);

        return ($current_request_method == $request);
    }

}
