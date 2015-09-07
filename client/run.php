<?php
/**
 * Created by PhpStorm.
 * User: morozov
 * Date: 07.09.2015
 * Time: 13:09
 */

define('PATH_LIB', __DIR__.'/lib/');
define('PATH_CACHE', __DIR__.'/cache/');



require_once PATH_LIB.'bootstrap.php';

$context = tmsContext::getInstance();

$cl = tms_ConsoleFlow::getInstance();
$cl->row_print('Select action:');

api_getOauthCode::execute();
api_getOauthTokenByCode::execute();




