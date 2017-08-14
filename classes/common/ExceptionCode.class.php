<?php
/**
 * Created by PhpStorm.
 * User: higashiguchi0kazuki
 * Date: 8/14/17
 * Time: 22:13
 */

namespace PureLogin\common;

class ExceptionCode{

    // エラーコード定義
    const INVALID_ERR = 1000;
    const INVALID_LOCK = 1001;
    const INVALID_LOGIN_FAIL = 1002;
    const APPLICATION_ERR = 2000;
    const SYSTEM_ERR = 3000;
    const TEMPLATE_ERR = 3001;

    private static $_arrMessage = array(
        self::INVALID_ERR => 'エラーが発生しました。',
        self::INVALID_LOCK => 'アカウントがロックされています。',
        self::INVALID_LOGIN_FAIL => 'ログインに失敗しました。',
        self::APPLICATION_ERR => 'アプリケーション・エラーが発生しました。',
        self::SYSTEM_ERR => 'システムエラーが発生しました。',
        self::TEMPLATE_ERR => 'テンプレート[%s]が見つかりません。'
    );

    static public function getMessage($intCode){
        if(array_key_exists($intCode, self::$_arrMessage)){
            return self::$_arrMessage[$intCode];
        }
    }
}