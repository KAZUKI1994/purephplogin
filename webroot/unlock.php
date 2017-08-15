<?php
/**
 * Created by PhpStorm.
 * User: higashiguchi0kazuki
 * Date: 8/15/17
 * Time: 11:03
 */

namespace PureLogin;

use PureLogin\controller\LoginController;
use PureLogin\common\Template;

define('LAYOUT', 'index');

try{
    require_once '../common.php';
    Template::assign('is_lock', LoginController::isAccountLock());
    Template::assign('success', LoginController::unlock());
}catch(\Exception $e){
    Template::assign($e);
}finally{
    Template::display();
}