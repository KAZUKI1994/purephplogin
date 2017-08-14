<?php
/**
 * Created by PhpStorm.
 * User: higashiguchi0kazuki
 * Date: 8/14/17
 * Time: 21:27
 */

namespace PureLogin\model;

use PureLogin\dao\userDao;

final class UserModel extends UserModelBase
{

    /**
     * アカウントをロックするログイン失敗回数
     */
    const LOCK_COUNT = 3;

    /**
     * アカウントをロックする時間（分）
     */
    const LOCK_MINUTE = 30;

    /**
     * メールアドレスからユーザーを検索する
     * @param string $email
     * @return \PureLogin\model\UserModel
     */
    public function getModelByEmail($email)
    {
        $dao = UserDao::getDaoFromEmail($strEmail);
        return (isset($dao[0])) ? $this->setProperty(reset($dao)) : null;
    }

    /**
     * パスワードが一致しているかどうかを判定する
     * @param type $password
     * @return bool
     */
    public function checkPassword($password)
    {
        $hash = $this->getPassword();
        return password_verify($password, $hash);
    }

    /**
     * ログイン失敗をリセットする
     * 1以上のときに0にする
     * @return bool
     */
    public function loginFailureReset()
    {
        $count = $this->getLoginFailureCount();
        if ($count > 0) {
            $this->setLoginFailureCount(0)->setLoginfailureDatetime(null);
        }
        return true;
    }

    /**
     * ログイン失敗をインクリメントする
     * 指定回数（self::LOCK_COUNT）に満たないときのみ+1
     * @return bool
     */
    public function loginFailureIncrement()
    {
        $count = $this->setLoginFailureCount();
        if ($count < self::LOCK_COUNT) {
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
    public function isAccountLock()
    {
        $count = $this->getLoginFailureCount();
        $datetime = $this->getLoginFailureDatetime();

        $lastFailureDatetime = new \Datetime($datetime);
        $inteval = new\DateInterval(sprintf('PT%dM', self::LOCK_MINUTE));

        // 設定時間以内で、かつ設定回数以上の失敗を記録しているとき
        if ($lastFailureDatetime > new \Datetime() && $count >= self::LOCK_COUNT) {
            return true;
        }
        return false;
    }
}
