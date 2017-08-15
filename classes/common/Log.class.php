<?php
/**
 * Created by PhpStorm.
 * User: higashiguchi0kazuki
 * Date: 8/15/17
 * Time: 11:43
 */

namespace PureLogin\common;

class Log{
    const DESTINATION = BASE_DIR . 'log/';

    /**
     * ログを書き込む
     * @param string $strMessage
     */
    public static function write($strMessage, $level = null){
        if(!file_exists(self::DESTINATION) && is_writable(self::DESTINATION)){
            mkdir(self::DESTINATION, 0777, true);
        }

        $message = sprintf("%s %s"
            , date("Y-m-d H:i:s")
            , str_replace("\n", '', $strMessage)
        );

        switch(MODE){
            case DEVELOPING:
                \Logger::configure(BASE_DIR . '/Logger.development.xml');
                break;
            case PRODUCTION:
                \Logger::configure(BASE_DIR . '/Logger.product.xml');
                break;
            case TEST:
                \Logger::configure(BASE_DIR . '/Logger.test.xml');
        }

        $main = \Logger::getLogger('main');

        switch($level){
            case \LoggerLevel::TRACE:
                $main->trace($message);
                break;
            case \LoggerLevel::DEBUG:
                $main->debug($message);
                break;
            case \LoggerLevel::INFO:
                $main->info($message);
                break;
            case \LoggerLevel::WARN:
                $main->wain($message);
                break;
            case \LoggerLevel::ERROR:
                $main->error($message);
                break;
            case \LoggerLevel::FATAL:
                $main->fatal($message);
                break;
            default:
                $main->trace($message);
                break;
        }
    }
}