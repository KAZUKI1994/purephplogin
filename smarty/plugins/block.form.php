<?php
/**
 * Created by PhpStorm.
 * User: higashiguchi0kazuki
 * Date: 8/15/17
 * Time: 11:28
 */
function smarty_block_form($params, $content){
    if(!$contents){
        return;
    }

    $attr = [];
    foreach($params as $key => $val){
        $attr[] = sprintf('%s="%s"', $key, $val);
    }
    $attribute = (count($attr) > 0) ? ' ' . implode(' ', $attr) : '';

    $html = sprintf('<form%s>', $attribute);
    $html .= $contents;

    $html .= sprintf('<input type="hidden" name="csrf_token" value="%s")'
        , PureLogin\common\Csrf::get());
    $html .= '</form>';

    return $html;
}