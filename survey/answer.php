<?php
/**
 * Created by PhpStorm.
 * User: jiasheng
 * Date: 2016/8/4
 * Time: 22:11
 */

include 'sql_config.php';


$questionId = $_REQUEST['qid'];
$sessionId = $_REQUEST['sid'];
$answer = $_REQUEST['a'];


if($questionId == 0)
{
    $question = GetQuestions()[1];
    echo json_encode(array('id' => 1, 'text' =>$question['text'], 'answers' => $question['answer']));
    include 'footer.php';
    exit;
}

$result = Answer($sessionId, $questionId, $answer);

if(!$result)
{
    header('HTTP/1.1 500 Internal Server Error');
    header("status: 500 Internal Server Error");
    include 'footer.php';
    exit;
}

echo json_encode(GetNextQuestion($questionId, $answer, $sessionId));

include 'footer.php';

function GetQuestions()
{
    global $memcache;
    global $db;

    $key = "survey:1:questions";

    if(useMemCache)
    {
        $questions = $memcache->get($key);

        if(is_array($questions) && !empty($questions))
            return $questions;
    }

    $questions = $db->CacheGetArray(600, "SELECT * FROM question WHERE survey_id = 1");

    $result = array();

    foreach($questions as $q)
    {
        $result[$q['index']] = array("text" => $q['text'], "answer" => json_decode($q['content'], true));
    }

    if(useMemCache)
    {
        $memcache->set($key, $result);
    }

    return $result;
}


function GetNextQuestion($questionId, $answer, $sessionId)
{
    $questions = GetQuestions();

    $currentQuestion = $questions[$questionId];

    if(!$currentQuestion)
        return null;

    $answer = $currentQuestion['answer'][$answer];

    if(!$answer)
        return null;

    $nextId = $answer['next'];

    if($nextId == null)
    {
        list($originalPoint, $point) = GetPoint($sessionId, $questions);

        UpdatePoint($sessionId, $originalPoint, $point);

        return array_merge(array('id' => -1, 'point' => $point), GetPointType($point));
    }
    else
    {
        $nextQuestion = $questions[$nextId];
        return array('id' => $nextId, 'text' =>$nextQuestion['text'], 'answers' => $nextQuestion['answer']);
    }
}

function UpdatePoint($sessionId, $originalPoint, $point)
{
    global $db;
    $db->Execute("UPDATE session SET point = ?, original_point = ?, finished_time = ? WHERE id = ? AND finished_time is null", array($point, $originalPoint, time(), $sessionId));
}

function GetPoint($sessionId, $questions)
{
    global $db;

    $answers = $db->CacheGetArray("SELECT question_id, answer FROM user_answer WHERE session_id = ?", array($sessionId));

    $point = 0;

    foreach($answers as $answer)
    {
        $answerNumber = $answer['answer'] == 0 ? 'n' : 'y';
        $p = $questions[$answer['question_id']]['answer'][$answerNumber]['point'];
        $point += $p;
    }

    $originalPoint = $point;
    $ran = rand(90, 110);
    $point = intval($point * $ran / 100);

    if($point > 100 )
        $point = 100;

    return array($originalPoint, $point);
}

function GetPointType($point)
{
    if($point == 100)
    {
        $rate = rand(95, 100);
        return array('type' => '7', 'name' => 'Sao神', 'detail' =>'Sao神在此，还不快来膜拜！哼', 'rate' =>$rate);
    }
    else if($point >= 90)
    {
        $rate = rand(85, 95);
        return array('type'=> '6', 'name' => '大Sao货', 'detail' =>'我就是有十八般武艺的大Sao货，你行么你', 'rate' =>$rate);
    }
    else if($point >= 80)
    {
        $rate = rand(75, 85);
        return array('type'=> '5', 'name' => '小表砸', 'detail' =>'哼，我就是那人见人像，花见花开的小表砸！来呀，打我呀', 'rate' =>$rate);
    }
    else if($point >= 65)
    {
        $rate = rand(55, 75);
        return array('type'=> '4', 'name' => '狐狸精', 'detail' =>'我就是那修行千年专吸男人血的胡丽精！来，让我吸口血', 'rate' =>$rate);
    }
    else if($point >= 50)
    {
        $rate = rand(35, 55);
        return array('type'=> '3', 'name' => '小溅人', 'detail' =>'我是一个小溅人，咿呀咿呀哟，嘿！', 'rate' =>$rate);
    }
    else if($point >= 1)
    {
        $rate = rand(1, 35);
        return array('type'=> '2', 'name' => '闷Sao', 'detail' =>'我好闷，好闷闷闷闷，闷Sao就是我。伙计，你闷吗', 'rate' =>$rate);
    }
    else
    {
        $rate = 0;
        return array('type'=> '1', 'name' => '离骚', 'detail' =>'我就是那断绝三世情缘无半点骚气之离骚，你离了么？', 'rate' =>$rate);
    }
}


function Answer($sessionId, $questionId, $answer)
{
    global $db;
    $time = time();

    $answerNumber = $answer == 'n' ? 0 : 1;

    $result = $db->Execute("INSERT INTO user_answer (session_id, question_id, answer, created_time) SELECT ?, ?, ?, ? FROM dual
                  WHERE NOT exists(SELECT * FROM user_answer WHERE session_id = ? AND question_id = ?)", array($sessionId, $questionId, $answerNumber, $time, $sessionId, $questionId));

    return $result;
}

