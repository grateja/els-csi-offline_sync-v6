<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    
        const ERROR_NO = 0;
        const ERROR_YES = 1;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
        
	public function authenticate()
	{
            if(!isset($this->username)) {
			$this->errorCode=self::ERROR_YES;
            } else if($this->username !== $this->password) {
                            $this->errorCode=self::ERROR_YES;
            } else {
                $this->errorCode = self::ERROR_NO;
            }
       
            return !$this->errorCode;
	}
        
        public function checkAccount()
        {
            $users = new Users();
            $critUsers = new CDbCriteria();
            $username = strtolower($this->username);
            $password = md5($this->password);


            $critUsers->condition = 'username = :username AND pword_hash = :hashPword AND is_active = :isActive';
            $critUsers->params = array(':username'=>$username, ':hashPword'=>$password,':isActive'=> Utilities::YES);

            $model = Users::model()->find($critUsers);
            $this->errorCode = self::ERROR_YES;
            if($model) {
                    $this->errorCode = self::ERROR_NONE;
                    $this->setState('user_id',$model->id);
                    $this->setState('username',$model->username);
                    $this->setState('password', $this->password);
                    $this->setState('pword_hash', $password);
                    $this->setState('account_type_id', $model->account_type_id);
                    $this->setState('emp_id', $model->emp_id);
                    $this->setState('role', $model->role);
                    $users->last_login = Settings::get_DateTime();
                    $users->save();
            }
           return !$this->errorCode;

        }          
        
        public function checkAccountStudents()
        {
            $users = new Students();
            $critUsers = new CDbCriteria();
            $username = strtolower($this->username);
            $password = md5($this->password);


            $critUsers->condition = 'username = :username AND pword_hash = :hashPword AND is_login_active = :isActive';
            $critUsers->params = array(':username'=>$username, ':hashPword'=>$password,':isActive'=> Utilities::YES);

            $users = Students::model()->find($critUsers);

            $this->errorCode = self::ERROR_YES;
            if($users) {
                    $this->errorCode = self::ERROR_NONE;
                    $this->setState('user_id',$users->id);
                    $this->setState('username',$users->username);
                    $this->setState('password', $this->password);
                    $this->setState('pword_hash', $password);
                    $this->setState('account_type_id', AccountTypes::USER_STUDENT);
                    $this->setState('educational_level_id', $users->educational_level_id);
                    //$users->last_login = Settings::get_DateTime();
                    $users->save();
            }
            return !$this->errorCode;

        }             
}