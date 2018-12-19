<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:74:"/Applications/XAMPP/xamppfiles/htdocs/lab/web/app/view/Member/contact.html";i:1515685122;s:70:"/Applications/XAMPP/xamppfiles/htdocs/lab/web/app/view/Common/top.html";i:1515684782;s:73:"/Applications/XAMPP/xamppfiles/htdocs/lab/web/app/view/Common/bottom.html";i:1514088785;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>联系我们</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
    
    <script src="__PUBLIC__/js/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="__PUBLIC__/js/pdfobject/pdfobject.js"></script>
    <!--<link rel="shortcut icon" href="__PUBLIC__/images/logo.ico" />-->
    <!--<link rel="bookmark" href="__PUBLIC__/images/logo.ico" />-->
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="http://cdn.bootcss.com/font-awesome/4.6.0/css/font-awesome.min.css">
    <link href="__PUBLIC__/css/main.css" rel="stylesheet"/>
    <style>
        html, body{
            font-family: "Microsoft YaHei, Geogia, Times New Roman, Times, serif";
        }
        #sec-info .main .con .arti .share {
            display: none;
        }
    </style>
</head>
<body>
<div id="top">
    <div class="main clearFix">
        <a href="__PRO_PATH__/">
            <div class="logo">
                <!--交通运输大数据分析与应用课题组-->
                <span style="font-family: 'Istok Web'; font-size: xx-large">Transportation Data Analysis And Application Research Group</span>
                <!--<img src="__PUBLIC__/images/logo1.jpg" alt=""/>-->
            </div>
        </a>
    </div>
</div>
<div id="nav">
    <div class="main" id="nav_main">
        <a href="__PRO_PATH__/Index/index">首&nbsp;&nbsp;&nbsp;&nbsp;页</a>
        <!--<a href="__PRO_PATH__/ResearchArea/index">研究方向</a>-->
        <a href="__PRO_PATH__/Result/index">科研成果</a>
        <!--<a href="__PRO_PATH__/Member/index">团队成员</a>-->
        <a href="__PRO_PATH__/Member/tutor">教师信息</a>
        <a href="__PRO_PATH__/Member/student">学生信息</a>
        <a href="__PRO_PATH__/News/index">科研动态</a>
        <a href="__PRO_PATH__/Member/contact">联系我们</a>
    </div>
</div>
<script>
    $('#nav .main a').eq(5).addClass('cur');
</script>
<link href="__PUBLIC__/css/member-info.css" rel="stylesheet" />
<div id="sec-info">
    <div class="main">
        <div class="con">
            <ul class="share" style="display: none">
                <li><img src="__PUBLIC__/images/wechat.png" alt="" /></li>
                <li><img src="__PUBLIC__/images/qq.png" alt="" /></li>
                <li><img src="__PUBLIC__/images/weibo.png" alt="" /></li>
                <li><img src="__PUBLIC__/images/friends.png" alt="" /></li>
            </ul>
            <div class="main-img-div">
                <img src="<?php echo formatUrl($info['img']); ?>" alt="" />
                <div class="mask"></div>
                <h2><?php echo $info['name']; ?></h2>
            </div>
            <div class="info clearFix">
                <div class="i-l fl">
                    <div class="i-l-t">
                        <?php echo $info['research_area']; ?>
                    </div>
                </div>
                <div class="i-r fl">
                    <?php echo $info['descr']; ?>
                    <h3>联系方式：<?php echo $info['phone']; ?></h3>
                    <h3>常用邮箱：<?php echo $info['email']; ?></h3>
                    <h3>联系地址：<?php echo $info['address']; ?></h3>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="bottom">
    <div class="main clearFix">
        <p style="width:100%; text-align: center; background: #1b1b1b;">
            联系地址：湖南省长沙市天心区中南大学铁道校区交通楼
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a style="color: white" href="http://www.miitbeian.gov.cn/">
                湘ICP备24320459540号
            </a>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;常用邮箱：transdatalab@163.com
        </p>
    </div>

</div>
</body>
</html>