<?php
/**
 * Created by PhpStorm.
 * User: higashiguchi0kazuki
 * Date: 8/15/17
 * Time: 05:09
 */

namespace PureLogin\dao;

use PureLogin\common\Db;
use PureLogin\model\UserModel;

class UserDao{
    /**
     * ユーザーIDから配列を取得する
     * @param type $intUserId
     * @return array
     */
    public static function getDaoFromUserId($intUserId, $intDeleteFlag = null){
        $sql = "SELECT ";
        $sql .= "`userId`";
        $sql .= ", `password`";
        $sql .= ", `displayName`";
        $sql .= ", `email`";
        $sql .= ", `token`";
        $sql .= ", `loginFailureCount`";
        $sql .= ", `loginFailureDatetime`";
        $sql .= ", `deleteFlag`";
        $sql .= "FROM `tbl_users` ";
        $sql .= "WHERE `userId` = :userId ";

        $arr = array();
        $arr[':userId'] = $intUserId;
        if(!is_null($intDeleteFlag) && in_array($intDeleteFlag, array(0, 1))){
            $sql .= "AND `deleteFlag` = :deleteFlag ";
            $arr[':deleteFlag'] = $intDeleteFlag;
        }
        return Db::select($sql, $arr);
    }

    /**
     * メールアドレスから配列を取得する
     * @param type $strEmail
     * @return array
     */
    public static function getDaoFromEmail($strEmail, $intDeleteFlag = null){
        $sql = "SELECT ";
        $sql .= "`userId`";
        $sql .= ", `password`";
        $sql .= ", `displayName`";
        $sql .= ", `email`";
        $sql .= ", `token`";
        $sql .= ", `loginFailureCount`";
        $sql .= ", `loginFailureDatetime`";
        $sql .= ", `deleteFlag` ";
        $sql .= "FROM `tbl_users` ";
        $sql .= "WHERE `email = :email ";

        $arr = array();
        $arr[':email'] = $strEmail;
        if(!is_null($intDeleteFlag) && in_array($intDeleteFlag, array(0, 1))){
            $sql .= "AND `deleteFlag` = :deleteFlag ";
            $arr[':deleteFlag'] = $intDeleteFlag;
        }
        return Db::select($sql, $arr);
    }

    /**
     * 更新する
     * @param UserModel $objUserModel
     * @return bool
     */
    public static function save(UserModel, $objUserModel){
        $sql = "UPDATE ";
        $sql .= "`tbl_users` ";
        $sql .= "SET ";
        $sql .= "`password` = :password ";
        $sql .= ", `displayName` = :displayName ";
        $sql .= ", `email = :email ";
        $sql .= ", `token` = :token ";
        $sql .= ", `loginFailureCount` = :loginFailureCount ";
        $sql .= ", `loginFailureDatetime` = :loginFailureDatetime ";
        $sql .= ", `deleteFlag` = :deleteFlag ";
        $sql .= "WHERE `userId` = :userId ";

        $arr = array();
        $arr[':userId'] = $objUserModel->getUserId();
        $arr[':password'] = $objUserModel->getPassword();
        $arr[':displayName'] = $objUserModel->getDisplayName();
        $arr[':email'] = $objUserModel->getEmail();
        $arr[':token'] = $objUserModel->getToken();
        $arr[':loginFailureCount'] = $objUserModel->getLoginFailureCount();
        $arr[':loginFailureDatetime'] = $objUserModel->getLoginFailureDatetime();
        $arr[':deleteFlag'] = $objUserModel->getDeleteFlag();

        return Db::update($sql, $arr);
    }

    /**
     * 新規作成する
     * @return int
     */
    public static function insert(UserModel $objUserModel){
        $sql = "INSERT INTO ";
        $sql .= "`tbl_users` ";
        $sql .= "(";
        $sql .= "`userId`";
        $sql .= ", `password`";
        $sql .= ", `displayName`";
        $sql .= ", `email`";
        $sql .= ", `token`";
        $sql .= ", `loginFailureCount`";
        $sql .= ", `loginFailureDatetime`";
        $sql .= ", `deleteFlag`";
        $sql .= ") VALUES (";
        $sql .= "NULL ";
        $sql .= ", :password ";
        $sql .= ", :displayName ";
        $sql .= ", :email ";
        $sql .= ", :token ";
        $sql .= ", :loginFailureCount" ;
        $sql .= ", :loginFailureDatetime ";
        $sql .= ", :deleteFlag ";
        $sql .= ")";

        $arr = array();
        $arr[':password'] = $objUserModel->getPassword();
        $arr[':displayName'] = $objUserModel->getDisplayName();
        $arr[':email'] = $objUserModel->getEmail();
        $arr[':token'] = $objUserModel->getToken();
        $arr[':loginFailureCount'] = $objUserModel->getLoginFailureCount();
        $arr[':loginFailureDatetime'] = $objUserModel->getLoginFailureCount();
        $arr[':deleteFlag'] = $objUserModel->getDeleteFlag();

        return Db::insert($sql, $arr);
    }
}