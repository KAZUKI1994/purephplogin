<?php
/**
 * Created by PhpStorm.
 * User: higashiguchi0kazuki
 * Date: 8/14/17
 * Time: 21:17
 */
$res = password_hash('password', PASSWORD_DEFAULT);
var_dump("res:" . $res);
var_dump("len:" . $strlen($res));