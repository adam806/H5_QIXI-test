<?php

include_once "./config.php";

function get_authorize_url($app_id, $redirect_uri)
{
	global $debugMode;

    $redirect_uri = urlencode($redirect_uri);
    $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$app_id}&redirect_uri={$redirect_uri}&response_type=code&scope=snsapi_base&state=base#wechat_redirect";

	if ($debugMode) {
		error_log("get_authorize_url:re:".$redirect_uri);
		error_log("get_authorize_url:url:".$url);
	}
    return $url;
}

function get_openid($app_id, $secret, $code) 
{
	global $debugMode;

	$token_api = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$app_id}&secret={$secret}&code={$code}&grant_type=authorization_code";
	$response = file_get_contents($token_api);
	$msg = json_decode($response);

	if ($debugMode) {
		error_log("get_openid:token:".$token_api);
		ob_start();
		var_dump($msg);
		error_log("get_openid:msg:".ob_get_clean());
	}
	
	if(isset($msg->errcode))
	{
		error_log("get_openid:errcode:".$msg->errcode);
		return "err";
	}

	$openid = $msg ->openid;
	return $openid;
}
?>