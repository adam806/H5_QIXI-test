<?php
/**
 * Created by PhpStorm.
 * User: jiasheng
 * Date: 2016/8/8
 * Time: 10:15
 */

include 'sql_config.php';

$sessionId = $_REQUEST['sid'];
$mobile = $_REQUEST['mobile'];


if($sessionId && $mobile)
{
   $db->Execute("Update session set mobile = ? WHERE id =?", array($mobile, $sessionId));
}

