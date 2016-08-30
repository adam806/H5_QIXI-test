<?php

include_once 'config.php';
include_once 'WXJSSDK.php';
include_once 'sql_config.php';

$wxsdk = new JSSDK($appId, $secret, $memcache);
$package = $wxsdk->getSignPackage();
$timestamp = $package['timestamp'];
$nonceStr = $package['nonceStr'];
$signature = $package['signature'];
$time = time();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="format-detection" content="telephone=no"/><!--手机号码不被显示为拨号号码-->
    <meta name="format-detection" content="email=no"/><!--email不会被显示为email链接-->
    <meta name="apple-mobile-web-app-capable" content="yes"/><!--开启网站对web app程序的支持-->
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/><!--在web app应用下顶部状态条的颜色-->
    <meta http-equiv="pragma" content="no-cache"><!--清浏览器的缓存-->
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <title>七夕撩汉测试</title>
    <link href="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/animate.min.css" rel="stylesheet">
    <script src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/jquery.min.js"></script>
    <script src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/jquery.mobile.min.js"></script>
    <link href="styles/survey.css?t=<?=$time?>" rel="stylesheet" type="text/css">
    <link href="styles/animation.css?t=<?=$time?>" rel="stylesheet" type="text/css"><!--自己写的动画插件-->
    <script src="js/survey_question.js?t=<?=$time?>"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
</head>
<body>
<div class="main">
    <audio class="playMusic" id="playMusic" loop="loop" autoplay="autoplay" src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/bgm.mp3"></audio>
    <section class="questionPage">
        <div class="questionNumContainer">
            <span class="questionNum" id="questionNum"></span>
        </div>
        <img class="message-window" id="message-window" src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/message-window.png">
        <img class="message-window-little" id="message-window-little" src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/message-window.png">
        <img class="female" id="female" src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/female.png">
        <img class="female-little" id="female-little" src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/female.png">
        <div class="optionBtn">
            <img class="BtnYes" id="BtnYes" src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/BtnYes.png">
            <img class="BtnNo" id="BtnNo" src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/BtnNo.png">
        </div>
        <span class="questionTitle" id="questionTitle">...</span>
        <img class="QuestionBox" id="QuestionBox" src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/Box.png">
        <span class="tipBox" id="tipBox"></span>
        <img class="QuestionNext" id="QuestionNext" src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/next.png">
        <img class="playMusicBtnOn" id="playMusicBtnOn" src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/music_on.png">
        <img class="playMusicBtnOff" id="playMusicBtnOff" src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/music_off.png">
    </section>
    <section class="resultPage">
        <img class="resultTitle" id="resultTitle" src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/resultTitle.png">
        <span class="resultPoint" id="resultPoint"></span>
        <img class="numBg" id="numBg" src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/numBG.png">
        <img class="resultNickName" id="resultNickName" src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/resultNickName.png">`
        <span class="resultDescription" id="resultDescription"></span>
        <div id="testResult_content">
            <img id="testResult_content_bg" src="images/testResult_contentAndButton.png">
            <a id="testResult_content_popupButton_1" onclick="showPopup_getDial(1)"></a>
            <a id="testResult_content_popupButton_2" onclick="showPopup_getDial(2)"></a>
        </div>
        <img class="shareBtn" id="shareBtn" src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/shareBtn.png">
        <span class="recognition" id="recognition">长按二维码关注<span class="productName">"自在App"</span>公众号</span>
        <span class="prizeWord" id="prizeWord">查看抽奖结果</span>
        <img class="recognitionCode" id="recognitionCode" src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/recognize.jpg">
        <section class="shareGuide">
        <img class="shareArrow" id="shareArrow" src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/guideArrow.png">
        </section>
    </section>
</div>
<div id="popupDiag"></div>
<script>
    $(".dianwo").bind("click",function(){
        $(".QuestionBox").addClass('animated slideInUp');
    });
    var curQid = 0;
    var curQuestion;
    var nextQid = 1;
    var selectedAnswer = "y";
    var qIndex = 1;
    var uid = getQuery('uid');
	var cid = getQuery('cid');
    var timestamp = getQuery('timestamp');
    var nonceStr = getQuery('nonceStr');
    var signature = getQuery('signature');
    function onErr(err) {
        location.reload();
    };
    function isValid(o) {
        return (o != null && o != undefined);
    };
    function isNotEmpty (str) {
        return (str != null && str != "" && str != undefined);
    };
    function isAnswerValid(answer) {
        if (isValid(answer.next) && (!isNaN(answer.next) || answer.next == null) && isNotEmpty(answer.pop)) {
            return true;
        }
        onErr("answer is invalid.");
        return false;
    };
    function isQuestionValid(question) {
        if (isLastQuestion(question) || (isValid(question) && isValid(question.answers) && isValid(question.id) && isNotEmpty(question.text) && isValid(question.answers.y) && isValid(question.answers.n))) {
            return true;
        }
        onErr("question is invalid");
        return false;
    };
    function getQuery(name) {
        url = window.location.href;
        name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    };
    function getQuestion(id) {
        var sid = getQuery("sid");
        $.post("answer.php?sid=" + sid + "&qid=" + id + "&a=" + selectedAnswer, function(question){
            if (isQuestionValid(question)) {
                if (isLastQuestion(question)) {
                    showResult(question);
                    return null;
                }
                curQid = question.id;
                curQuestion = question;
                showQuestion();
                return question;
            }
        }, 'json');
    };
    function showQuestion() {
        if (!isNaN(curQuestion.id)) {
            $("#questionNum").text("NO." + qIndex);
            qIndex++;
        }
        $("#questionTitle").text(curQuestion.text);
    };
    function showTip(tip) {
        $("#tipBox").text(tip);
    };
    function isLastQuestion (question) {
        if (!isValid(question)) {
            return false;
        }
        return (question.id === -1 && isNotEmpty(question.type) && !isNaN(question.point));
    };
    function showResult (result) {
        $(".questionPage").hide();
        $(".resultPage").show();
        $(".resultPoint").text(result.point);
        if(String.valueOf(result.point).length==1)
        {
            resultPoint.style.left = winWidth*0.54+15+"px";
        }
        else if(String.valueOf(result.point).length==2)
        {
            resultPoint.style.left = winWidth*0.54+7+"px";
        }
        $(".resultDescription").text(result.detail);
        var imgName=result.type;
        var typeName = result.name;
        wx.ready(function()
        {
            //微信分享给朋友
            wx.onMenuShareAppMessage({
                title: '七夕免费送撩汉神器纪梵希口红', // 分享标题
                desc: '我的撩汉指数击败了全国' + result.rate + '%的人，纪梵希口红快到碗里来！你也试试！', // 分享描述
                link: 'http://stage.yunyunlive.cn/survey/start1.php?uid='+uid + '&cid=' + cid , // 分享链接
                imgUrl: 'http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/luhan.png', // 分享图标
                type: 'link', // 分享类型,music、video或link，不填默认为link
                dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
                success: function () {
                    // 用户确认分享后执行的回调函数
                    var sid = getQuery("sid");
                    $.get("shared.php?sid=" + sid + "&type=1");
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                }
            });
            //微信分享到朋友圈
            wx.onMenuShareTimeline({
                title: '我的撩汉指数击败了全国' + result.rate + '%的人，纪梵希口红快到碗里来！你也试试！', // 分享标题
                link: 'http://stage.yunyunlive.cn/survey/start1.php?uid='+uid+'&cid='+ cid, // 分享链接
                imgUrl: 'http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/luhan.png', // 分享图标
                success: function () {
                    // 用户确认分享后执行的回调函数
                    var sid = getQuery("sid");
                    $.get("shared.php?sid=" + sid + "&type=2");
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                }
            });
        });
        $(".resultNickName").attr('src',"http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/resn" + imgName + ".png");
        $(".resultHead").attr('src',"http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/resh" + imgName + ".png");
    };
    function toggleAudioPlayback () {
        var media = document.getElementById("playMusic");
        if(!media.src)
            return;
        if(media.paused)
        {
            media.play();
        }
        else {
            media.pause();
        }
    }
    function showPopup_getDial(idx){
   var htmlString = '<div id="testResult_getDailPopup_wrapper" '+'class="show t'+idx+'"'+'>'+
    '<div id="testResult_getDailPopup">'+
        '<img id="testResult_getDailPopup_bg" src="images/testResult_getDial_bg.png">'+
        '<img id="testResult_getDailPopup_text1" src="images/testResult_getDial_text1.png">'+
        '<img id="testResult_getDailPopup_text2" src="images/testResult_getDial_text2.png">'+
        '<input type="text" id="testResult_getDailPopup_input">'+
        '<a id="testResult_content_all_popupSubmit" ></a>'+
        '<a id="testResult_content_all_popupClose" ></a>'+
    '</div></div>';
document.getElementById("popupDiag").innerHTML = htmlString;
$('#testResult_content_all_popupSubmit').click(function () {
            submitMobileNo();
            return false;
        });
        $('#testResult_content_all_popupClose').click(function () {
            closePopup_getDial();
            return false;
        });
    }
    function closePopup_getDial(){
	    document.getElementById("popupDiag").innerHTML = '';
    }
    function submitMobileNo() {
        var mobileNo = document.getElementById("testResult_getDailPopup_input").value;
        var pattern=/(^(([0\+]\d{2,3}-)?(0\d{2,3})-)(\d{7,8})(-(\d{3,}))?$)|(^0{0,1}1[3|4|5|6|7|8|9][0-9]{9}$)/;
        if(pattern.test(mobileNo)) {      
            var sid = getQuery("sid");
            $.get("mobile.php?sid=" + sid + "&mobile=" + mobileNo);
            closePopup_getDial();
        }else{ 
            alert("这是电话号码吗？不要骗我！");
        }
    }
    //    首页跳转
    $(".homePage_button").bind("click", function () {
        $(".questionPage").show();
        $(".homePage").hide();
    });
    //问题页答题动画
    $(".BtnYes").bind("click", function () {
        $(".message-window").hide();
        $(".questionTitle").hide();
        $(".female").hide();
        selectedAnswer = "y";
        if (isQuestionValid(curQuestion)) {
            showTip(curQuestion.answers.y.pop);
            $(".QuestionBox").delay(100).show(1);
            $(".tipBox").delay(100).show(1);
            $(".QuestionNext").delay(200).show(1);
            $(".optionBtn").hide();
        }
    });
    $(".BtnNo").bind("click", function () {
        $(".message-window").hide();
        $(".questionTitle").hide();
        $(".female").hide();
        selectedAnswer = "n";
        if (isQuestionValid(curQuestion)) {
            showTip(curQuestion.answers.n.pop);
            $(".QuestionBox").delay(100).show(1);
            $(".tipBox").delay(100).show(1);
            $(".QuestionNext").delay(200).show(1);
            $(".optionBtn").hide();
        }
    });
    //下一题按钮
    $(".QuestionNext").bind("click", function () {
        if (curQid == null) {
        } else if (!isNaN(nextQid)) {
            $(".questionTitle").show();
            $(".message-window-little").hide();
            $(".message-window").show();
            $(".female-little").hide();
            $(".female").show();
            $(".QuestionBox").hide();
            $(".tipBox").hide();
            $(".QuestionNext").hide();
            $(".optionBtn").show();
            getQuestion(curQid);
        }
    });
    //点击分享按钮
    $(".shareBtn").bind("click",function(){
        $(".shareGuide").show();
    });
    $(".shareGuide").bind("click",function(){
        $(".shareGuide").hide();
    });
    $(document).ready(function(){
        getQuestion(0);
    });
    //微信分享config
    wx.config({
        debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
        appId: 'wx1b995d5a13c1d4c4', // 必填，公众号的唯一标识
        timestamp: <?=$timestamp?>, // 必填，生成签名的时间戳
        nonceStr: '<?=$nonceStr?>', // 必填，生成签名的随机串
        signature: '<?=$signature?>',// 必填，签名，见附录1
        jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
    });
    wx.ready(function () {
        var media = document.getElementById("playMusic");
        if(!media.src)
            media.src = "http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/bgm.mp3";
        media.play();
    });
    wx.ready(function()
    {
        //微信分享给朋友
        wx.onMenuShareAppMessage({
            title: '七夕大奖免费领', // 分享标题
            desc: '趣味测试得纪梵希定制口红，微信红包送不停！', // 分享描述
            link: 'http://stage.yunyunlive.cn/survey/start1.php?uid='+uid + '&cid=' + cid , // 分享链接
            imgUrl: 'http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/luhan.png', // 分享图标
            type: 'link', // 分享类型,music、video或link，不填默认为link
            dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
            success: function () {
                // 用户确认分享后执行的回调函数
                var sid = getQuery("sid");
                $.get("shared.php?sid=" + sid + "&type=1");
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
            }
        });
        //微信分享到朋友圈
        wx.onMenuShareTimeline({
            title: '七夕大奖免费领！趣味测试得纪梵希定制口红，微信红包送不停！', // 分享标题
            link: 'http://stage.yunyunlive.cn/survey/start1.php?uid='+uid+'&cid='+ cid, // 分享链接
            imgUrl: 'http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/luhan.png', // 分享图标
            success: function () {
                // 用户确认分享后执行的回调函数
                var sid = getQuery("sid");
                $.get("shared.php?sid=" + sid + "&type=2");
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
            }
        });
    });
    $(".playMusicBtnOn").bind("click",function(){
        $(".playMusicBtnOff").show();
        $(".playMusicBtnOn").hide();
        toggleAudioPlayback();
    });
    $(".playMusicBtnOff").bind("click",function(){
        $(".playMusicBtnOn").show();
        $(".playMusicBtnOff").hide();
        toggleAudioPlayback();
    });
</script>
</body>
</html>
