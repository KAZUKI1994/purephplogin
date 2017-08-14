<?php
/**
 * Created by PhpStorm.
 * User: higashiguchi0kazuki
 * Date: 8/14/17
 * Time: 22:22
 */

namespace PureLogin\common;

class ApplicationErrorException{
    /**
     * コンストラクタ
     * @param type $code
     * @param \Exception $previous
     */
    public function __construct($code, \Exception $previous = null){
        $message = ExceptionCode::getMessage($code);
        self::writeLog($message);
        parent::__construct('アプリケーションエラーが発生しました。', $code, $previous);
    }

    static private function writeLog($message){

    }
}

