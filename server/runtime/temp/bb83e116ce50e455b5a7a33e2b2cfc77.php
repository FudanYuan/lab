<?php if (!defined('THINK_PATH')) exit(); /*a:10:{s:79:"/Applications/XAMPP/xamppfiles/htdocs/lab/server/app/view/Member/curmember.html";i:1510928298;s:73:"/Applications/XAMPP/xamppfiles/htdocs/lab/server/app/view/Common/top.html";i:1503214051;s:80:"/Applications/XAMPP/xamppfiles/htdocs/lab/server/app/view/Common/popup_warn.html";i:1503219129;s:80:"/Applications/XAMPP/xamppfiles/htdocs/lab/server/app/view/Common/popup_list.html";i:1502953890;s:78:"/Applications/XAMPP/xamppfiles/htdocs/lab/server/app/view/Common/calendar.html";i:1502883587;s:76:"/Applications/XAMPP/xamppfiles/htdocs/lab/server/app/view/Common/upload.html";i:1502937049;s:79:"/Applications/XAMPP/xamppfiles/htdocs/lab/server/app/view/Common/popup_top.html";i:1503217918;s:85:"/Applications/XAMPP/xamppfiles/htdocs/lab/server/app/view/Common/popup_recommend.html";i:1503219178;s:79:"/Applications/XAMPP/xamppfiles/htdocs/lab/server/app/view/Common/pop_toast.html";i:1503219863;s:76:"/Applications/XAMPP/xamppfiles/htdocs/lab/server/app/view/Common/bottom.html";i:1502885165;}*/ ?>
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
	<div class="padding-md" style="overflow-x: scroll">
		<ul class="breadcrumb">
			<li><span class="primary-font"><i class="icon-home"></i></span><a href="__PRO_PATH__/"> 首页</a></li>
			<li>在校</li>
		</ul>
		<div class="list-search">
			<form action="" class="form-inline" method="get">
			  <div class="form-group">
			    <label for="select-tagid">标签：</label>
			    <select name="tagid" class="form-control" style="width:100px" id="select-tagid">
				  <option value="-1">全部</option>
				  <?php if(is_array($tags) || $tags instanceof \think\Collection): if( count($tags)==0 ) : echo "" ;else: foreach($tags as $key=>$tag): ?>
					<option value="<?php echo $tag['id']; ?>"><?php echo $tag['title']; ?></option>
				  <?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
			  </div>
			  <div class="form-group">
			    <label for="select-name">姓名：</label>
				<input id="select-name" name="name" class="form-control" style="width:200px" value="<?php echo isset($cond['name']) ? $cond['name'] :  ''; ?>" />
			  </div>
			  <button type="submit" class="btn btn-default">查询</button>
			  <script>
			  	$('#select-tagid').val('<?php echo isset($cond['tagid']) ? $cond['tagid'] :  -1; ?>');
			  </script>
			</form>
		</div>
		<div class="list-btns">
			<?php if(authority('CurMember_add')): ?>
			<button type="button" class="btn btn-success" id="addItem">新建</button>
			<?php endif; if(authority('CurMember_del')): ?>
			<button type="button" class="btn btn-default" id="removeItem">删除</button>
			<?php endif; ?>
		</div>
		<table class="table table-hover" style="background:#fff;">
		  <thead>
		  	<tr>
		  		<th><input type="checkbox" id="checkbox-all"/></th>
		  		<th>序号</th>
		  		<th>标签</th>
		  		<th>姓名</th>
				<th>导师</th>
				<th>联系方式</th>
				<th>邮箱</th>
				<th hidden>地址</th>
				<th>职称</th>
				<th>链接</th>
				<th hidden>研究领域</th>
				<th hidden>摘要</th>
		  		<th>封面照片</th>
		  		<th hidden>主页照片</th>
		  		<th>操作</th>
		  	</tr>
		  </thead>
		  <tbody>
			<?php if(is_array($list) || $list instanceof \think\Collection): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$model): ?>
				<tr>
					<td><input type="checkbox" name="select" value="<?php echo $model['id']; ?>" /></td>
					<td><?php echo $model['id']; ?></td>
					<td><?php echo $model['tag_title']; ?></td>
					<td><?php echo $model['name']; ?></td>
					<td><?php echo $model['tutor']; ?></td>
					<td><?php echo $model['phone']; ?></td>
					<td><?php echo $model['email']; ?></td>
					<td hidden><?php echo $model['address']; ?></td>
					<td><?php echo $model['position']; ?></td>
					<td><?php echo $model['url']; ?></td>
					<td hidden><?php echo $model['research_area']; ?></td>
					<td hidden><?php echo $model['digest']; ?></td>
					<td><img src="<?php echo $model['img']; ?>" alt="" style="width:160px; height:50px;" /></td>
					<td hidden><img src="<?php echo $model['bgimg']; ?>" alt="" style="width:160px; height:50px;" /></td>
					<td>
						<?php if(authority('CurMember_top')): ?>
						<a href="javascript:;" onclick="doTop(<?php echo $model['id']; ?>)">置顶</a>
						<?php endif; if(!$model['ispublish']): ?>
						<a href="javascript:;" onclick="doPublish(<?php echo $model['id']; ?>)">发布</a>
						<?php endif; if(authority('CurMember_recomm')): if($model['isrecommend']): ?>
						<a href="javascript:;" onclick="cancelRecomm(<?php echo $model['id']; ?>)">取消</a>
						<?php else: ?>
						<a href="javascript:;" onclick="doRecommend(<?php echo $model['id']; ?>)">推荐</a>
						<?php endif; endif; if(authority('CurMember_edit')): ?>
						<a href="__PRO_PATH__/Member/cur_edit?id=<?php echo $model['id']; ?>">编辑</a>
						<?php endif; ?>
					</td>
				</tr>
			<?php endforeach; endif; else: echo "" ;endif; ?>
		  </tbody>
		</table>
		<?php echo $list->render(); ?>
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
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/flatpickr.min.css">
<script src="__PUBLIC__/js/flatpickr.min.js"></script>
<script>
Flatpickr.l10n.weekdays.shorthand = ['周一', '周二', '周三', '周四', '周五', '周六', '周天'];
Flatpickr.l10n.months.longhand = ['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'];
</script>
<script src="__PUBLIC__/js/plupload/plupload.full.min.js"></script>
<script>
function myupload(config){
	if(!config){
		var config = {
			container:'upload-wrapper',
			browse:'pickfiles',
			url:'upload.php',
			img_types:'jpg,gif,png',
			zip_types:'zip',
			filelist:'filelist',
			uploadfiles:'uploadfiles',
			file_size:'10mb',
			is_multi: true
		};
	}
	var uploader = new plupload.Uploader({
		runtimes : 'html5',
		browse_button : config.browse, // you can pass an id...
		container: document.getElementById(config.container), // ... or DOM Element itself
		url : config.url,
		flash_swf_url : '__PUBLIC__/js/plupload/Moxie.swf',
		silverlight_xap_url : '__PUBLIC__/js/plupload/Moxie.xap',
		prevent_duplicates:true,
		filters : {
			/*max_file_size : config.file_size,
			mime_types: [
				{title : "Image files", extensions : config.img_types},
				{title : "Zip files", extensions : config.zip_types}
			]*/
		},

		init: {
			PostInit: function() {
				//document.getElementById(config.filelist).innerHTML = '';

				document.getElementById(config.uploadfiles).onclick = function() {
					uploader.start();
					return false;
				};
			},

			FilesAdded: function(up, files) {
				if(config.is_multi){
					plupload.each(files, function(file) {
						document.getElementById(config.filelist).innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
					});
				}else{
					up.splice(0, up.files.length - 1);
					var file = files[files.length - 1];
					document.getElementById(config.filelist).innerHTML = '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
				}
			},

			UploadProgress: function(up, file) {
				document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
			},

			Error: function(up, err) {
				document.getElementById('console').appendChild(document.createTextNode("\nError #" + err.code + ": " + err.message));
			},
			FileUploaded:config.onUploaded
		}
	});

	uploader.init();
	return uploader;
}
</script>
<!--  必须包含
	Common/calendar
	Common/upload
	Common/popup_warn   
	
	调用popupForm(板块,内容ID)
-->
<div class="custom-popup" id="form-popup" style="width:300px;padding-bottom:30px;">
	<div class="popup-body" style="text-align:left">
		<form id="top-form">
		  <input type="hidden" name="conid" id="top-form-conid" />
		  <input type="hidden" name="section" id="top-form-sec" />
		  <div class="form-group">
		    <label for="top-form-pos">位置</label>
		    <select class="form-control" id="top-form-pos" name="position">
		    	<option value="1">位置1</option>
		    	<option value="2">位置2</option>
		    	<option value="3">位置3</option>
		    	<option value="4">位置4</option>
		    	<option value="5">位置5</option>
		    </select>
		    <p class="help-block"></p>
		  </div>
		  <div class="form-group">
		    <label for="top-form-stime">开始时间</label>
		    <input id="top-form-stime" name="begintime_str" data-enable-time=true data-time_24hr=true class="form-control flatpickr">
		  	<p class="help-block"></p>
		  </div>
		  <div class="form-group">
		    <label for="top-form-etime">结束时间</label>
		    <input id="top-form-etime" name="endtime_str" data-enable-time=true data-time_24hr=true class="form-control flatpickr">
		    <p class="help-block"></p>
		  </div>
		  <div class="form-group">
		    <label>封面图：</label>
		    <div style="margin-left:20px;">
		      <div id="filelist-top">
		      	
		      </div>
			  <div id="upload-wrapper-top">
			    <a id="pickfiles-top" href="javascript:;">选择文件</a> 
			    <a id="uploadfiles-top" href="javascript:;">上传</a>
			  </div>
			  <input type="hidden" name="img" />
			  <input type="hidden" name="img_origin" />
		      <span class="help-block"></span>
		    </div>
		  </div>
		  <div class="form-group">
		  	<div id="top-form-all"></div>
		    <p class="help-block"></p>
		  </div>
		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10 lab-btns">
		      <a id="top-form-save" class="btn btn-success">保存</a>
		      <a id="top-form-cancel" class="btn btn-info">取消</a>
		    </div>
		  </div>
		</form>
	</div>
</div>
<script>
function popupForm(section, id){
	if(!id){
		popWarn('ID不能为空');
		return;
	}
	clearFormData();
	$('#top-form-conid').val(id);
	$('#top-form-sec').val(section);
	$('#form-popup').popup({blur:false});
	$('#form-popup').popup('show');
}
$('#top-form-cancel').on('click', function(){
	$('#form-popup').popup('hide');
});
$('#top-form-save').on('click', function(){
	$('#top-form .form-group').removeClass('has-error');
	$('#top-form .help-block').html('');
	var params = {};
	var data = $('#top-form').serializeArray();
	$.each(data, function() {
		params[this.name] = this.value;
    });
	params['position'] = $('#top-form-pos').val();
	$.post('__PRO_PATH__/Banner/dotop', params, function(res){
		if(res.code == 1){
			$('#form-popup').popup('hide');
			popWarn('置顶成功');
		}else if(res.code == 2){
			$.each(res.errors, function(k, v){
				if(k == 'begintime' || k == 'endtime') k += '_str';
				var obj = k == 'all' ? $('#top-form-all') : $('#top-form [name="'+k+'"]');
				obj.siblings('.help-block').html(v);
				obj.parent().addClass('has-error');
			})
		}
	});
});
function clearFormData(){
	$('#top-form')[0].reset();
	$('#filelist').html('');
	$('#top-form .help-block').html('');
}
$(".flatpickr").flatpickr({time_24hr:true});
myupload({
	container:'upload-wrapper-top',
	browse:'pickfiles-top',
	url:'__PRO_PATH__/Media/upload?dir=banner',
	img_types:'jpg,gif,png',
	zip_types:'zip',
	filelist:'filelist-top',
	uploadfiles:'uploadfiles-top',
	file_size:'10mb',
	onUploaded: function(up, file, result){
		$("input[name='img_origin']").val(file.name);
		var res = JSON.parse(result.response);
		$("input[name='img']").val(res.result.file);
	},
	isMulti:false
});

</script>
<!--  必须包含
	Common/calendar
	Common/upload
	Common/popup_warn

	调用popupForm(板块,内容ID)
-->
<!--弹窗-->
<div class="custom-popup" id="toast-popup" style="width:200px;display:none;">
    <div class="popup-body text-center">
        <h5></h5>
    </div>
</div>
<script>
    function popupToast(con){
        $('#toast-popup h5').html(con);
        setTimeout(function () {
            $('#toast-popup').popup('show');
        }, 2000);
    }
</script>
<div class="custom-popup" id="form-popup-recomm" style="width:300px;padding-bottom:30px;display:none;">
    <div class="popup-body" style="text-align:left">
        <form id="recomm-form">
            <input type="hidden" name="conid" id="recomm-form-conid" />
            <div class="form-group">
                <label for="recomm-form-pos">位置</label>
                <select class="form-control" id="recomm-form-pos" name="recomm_pos">
                    <option value="1">位置1</option>
                    <option value="2">位置2</option>
                    <option value="3">位置3</option>
                    <option value="4">位置4</option>
                    <option value="5">位置5</option>
                    <option value="6">位置6</option>
                </select>
                <p class="help-block"></p>
            </div>
            <div class="form-group">
                <label for="recomm-form-stime">开始时间</label>
                <input id="recomm-form-stime" name="recomm_begintime_str" data-enable-time=true data-time_24hr=true class="form-control flatpickr">
                <p class="help-block"></p>
            </div>
            <div class="form-group">
                <label for="recomm-form-etime">结束时间</label>
                <input id="recomm-form-etime" name="recomm_endtime_str" data-enable-time=true data-time_24hr=true class="form-control flatpickr">
                <p class="help-block"></p>
            </div>
            <div class="form-group">
                <div id="recomm-form-all"></div>
                <p class="help-block"></p>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10 lab-btns">
                    <a id="recomm-form-save" class="btn btn-success">保存</a>
                    <a id="recomm-form-cancel" class="btn btn-info">取消</a>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    function popupRecomm(uri, id, data){
        if(!id){
            popWarn('ID不能为空');
            return;
        }
        $('#recomm-form-conid').val(id);
        $('#form-popup-recomm').popup('show');
        $('#recomm-form-cancel').on('click', function(){
            $('#form-popup-recomm').popup('hide');
        });
        $('#recomm-form-save').on('click', function(){
            $('#recomm-form .form-group').removeClass('has-error');
            $('#recomm-form .help-block').html('');
            var params = {};
            var data = $('#recomm-form').serializeArray();
            $.each(data, function() {
                params[this.name] = this.value;
            });
            $.post(uri, params, function(res){
                if(res.code == 1){
                    $('#form-popup-recomm').popup('hide');
                    popupToast('推荐成功');
                    window.location.reload();
                }else if(res.code == 2){
                    $.each(res.errors, function(k, v){
                        if(k == 'recomm_begintime' || k == 'recomm_endtime') k += '_str';
                        var obj = k == 'all' ? $('#recomm-form-all') : $('#recomm-form [name="'+k+'"]');
                        obj.siblings('.help-block').html(v);
                        obj.parent().addClass('has-error');
                    })
                }
            });
        });
    }
    $(".flatpickr").flatpickr();
</script>
<script>
	$('#lab-nav4').addClass('active open');
	$('#lab-nav4-sub1').addClass('active');
	popupList({
		create:'__PRO_PATH__/Member/cur_create',
		remove:'__PRO_PATH__/Member/remove'
	});
	function doPublish(id){
		$.get('__PRO_PATH__/Member/dopublish', {id:id}, function(res){
			if(res.code == 1){
				window.location.reload();
			}else{
				popWarn('发布失败');
			}
		});
	}
	function doRecommend(id){
		popupRecomm('__PRO_PATH__/Member/dorecomm', id);
	}
	function cancelRecomm(id){
		$.get('__PRO_PATH__/Member/cancelrecomm', {conid:id}, function(res){
			if(res.code == 1){
				window.location.reload();
			}else{
				popWarn(ret.msg);
			}
		});
	}
	function doTop(id){
		popupForm(3, id);
	}
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
