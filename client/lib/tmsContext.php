<?php

/**
 * Class tmsContext
 * @method boolean set*(mixed $value)
 * @method mixed get*(string $param_name
 */
class tmsContext
{
    private static $instance;
    private $count = 0;

    protected $DATA = array();

    private function __construct()
    {
        if(file_exists(PATH_CACHE.'context')){
            $this->DATA = unserialize(file_get_contents(PATH_CACHE.'context'));
        }
    }

    /**
     * @return \tmsContext
     */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            $className = __CLASS__;
            self::$instance = new $className;
        }
        return self::$instance;
    }

    public function increment()
    {
        return $this->count++;
    }

    public function __clone()
    {
//        trigger_error('Клонирование запрещено.', E_USER_ERROR);
    }

    public function __wakeup()
    {

    }

    public function __sleep(){
        return serialize($this->DATA);
    }


    public function  __call($name, $arguments)
    {
        // Замечание: значение $name регистрозависимо.


        if (substr($name, 0, 3) == 'get') {
            $key = substr($name, 3, strlen($name) - 3);
            if (isset($this->DATA[$key])) return $this->DATA[$key];
            $key = lcfirst($key);
            if (isset($this->DATA[$key])) return $this->DATA[$key];
            return null;
        }

        if (substr($name, 0, 3) == 'set') {
            $key = substr($name, 3, strlen($name) - 3);
            $this->DATA[lcfirst($key)] = $arguments[0];
            return true;
        }

        if (substr($name, 0, 5) == 'unset') {
            $key = substr($name, 5, strlen($name) - 5);
            if (isset($this->DATA[$key])) {
                unset($this->DATA[$key]);
                return true;
            }
            $key = lcfirst($key);
            if (isset($this->DATA[$key])) {
                unset($this->DATA[$key]);
                return true;

            }
            return false;
        }

    }



    public function __destruct(){
        echo PATH_CACHE.'context';
        file_put_contents(PATH_CACHE.'context', $this->__sleep());
    }
}