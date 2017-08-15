<?php
/**
 * Created by PhpStorm.
 * User: higashiguchi0kazuki
 * Date: 8/14/17
 * Time: 21:48
 */

namespace PureLogin;

use PureLogin\controller\LoginController;
use PureLogin\common\Template;

define("LAYOUT", "index");

try{
    require_once '../common.php';
    LoginController::login();
}catch(\Exception $e){
    Template::exception($e);
}finally{
    Template::display();
}