<?php

/**
 * Created by PhpStorm.
 * User: morozov
 * Date: 07.09.2015
 * Time: 13:22
 */
class tmsApiConfig
{
    private static $instance;

    protected $SERVER = 'http://127.0.0.1:32290';

    //curl -u testclient:testpass http://localhost/token.php -d 'grant_type=authorization_code&code=YOUR_CODE'
    protected $ADDRESS = array(
        'oauth_get_code' => '/authorize.php'
        ,'oauth_get_token' => '/token.php'
    );

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            $className = __CLASS__;
            self::$instance = new $className;
        }
        return self::$instance;
    }


    public function __clone()
    {
        trigger_error('Клонирование запрещено.', E_USER_ERROR);
    }

    public function __wakeup()
    {
        trigger_error('Десериализация запрещена.', E_USER_ERROR);
    }

    public function getActionAddress($action = null)
    {
        if(isset($this->ADDRESS[$action])){
            return $this->SERVER. $this->ADDRESS[$action];
        }
        throw new Exception('no address for selected action '.$action.PHP_EOL);
    }


}