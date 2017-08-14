<?php
/**
 * Created by PhpStorm.
 * User: higashiguchi0kazuki
 * Date: 8/14/17
 * Time: 22:11
 */

namespace PureLogin\common;

class InvalidErrorException extends \Exception{

    public function __construct($code, \Exception $previous = null){
        $message = ExceptionCode::getMessage($code);
        parent::__construct($message, $code, $previous);
    }
}