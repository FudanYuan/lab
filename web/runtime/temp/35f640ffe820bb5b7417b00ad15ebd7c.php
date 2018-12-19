<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:71:"/Applications/XAMPP/xamppfiles/htdocs/lab/web/app/view/Index/index.html";i:1515685606;s:70:"/Applications/XAMPP/xamppfiles/htdocs/lab/web/app/view/Common/top.html";i:1515684782;s:71:"/Applications/XAMPP/xamppfiles/htdocs/lab/web/app/view/Common/main.html";i:1509723955;s:73:"/Applications/XAMPP/xamppfiles/htdocs/lab/web/app/view/Common/bottom.html";i:1536026236;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Transportation Data Analysis And Application</title>
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

<link href="__PUBLIC__/css/slider.css" rel="stylesheet"/>
<script src="__PUBLIC__/js/slider.js"></script>
<link href="__PUBLIC__/css/index.css" rel="stylesheet"/>
<!-- Bootstrap core CSS -->
<link rel="stylesheet" type="text/css" href="__PUBLIC__/js/bootstrap/css/bootstrap.min.css">
<script>
    $('#nav .main a').eq(0).addClass('cur');
</script>

<style>
    #nav .main {
        width: 1100px;
        height: 50px;
        margin: 0 auto;
        background: #fffaf2;
        padding-left: 100px;
        /*padding-left: 199px;*/
    }

    #nav .main a{
        width: 112px;
    }

    #container{
        width: 1100px;
        margin: 5px auto;
        padding-bottom: 30px;
    }

    #container .main-con{
        width: 100%;
    }

    p{
        margin: 0;
    }

    .con_1{
        width:530px;
        padding-bottom: 10px;
        z-index: 10;
        line-height: 26px;
        text-align: justify;
    }
</style>

<div id="container">
    <div class="main-con clearFix">
        <div class="row">
            <!--实验室简介-->
            <div class="col-lg-6">
                <div id="introduce">
                    <div class="main">
                        <div class="title" hidden>实验室简介</div>
                        <div class="con"><?php echo $introduce['research_area']; ?></div>
                        <div class="con_1"><?php echo $introduce['digest']; ?></div>
                    </div>
                </div>
            </div>
            <link href="__PUBLIC__/css/banner.css" rel="stylesheet" />
<div class="col-lg-6">
	<div id="banner">
		<div class="main banner">
			<ul class="img">
				<?php if(is_array($banners) || $banners instanceof \think\Collection): if( count($banners)==0 ) : echo "" ;else: foreach($banners as $key=>$banner): ?>
				<li><a href="<?php echo $banner['url']; ?>?id=<?php echo $banner['conid']; ?>"><img src="<?php echo formatUrl($banner['img']); ?>" alt=""></a></li>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
			<ul class="num"></ul>
			<div class="btn btn_l"><img src="__PUBLIC__/images/arrow_l.png" alt="" /></div>
			<div class="btn btn_r"><img src="__PUBLIC__/images/arrow_r.png" alt="" /></div>
		</div>
	</div>
</div>
<br/>
<script src="__PUBLIC__/js/banner/js/gdlb.js"></script>
<script>
	imgscroll('#banner');
</script>
        </div>

        <div class="row">
            <!--研究方向-->
            <div class="col-lg-6">
                <div id="research">
                    <div class="main">
                        <div class="title"><a href="__PRO_PATH__/ResearchArea/index">研究方向</a></div>
                        <div class="descr" hidden>用敏锐的双眼洞察整个世界</div>
                        <div class="con">
                            <ul class="clearFix">
                                <?php if(is_array($researchs) || $researchs instanceof \think\Collection): if( count($researchs)==0 ) : echo "" ;else: foreach($researchs as $key=>$research): ?>
                                <li>
                                    <a href="__PRO_PATH__/ResearchArea/info?id=<?php echo $research['id']; ?>">
                                        <img class="b-img" src="<?php echo formatUrl($research['img']); ?>" alt=""/>
                                        <p><?php echo formatText($research['digest'],34); ?></p>
                                    </a>
                                </li>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!--最新动态-->
            <div class="col-lg-6">
               <div id="news">
                   <div class="main">
                       <div class="title"><a href="__PRO_PATH__/News/index">科研动态</a></div>
                       <div class="descr" hidden>实验室日常都在这</div>
                       <div class="list">
                           <ul>
                               <?php if(is_array($news) || $news instanceof \think\Collection): if( count($news)==0 ) : echo "" ;else: foreach($news as $key=>$item): ?>
                               <li>
                                   <a style="color: rgb(85,85,85);" title="<?php echo $item['digest']; ?>"
                                      href="__PRO_PATH__/News/info?id=<?php echo $item['id']; ?>">
                                       <?php echo formatText($item['title'],20); ?>
                                   </a>
                                   <?php if($item['isrecommend'] == 1): ?>
                                   <span><i style="color: red" class="fa fa-flag" aria-hidden="true"></i></span>
                                   <?php endif; ?>
                                   <span style="float: right"><?php if($item['publishtime']): ?><?php echo date("Y-m-d",$item['publishtime'] ); endif; ?></span>
                               </li>
                               <?php endforeach; endif; else: echo "" ;endif; ?>
                           </ul>
                       </div>
                   </div>
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