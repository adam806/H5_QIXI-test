<?php

require_once('./config.php');
require_once('./utils.php');
include_once 'WXJSSDK.php';

$wxsdk = new JSSDK($appId, $secret, $memcache);
$package = $wxsdk->getSignPackage();
$timestamp = $package['timestamp'];
$nonceStr = $package['nonceStr'];
$signature = $package['signature'];
$cid = isset($_REQUEST['cid'])? $_REQUEST['cid']:0;
$uid = isset($_REQUEST["uid"])? $_REQUEST["uid"] : 0;
$url = get_authorize_url($appId, $urlRoot."auth1.php?uid=".$uid."&cid=".$cid."&surveyid=2");
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
    <link href="styles/survey.css" rel="stylesheet" type="text/css">
    <link href="styles/animation.css" rel="stylesheet" type="text/css"><!--自己写的动画插件-->
    <script src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/jquery.min.js"></script>
    <script src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/jquery.mobile.min.js"></script>
    <link href="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/animate.min.css" rel="stylesheet">
    <script src="js/survey.js"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <style>
    </style>
</head>
<body>
<section class="homePage">

    <a href= "<?=$url;?>"><img class="homePage_button" id="homePage_button" src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/startBtn.png"></a>
    <a class="homePge_detail" id="homePge_detail">活动详情</a>
</section>

<section class="rewardPage">
    <img class="rewardPic1" id="rewardPic1" src="images/reward2.png">
    <a class="backToHome" id="backToHome">返回首页</a>
    <div class="rewardIntroduce"  id="rewardIntroduce">
        <p class="rewardText">纪梵希黑色压纹小羊皮唇膏，时尚高端，为你带来惊艳的唇妆，让你万众瞩目。七夕将至，带上这只唇膏，妆点朱唇，给你的男神轻轻一吻！</p>
        <p class="rewardText">是否想将这只唇膏收入囊中？参与有奖问答活动即有机会获得。</p>
        <p class="rewardText">奖品说明：10只纪梵希小羊皮唇膏和100个7元红包</p>
        <p class="rewardText">参与时间：2016年8月9日7:07:07—2016年8月11日17:17:17</p>
        <p class="rewardText">抽奖时间：2016年8月12日</p>
        <p class="rewardText">获奖名单公布时间：七夕活动结束后1-2个工作内在微信服务号公布。</p>
        <p class="rewardText">活动规则：参与有奖问答，完成测试答题并分享到朋友圈，即可参与抽奖。获奖者由系统随机抽取。</p>
    </div>
</section>
<script>
    //微信分享config
    wx.config({
        debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
        appId: 'wx1b995d5a13c1d4c4', // 必填，公众号的唯一标识
        timestamp: <?=$timestamp?>, // 必填，生成签名的时间戳
        nonceStr: '<?=$nonceStr?>', // 必填，生成签名的随机串
        signature: '<?=$signature?>',// 必填，签名，见附录1
        jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
    });

    wx.ready(function()
    {
        //微信分享给朋友
        wx.onMenuShareAppMessage({
            title: '七夕大奖免费领', // 分享标题
            desc: '趣味测试得纪梵希定制口红，微信红包送不停！', // 分享描述
            link: 'http://stage.yunyunlive.cn/survey/start1.php?uid='+ '<?=$uid?>' + '&cid=' + '<?=$cid?>' , // 分享链接
            imgUrl: 'http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/luhan.png', // 分享图标
            type: 'link', // 分享类型,music、video或link，不填默认为link
            dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
            success: function () {
                // 用户确认分享后执行的回调函数
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
            }
        });
        //微信分享到朋友圈
        wx.onMenuShareTimeline({
            title: '七夕大奖免费领!趣味测试得纪梵希定制口红，微信红包送不停！', // 分享标题
            link: 'http://stage.yunyunlive.cn/survey/start1.php?uid='+ '<?=$uid?>' +'&cid='+ '<?=$cid?>', // 分享链接
            imgUrl: 'http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/luhan.png', // 分享图标
            success: function () {
                // 用户确认分享后执行的回调函数
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
            }
        });
    });

    wx.error(function(res){
        alert(res);
    });

    $(document).ready(function(){
        $(".homePage").show();
    });

    $(".homePge_detail").bind("click",function(){
        $(".homePage").hide();
        $(".rewardPage").show();
    });
    $(".backToHome").bind("click",function(){
        $(".homePage").show();
        $(".rewardPage").hide();
    });


</script>

</body>
</html>
