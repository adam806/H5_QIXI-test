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
    ////获取窗口尺寸，来设置月亮尺寸
    //document.getElementById("homePage_moon").style.width=winWidth*0.5+"px";
    //document.getElementById("homePage_moon").style.height=winWidth*0.5+"px";
    ////获取窗口尺寸，来设置月亮位置
    //document.getElementById("homePage_moon").style.left=winWidth*0.04+"px";
    //document.getElementById("homePage_moon").style.top=winHeight*0.02+"px";
    ////获取窗口尺寸，来设置title尺寸
    //document.getElementById("homeTitle").style.width=winWidth+"px";
    //document.getElementById("homeTitle").style.height=winHeight*0.55+"px";
    ////获取窗口尺寸，来设置title位置
    //document.getElementById("homeTitle").style.left="0px";
    //document.getElementById("homeTitle").style.top=winHeight*0.02+"px";
    ////获取窗口尺寸，来设置"七夕"尺寸
    //document.getElementById("homePage_qixi").style.width=winWidth*0.3+"px";
    //document.getElementById("homePage_qixi").style.height=winHeight*0.17+"px";
    ////获取窗口尺寸，来设置"七夕"位置
    //document.getElementById("homePage_qixi").style.left=winWidth*0.1+"px";
    //document.getElementById("homePage_qixi").style.top=winHeight*0.02+"px";
    ////获取窗口尺寸，来设置"左云彩"尺寸
    //document.getElementById("homePage_cloudL").style.width=winWidth*0.3+"px";
    //document.getElementById("homePage_cloudL").style.height=winHeight*0.09+"px";
    ////获取窗口尺寸，来设置"左云彩"位置
    //document.getElementById("homePage_cloudL").style.left=winWidth*0.04+"px";
    //document.getElementById("homePage_cloudL").style.top=winHeight*0.15+"px";
    ////获取窗口尺寸，来设置"右云彩"尺寸
    //document.getElementById("homePage_cloudR").style.width=winWidth*0.25+"px";
    //document.getElementById("homePage_cloudR").style.height=winHeight*0.15+"px";
    ////获取窗口尺寸，来设置"右云彩"位置
    //document.getElementById("homePage_cloudR").style.left=winWidth*0.35+"px";
    //document.getElementById("homePage_cloudR").style.top=winHeight*0.01+"px";
    ////获取窗口尺寸，来设置"梦露"尺寸
    //document.getElementById("homePage_girl").style.width=winWidth*0.6+"px";
    //document.getElementById("homePage_girl").style.height=winHeight*0.65+"px";
    ////获取窗口尺寸，来设置"梦露"位置
    //document.getElementById("homePage_girl").style.left=winWidth*0.48+"px";
    //document.getElementById("homePage_girl").style.top=winHeight*0.4+"px";
    ////获取窗口尺寸，来设置"开始按钮"尺寸
    //document.getElementById("homePage_button").style.width=winWidth*0.6+"px";
    //document.getElementById("homePage_button").style.height=winHeight*0.2+"px";
    ////获取窗口尺寸，来设置"开始按钮"位置
    //document.getElementById("homePage_button").style.left=winWidth*(-0.025)+"px";
    //document.getElementById("homePage_button").style.top=winHeight*0.63+"px";
    ////获取窗口尺寸，来设置"提示"尺寸
    //document.getElementById("homePge_prompt").style.width=winWidth*0.5+"px";
    //document.getElementById("homePge_prompt").style.height=winHeight*0.04+"px";
    ////获取窗口尺寸，来设置"提示"位置
    //document.getElementById("homePge_prompt").style.left=winWidth*0.08+"px";
    //document.getElementById("homePge_prompt").style.top=winHeight*0.8+"px";
    ////获取窗口尺寸，来设置"活动详情"尺寸
    //document.getElementById("homePge_detail").style.width=winWidth*0.2+"px";
    //document.getElementById("homePge_detail").style.height=winHeight*0.02+"px";
    ////获取窗口尺寸，来设置"活动详情"位置
    //document.getElementById("homePge_detail").style.left=winWidth*0.25+"px";
    //document.getElementById("homePge_detail").style.top=winHeight*0.85+"px";


    //问题页Num尺寸
    document.getElementById("questionNum").style.width=winWidth*0.2+"px";
    document.getElementById("questionNum").style.height=winHeight*0.05+"px";
    //问题页Num位置
    document.getElementById("questionNum").style.left=winWidth*0.11+"px";
    document.getElementById("questionNum").style.top=winHeight*0.065+"px";
    //问题页"问题框"尺寸
    document.getElementById("message-window").style.width=winWidth*0.9+"px";
    document.getElementById("message-window").style.height=winHeight*0.4+"px";
    //问题页"问题框"位置
    document.getElementById("message-window").style.left=winWidth*0.05+"px";
    document.getElementById("message-window").style.top=winHeight*0.15+"px";
    //问题页小框位置以及尺寸
    var messageWindowLittle=document.getElementById("message-window-little");
    messageWindowLittle.style.width=winWidth*0.9+"px";
    messageWindowLittle.style.height=winHeight*0.25+"px";
    messageWindowLittle.style.left=winWidth*0.05+"px";
    messageWindowLittle.style.top=winHeight*0.15+"px";
    //问题页"female"尺寸
    document.getElementById("female").style.width=winWidth*0.65+"px";
    document.getElementById("female").style.height=winHeight*0.25+"px";
    //问题页"female"位置
    document.getElementById("female").style.left=winWidth*0.32+"px";
    document.getElementById("female").style.top=winHeight*0.55+"px";
    //问题页小female位置以及尺寸
    var femaleLittle=document.getElementById("female-little");
    femaleLittle.style.width=winWidth*0.38+"px";
    femaleLittle.style.height=winHeight*0.16+"px";
    femaleLittle.style.left=winWidth*0.57+"px";
    femaleLittle.style.top=winHeight*0.4+"px";

    //问题页"YesBtn尺寸
    var BtnYes=document.getElementById("BtnYes");
    BtnYes.style.width=winWidth*0.5+"px";
    BtnYes.style.height=winHeight*0.15+"px";
    //问题页"NoBtn尺寸
    var BtnNo=document.getElementById("BtnNo");
    BtnNo.style.width=winWidth*0.5+"px";
    BtnNo.style.height=winHeight*0.15+"px";
    //问题页"questionTitle"尺寸
    var QuestionTitle=document.getElementById("questionTitle");
    QuestionTitle.style.width=winWidth*0.65+"px";
    QuestionTitle.style.height=winHeight*0.25+"px";
    //问题页"questionTitle"位置
    var QuestionTitle=document.getElementById("questionTitle");
    QuestionTitle.style.left=winWidth*0.2+"px";
    QuestionTitle.style.top=winHeight*0.26+"px";
    //吐槽牌子尺寸
    var QuestionBox=document.getElementById("QuestionBox");
    QuestionBox.style.width=winWidth*1.2+"px";
    QuestionBox.style.height=winHeight*0.5+"px";
    //吐槽牌子尺寸
    QuestionBox.style.top=winHeight*0.2+"px";
    QuestionBox.style.left=winWidth*(-0.2)+"px";
    //下一题Btn
    var QuestionNext=document.getElementById("QuestionNext");
    //下一题尺寸
    QuestionNext.style.width=winWidth*0.4+"px";
    QuestionNext.style.height=winHeight*0.09+"px";
    //下一题位置
    QuestionNext.style.left=winWidth*0.58+"px";
    QuestionNext.style.top=winHeight*0.89+"px";
    //吐槽文字位置
    var tipBox=document.getElementById("tipBox");
    tipBox.style.width=winWidth*0.7+"px";
    tipBox.style.heifht=winHeight*0.3+"px";
    //吐槽文字尺寸
    tipBox.style.left=winWidth*0.17+"px";
    tipBox.style.top=winHeight*0.28+"px";
    //题号背景div尺寸
    //var questionNumContainer=document.getElementById("questionNumContainer");
    //questionNumContainer.style.width=winWidth*0.1+"px";
    //questionNumContainer.style.height=winHeight*0.1+"px";



    //得分页title尺寸
    var resultTitle=document.getElementById("resultTitle");
    resultTitle.style.width=winWidth*0.25+"px";
    resultTitle.style.height=winHeight*0.03+"px";
    //得分页title位置
    resultTitle.style.left=winWidth*0.215+"px";
    resultTitle.style.top=winHeight*0.142+"px";

    //得分页小编头像
    var testResult_content=document.getElementById("testResult_content");
    testResult_content.style.width=winWidth*0.631+"px";
    //testResult_content_bg.style.height=winHeight*0.703+"px";
    testResult_content.style.left=winWidth*0.1753+"px";
    testResult_content.style.top=winHeight*0.228+"px";
    ////得分页name尺寸
    //var resultName=document.getElementById("resultName");
    ////resultName.style.width=winWidth*0.15+"px";
    //resultName.style.width=winWidth*0.15+"px";
    //resultName.style.height=winHeight*0.025+"px";
    ////得分页name位置
    //resultName.style.left=winWidth*0.19+"px";
    //resultName.style.top=winHeight*0.235+"px";
    //得分页nickname尺寸
    var resultNickName=document.getElementById("resultNickName");
    resultNickName.style.width=winWidth*0.429+"px";
    resultNickName.style.height=winHeight*0.0499+"px";
    //得分页nickname位置
    resultNickName.style.left=winWidth*0.282+"px";
    resultNickName.style.top=winHeight*0.0479+"px";
    //用户得分位置
    var resultPoint=document.getElementById("resultPoint");
    resultPoint.style.left=winWidth*0.54+"px";
    resultPoint.style.top=winHeight*0.13+"px";
    //得分背景
    var numBg=document.getElementById("numBg");
    numBg.style.width=winWidth*0.181+"px";
    numBg.style.height=winHeight*0.089+"px";
    numBg.style.left=winWidth*0.52+"px";
    numBg.style.top=winHeight*0.114+"px";

    //得分页称号
    //var resultNickName=document.getElementById("resultNickName");
    //resultNickName.style.width=winWidth*0.519+"px";
    //resultNickName.style.height=winHeight*0.057+"px";
    //resultNickName.style.left=winWidth*0.264+"px";
    //resultNickName.style.top=winHeight*0.072+"px";


    //var resultHead=document.getElementById("resultHead");
    //resultHead.style.width=winWidth*0.27+"px";
    //resultHead.style.height=winWidth*0.27+"px";
    ////得分页头像位置
    //resultHead.style.left=winWidth*0.37+"px";
    //resultHead.style.top=winHeight*0.3+"px";
    ////得分页描述位置
    var resultDescription=document.getElementById("resultDescription");
    resultDescription.style.left=winWidth*0.15+"px";
    resultDescription.style.top=winHeight*0.203+"px";
    //得分页分享按钮尺寸
    var shareBtn=document.getElementById("shareBtn");
    shareBtn.style.width=winWidth*0.272+"px";
    shareBtn.style.height=winHeight*0.054+"px";
    //得分页分享按钮位置
    shareBtn.style.left=winWidth*0.356+"px";
    shareBtn.style.top=winHeight*0.22+"px";
    //识别二维码提示文字
    var recognition=document.getElementById("recognition");
    recognition.style.left=winWidth*0.15+"px";
    recognition.style.top=winHeight*0.78+"px";
    //查看抽奖结果文字
    var prizeWord=document.getElementById("prizeWord");
    prizeWord.style.left=winWidth*0.16+"px";
    prizeWord.style.top=winHeight*0.81+"px";
    //引导分享图片尺寸
    var guideArrow=document.getElementById("shareArrow");
    guideArrow.style.width=winWidth*0.5+"px";
    guideArrow.style.right=winWidth*0.2+"px";
    //引导分享图片位置
    guideArrow.style.top=winWidth*0.05+"px";
    //二维码尺寸
    var recognizeCode=document.getElementById("recognitionCode");
    recognizeCode.style.width=winWidth*0.24+"px";
    //recognizeCode.style.heigh=winWidth*0.4+"px";
    //二维码位置
    recognizeCode.style.left=winWidth*0.382+"px";
    recognizeCode.style.top=winHeight*0.85+"px";

    //音乐播放按钮
    var playMusicBtnOn=document.getElementById("playMusicBtnOn");
    playMusicBtnOn.style.width=winWidth*0.114+"px";
    playMusicBtnOn.style.height=winHeight*0.065+"px";
    playMusicBtnOn.style.left=winWidth*0.835+"px";
    playMusicBtnOn.style.top=winHeight*0.016+"px";
    var playMusicBtnOff=document.getElementById("playMusicBtnOff");
    playMusicBtnOff.style.width=winWidth*0.114+"px";
    playMusicBtnOff.style.height=winHeight*0.065+"px";
    playMusicBtnOff.style.left=winWidth*0.835+"px";
    playMusicBtnOff.style.top=winHeight*0.016+"px";
}


window.onload = function () {
    getWindowSize()
};