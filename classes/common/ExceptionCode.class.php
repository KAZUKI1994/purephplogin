<?php
/**
 * Created by PhpStorm.
 * User: higashiguchi0kazuki
 * Date: 8/14/17
 * Time: 22:13
 */

namespace PureLogin\common;

class ExceptionCode{

    /**
     * InvalidError
     */
    const INVALID_ERR = 1000;
    const INVALID_LOCK = 1001;
    const INVALID_LOGIN_FAIL = 1002;
    const ARGUMENT_REQUIRED = 10003;
    const INVALID_CSRF_ERR = 1004;

    /**
     * ApplicaitonError
     */
    const APPLICATION_ERR = 2000;

    /**
     * SystemError
     */
    const SYSTEM_ERR = 3000;
    const TEMPLATE_ERR = 3001;
    const TEMPLATE_ARG_ERR = 3002;

    /**
     * エラーメッセージ
     * @var array<string>
     */
    private static $_arrMessage = array(
        self::INVALID_ERR => 'エラーが発生しました。',
        self::INVALID_LOCK => 'アカウントがロックされています。',
        self::INVALID_LOGIN_FAIL => 'ログインに失敗しました。',
        self::INVALID_CSRF_ERR => '二重送信されたので処理を中断しました。',
        self::ARGUMENT_REQUIRED => 'メールアドレス及びパスワードは入力必須です。',
        self::APPLICATION_ERR => 'アプリケーション・エラーが発生しました。',
        self::SYSTEM_ERR => 'システムエラーが発生しました。',
        self::TEMPLATE_ERR => 'テンプレート[%s]が見つかりません。',
        self::TEMPLATE_ARG_ERR => '引数に[%S]は利用できません。'
    );

    /**
     * エラーメッセージを取得する
     * @param int $intCode
     * @return string
     */
    static public function getMessage($intCode){
        if(array_key_exists($intCode, self::$_arrMessage)){
            return self::$_arrMessage[$intCode];
        }
    }
}