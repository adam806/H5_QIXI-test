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
    <!--<link href="styles/reset.css" rel="stylesheet">-->
    <link href="styles/EasySlide.css" rel="stylesheet">
    <script src="js/EasySlide.js"></script>
    <script src="js/loader.js"></script>
    <script src="js/effects.js"></script>
    <script src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/jquery.min.js"></script>
    <script src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/jquery.mobile.min.js"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <title>七夕-廖汉测试</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: "Helvetica", "Arial", "Microsoft YaHei", "sans-serif";
        }

        /*下方三个类用于取消因为引入jquery mobile导致的页面底部产生的loading字样*/
        .ui-loader-default {
            display: none
        }

        .ui-mobile-viewport {
            border: none;
        }

        .ui-page {
            padding: 0;
            margin: 0;
            outline: 0
        }

        #loadingWrap {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            z-index: 999;
            font-size: 14px;
            line-height: 20px;
            -webkit-transition: -webkit-transform 0.4s ease;
            background: #0dcecb;
            color: #fff
        }

        #loadingWrap .loader {
            font-size: 11px;
            margin: 5em auto;
            width: 1em;
            height: 1em;
            border-radius: 50%;
            position: relative;
            text-indent: -9999em;
            -webkit-animation: preload 1.3s infinite linear;
            animation: preload 1.3s infinite linear;
            top: 31%;
            -webkit-transform: translate3d(0, 0, 0);
            -moz-transform: translate3d(0, 0, 0);
            -ms-transform: translate3d(0, 0, 0);
            -o-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }

        #loadingWrap #loading {
            top: 50%;
            position: absolute;
            left: 42%;
            font-weight: bold;
        }

        @keyframes preload {
            0%, 100% {
                box-shadow: 0em -3em 0em 0.2em #ffffff, 2em -2em 0 0em #ffffff, 3em 0em 0 -0.5em #ffffff, 2em 2em 0 -0.5em #ffffff, 0em 3em 0 -0.5em #ffffff, -2em 2em 0 -0.5em #ffffff, -3em 0em 0 -0.5em #ffffff, -2em -2em 0 0em #ffffff;
            }
            12.5% {
                box-shadow: 0em -3em 0em 0em #ffffff, 2em -2em 0 0.2em #ffffff, 3em 0em 0 0em #ffffff, 2em 2em 0 -0.5em #ffffff, 0em 3em 0 -0.5em #ffffff, -2em 2em 0 -0.5em #ffffff, -3em 0em 0 -0.5em #ffffff, -2em -2em 0 -0.5em #ffffff;
            }
            25% {
                box-shadow: 0em -3em 0em -0.5em #ffffff, 2em -2em 0 0em #ffffff, 3em 0em 0 0.2em #ffffff, 2em 2em 0 0em #ffffff, 0em 3em 0 -0.5em #ffffff, -2em 2em 0 -0.5em #ffffff, -3em 0em 0 -0.5em #ffffff, -2em -2em 0 -0.5em #ffffff;
            }
            37.5% {
                box-shadow: 0em -3em 0em -0.5em #ffffff, 2em -2em 0 -0.5em #ffffff, 3em 0em 0 0em #ffffff, 2em 2em 0 0.2em #ffffff, 0em 3em 0 0em #ffffff, -2em 2em 0 -0.5em #ffffff, -3em 0em 0 -0.5em #ffffff, -2em -2em 0 -0.5em #ffffff;
            }
            50% {
                box-shadow: 0em -3em 0em -0.5em #ffffff, 2em -2em 0 -0.5em #ffffff, 3em 0em 0 -0.5em #ffffff, 2em 2em 0 0em #ffffff, 0em 3em 0 0.2em #ffffff, -2em 2em 0 0em #ffffff, -3em 0em 0 -0.5em #ffffff, -2em -2em 0 -0.5em #ffffff;
            }
            62.5% {
                box-shadow: 0em -3em 0em -0.5em #ffffff, 2em -2em 0 -0.5em #ffffff, 3em 0em 0 -0.5em #ffffff, 2em 2em 0 -0.5em #ffffff, 0em 3em 0 0em #ffffff, -2em 2em 0 0.2em #ffffff, -3em 0em 0 0em #ffffff, -2em -2em 0 -0.5em #ffffff;
            }
            75% {
                box-shadow: 0em -3em 0em -0.5em #ffffff, 2em -2em 0 -0.5em #ffffff, 3em 0em 0 -0.5em #ffffff, 2em 2em 0 -0.5em #ffffff, 0em 3em 0 -0.5em #ffffff, -2em 2em 0 0em #ffffff, -3em 0em 0 0.2em #ffffff, -2em -2em 0 0em #ffffff;
            }
            87.5% {
                box-shadow: 0em -3em 0em 0em #ffffff, 2em -2em 0 -0.5em #ffffff, 3em 0em 0 -0.5em #ffffff, 2em 2em 0 -0.5em #ffffff, 0em 3em 0 -0.5em #ffffff, -2em 2em 0 0em #ffffff, -3em 0em 0 0em #ffffff, -2em -2em 0 0.2em #ffffff;
            }
        }

        @-webkit-keyframes preload {
            0%, 100% {
                box-shadow: 0em -3em 0em 0.2em #ffffff, 2em -2em 0 0em #ffffff, 3em 0em 0 -0.5em #ffffff, 2em 2em 0 -0.5em #ffffff, 0em 3em 0 -0.5em #ffffff, -2em 2em 0 -0.5em #ffffff, -3em 0em 0 -0.5em #ffffff, -2em -2em 0 0em #ffffff;
            }
            12.5% {
                box-shadow: 0em -3em 0em 0em #ffffff, 2em -2em 0 0.2em #ffffff, 3em 0em 0 0em #ffffff, 2em 2em 0 -0.5em #ffffff, 0em 3em 0 -0.5em #ffffff, -2em 2em 0 -0.5em #ffffff, -3em 0em 0 -0.5em #ffffff, -2em -2em 0 -0.5em #ffffff;
            }
            25% {
                box-shadow: 0em -3em 0em -0.5em #ffffff, 2em -2em 0 0em #ffffff, 3em 0em 0 0.2em #ffffff, 2em 2em 0 0em #ffffff, 0em 3em 0 -0.5em #ffffff, -2em 2em 0 -0.5em #ffffff, -3em 0em 0 -0.5em #ffffff, -2em -2em 0 -0.5em #ffffff;
            }
            37.5% {
                box-shadow: 0em -3em 0em -0.5em #ffffff, 2em -2em 0 -0.5em #ffffff, 3em 0em 0 0em #ffffff, 2em 2em 0 0.2em #ffffff, 0em 3em 0 0em #ffffff, -2em 2em 0 -0.5em #ffffff, -3em 0em 0 -0.5em #ffffff, -2em -2em 0 -0.5em #ffffff;
            }
            50% {
                box-shadow: 0em -3em 0em -0.5em #ffffff, 2em -2em 0 -0.5em #ffffff, 3em 0em 0 -0.5em #ffffff, 2em 2em 0 0em #ffffff, 0em 3em 0 0.2em #ffffff, -2em 2em 0 0em #ffffff, -3em 0em 0 -0.5em #ffffff, -2em -2em 0 -0.5em #ffffff;
            }
            62.5% {
                box-shadow: 0em -3em 0em -0.5em #ffffff, 2em -2em 0 -0.5em #ffffff, 3em 0em 0 -0.5em #ffffff, 2em 2em 0 -0.5em #ffffff, 0em 3em 0 0em #ffffff, -2em 2em 0 0.2em #ffffff, -3em 0em 0 0em #ffffff, -2em -2em 0 -0.5em #ffffff;
            }
            75% {
                box-shadow: 0em -3em 0em -0.5em #ffffff, 2em -2em 0 -0.5em #ffffff, 3em 0em 0 -0.5em #ffffff, 2em 2em 0 -0.5em #ffffff, 0em 3em 0 -0.5em #ffffff, -2em 2em 0 0em #ffffff, -3em 0em 0 0.2em #ffffff, -2em -2em 0 0em #ffffff;
            }
            87.5% {
                box-shadow: 0em -3em 0em 0em #ffffff, 2em -2em 0 -0.5em #ffffff, 3em 0em 0 -0.5em #ffffff, 2em 2em 0 -0.5em #ffffff, 0em 3em 0 -0.5em #ffffff, -2em 2em 0 0em #ffffff, -3em 0em 0 0em #ffffff, -2em -2em 0 0.2em #ffffff;
            }
        }

        .playMusicBtn {
            position: absolute;
            z-index: 3;
            left: 86%;
            top: 3%;
            width: 10%;
        }

        .playMusicNeedle {
            position: absolute;
            z-index: 4;
            width: 2.5%;
            left: 92%;
            top: 0%;
            transform-origin: 50% 0;
        }

        .playNeedleAnimation {
            -webkit-animation: needleRotate 0.2s linear both;
            -o-animation: needleRotate 0.2s linear both;
            animation: needleRotate 0.2s linear both;
            -webkit-transform: translate3d(0, 0, 0);
            -moz-transform: translate3d(0, 0, 0);
            -ms-transform: translate3d(0, 0, 0);
            -o-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }

        .playNeeleAnimationBack {
            -webkit-animation: needleRotateBack .2s linear both;
            -o-animation: needleRotateBack .2s linear both;
            animation: needleRotateBack .2s linear both;
            -webkit-transform: translate3d(0, 0, 0);
            -moz-transform: translate3d(0, 0, 0);
            -ms-transform: translate3d(0, 0, 0);
            -o-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }

        @-webkit-keyframes needleRotateBack {
            0% {
                -webkit-transform: rotate(-18deg);
                -moz-transform: rotate(-18deg);
                -ms-transform: rotate(-18deg);
                -o-transform: rotate(-18deg);
                transform: rotate(-18deg);
            }
            100% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
        }

        @keyframes needleRotateBack {
            0% {
                -webkit-transform: rotate(-18deg);
                -moz-transform: rotate(-18deg);
                -ms-transform: rotate(-18deg);
                -o-transform: rotate(-18deg);
                transform: rotate(-18deg);
            }
            100% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
        }

        @-webkit-keyframes needleRotate {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(-18deg);
                -moz-transform: rotate(-18deg);
                -ms-transform: rotate(-18deg);
                -o-transform: rotate(-18deg);
                transform: rotate(-18deg);
            }
        }

        @keyframes needleRotate {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(-18deg);
                -moz-transform: rotate(-18deg);
                -ms-transform: rotate(-18deg);
                -o-transform: rotate(-18deg);
                transform: rotate(-18deg);
            }
        }

        .musicRotate {
            -webkit-animation: musicRotate 3s infinite linear;
            -o-animation: musicRotate 3s infinite linear;
            animation: musicRotate 3s infinite linear;
            -webkit-transform: translate3d(0, 0, 0);
            -moz-transform: translate3d(0, 0, 0);
            -ms-transform: translate3d(0, 0, 0);
            -o-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }

        @keyframes musicRotate {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        @-webkit-keyframes musicRotate {
            0% {
                -webkit-transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        .homeBg {
            width: 100%;
            height: 100%;
            position: absolute;
        }

        .homeTitle {
            width: 100%;
            /*height: 50%;*/
            position: absolute;
            top: 2%;
            left: 0%;
            right: 0%;
            z-index: 1;
        }

        .Moon {
            width: 51%;
            /*height: 29%;*/
            position: absolute;
            left: 2%;
            top: 1%;
        }

        .homeWord {
            width: 25%;
            /*height: 16%;*/
            z-index: 2;
            position: absolute;
            left: 9%;
            top: 3%;
        }

        .cloudL {
            width: 20%;
            /*height: 6%;*/
            position: absolute;
            top: 16%;
            z-index: 2;
            left: 4%;
        }

        .cloudR {
            width: 20%;
            /*height: 11%;*/
            position: absolute;
            left: 35%;
            top: 5%;
            z-index: 2;
        }

        .girl {
            width: 53%;
            /*height: 57%;*/
            position: absolute;
            right: -5%;
            bottom: -2%;
            z-index: 2;
        }

        .startBtn {
            width: 47%;
            /*height: 15%;*/
            position: absolute;
            top: 65%;
            z-index: 2;
        }

        .opacityAnimation {
            -webkit-animation: slideIn .5s 3.4s linear both, pluse 1s 3.7s infinite linear both;
            -o-animation: slideIn .5s 3.4s linear both, pluse 1s 3.7s infinite linear both;
            animation: slideIn .5s 3.4s linear both, pluse 1s 3.7s infinite linear both;
        }

        @-webkit-keyframes slideIn {
            0% {
                left: -100%;
            }
            100% {
                left: 0%;
            }

        }

        @keyframes slideIn {
            0% {
                left: -100%;
            }
            100% {
                left: 0%;
            }

        }

        @-webkit-keyframes pluse {
            0% {
                -webkit-transform: scaleX(1);
            }
            50% {
                -webkit-transform: scale3d(1.05, 1.05, 1.05);
            }
            100% {
                -webkit-transform: scaleX(1);
            }
        }

        @keyframes pluse {
            0% {
                transform: scaleX(1);
            }
            50% {
                transform: scale3d(1.05, 1.05, 1.05);
            }
            100% {
                transform: scaleX(1);
            }
        }

        .qNum {
            background: url(http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/questionNumContainer.png) no-repeat;
            position: absolute;
            background-size: 89px 104px;
            background-position: 0 -34px;
            width: 26%;
            height: 11%;
            left: 10%;
            top: 0%;
            padding-top: 9%;
            padding-left: 6%;
            font-weight: bold;
            font-size: 3.5rem;
        }

        .questionBg {
            width: 100%;
            position: absolute;
        }

        .questionBox {
            width: 80%;
            /*height: 34%;*/
            left: 9%;
            top: 20%;
            position: absolute;
            transform-origin: 50% 0;
        }

        .questionTitle {
            position: absolute;
            color: #fff;
            top: 29%;
            left: 20%;
            font-size: 2.5rem;
            width: 62%;
        }

        .questionTitleAnimation {
            -webkit-animation: questionTitleUp .5s linear both;
            animation: questionTitleUp .5s linear both;
            -webkit-transform: translate3d(0, 0, 0);
            -moz-transform: translate3d(0, 0, 0);
            -ms-transform: translate3d(0, 0, 0);
            -o-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }

        @-webkit-keyframes questionTitleUp {
            0% {
                -webkit-transform: none;
            }
            100% {
                -webkit-transform: translateY(-58%);
            }
        }

        @keyframes questionTitleUp {
            0% {
                transform: none;
            }
            100% {
                transform: translateY(-58%);
            }
        }

        .female {
            /*height: 25%;*/
            width: 66%;
            position: absolute;
            top: 54%;
            right: 3%;
        }

        .selectBottom {
            width: 100%;
            /*height: 15%;*/
            position: absolute;
            bottom: -4%;
            z-index: 2;
        }

        .selectBottom .btnYes {
            float: left;
            width: 50%;
        }

        .selectBottom .btnNo {
            float: left;
            width: 50%;
        }

        .tipBoxImg {
            position: absolute;
            width: 101%;
            height: 47%;
            left: -11%;
            bottom: 0;
        }

        .tipBox {
            position: absolute;
            color: #000;
            font-size: 2.5rem;
            top: 62%;
            left: 20%;
            width: 60%;
            font-weight: bold;
            display: none;
        }

        .tipDiv {
            position: absolute;
            width: 100%;
            height: 100%;
            bottom: -51%;
        }

        .moveUp {
            -webkit-animation: moveUpAnimation .5s linear both, femaleScale .5s linear both;
            animation: moveUpAnimation .5s linear both, femaleScale .5s linear both;
            -webkit-transform: translate3d(0, 0, 0);
            -moz-transform: translate3d(0, 0, 0);
            -ms-transform: translate3d(0, 0, 0);
            -o-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }

        .moveDown {
            -webkit-animation: moveUpAnimationaDown .5s linear both;
            animation: moveUpAnimationDown .5s linear both;
            -webkit-transform: translate3d(0, 0, 0);
            -moz-transform: translate3d(0, 0, 0);
            -ms-transform: translate3d(0, 0, 0);
            -o-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }

        @-webkit-keyframes moveUpAnimationDown {
            0% {
                -webkit-transform: translateY(-100%);
                width: 52%;
                height: 17%;
            }
            100% {
                -webkit-transform: translateY(0);
                width: 70%;
                height: 28%;
            }
        }

        @keyframes moveUpAnimationDown {
            0% {
                transform: translateY(-100%);
                width: 52%;
                height: 17%;
            }
            100% {
                transform: translateY(0);
                width: 70%;
                height: 28%;
            }
        }

        @-webkit-keyframes moveUpAnimation {
            0% {
                -webkit-transform: none;
            }
            100% {
                top: 35%;
            }
        }

        @keyframes moveUpAnimation {
            0% {
                transform: none;
            }
            100% {
                top: 35%;
            }
        }

        /*@-webkit-keyframes femaleScale {*/
        /*0%{*/
        /*-webkit-transform: scaleX(1);*/
        /*transform: scaleX(1);*/
        /*}*/
        /*100%{*/
        /*-webkit-transform: scale3d(.7, .7, .7);*/
        /*transform: scale3d(.7, .7, .7);*/
        /*}*/
        /*}*/
        /*@keyframes femaleScale {*/
        /*0%{*/
        /*-webkit-transform: scaleX(1);*/
        /*transform: scaleX(1);*/
        /*}*/
        /*100%{*/
        /*-webkit-transform: scale3d(.7, .7, .7);*/
        /*transform: scale3d(.7, .7, .7);*/
        /*}*/
        /*}*/

        .questionBoxScale {
            -webkit-animation: qScale .5s linear both;
            animation: qScale .5s linear both;
            -webkit-transform: translate3d(0, 0, 0);
            -moz-transform: translate3d(0, 0, 0);
            -ms-transform: translate3d(0, 0, 0);
            -o-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }

        .questionBoxScaleDown {
            -webkit-animation: qScaleDown .5s linear both;
            animation: qScaleDown .5s linear both;
            -webkit-transform: translate3d(0, 0, 0);
            -moz-transform: translate3d(0, 0, 0);
            -ms-transform: translate3d(0, 0, 0);
            -o-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }

        @-webkit-keyframes qScale {
            0% {
                -webkit-transform: none;
                transform: none;
            }
            100% {
                -webkit-transform: scale(1, .6);
                transform: scale(1, .6);
            }
        }

        @keyframes qScaleDown {
            0% {
                transform: scale(1, .6);
            }
            100% {
                transform: scale(1, 1);
            }
        }

        @-webkit-keyframes qScaleDown {
            0% {
                -webkit-transform: scale(1, .6);
            }
            100% {
                -webkit-transform: scale(1, 1);
            }
        }

        .tipBoxAnimationDown {
            -webkit-animation: tipBoxAnimationDown .5s linear both;
            animation: tipBoxAnimationDown .5s linear both;
            -webkit-transform: translate3d(0, 0, 0);
            -moz-transform: translate3d(0, 0, 0);
            -ms-transform: translate3d(0, 0, 0);
            -o-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }

        @keyframes tipBoxAnimationDown {
            0% {
                transform: translateY(-48%);
            }
            100% {
                transform: translateY(100%);
            }
        }

        @-webkit-keyframes tipBoxAnimationDown {
            0% {
                -webkit-transform: translateY(-48%);
            }
            100% {
                -webkit-transform: translateY(100%);;
            }
        }

        .tipBoxAnimation {
            -webkit-animation: tipBoxAnimation .5s linear both;
            animation: tipBoxAnimation .5s linear both;
            -webkit-transform: translate3d(0, 0, 0);
            -moz-transform: translate3d(0, 0, 0);
            -ms-transform: translate3d(0, 0, 0);
            -o-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }

        @keyframes tipBoxAnimation {
            0% {
                transform: translateY(100%);
            }
            100% {
                transform: translateY(-48%);
            }
        }

        @-webkit-keyframes tipBoxAnimation {
            0% {

                -webkit-transform: translateY(100%);
            }
            100% {
                -webkit-transform: translateY(-48%);
            }
        }

        .nextBtn {
            position: absolute;
            width: 30%;
            right: 5%;
            bottom: 2%;
            display: none;
            z-index: 1;
        }

        .relative {
            position: relative;
            width: 100%;
            height: 100%;
        }

        .resultBg {
            width: 100%;
            height: 100%;
            position: absolute;
        }

        .resultNameContainer {
            width: 100%;
            padding-top: 4%;
        }

        .resultNickName {
            position: relative;
            width: 50%;
            /*width:27rem;*/
            margin: 0 auto;
            display: block;
        }

        .resultTitleDiv {
            width: 100%;
            position: relative;
            margin-top: 2%;
            text-align: center;

        }

        .resultTitle {
            width: 25%;
            margin-left: -3%;
            margin-right: 3%;
        }

        .resultNumBG {
            position: absolute;
            width: 18%;
            left: 52%;
        }

        .resultNum {
            font-weight: bold;
            font-size: 5rem;
            background: url(http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/numBG.png) no-repeat;
            background-size: contain;
            background-position: 0;
            padding: 4%;

        }

        .resultDescription {
            z-index: 2;
            position: relative;
            text-align: center;
            margin-top: 2%;
            font-weight: bold;
            padding-left: 7%;
            padding-right: 7%;
            font-size: 2.5rem;
        }

        .resultDownPart {
            position: relative;
            z-index: 2;
            text-align: center;
        }

        .resultEditorImg {
            width: 50%;
            position: relative;
            display: block;
            margin: 0 auto;
        }

        .resultShareBtn {
            position: relative;
            width: 23%;
            display: block;
            margin: 0 auto;
            margin-top: -1%;
        }

        .resultAttention {
            position: relative;
            width: 80%;
            margin: 0 auto;
            font-weight: bold;
            margin-top: 3%;
            font-size: 2rem;
        }

        .checkResult {
            position: relative;
            width: 80%;
            margin: 0 auto;
            font-weight: bold;
            margin-top: 2%;
            font-size: 2rem;
        }

        .qrCode {
            position: relative;
            width: 30%;
            margin-top: 2%;
        }

        .outDiv {
            position: relative;
        }

        .memeDa {
            position: absolute;
            width: 20%;
            height: 20%;
            left: 29%;
            top: 74%;
        }

        .gunCu {
            position: absolute;
            width: 20%;
            height: 20%;
            left: 52%;
            top: 74%;
        }

        /*用于rem单位的html根元素字号大小*/
        @media only screen and (max-width: 1080px), only screen and (max-device-width: 1080px) {
            html, body {
                font-size: 16.875px;
            }
        }

        @media only screen and (max-width: 960px), only screen and (max-device-width: 960px) {
            html, body {
                font-size: 15px;
            }
        }

        @media only screen and (max-width: 800px), only screen and (max-device-width: 800px) {
            html, body {
                font-size: 12.5px;
            }
        }

        @media only screen and (max-width: 720px), only screen and (max-device-width: 720px) {
            html, body {
                font-size: 11.25px;
            }
        }

        @media only screen and (max-width: 640px), only screen and (max-device-width: 640px) {
            html, body {
                font-size: 10px;
            }
        }

        @media only screen and (max-width: 600px), only screen and (max-device-width: 600px) {
            html, body {
                font-size: 9.375px;
            }
        }

        @media only screen and (max-width: 540px), only screen and (max-device-width: 540px) {
            html, body {
                font-size: 8.4375px;
            }
        }

        @media only screen and (max-width: 480px), only screen and (max-device-width: 480px) {
            html, body {
                font-size: 7.5px;
            }
        }

        @media only screen and (max-width: 414px), only screen and (max-device-width: 414px) {
            html, body {
                font-size: 6.46875px;
            }
        }

        @media only screen and (max-width: 400px), only screen and (max-device-width: 400px) {
            html, body {
                font-size: 6.25px;
            }
        }

        @media only screen and (max-width: 375px), only screen and (max-device-width: 375px) {
            html, body {
                font-size: 5.859375px;
            }
        }

        @media only screen and (max-width: 360px), only screen and (max-device-width: 360px) {
            html, body {
                font-size: 5.625px;
            }
        }

        @media only screen and (max-width: 320px), only screen and (max-device-width: 320px) {
            html, body {
                font-size: 5px;
            }
        }

        @media only screen and (max-width: 240px), only screen and (max-device-width: 240px) {
            html, body {
                font-size: 3.75px;
            }
        }

        .share {
            position: absolute;
            width: 100%;
            height: 100%;
            background: #000;
            opacity: 0.8;
            top: 0;
            left: 0;
            z-index: 99999;
            display: none;
        }

        .shareArrow {
            position: absolute;
            width: 51%;
            left: 30%;
            top: 15%;
        }

        /*----------------------------------*/
        #testResult_getDailPopup_wrapper a, #testResult_getDailPopup_wrapper img {
            user-select: none;
            -webkit-user-select: none;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        }

        #testResult_getDailPopup_wrapper {
            position: fixed;
            z-index: 99;
            left: 0px;
            top: 0px;
            right: 0px;
            bottom: 0px;
            background-color: rgba(0, 0, 0, .20);
            visibility: hidden;
            opacity: 0;
            transition: all 0.6s 0s;
            -webkit-transition: all 0.6s 0s;
        }

        #testResult_getDailPopup_wrapper.show {
            visibility: visible;
            opacity: 1;
        }

        #testResult_getDailPopup {
            position: absolute;
            top: 50%;
            width: 100%;
            opacity: 0;
            transform: translateY(-40%) scale(0.9);
            -webkit-transform: translateY(-40%) scale(0.9);
            transition: all 0.3s ease-out;
            -webkit-transition: all 0.3s ease-out;
        }

        #testResult_getDailPopup_wrapper.show #testResult_getDailPopup {
            position: absolute;
            top: 50%;
            width: 100%;
            opacity: 1;
            transform: translateY(-50%) scale(1);
            -webkit-transform: translateY(-50%) scale(1);
            transition: all 0.4s ease-out;
            -webkit-transition: all 0.4s ease-out;
        }

        #testResult_getDailPopup_bg {
            position: relative;
            display: block;
            width: 100%;
        }

        #testResult_getDailPopup_text1, #testResult_getDailPopup_text2 {
            position: absolute;
            display: none;
            top: 0px;
            width: 100%;
        }

        #testResult_getDailPopup_wrapper.t1 #testResult_getDailPopup_text1, #testResult_getDailPopup_wrapper.t2 #testResult_getDailPopup_text2 {
            display: block;
        }

        #testResult_getDailPopup_input {
            position: absolute;
            left: 14%;
            width: 72%;
            top: 61%;
            height: 9%;
            font-size: 20px;
            font-family: geogia;
            text-align: center;
            border: 0px none;
            padding: 8px;
            box-sizing: border-box;
            outline: none;
            font-weight: bold;
            background-color: rgba(0, 0, 0, 0);
        }

        #testResult_content_all_popupSubmit {
            position: absolute;
            width: 56%;
            height: 18%;
            top: 78%;
            left: 22%;
        }

        #testResult_content_all_popupClose {
            position: absolute;
            width: 11%;
            height: 10%;
            top: 1%;
            right: 1%;
        }
    </style>
</head>
<body>
<audio class="playMusic" id="playMusic" loop="loop" autoplay="autoplay"
       src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/bgm.mp3"></audio>
<img class="playMusicBtn musicRotate" id="playMusicBtn" src="images/playMusic.png">
<img class="playMusicNeedle" src="images/needle.png">
<div class="EasySlide-warp" id="wrapAll">
    <div id="frame0" index="0" class="EasySlide-slides"><!--第一页-->
        <div gindex="0" class="EasySlide-groups" allowswipe="no"><!--每个页面中都要放一个gindex-->
            <img class="homeBg" src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/homeBG.png">
            <img class="homeTitle" src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/homeTitle.png">
            <img class="Moon EasySlide-animate" in="zoomIn" delay=".5s" duration="1s"
                 src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/Moon.png">
            <!--有动画效果的地方一定能要有delay和duration-->
            <img class="homeWord EasySlide-animate" in="bounceInDown" delay="1.4s" duration="0.5s"
                 src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/homeWord.png">
            <img class="cloudL EasySlide-animate" in="bounceInLeft" delay="1.9s" duration="0.5s"
                 src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/cloudL.png">
            <img class="cloudR EasySlide-animate" in="bounceInRight" delay="2.4s" duration="0.5s"
                 src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/cloudR.png">
            <img class="girl EasySlide-animate" in="bounceInRight" delay="2.9s" duration="0.5s"
                 src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/girl.png">
            <!--<img class="startBtn EasySlide-animate opacityAnimation" goto="1" in="pulse" delay="3.4s" duration="1s" iteration="infinite"-->
            <!--src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/startBtn.png">-->
            <img class="startBtn opacityAnimation" goto="1"
                 src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/startBtn.png">
        </div>
    </div>
    <div id="frame1" index="1" class="EasySlide-slides"><!--第二页-->
        <div gindex="0" class="EasySlide-groups relative" allowswipe="no">
            <!--<span style="position: absolute;z-index:2;left: 40%;top: 5%;font-size: 3.5rem;" goto="2">查看结果页</span>-->
            <img class="questionBg" src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/questionBgy.png">
            <div class="qNum">No.1</div>
            <img class="questionBox" src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/message-window.png">
            <span class="questionTitle" id="questionTitle">...</span>
            <img class="female" src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/female.png">
            <img class="nextBtn" src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/next.png">
            <div class="tipDiv">
                <img class="tipBoxImg" src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/Box.png">
                <span class="tipBox" id="tipBox">...</span>
            </div>
            <div class="selectBottom">
                <img class="btnYes" src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/BtnYes.png">
                <img class="btnNo" src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/BtnNo.png">
            </div>


            </img>
        </div>
    </div>
    <div id="frame2" index="2" class="EasySlide-slides"><!--结尾页-->
        <div gindex="0" class="EasySlide-groups relative" allowswipe="no">
            <img class="resultBg" src="images/resultBG.jpg">
            <div class="resultNameContainer">
                <img class="resultNickName"
                     src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/resultNickName.png">
            </div>
            <div class="resultTitleDiv">
                <img class="resultTitle" src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/resultTitle.png">
                <!--<img class="resultNumBG" src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/numBG.png">-->
                <span class="resultNum">00</span>
            </div>
            <div class="resultDescription">这是一段根据得分取得的描述</div>
            <div class="resultDownPart">
                <div class="outDiv">
                    <img class="resultEditorImg"
                         src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/testResult_contentAndButton.png">
                    <a class="memeDa" onclick="showPopup_getDial(1)"></a>
                    <a class="gunCu" onclick="showPopup_getDial(2)"></a>
                </div>
                <img class="resultShareBtn" src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/shareBtn.png">
                <p class="resultAttention">长按二维码关注<span class="ziZai">"自在"公众号</span></p>
                <p class="checkResult">查看抽奖结果</p>
                <img class="qrCode" src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/recognize.jpg">
            </div>

        </div>
    </div>
    <div class="share">
        <img class="shareArrow" src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/guideArrow.png">
    </div>
    <div id="popupDiag"></div>
    <div id="loadingWrap">
        <div class="loader"></div>
        <div id="loading">0%</div>
    </div>
</div>


<script>

    //EasySlide插件的初始化
    var Slide = new EasySlide({
        replay: true,
        wrapAll: "wrapAll",
        swipeDirection: "y",
        backgroungMusic: "http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/bgm.mp3",
        animateEffect: "card",
    });

    var utils = EasySlide.utils;


    window.onload = function () {
        //音乐播放控制,要放在window.onload中，否则可能在进入页面时不会自动播放
        Slide.setBgMusic();
        var musicBtn = EasySlide.utils.$('playMusicBtn');
        Slide.bgMusicSwitch();//音乐播放切换开关
        EasySlide.utils.bind(musicBtn, 'click', function () {
            Slide.bgMusicSwitch();
        });

    }


    Slide.on("progress", function (percent) {
        console.log(percent);
        utils.$('loading').innerHTML = percent + '%';
    });
    Slide.on("loaded", function () {
        utils.hide(utils.$('loadingWrap'));
        //load资源结束，隐藏loading层，展示slide
    });
    Slide.loader(["http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/homeBG.png", "http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/homeTitle.png", "http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/Moon.png", "http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/homeWord.png", "http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/cloudL.png",
        "http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/cloudR.png", "http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/girl.png", "http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/startBtn.png", "http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/questionBgy.png", "http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/message-window.png",
        "http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/female.png", "http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/BtnYes.png", "http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/BtnNo.png", "http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/Box.png", "images/resultBG.jpg", "images/resultBG.jpg",
        "images/resultBG.jpg", "http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/resultNickName.png", "http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/resultTitle.png", "http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/numBG.png", "http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/testResult_contentAndButton.png",
        "http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/shareBtn.png", "http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/recognize.jpg", "images/playMusic.png", "images/needle.png"]);


    $(".btnYes").bind('touchstart', function () {
        $(".selectBottom").hide();
        $(".female").removeClass("moveDown");
        $(".questionBox").removeClass("questionBoxScaleDown");
        $(".tipDiv").removeClass("tipBoxAnimationDown");
        selectedAnswer = "y";
        if (isQuestionValid(curQuestion)) {
            showTip(curQuestion.answers.y.pop);
            $(".questionTitle").addClass("questionTitleAnimation");
            $(".female").addClass("moveUp");
            $(".questionBox").addClass("questionBoxScale");
            $(".tipDiv").addClass("tipBoxAnimation");
            $(".tipBox").show(1);
            $(".nextBtn").delay(500).show(1);
        }


    });
    $(".btnNo").bind('touchstart', function () {
        $(".selectBottom").hide();
        $(".female").removeClass("moveDown");
        $(".questionBox").removeClass("questionBoxScaleDown");
        $(".tipDiv").removeClass("tipBoxAnimationDown");
        selectedAnswer = "n";
        if (isQuestionValid(curQuestion)) {
            showTip(curQuestion.answers.n.pop);
            $(".questionTitle").addClass("questionTitleAnimation");

            $(".female").addClass("moveUp");
            $(".questionBox").addClass("questionBoxScale");
            $(".tipDiv").addClass("tipBoxAnimation");
            $(".tipBox").show(1);
            $(".nextBtn").delay(500).show(1);
        }


    });
    $(".nextBtn").bind('touchstart', function () {
        if (curQid == null) {
        }
        else if (!isNaN(nextQid)) {
            $(".selectBottom").show();
            $(".questionTitle ").removeClass("questionTitleAnimation");
            $(".female").removeClass("moveUp");
            $(".questionBox").removeClass("questionBoxScale");
            $(".tipDiv").removeClass("tipBoxAnimation");
            getQuestion(curQid);
        }
    });

    //点击分享
    $(".resultShareBtn").click(function () {
        $(".share").show();
    });
    $(".share").click(function () {
        $(".share").hide();
    });

    //音乐按钮点击时切换按钮旋转
    $(".playMusicBtn").bind('touchstart', function () {
        var toggleRotate = $(".playMusicBtn");
        var toggleNeedle = $(".playMusicNeedle");
        if (toggleRotate.hasClass("musicRotate") || (toggleNeedle.hasClass("playNeedleAnimation") == false)) { //jquery下查找是否有某个class用hasClass，js下用indexOf
            toggleRotate.removeClass("musicRotate");
            toggleNeedle.addClass("playNeedleAnimation");
            toggleNeedle.removeClass("playNeeleAnimationBack");
        } else {
            toggleNeedle.addClass("playNeeleAnimationBack");
            toggleNeedle.removeClass("playNeedleAnimation");
            toggleRotate.addClass("musicRotate");
        }
    });


    //    下方开始绑定数据
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


    function isValid(o) {
        return (o != null && o != undefined);
    }
    ;
    function isLastQuestion(question) {
        if (!isValid(question)) {
            return false;
        }
        return (question.id === -1 && isNotEmpty(question.type) && !isNaN(question.point));
    }
    ;

    function isQuestionValid(question) {
        console.log(question);
        if (isLastQuestion(question) || (isValid(question) && isValid(question.answers) && isValid(question.id) && isNotEmpty(question.text) && isValid(question.answers.y) && isValid(question.answers.n))) {
            return true;
        }
        onErr("question is invalid");
        return false;
    }
    ;

    function showQuestion() {
        if (!isNaN(curQuestion.id)) {
            $(".qNum").text("NO." + qIndex);
            qIndex++;
        }
        $("#questionTitle").text(curQuestion.text);
    }
    ;

    function getQuery(name) {
        url = window.location.href;
        name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    }
    ;

    function getQuestion(id) {
        var sid = getQuery("sid");
        $.post("answer.php?sid=" + sid + "&qid=" + id + "&a=" + selectedAnswer, function (question) {
            if (isQuestionValid(question)) {
                if (isLastQuestion(question)) {
                    showResult(question);
                    return null;
                }
                curQid = question.id;
                console.log(curQid);
                curQuestion = question;
                showQuestion();
                return question;
            }
        }, 'json');
    }
    ;


    //微信分享config
    wx.config({
        debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
        appId: 'wx1b995d5a13c1d4c4', // 必填，公众号的唯一标识
        timestamp: <?=$timestamp?>, // 必填，生成签名的时间戳
        nonceStr: '<?=$nonceStr?>', // 必填，生成签名的随机串
        signature: '<?=$signature?>',// 必填，签名，见附录1
        jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
    });

    function showResult(result) {
//        alert("最后一道题，点击查看");
//        $(".selectBottom").hide();
        $(".nextBtn").attr("goto", "2");
        $(".resultNum").text(result.point);
        $(".resultDescription").text(result.detail);
        var imgName = result.type;
        var typeName = result.name;
        wx.ready(function () {
            //微信分享给朋友
            wx.onMenuShareAppMessage({
                title: '七夕到了，想撩汉的你真的足够骚吗？', // 分享标题
                desc: '原来我是【' + typeName + '】，撩汉指数' + result.point + '，快来试试你有多Sao吧！', // 分享描述
                link: 'http://stage.yunyunlive.cn/survey/start.php?uid=' + uid + '&cid=' + cid, // 分享链接
                imgUrl: 'http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/title.jpg', // 分享图标
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
                title: '七夕有奖测试！我是【' + typeName + '】，撩汉指数' + result.point + '，你呢？', // 分享标题
                link: 'http://stage.yunyunlive.cn/survey/start.php?uid=' + uid + '&cid=' + cid, // 分享链接
                imgUrl: 'http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/title.jpg', // 分享图标
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
        $(".resultNickName").attr('src', "http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/resn" + imgName + ".png");
    }
    ;


    wx.ready(function () {
        //微信分享给朋友
        wx.onMenuShareAppMessage({
            title: '七夕有奖趣味测试', // 分享标题
            desc: '测测你的撩汗指数，让你七夕不孤单！', // 分享描述
            link: 'http://stage.yunyunlive.cn/survey/start.php?uid=' + uid + '&cid=' + cid, // 分享链接
            imgUrl: 'http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/title.jpg', // 分享图标
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
            title: '七夕有奖趣味测试：测测你的撩汗指数，让你七夕不孤单！', // 分享标题
            link: 'http://stage.yunyunlive.cn/survey/start.php?uid=' + uid + '&cid=' + cid, // 分享链接
            imgUrl: 'http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/title.jpg', // 分享图标
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


    function isNotEmpty(str) {
        return (str != null && str != "" && str != undefined);
    }

    function showTip(tip) {
        $("#tipBox").text(tip);
    }
    ;

    function showPopup_getDial(idx) {
        var htmlString = '<div id="testResult_getDailPopup_wrapper" ' + 'class="show t' + idx + '"' + '>' +
            '<div id="testResult_getDailPopup">' +
            '<img id="testResult_getDailPopup_bg" src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/testResult_getDial_bg.png">' +
            '<img id="testResult_getDailPopup_text1" src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/testResult_getDial_text1.png">' +
            '<img id="testResult_getDailPopup_text2" src="http://yunyunlive.oss-cn-beijing.aliyuncs.com/survey/testResult_getDial_text2.png">' +
            '<input type="text" id="testResult_getDailPopup_input">' +
            '<a id="testResult_content_all_popupSubmit" ></a>' +
            '<a id="testResult_content_all_popupClose" ></a>' +
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
    function closePopup_getDial() {
        document.getElementById("popupDiag").innerHTML = '';
    }
    function submitMobileNo() {
        var mobileNo = document.getElementById("testResult_getDailPopup_input").value;
        var pattern = /(^(([0\+]\d{2,3}-)?(0\d{2,3})-)(\d{7,8})(-(\d{3,}))?$)|(^0{0,1}1[3|4|5|6|7|8|9][0-9]{9}$)/;
        if (pattern.test(mobileNo)) {
            var sid = getQuery("sid");
            $.get("mobile.php?sid=" + sid + "&mobile=" + mobileNo);
            closePopup_getDial();
        } else {
            alert("这是电话号码吗？不要骗我！");
        }
    }


    $(document).ready(function () {
        getQuestion(0);
    })

</script>
</body>
</html>