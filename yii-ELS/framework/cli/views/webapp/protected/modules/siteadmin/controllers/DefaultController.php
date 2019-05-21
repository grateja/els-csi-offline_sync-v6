<?php

class DefaultController extends SiteadminController {

    public function actionIndex()
    {
        Utilities::setMenuActive_Siteadmin(Settings::get_ControllerID(), Settings::get_ActionID());
        $this->render('index');
    }
    
}
