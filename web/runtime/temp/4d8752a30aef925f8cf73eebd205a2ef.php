<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:70:"/Applications/XAMPP/xamppfiles/htdocs/lab/web/app/view/News/index.html";i:1515679524;s:70:"/Applications/XAMPP/xamppfiles/htdocs/lab/web/app/view/Common/top.html";i:1515684782;s:73:"/Applications/XAMPP/xamppfiles/htdocs/lab/web/app/view/Common/bottom.html";i:1514088785;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>最新动态</title>
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
	$('#nav .main a').eq(4).addClass('cur');
</script>
<link href="__PUBLIC__/css/common-index.css" rel="stylesheet" />
<div id="news-con">
	<div class="main">
		<div class="con">
			<div class="c-top">
				<?php $curTagid = input('get.tagid'); ?>
				<a href="?" class="<?php if(empty($curTagid) || ($curTagid instanceof \think\Collection && $curTagid->isEmpty())): ?>cur<?php endif; ?>">全部</a>
				<?php if(is_array($tags) || $tags instanceof \think\Collection): if( count($tags)==0 ) : echo "" ;else: foreach($tags as $key=>$tag): ?>
				<a href="?tagid=<?php echo $tag['id']; ?>" class="<?php if($curTagid==$tag['id']): ?>cur<?php endif; ?>"><?php echo $tag['title']; ?></a>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
			<h2>最新动态</h2>
			<div class="c-descr clearFix" hidden>
				<i class="fl"></i>
				<p class="fl">快来看看实验室的日常～</p>
				<i class="fl"></i>
			</div>
			<ul class="list clearFix">
				<?php if(is_array($list) || $list instanceof \think\Collection): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$model): ?>
				<li>
					<a href="<?php if(empty($model['href']) || ($model['href'] instanceof \think\Collection && $model['href']->isEmpty())): ?>__PRO_PATH__/News/info?id=<?php echo $model['id']; else: ?><?php echo $model['href']; endif; ?>">
					<img src="<?php echo formatUrl($model['img']); ?>" alt="">
					<div class="info">
						<div class="i-title">
							<div class="mask"></div>
							<p><?php echo formatText($model['title'],16); ?></p>
						</div>
						<div class="i-descr">
							<div class="mask"></div>
							<p><?php echo formatText($model['digest'],38); ?></p>
						</div>
					</div>
					<div class="img-title"><?php echo $model['tagname']; ?></div>
					<div class="t-frame">
						<i class="f-line fl"></i>
						<i class="f-box fl"></i>
						<i class="f-line fl"></i>
					</div>
					</a>
				</li>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
			<?php echo $list->render(); ?>
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