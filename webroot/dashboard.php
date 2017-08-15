<?php
/**
 * Created by PhpStorm.
 * User: higashiguchi0kazuki
 * Date: 8/15/17
 * Time: 06:30
 */

namespace PureLogin;

use PureLogin\common\Template;
use PureLogin\controller\LoginController;

define("LAYOUT", "main");

try{
    require_once "../common.php";
    LoginController::checkLogin();
}catch(\Exception $e) {
    Template::exception($e);
}finally{
    Template::display();
}
