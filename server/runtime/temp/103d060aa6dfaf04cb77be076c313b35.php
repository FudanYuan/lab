<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:74:"/Applications/XAMPP/xamppfiles/htdocs/lab/server/app/view/Index/index.html";i:1502883879;s:73:"/Applications/XAMPP/xamppfiles/htdocs/lab/server/app/view/Common/top.html";i:1503214051;s:80:"/Applications/XAMPP/xamppfiles/htdocs/lab/server/app/view/Common/popup_warn.html";i:1503219129;s:76:"/Applications/XAMPP/xamppfiles/htdocs/lab/server/app/view/Common/bottom.html";i:1502885165;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>实验室管理平台</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="yzs">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="http://cdn.bootcss.com/font-awesome/4.6.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/lab.css">

    <!-- ionicons -->
    <link rel="shortcut icon" href="__PUBLIC__/images/logo.ico" />
    <link rel="bookmark" href="__PUBLIC__/images/logo.ico" />

    <!-- Simplify -->
    <link href="__PUBLIC__/css/simplify.min.css" rel="stylesheet">

    <!-- Jquery -->
    <script src="__PUBLIC__/js/jquery-1.11.1.min.js"></script>

    <!-- Bootstrap -->
    <script src="__PUBLIC__/js/bootstrap.min.js"></script>
</head>
<body class="overflow-hidden">
<div class="wrapper preload">
    <header class="top-nav">
        <div class="top-nav-inner">
            <div class="nav-header">
                <a href="__PRO_PATH__/" class="brand">
                    <i class="fa fa-database"></i>
                    <span class="brand-name">实验室管理平台</span>
                </a>
            </div>

            <div class="nav-container">
                <button type="button" class="navbar-toggle pull-left sidebar-toggle" id="sidebarToggleLG">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="javascript:;" class="btn pull-right" id="clearCache" style="margin:10px 20px 0 0;">清空缓存</a>
                <a href="javascript:;" class="btn pull-right" id="logout" style="margin:10px 20px 0 0;">注销</a>
                <div class="custom-popup" id="warn-popup" style="width:200px;display:none;">
	<div class="popup-body text-center">
		<h5></h5>
		<div class="text-center m-top-lg">
			<a class="btn btn-success m-center-sm warn-do">返回</a>
		</div>
	</div>
</div>
<script>
function popWarn(con){
	$('#warn-popup h5').html(con);
	$('#warn-popup').popup('show');
}
$('.warn-do').on('click', function(){
	$('#warn-popup').popup('hide');
});
$(function(){
	//Delete Widget Confirmation
	$('#confirm-popup').popup({
		vertical: 'top',
		transition: 'all 0.3s'
	});
});
</script>
                <script>
                    $('#clearCache').on('click', function () {
                        $.get('__PRO_PATH__/Index/clearcache', function (res) {
                            if (res.errorcode == 0) {
                                popWarn('清空缓存成功');
                            } else {
                                popWarn('清空缓存失败');
                            }
                        });
                    });
                    $('#logout').on('click', function () {
                        $.get('__PRO_PATH__/UserAdmin/dologout', {}, function (res) {
                            if (res.errorcode == 0) {
                                window.location.href = '__PRO_PATH__/UserAdmin/login';
                            } else {
                                alert(res.msg);
                            }
                        });
                    });
                </script>
            </div>
        </div><!-- ./top-nav-inner -->
    </header>

    <aside class="sidebar-menu fixed">
        <div class="sidebar-inner scrollable-sidebar">
            <div class="main-menu">
                <ul class="accordion">
                    <li class="menu-header">
                        Main Menu
                    </li>
                    <li class="bg-palette1" id="lab-nav1">
                        <a href="__PRO_PATH__/">
									<span class="menu-content block">
										<span class="menu-icon"><i class="block fa fa-home fa-lg"></i></span>
										<span class="text m-left-sm">首页</span>
									</span>
                            <span class="menu-content-hover block">
										Home
									</span>
                        </a>
                    </li>

                    <?php if(authority('Banner')): ?>
                    <li class="bg-palette3" id="lab-nav2">
                        <a href="__PRO_PATH__/Banner/index">
                            <span class="menu-content block">
                                <span class="menu-icon"><i class="block fa fa-desktop fa-lg"></i></span>
								<span class="text m-left-sm">置顶窗口</span>
                            </span>
                            <span class="menu-content-hover block">Landing</span>
                        </a>
                    </li>
                    <?php endif; if(authority('ResearchArea')): ?>
                    <li class="bg-palette1" id="lab-nav3">
                        <a href="__PRO_PATH__/ResearchArea/index">
                            <span class="menu-content block">
                                <span class="menu-icon"><i class="block fa fa-desktop fa-lg"></i></span>
                                <span class="text m-left-sm">研究方向</span>
                            </span>
                            <span class="menu-content-hover block">Landing</span>
                        </a>
                    </li>
                    <?php endif; if(authority('Result')): ?>
                    <li class="bg-palette4" id="lab-nav7">
                        <a href="__PRO_PATH__/Result/index">
                            <span class="menu-content block">
                                <span class="menu-icon"><i class="block fa fa-desktop fa-lg"></i></span>
                                <span class="text m-left-sm">科研成果</span>
                            </span>
                            <span class="menu-content-hover block">Form</span>
                        </a>
                    </li>
                    <?php endif; if(authority('Member')): ?>
                    <li class="openable bg-palette2" id="lab-nav4">
                        <a href="#">
                            <span class="menu-content block">
                                <span class="menu-icon"><i class="block fa fa-list fa-lg"></i></span>
                                <span class="text m-left-sm">团队成员</span>
                                <span class="submenu-icon"></span>
                            </span>
                            <span class="menu-content-hover block">Form</span>
                        </a>
                        <ul class="submenu bg-palette3">
                            <?php if(authority('CurMember')): ?>
                            <li id="lab-nav4-sub1"><a href="__PRO_PATH__/Member/curmember"><span class="submenu-label">在校</span></a>
                            </li>
                            <?php endif; if(authority('ProMember')): ?>
                            <li id="lab-nav4-sub2">
                                <a href="__PRO_PATH__/Member/lastmember">
                                    <span class="submenu-label">校友</span>
                                </a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; if(authority('News')): ?>
                    <li class="bg-palette1" id="lab-nav5">
                        <a href="__PRO_PATH__/News/index">
                            <span class="menu-content block">
                                <span class="menu-icon"><i class="block fa fa-desktop fa-lg"></i></span>
                                <span class="text m-left-sm">最新动态</span>
                            </span>
                            <span class="menu-content-hover block">Landing</span>
                        </a>
                    </li>
                    <?php endif; if(authority('User')): ?>
                    <li class="openable bg-palette4" id="lab-nav6">
                        <a href="javascript:;">
                            <span class="menu-content block">
                                <span class="menu-icon"><i class="block fa fa-list fa-lg"></i></span>
								<span class="text m-left-sm">设置</span>
                                <span class="submenu-icon"></span>
                            </span>
                            <span class="menu-content-hover block">Form</span>
                        </a>
                        <ul class="submenu bg-palette4">
                            <?php if(authority('Tag')): ?>
                            <li id="lab-nav6-sub1"><a href="__PRO_PATH__/Tag/index"><span
                                    class="submenu-label">标签设置</span></a></li>
                            <?php endif; if(authority('Authority')): ?>
                            <li id="lab-nav6-sub2">
                                <a href="__PRO_PATH__/UserAdmin/index">
                                    <span class="submenu-label">权限设置</span>
                                </a>
                            </li>
                            <?php endif; if(authority('Role')): ?>
                            <li id="lab-nav6-sub3">
                                <a href="__PRO_PATH__/UserAdmin/roles">
                                    <span class="submenu-label">角色设置</span>
                                </a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div><!-- sidebar-inner -->
    </aside>
<style>
	.index-wel-wrapper{
		width:350px;
		margin:200px auto;
	}
	.index-wel{
		width:100px;
		height:100px;
		border-radius:200px;
		border:1px solid gray;
		float:left;
		font-size:60px;
		line-height:100px;
		text-align:center;
	}
	.index-wel-r{
		margin-left:150px;
	}
</style>
<div class="main-container">
	<div class="padding-md">
		<div class="index-wel-wrapper">
			<div class="index-wel index-wel-l">欢</div>
			<div class="index-wel index-wel-r">迎</div>
		</div>
	</div>
</div><!-- /main-container -->
<script>
	$('#lab-nav1').addClass('active');
</script>
<footer class="footer">
				<span class="footer-brand">
					<strong class="text-danger">实验室管理平台</strong>
				</span>
				<p class="no-margin">
					&copy; 2017 <strong>实验室管理平台</strong>. ALL Rights Reserved.
				</p>	
			</footer>
		</div><!-- /wrapper -->

		<a href="#" class="scroll-to-top hidden-print"><i class="fa fa-chevron-up fa-lg"></i></a>
		
	    <!-- Le javascript
	    ================================================== -->
	    <!-- Placed at the end of the document so the pages load faster -->

		<!-- Slimscroll -->
		<script src='__PUBLIC__/js/jquery.slimscroll.min.js'></script>
		
		<!-- Popup Overlay -->
		<script src='__PUBLIC__/js/jquery.popupoverlay.min.js'></script>

		<!-- Modernizr -->
		<script src='__PUBLIC__/js/modernizr.min.js'></script>

		<!-- Simplify -->
		<script src="__PUBLIC__/js/simplify/simplify.js"></script>
	
  	</body>
</html>
