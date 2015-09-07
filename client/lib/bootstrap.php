<?php
/**
 * Created by PhpStorm.
 * User: morozov
 * Date: 07.09.2015
 * Time: 13:09
 */

function my_autoloader($class) {

    if(file_exists(PATH_LIB.$class.'.php')){
        require_once PATH_LIB.$class.'.php';
    }else{
        throw new Exception ('Class '.$class.' not exists');
    }
}

spl_autoload_register('my_autoloader');