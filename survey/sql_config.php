<?php
/**
 * Created by PhpStorm.
 * User: jiasheng
 * Date: 2016/8/4
 * Time: 21:42
 */

include_once $_SERVER['DOCUMENT_ROOT'].'/include/adodb-5.20.4/adodb.inc.php';

define('_MYSQL_HOST_', 'stage.yunyunlive.cn');//数据库地址
define('_MYSQL_DB_', 'zizai_survey');//数据库名
define('_MYSQL_USER_', 'root');//数据库用户名
define('_MYSQL_PWD_', '43r2g43grh');//数据库密码

const useMemCache = true;

//连接数据库
$db = ADONewConnection('mysqli');
$db->Connect(_MYSQL_HOST_, _MYSQL_USER_, _MYSQL_PWD_, _MYSQL_DB_);
$db->SetFetchMode(ADODB_FETCH_ASSOC);
//$ADODB_CACHE_DIR = $app_path."/cache";
//设置缓存为memcache
$db->cacheSecs = 3600*24*365;
$db->memCache=true;
$db->memCacheHost = array("127.0.0.1");
$db->memCachePort = 11211; /// this is default memCache port
$db->memCacheCompress = false;
//$db->debug=true;
$db->Execute("set names utf8");

if(useMemCache) {
    $memcache = new Memcache();
    $memcache->addServer('127.0.0.1', 11211);
}