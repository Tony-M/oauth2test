<?php

/**
 * Created by PhpStorm.
 * User: morozov
 * Date: 07.09.2015
 * Time: 16:07
 */
class api_getOauthTokenByCode extends __api
{

    public static function execute()
    {
        echo __CLASS__ . PHP_EOL;

        echo 'Запрос токена по коду авторизации: ';

        $form = array(
            'grant_type' => 'authorization_code'
        , 'code' => tmsContext::getInstance()->getCode()
        );

        tmsContext::getInstance()->unsetCode();
        //curl -u testclient:testpass http://localhost/token.php -d 'grant_type=authorization_code&code=YOUR_CODE'
        $address = tmsApiConfig::getInstance()->getActionAddress('oauth_get_token');

        $result = tmsApiClient::POST('" -u testclient:testpass "' . $address, $form);
        $result = json_decode($result, true);
        if ($result && isset($result['access_token'])) {

            tmsContext::getInstance()->setOauth($result);
            echo 'Токен получен: ';

        }
    }
}