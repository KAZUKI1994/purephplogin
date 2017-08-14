<?php
/**
 * Created by PhpStorm.
 * User: higashiguchi0kazuki
 * Date: 8/14/17
 * Time: 21:56
 */

function autoloader($name){
    $arrToken = explode('\\', $name);
    $arrToken[0] = '/classes';
    $filename = BASE_DIR . implode("/", $arrToken) . '.class.php';
    if(file_exists($filename)){
        require_once($filename);
    }
}
