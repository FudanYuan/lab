<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:78:"/Applications/XAMPP/xamppfiles/htdocs/lab/server/app/view/UserAdmin/index.html";i:1503048215;s:73:"/Applications/XAMPP/xamppfiles/htdocs/lab/server/app/view/Common/top.html";i:1503214051;s:80:"/Applications/XAMPP/xamppfiles/htdocs/lab/server/app/view/Common/popup_warn.html";i:1503219129;s:80:"/Applications/XAMPP/xamppfiles/htdocs/lab/server/app/view/Common/popup_list.html";i:1502953890;s:76:"/Applications/XAMPP/xamppfiles/htdocs/lab/server/app/view/Common/bottom.html";i:1502885165;}*/ ?>
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
<div class="main-container">
	<div class="padding-md">
		<ul class="breadcrumb">
			<li><span class="primary-font"><i class="icon-home"></i></span><a href="__PRO_PATH__/"> 首页</a></li>
			<li>权限设置</li>	 	 
		</ul>
		<div class="list-search">
			<form action="" class="form-inline" method="get" >
			  <div class="form-group">
			    <label for="select-pos">使用状态：</label>
			    <select name="status" class="form-control" style="width:100px" id="select-status">
				  <option value="">全部</option>
				  <option value="1">使用中</option>
				  <option value="3">已禁用</option>
				</select>
			  </div>
			  <div class="form-group">
				<input name="username" class="form-control" style="width:200px" value="<?php echo isset($cond['username']) ? $cond['username'] :  ''; ?>" placeholder="账号" />
			  </div>
			  <button type="submit" class="btn btn-default">查询</button>
			  <script>
			  	$('#select-status').val('<?php echo isset($cond['status']) ? $cond['status'] :  ""; ?>');
			  </script>
			</form>
		</div>
		<div class="list-btns">
			<?php if(authority('Authority_add')): ?>
			<button type="button" class="btn btn-success" id="addItem">新建</button>
			<?php endif; if(authority('Authority_del')): ?>
			<button type="button" class="btn btn-default" id="removeItem">删除</button>
			<?php endif; ?>
		</div>
		<table class="table table-hover" style="background:#fff;">
		  <thead>
		  	<tr>
		  		<th><input type="checkbox" id="checkbox-all"/></th>
		  		<th>序号</th>
		  		<th>账号名称</th>
		  		<th>使用状态</th>
		  		<th>创建时间</th>
		  		<th>最后登录时间</th>
		  		<th>备注</th>
		  		<th>操作</th>
		  	</tr>
		  </thead>
		  <tbody>
			<?php if(is_array($list) || $list instanceof \think\Collection): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$model): ?>
				<tr>
					<td><input type="checkbox" name="select" value="<?php echo $model['id']; ?>" /></td>
					<td><?php echo $model['id']; ?></td>
					<td><?php echo $model['username']; ?></td>
					<td><?php echo !empty($model['status']) && $model['status']==1?'使用中' : '禁用'; ?></td>
					<td><?php if($model['createtime']): ?><?php echo date('Y-m-d H:i:s', $model['createtime']); endif; ?></td>
					<td><?php if($model['logintime']): ?><?php echo date('Y-m-d H:i:s', $model['logintime']); endif; ?></td>
					<td><?php echo $model['remark']; ?></td>
					<td>
						<?php if(authority('Authority_edit')): ?>
						<a href="__PRO_PATH__/UserAdmin/edit?id=<?php echo $model['id']; ?>">编辑</a>
						<?php endif; ?>
					</td>
				</tr>
			<?php endforeach; endif; else: echo "" ;endif; ?>
		  </tbody>
		</table>
	</div>
</div><!-- /main-container -->
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
<!-- 必须包含
	Common/popup_warn
	
	调用：popupList(配置);
 -->
<div class="custom-popup" id="confirm-popup" style="width:200px;">
    <div class="popup-body text-center">
        <h5>您确定要删除吗？</h5>
        <div class="text-center m-top-lg">
            <a class="btn btn-success m-right-sm confirm-do">删除</a>
            <a class="btn btn-default confirm-cancel">取消</a>
        </div>
    </div>
</div>
<script>
    function popupList(config) {
        $('#addItem').on('click', function () {
            console.log('add');
            window.location.href = config.create;
        });
        $('#removeItem').on('click', function () {
            console.log('test');
            $('#confirm-popup').popup('show');
        });
        $('.confirm-do').on('click', function () {
            $('#confirm-popup').popup('hide');
            var ids = [];
            $("input[name='select']:checked").each(function () {
                ids.push(this.value);
            });
            if (ids.length <= 0) {
                $('#warn-popup h5').html('请选择至少一条');
                $('#warn-popup').popup('show');
                return;
            }
            $.get(config.remove, {ids: ids.join(',')}, function (res) {
                if (res['code'] == 1) {
                    window.location.reload();
                } else {
                    popWarn('删除失败');
                }
            });
        });
    }
    $('.confirm-cancel').on('click', function () {
        $('#confirm-popup').popup('hide');
    });
    var len = $("input[name='select']").length;
    $('#checkbox-all').on('click', function () {
        if (this.checked) {
            $("input[name='select']").prop('checked', true);
        } else {
            $("input[name='select']").prop('checked', false);
        }
    });
    $("input[name='select']").on('click', function () {
        if ($("input[name='select']:checked").length == len) {
            $('#checkbox-all').prop('checked', true);
        } else {
            $('#checkbox-all').prop('checked', false);
        }
    });
    $(function () {
        //Delete Widget Confirmation
        $('#confirm-popup').popup({
            vertical: 'top',
            transition: 'all 0.3s'
        });
        $('#form-popup').popup({
            vertical: 'top',
            transition: 'all 0.3s'
        });
    });
</script>
<script>
	$('#lab-nav6').addClass('active open');
	$('#lab-nav6-sub2').addClass('active');
	popupList({
		create:'__PRO_PATH__/UserAdmin/create',
		remove:'__PRO_PATH__/UserAdmin/remove'
	});
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
