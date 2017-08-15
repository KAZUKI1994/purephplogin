<?php
/**
 * Created by PhpStorm.
 * User: higashiguchi0kazuki
 * Date: 8/15/17
 * Time: 06:33
 */

namespace PureLogin\common;

use PureLogin\common\SystemErrorException;

class Template{
    /**
     * テンプレートディレクトリ
     */
    const TEMPLATE_DIR = BASE_DIR . '/smarty/templates';

    /**
     * コンパイルディレクトリ
     */
    const COMPILE_DIR = BASE_DIR . '/smarty/templates_c';

    /**
     * プラグインディレクトリ
     */
    const PLUGINS_DIR  = BASE_DIR . '/smarty/plugins';

    /**
     * コンフィグディレクトリ
     */
    const CONFIGS_DIR = BASE_DIR . '/smarty/configs';

    /**
     * インスタンス
     */
    private static $instance = null;

    /**
     * コンストラクタ
     */
    private function __construct(){

    }

    /**
     * インスタンスを取得する
     * @return self::$instance[className]
     */
    public static function getInstance(){
        if(is_null(self::$instance)){
            self::$instance = new \Smarty();
            self::init();
        }
        return self::$instance;
    }

    /**
     * クローン
     * @throws \Exception
     */
    public final function __clone(){
        throw new \Exception('Clone is not allowed against' . get_class($this));
    }

    /**
     * 初期設定
     */
    private static function init(){
        // ディレクトリ設定
        self::getInstance()->setTemplateDir(self::TEMPLATE_DIR);
        self::getInstance()->setCompileDir(self::COMPILE_DIR);
        self::getInstance()->setPluginsDir(self::PLUGINS_DIR);
        self::getInstance()->setConfigsDir(self::CONFIGS_DIR);

        // XSS対策
        self::getInstance()->escape_html = true;
    }

    /**
     * テンプレートに変数をアサインする
     * @param string $key
     * @param mixed $value
     */
    public static function assign($key, $value){
        if($key == 'exception'){
            throw new SystemErrorException(
                ExceptionCode::TEMPLATE_ARG_ERR, ['exception']
            );
        }
        self::getInstance()->assign($key, $value);
    }

    /**
     * 例外をテンプレートにアサインする
     * @param \Exception $e
     */
    public static function exception(\Exception $e){
        self::getInstance()->assign('exception', $e);
    }

    /**
     * テンプレートを表示する
     */
    public static function display($template = null){
        if(is_null($template)){
            $template = preg_replace("/\/(.+)\.php/"
            , self::TEMPLATE_DIR . "/$1.tpl"
            , filter_input(INPUT_SERVER, 'SCRIPT_NAME')
            );
        }
        if(!file_exists($template)){
            throw new SystemErrorException(
                ExceptionCode::TEMPLATE_ERR, [$template]
            );
        }

        $temp = $template;

        if(defined('LAYOUT')){
            $layout = sprintf("%s/layout/%s.tp;", self::TEMPLATE_DIR, LAYOUT);
            if(!file_exists($layout)){
                throw new SystemErrorException(
                    ExceptionCode::TEMPLATE_ERR, [$layout]
                );
            }
            $temp = "extends:{$layout}|{$template}";
        }
        self::getInstance()->display($temp);
    }
}