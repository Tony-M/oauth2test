<?php

/**
 * Created by PhpStorm.
 * User: morozov
 * Date: 07.09.2015
 * Time: 14:03
 */
class api_getOauthCode extends __api
{
    public static function execute(){

        echo __CLASS__.PHP_EOL;

        echo 'Запрос кода авторизации: ';
        $get_params = array(
            'response_type'=>'code'
            ,'client_id'=>'testclient'
            ,'state'=>'xyz'
        );
        $form=array(
            'authorized'=>'yes'
        );

        $address = tmsApiConfig::getInstance()->getActionAddress('oauth_get_code');

        $result = tmsApiClient::POST($address, $form,$get_params );

        echo $result.PHP_EOL;

        $result = json_decode($result, true);
//        print_r($result);
        if($result && isset($result['code'])){
            tmsContext::getInstance()->setCode($result['code']);
            return true;
        }
        return false;
    }
}