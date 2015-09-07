<?php

/**
 * Created by PhpStorm.
 * User: morozov
 * Date: 07.09.2015
 * Time: 13:16
 */
class tms_ConsoleFlow
{

    private static $instance;


    private function __construct()
    {
    }

    /**
     * @return \tms_ConsoleFlow
     */
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

    public function ask($text = '')
    {
        echo $text;
        $handle = fopen("php://stdin", "r");
        $line = fgets($handle);
        return $line;
    }

    /**
     * @param string $text
     */
    public function row_print($text = '')
    {
        echo $text . PHP_EOL;
    }


}