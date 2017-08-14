<?php
/**
 * Created by PhpStorm.
 * User: higashiguchi0kazuki
 * Date: 8/15/17
 * Time: 04:13
 */

namespace PureLogin\common;

class Db{
    /**
     * 接続文字列
     */
    const DSN = 'mysql:dbname=%s;host=localhost;charset=utf8;';

    /**
     * データベース名
     */
    const DBNAME = 'purephplogin';

    /**
     * ユーザー名
     */
    const USER_NAME = 'cake';

    /**
     * パスワード
     */
    const PASSWORD = 'cake';

    /**
     * PDOインスタンス
     * @var \PDO
     */
    static private $instance = null;

    /**
     * コンストラクタ
     * @var \PDO
     */
    private function __construct(){

    }

    /**
     * インスタンスを取得
     * @return \PDO
     */
    private static function getInstance(){
        if(is_null(self::$instance)){
            $options = array(
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
                , \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
                , \PDO::ATTR_AUTOCOMMIT = true
            );
            self::$instance = new \PDO(
                sprintf(self::DSN, self::DBNAME)
                , self::USER_NAME
                , self::PASSWORD
                , $options
            );
        }
        return self::$instance;
    }

    /**
     * クローン
     * @throws \Exception
     */
    final public function __clone(){
        $msg = sprintf('Clone is not allowed against %s', get_class($this));
        throw new \Exception($msg);
    }

    /**
     * トランザクション実行
     */
    public static function transaction(){
        self::getInstance()->beginTransaction();
    }

    /**
     * コミット
     */
    public static function commit(){
        self::getInstance()->commit();
    }

    /**
     * ロールバック
     */
    public static function rollback(){
        self::getInstance()->rollBack()
    }

    /**
     * SELECT実行
     * @param string $sql
     * @param array $arr
     * @return array
     */
    public static function select($sql, array  $arr = array()){
        $stmt = self::getInstance()->prepare($sql);
        $stmt->execute($arr);
        return $stmt->fetchAll();
    }

    /**
     * INSERT実行
     * @param string $sql
     * @param array $arr
     * @return int
     */
    public static function insert($sql, array $arr){
        if(!self::getInstance()->inTransaction()){
            throw new \Exception('Not in transaction');
        }
        $stmt = self::getInstance()->prepare($sql);
        $stmt->execute($arr);
        return self::getInstance()->lastInsertId();
    }

    /**
     * UPDATE実行
     * @param string $sql
     * @param array $arr
     * @return bool
     */
    public static function update($sql, array $arr){
        if(!self::getInstance()->inTransaction()){
            throw new \Exception('Not in transaction');
        }
        $stmt = self::getInstance()->prepare($sql);
        return $stmt->execute($arr);
    }

    /**
     * DELETE実行
     * @param string $sql
     * @param array $arr
     * @return bool
     */
    public static function delete($sql, array $arr){
        if(!self::getInstance()->inTransaction()){
            throw new \Exception('Not in transaction.');
        }
        $stmt = self::getInstance()->prepare($sql);
        return $stmt->execute($arr);
    }

}