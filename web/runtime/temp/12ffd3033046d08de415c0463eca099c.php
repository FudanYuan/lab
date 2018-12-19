<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:77:"/Applications/XAMPP/xamppfiles/htdocs/lab/web/app/view/ResearchArea/info.html";i:1503128342;s:70:"/Applications/XAMPP/xamppfiles/htdocs/lab/web/app/view/Common/top.html";i:1515684782;s:73:"/Applications/XAMPP/xamppfiles/htdocs/lab/web/app/view/Common/bottom.html";i:1514088785;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>研究方向</title>
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
    $('#nav .main a').eq(1).addClass('cur');
</script>
<link href="__PUBLIC__/css/research-info.css" rel="stylesheet"/>
<div id="sec-info">
    <div class="main clearFix">
        <div class="con fl">
            <div class="arti">
                <ul class="share">
                    <li><img src="__PUBLIC__/images/wechat.png" alt=""/></li>
                    <li><img src="__PUBLIC__/images/qq.png" alt=""/></li>
                    <li><img src="__PUBLIC__/images/weibo.png" alt=""/></li>
                    <li><img src="__PUBLIC__/images/friends.png" alt=""/></li>
                </ul>
                <h2><?php echo $info['title']; ?></h2>
                <div class="info clearFix">
                    <i style="margin-left: 30px;" class="tag">标签：<?php echo $info['tagname']; ?></i>
                    <img style="margin-left: 10px;" src="__PUBLIC__/images/clock.png" alt=""/>
                    <i style="width:75px; margin-right: 30px;" class="clock"><?php echo date('Y-m-d', $info['publishtime']); ?></i>
                    <img style="margin-left: 10px;" src="__PUBLIC__/images/eye.png" alt=""/>
                    <i style="width:30px;" class="num"><?php echo $info['count_view']; ?></i>
                </div>
                <div class="line"></div>
                <div class="text">
                    <?php echo $info['content']; ?>
                </div>
            </div>
            <?php $section = 1; ?>
        </div>
        <div class="relative fl">
            <div class="top">其他方向</div>
            <ul>
                <?php if(is_array($recomms) || $recomms instanceof \think\Collection): if( count($recomms)==0 ) : echo "" ;else: foreach($recomms as $key=>$model): ?>
                <li>
                    <a href="__PRO_PATH__/ResearchArea/info?id=<?php echo $model['id']; ?>">
                        <img src="<?php echo formatUrl($model['img']); ?>" alt=""/>
                        <div class="info">
                            <h4><?php echo $model['title']; ?></h4>
                            <p><?php echo $model['digest']; ?></p>
                            <div class="statistic clearFix">
                                <img src="__PUBLIC__/images/clock.png" alt=""/>
                                <i class="clock"><?php echo date('Y-m-d', $model['publishtime']); ?></i>
                                <img src="__PUBLIC__/images/eye.png" alt=""/>
                                <i class="num"><?php echo $model['count_view']; ?></i>
                            </div>
                        </div>
                    </a>
                </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
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