<?php

/**
 * Created by PhpStorm.
 * User: morozov
 * Date: 07.09.2015
 * Time: 14:08
 */
class tmsApiClient
{

    public static function GET($address=null, $form = array(), $headers=null)
    {
        $form_params = '';
        foreach ($form as $key => $value) {
            $form_params .= ($form_params == '' ? '' : '&');
            $form_params .= $key . '=' . $value;
        }


        $command = 'curl -s "' . $address . '?' . $form_params.'"';

//        echo PHP_EOL.$command.PHP_EOL;

        return shell_exec($command);
    }

    /**
     * @param null $address
     * @param array $form post params
     * @param array $get_params get params
     * @param array $headers
     * @return string
     */
    public static function POST($address=null, $form = array(), $get_params=array(), $headers = array())
    {

        $get_pars = '';
        foreach ($get_params as $key => $value) {
            $get_pars .= ($get_pars == '' ? '' : '&');
            $get_pars .= $key . '=' . $value;
        }

        if(false == strpos($address,'?'))
        $get_pars = '?'.$get_pars;

        $form_params = '';
        foreach ($form as $key => $value) {
            $form_params .= ($form_params == '' ? '' : '&');
            $form_params .= $key . '=' . $value;
        }


        $command = 'curl -s "' . $address .$get_pars. '" -d \'' . $form_params.'\'';
        echo PHP_EOL.$command.PHP_EOL;

        return shell_exec($command);
    }
}