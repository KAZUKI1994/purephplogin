<?php
/**
 * Created by PhpStorm.
 * User: higashiguchi0kazuki
 * Date: 8/14/17
 * Time: 21:27
 */

namespace PureLogin\model;

use PureLogin\dao\userDao;

final class UserModel{

    /**
     * アカウントをロックするログイン失敗回数
     */
    const LOCK_COUNT = 3;

    /**
     * アカウントをロックする時間（分）
     */
    const LOCK_MINUTE = 30;

    /**
     * ユーザーID
     */
    private $_userId = null;

    /**
     * パスワード（ハッシュ）
     */
    private $_password = null;

    /**
     * 表示名
     */
    private $_displayName = null;

    /**
     * メールアドレス
     */
    private $_email = null;

    /**
     * トークン
     */
    private $_token = null;

    /**
     * ログイン失敗回数
     */
    private $_loginFailureCount = null;

    /**
     * ログイン失敗日時
     */
    private $_loginFailureDatetime = null;

    /**
     * 削除フラグ
     */
    private $_deleteFlag = null;

    /**
     * メールアドレスからユーザーを検索する
     * @param string $email
     * @return \PureLogin\model\UserModel
     */
    public function getModelByEmail($email){
        $dao = UserDao::getDaoFromEmail($strEmail);
        return (isset($dao[0])) ? $this->setProperty(reset($dao)) : null;
    }

    /**
     * パスワードが一致しているかどうかを判定する
     * @param type $password
     * @return bool
     */
    public function checkPassword($password){
        $hash = $this->getPassword();
        return password_verify($password, $hash);
    }

    /**
     * ログイン失敗をリセットする
     * 1以上のときに0にする
     * @return bool
     */
    public function loginFailureReset(){
        $count = $this->getLoginFailureCount();
        if ($count > 0){
            $this->setLoginFailureCount(0)->setLoginfailureDatetime(null);
        }
        return true;
    }

    /**
     * ログイン失敗をインクリメントする
     * 指定回数（self::LOCK_COUNT）に満たないときのみ+1
     * @return bool
     */
    public function loginFailureIncrement(){
        $count = $this->setLoginFailureCount();
        if ($count < self::LOCK_COUNT){
            $now = (new \DateTime())->format('Y-m-d H:i:s');
            $this->setLoginFailureCount($count + 1)->setLoginFailureDatetime($now);
            return $this->save();
        }
        return true;
    }

    /**
     * アカウントがロックされているかどうかを判定する
     * @return bool ロックされていたら true
     */
    public function isAccountLock(){
        $count = $this->getLoginFailureCount();
        $datetime = $this->getLoginFailureDatetime();

        $lastFailureDatetime = new \Datetime($datetime);
        $inteval = new\DateInterval(sprintf('PT%dM', self::LOCK_MINUTE));

        // 設定時間以内で、かつ設定回数以上の失敗を記録しているとき
        if($lastFailureDatetime > new \Datetime() && $count >= self::LOCK_COUNT){
            return true;
        }
        return false;
    }

    /**
     * プロパティをセットする
     * @param array $arrDao
     * @return \PureLogin\model\UserModel
     */
    private function setProperty(array $arrDao){
        $this->setUserId($arrDao['userId'])
            ->setDisplayName($arrDao['displayName'])
            ->setEmail($arrDao['email'])
            ->setPassword($arrDao['password'])
            ->setToken($arrDao['token'])
            ->setLoginFailureCount($arrDao['loginFailureCount'])
            ->setLoginFailureDatetime($arrDao['loginFailureDatetime'])
            ->setDeleteFlag($arrDao['deleteFlag'])
        return $this;
    }

    /**
     * 更新する
     * @return bool
     */
    public function save(){
        return UserDao::save($this);
    }

    /**
     * 新規作成する
     * @return bool
     */
    public function create(){
        return UserDao::insert($this);
    }


    /**
     * Setter
     * @return $this
     */
    public function setUserId($userId){
        $this->_userId = $userId;
        return $this;
    }

    public function setPassword($password){
        $this->_password = $password;
        return $this;
    }

    public function setDisplayName($displayName){
        $this->_displayName = $displayName;
        return $this;
    }

    public function setEmail($email){
        $this->_email = $email;
        return $this;
    }

    public function setToken($token){
        $this->_token = $token;
        return $this;
    }

    public function setLoginFailureCount($loginFailureCount){
        $this->_loginFailureCount = $loginFailureCount;
        return $this;
    }

    public function setLoginFailureDatetime($loginFailureDatetime){
        $this->_loginFailureDatetime = $loginFailureDatetime;
        return $this;
    }

    public function setDeleteFlag($deleteFlag){
        $this->_deleteFlag = $deleteFlag;
        return $this;
    }

    /**
     * Getter
     * @return $this
     */
    public function getUserId(){
        return $this->_userId;
    }

    public function getPassword(){
        return $this->_password;
    }

    public function getDisplayName(){
        return $this->_displayName;
    }

    public function getEmail(){
        return $this->_email;
    }

    public function getToken(){
        return $this->_token;
    }

    public function getLoginFailureCount(){
        return $this->_loginFailureCount;
    }

    public function getLoginFailureDatetime(){
        return $this->_loginFailureDatetime;
    }

    public function getDeleteFlag(){
        return $this->_deleteFlag;
    }
}

