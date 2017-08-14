<?php
/**
 * Created by PhpStorm.
 * User: higashiguchi0kazuki
 * Date: 8/15/17
 * Time: 06:13
 */

/**
 * **** 注意 ****
 * このファイルは自動的に生成されます。
 * 手動でいじったりしないようにしてください。
 */

namespace PureLogin\model;

use PureLogin\dao\UserDao;

/**
 * UserModelBase
 */
class UserModelBase{
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
     * プロパティをセットする
     * @param array $arrDao
     * @return \MyApp\model\UserModel
     */
    protected function setProperty(array $arrDao)
    {
        $this->setUserId($arrDao['userId'])
            ->setDisplayName($arrDao['displayName'])
            ->setEmail($arrDao['email'])
            ->setPassword($arrDao['password'])
            ->setToken($arrDao['token'])
            ->setLoginFailureCount($arrDao['loginFailureCount'])
            ->setLoginFailureDatetime($arrDao['loginFailureDatetime'])
            ->setDeleteFlag($arrDao['deleteFlag']);
        return $this;
    }

    /**
     * 更新する
     * @return bool
     */
    public function save()
    {
        return UserDao::save($this);
    }

    /**
     * 新規作成する
     * @return int
     */
    public function create()
    {
        return UserDao::insert($this);
    }

    /**
     * ユーザーIDを設定する
     * @param int $userId
     * @return \MyApp\model\UserModel
     */
    public function setUserId($userId)
    {
        $this->_userId = $userId;
        return $this;
    }

    /**
     * パスワード（ハッシュ）を設定する
     * @param string $password
     * @return \MyApp\model\UserModel
     */
    public function setPassword($password)
    {
        $this->_password = $password;
        return $this;
    }

    /**
     * 表示名を設定する
     * @param string $displayName
     * @return \MyApp\model\UserModel
     */
    public function setDisplayName($displayName)
    {
        $this->_displayName = $displayName;
        return $this;
    }

    /**
     * メールアドレスを設定する
     * @param string $email
     * @return \MyApp\model\UserModel
     */
    public function setEmail($email)
    {
        $this->_email = $email;
        return $this;
    }

    /**
     * トークンを設定する
     * @param string $token
     * @return \MyApp\model\UserModel
     */
    public function setToken($token)
    {
        $this->_token = $token;
        return $this;
    }

    /**
     * ログイン失敗回数を設定する
     * @param int $loginFailureCount
     * @return \MyApp\model\UserModel
     */
    public function setLoginFailureCount($loginFailureCount)
    {
        $this->_loginFailureCount = $loginFailureCount;
        return $this;
    }

    /**
     * ログイン失敗日時を設定する
     * @param string $loginFailureDatetime
     * @return \MyApp\model\UserModel
     */
    public function setLoginFailureDatetime($loginFailureDatetime)
    {
        $this->_loginFailureDatetime = $loginFailureDatetime;
        return $this;
    }

    /**
     * 削除フラグを設定する
     * @param bool $deleteFlag
     * @return \MyApp\model\UserModel
     */
    public function setDeleteFlag($deleteFlag)
    {
        $this->_deleteFlag = $deleteFlag;
        return $this;
    }

    /**
     * ユーザーIDを取得する
     * @return int
     */
    public function getUserId()
    {
        return $this->_userId;
    }

    /**
     * パスワード（ハッシュ）を取得する
     * @return string
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * 表示名を取得する
     * @return string
     */
    public function getDisplayName()
    {
        return $this->_displayName;
    }

    /**
     * メールアドレスを取得する
     * @return string
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * トークンを取得する
     * @return string
     */
    public function getToken()
    {
        return $this->_token;
    }

    /**
     * ログイン失敗回数を取得する
     * @return int
     */
    public function getLoginFailureCount()
    {
        return $this->_loginFailureCount;
    }

    /**
     * ログイン失敗日時を取得する
     * @return string
     */
    public function getLoginFailureDatetime()
    {
        return $this->_loginFailureDatetime;
    }

    /**
     * 削除フラグを取得する
     * @return bool
     */
    public function getDeleteFlag()
    {
        return $this->_deleteFlag;
    }
}