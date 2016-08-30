var winWidth;
var winHeight;
//获取相关设备尺寸
function getWindowSize() {
    //获取窗口宽度，下方用于兼容浏览器
    if (window.innerWidth) {
        winWidth = window.innerWidth;
    } else if ((document.body) && (document.body.clientWidth)) {
        winWidth = document.body.clientWidth;
    }
    //获取窗口高度，下方用于兼容浏览器
    if (window.innerHeight) {
        winHeight = window.innerHeight;
    } else if ((document.body) && (document.body.clientHeight)) {
        winHeight = document.body.clientHeight;
    }
    var page1 = document.getElementsByTagName("section");
    for (var i = 0; i < page1.length; i++) {
        page1[i].style.height = winHeight + "px";
    }
    document.getElementById("homePage_button").style.width = winWidth * 0.704 + "px";
    document.getElementById("homePage_button").style.height = winHeight * 0.212 + "px";
    //获取窗口尺寸，来设置"开始按钮"位置
    document.getElementById("homePage_button").style.left = winWidth * (-0.0492) + "px";
    document.getElementById("homePage_button").style.top = winHeight * 0.6091 + "px";
    //获取窗口尺寸，来设置"活动详情"尺寸
    document.getElementById("homePge_detail").style.width = winWidth * 0.2 + "px";
    document.getElementById("homePge_detail").style.height = winHeight * 0.02 + "px";
    //获取窗口尺寸，来设置"活动详情"位置
    document.getElementById("homePge_detail").style.left = winWidth * 0.23 + "px";
    document.getElementById("homePge_detail").style.top = winHeight * 0.88 + "px";
    //奖品页返回按钮
    var backTohome=document.getElementById("backToHome");
    backTohome.style.left=winWidth*0.81+"px";
    backTohome.style.top=winHeight*0.048+"px";



    //奖品页图片位置尺寸；
    var rewardPic1=document.getElementById("rewardPic1");
    rewardPic1.style.width=winWidth+"px";
    rewardPic1.style.height=winHeight*0.429+"px";
    rewardPic1.style.top=0+"px";
    //奖品页文字部分宽度
    var rewardIntroduce=document.getElementById("rewardIntroduce");
    rewardIntroduce.style.height=winHeight*0.6+"px";
    rewardIntroduce.style.top=winHeight*0.43+"px";

    if(winWidth>winHeight){
        $(".shuPing").show();
        $(".homePage").hide();
    }else{
        $(".shuPing").hide();
        $(".homePage").show();
    }


}

window.onload = function () {
    getWindowSize()
};

