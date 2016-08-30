<?php

include_once "./config.php";
include_once "./utils.php";
include_once './sql_config.php';

const SurveyUserKey = 'survey:user:';
$openid = get_openid($appId, $secret, $_REQUEST["code"]);
if($openid === "err")
{
	$home = $urlRoot."start.php";
	Header("Location: $home");
    exit;
}

$ownerId = $_REQUEST["uid"];
$channelId = isset($_REQUEST['cid'])?$_REQUEST['cid'] : 0 ;

$userId = Register($openid);

//pass sessionId to the start page.
$sessionId = CreateNewSession($userId, $ownerId, $channelId);

function Register($openid)
{
	global $db;
    global $memcache;
    if(useMemCache)
    {
        $userId = $memcache->get(SurveyUserKey.$openid);  
        if($userId)
        {
            return $userId;   
        }

    }
    $userId = $db->GetOne("SELECT id FROM user WHERE openid = ?", $openid);

	if(!$userId)
	{
		$time = time();
		$db->Execute("INSERT INTO user SET openid = ?, created_time = ? ", array($openid, $time));
		$userId = $db->Insert_ID();
	}
    if(useMemCache && $userId)
    {
        $memcache->set(SurveyUserKey.$openid, $userId); 
	}

	return $userId;
}

function CreateNewSession($userId, $ownerId, $channelId)
{
	global $db;

	$time = time();

	if(!$ownerId)
	{
		$ownerId = 'null';
	}

	$db->Execute("INSERT INTO session (survey_id, created_time, user_id, original_user_id, channel_id) VALUES (?, ?, ? , ?, ?)",
	array(1, $time, $userId, $ownerId, $channelId));

	return $db->Insert_ID();
}

$redir = $urlRoot."survey_question.php?sid=".$sessionId."&uid=".$openid."&cid=".$channelId;
Header("Location: $redir");
?>
