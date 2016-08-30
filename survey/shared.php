<?php
/**
 * Created by PhpStorm.
 * User: jiasheng
 * Date: 2016/8/7
 * Time: 21:45
 */

include 'sql_config.php';

$sessionId = $_REQUEST['sid'];
$type = $_REQUEST['type'];


if($sessionId)
{
    if($type == 1)
    {
        $field = 'share_message';
    }
    else if($type == 2)
    {
        $field = 'share_timeline';
    }
    else
    {
        include 'footer.php';
        exit;
    }

  $db->Execute("Update session SET {$field} = 1 WHERE id = ? AND {$field} = 0", $sessionId);
}


include 'footer.php';
