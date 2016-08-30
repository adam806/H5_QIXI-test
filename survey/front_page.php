<?php
/**
 * Created by PhpStorm.
 * User: jiasheng
 * Date: 2016/8/4
 * Time: 21:40
 */
include_once 'sql_config.php';

$ownerId = $_REQUEST['ownerId'];

$userId = $_REQUEST['userId'];

Register($userId);

$id = CreateNewSession($userId, $ownerId);

echo $id;


function Register($userId)
{
  global $db;

    $time = time();

  $db->Replace('user', array('openid' => $userId, 'created_time' => $time), array('openid'));
}

function CreateNewSession($userId, $ownerId)
{
    global $db;

    $time = time();

    if(!$ownerId)
    {
        $ownerId = 'null';
    }

    $db->Execute("INSERT INTO session (survey_id, created_time, user_id, original_user_id) VALUES (?, ?, ? , ?)",
        array(1, $time, $userId, $ownerId));

    return $db->Insert_ID();
}