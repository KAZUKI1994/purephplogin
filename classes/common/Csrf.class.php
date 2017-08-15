<?php
/**
 * Created by PhpStorm.
 * User: higashiguchi0kazuki
 * Date: 8/15/17
 * Time: 11:17
 */

namespace PureLogin\common;

class Csrf{
    /**
     * トークン
     * @var string
     */
    private static $token = null;

    /**
     * 初期化
     */
    private static function init(){
        self::$token = sha1(uniqid());
    }

    /**
     * CSRF用にトークン生成
     * @return string
     */
    public static function get(){
        if(is_null(self::$token)){
            self::init();
        }
        $_SESSION['csrf_token'] = self::$token;
        return self::$token;
    }

    /**
     * CSRFをチェックする
     * @return boolean
     * @throws ApplicationErrorException
     */
    public static function check(){
        $csrf_token = (isset($_SESSION['csrf_token'])) ? $_SESSION['csrf_token'] : null;
        $_SESSION['csrf_token'] = null;

        if(filter_input(INPUT_POST, 'csrf_token') !== $csrf_token){
            throw new InvalidErrorException(ExceptionCode::INVALID_CSRF_ERR);
        }
        return true;
    }
}