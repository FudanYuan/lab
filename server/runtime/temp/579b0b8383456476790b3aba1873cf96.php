<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:76:"/Applications/XAMPP/xamppfiles/htdocs/lab/server/app/view/Result/create.html";i:1513139071;s:73:"/Applications/XAMPP/xamppfiles/htdocs/lab/server/app/view/Common/top.html";i:1503214051;s:80:"/Applications/XAMPP/xamppfiles/htdocs/lab/server/app/view/Common/popup_warn.html";i:1503219129;s:76:"/Applications/XAMPP/xamppfiles/htdocs/lab/server/app/view/Common/upload.html";i:1502937049;s:76:"/Applications/XAMPP/xamppfiles/htdocs/lab/server/app/view/Common/bottom.html";i:1502885165;}*/ ?>
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
            <li><span class="primary-font"><i class="icon-home"></i></span><a href="__PRO_PATH__/Result/index">论文发表</a></li>
            <li>新建</li>
        </ul>
        <div class="form-wrapper">
            <form class="form-horizontal" method="post" id="main-form">
                <input type="hidden" name="ispublish" value="0"/>
                <div class="form-group <?php if(!empty($errors['title'])) echo  'has-error'; ?>">
                    <label for="form-title" class="col-sm-2 control-label">标题：</label>
                    <div class="col-sm-4">
                        <input name="title" type="text" class="form-control" id="form-title" value="<?php echo isset($data['title']) ? $data['title'] : ''; ?>">
                        <span class="help-block"><?php echo isset($errors['title']) ? $errors['title'] : ''; ?></span>
                    </div>
                </div>
                <div class="form-group <?php if(!empty($errors['tagid'])) echo  'has-error'; ?>">
                    <label for="form-tag" class="col-sm-2 control-label">标签：</label>
                    <div class="col-sm-4">
                        <select name="tagid" class="form-control" style="width:100px" id="form-tag">
                            <option value="">--选择--</option>
                            <?php if(is_array($tags) || $tags instanceof \think\Collection): if( count($tags)==0 ) : echo "" ;else: foreach($tags as $key=>$tag): ?>
                            <option value="<?php echo $tag['id']; ?>"><?php echo $tag['title']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                        <span class="help-block"><?php echo isset($errors['tagid']) ? $errors['tagid'] :  ''; ?></span>
                    </div>
                </div>
                <div class="form-group <?php if(!empty($errors['research'])) echo  'has-error'; ?>">
                    <label for="form-research" class="col-sm-2 control-label">研究方向：</label>
                    <div class="col-sm-4">
                        <select name="research_id" class="form-control" style="width:100px" id="form-research">
                            <option value="">--选择--</option>
                            <?php if(is_array($research) || $research instanceof \think\Collection): if( count($research)==0 ) : echo "" ;else: foreach($research as $key=>$model): ?>
                            <option value="<?php echo $model['id']; ?>"><?php echo $model['title']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                        <span class="help-block"><?php echo isset($errors['research']) ? $errors['research'] :  ''; ?></span>
                    </div>
                </div>
                <div class="form-group <?php if(!empty($errors['digest'])) echo  'has-error'; ?>">
                    <label for="form-digest" class="col-sm-2 control-label">摘要：</label>
                    <div class="col-sm-4">
                        <input name="digest" type="text" class="form-control" id="form-digest"
                               value="<?php echo isset($data['digest']) ? $data['digest'] : ''; ?>">
                        <span class="help-block"><?php echo isset($errors['digest']) ? $errors['digest'] : ''; ?></span>
                    </div>
                </div>

                <div class="form-group <?php if(!empty($errors['img'])) echo  'has-error'; ?>">
                    <label class="col-sm-2 control-label">封面：</label>
                    <div class="col-sm-4">
                        <div id="filelist">
                            <div><?php echo isset($data['img_origin']) ? $data['img_origin'] : ''; ?><b></b></div>
                        </div>
                        <br/>
                        <div id="upload-wrapper-img">
                            <a id="pickfiles" href="javascript:;">选择文件</a>
                            <a id="uploadfiles" href="javascript:;">上传</a>
                        </div>
                        <input type="hidden" name="img" value="<?php echo isset($data['img']) ? $data['img'] : ''; ?>"/>
                        <input type="hidden" name="img_origin" value="<?php echo isset($data['img_origin']) ? $data['img_origin'] : ''; ?>"/>
                        <span class="help-block"><?php echo isset($errors['img']) ? $errors['img'] :  ''; ?></span>
                    </div>
                </div>
                <div class="form-group <?php if(!empty($errors['file'])) echo  'has-error'; ?>">
                    <label class="col-sm-2 control-label">文件：</label>
                    <div class="col-sm-4">
                        <div id="filelist-file">
                            <div><?php echo isset($data['file_origin']) ? $data['file_origin'] : ''; ?><b></b></div>
                        </div>
                        <br/>
                        <div id="upload-wrapper-file">
                            <a id="pickfiles-file" href="javascript:;">选择文件</a>
                            <a id="uploadfiles-file" href="javascript:;">上传</a>
                        </div>
                        <input type="hidden" name="file" value="<?php echo isset($data['file']) ? $data['file'] : ''; ?>"/>
                        <input type="hidden" name="file_origin" value="<?php echo isset($data['file_origin']) ? $data['file_origin'] : ''; ?>"/>
                        <span class="help-block"><?php echo isset($errors['file']) ? $errors['file'] :  ''; ?></span>
                    </div>
                </div>

                <div class="form-group <?php if(!empty($errors['href'])) echo  'has-error'; ?>">
                    <label for="form-href" class="col-sm-2 control-label">外链链接：</label>
                    <div class="col-sm-4">
                        <input name="href" type="text" class="form-control" id="form-href" value="<?php echo isset($data['href']) ? $data['href'] : ''; ?>">
                        <span class="help-block"><?php echo isset($errors['href']) ? $errors['href'] : ''; ?></span>
                    </div>
                </div>

                <div class="form-group <?php if(!empty($errors['content'])) echo  'has-error'; ?>" hidden>
                    <label class="col-sm-2 control-label">内容：</label>
                    <span class="help-block"><?php echo isset($errors['content']) ? $errors['content'] :  ''; ?></span>
                </div>
                <div class="form-group" hidden>
                    <div class="col-sm-offset-1 col-sm-10">
                        <script id="editor" type="text/plain" style="width:100%;height:500px;" name="content">
                            <?php echo isset($data['content']) ? $data['content'] :  ''; ?>



                        </script>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10 lab-btns">
                        <a id="form-publish" class="btn btn-primary">发布</a>
                        <button type="submit" class="btn btn-success">保存</button>
                        <a id="form-cancel" class="btn btn-info">取消</a>
                        <!-- <a id="form-delete" class="btn btn-default">删除</a> -->
                    </div>
                </div>
            </form>
        </div>
    </div>
</div><!-- /main-container -->
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
<script type="text/javascript" charset="utf-8" src="__PUBLIC__/js/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="__PUBLIC__/js/ueditor/ueditor.all.min.js"></script>
<script type="text/javascript" charset="utf-8" src="__PUBLIC__/js/ueditor/lang/zh-cn/zh-cn.js"></script>
<script>
    var ue = UE.getEditor('editor');
    $('#form-tag').val('<?php echo isset($data['tagid']) ? $data['tagid'] :  ""; ?>');
    $('#lab-nav7').addClass('active');

    $('#form-cancel').on('click', function () {
        window.location.href = '__PRO_PATH__/Result/index';
    });
    $('#form-publish').on('click', function () {
        $("input[name='ispublish']").val(1);
        $('#main-form').submit();
    });
    myupload({
        container: 'upload-wrapper-img',
        browse: 'pickfiles',
        url: '__PRO_PATH__/Media/upload?dir=result_img',
        img_types: 'jpg,gif,png',
        zip_types: 'zip',
        filelist: 'filelist',
        uploadfiles: 'uploadfiles',
        file_size: '10mb',
        onUploaded: function (up, file, result) {
            $("input[name='img_origin']").val(file.name);
            var res = JSON.parse(result.response);
            $("input[name='img']").val(res.result.file);
        },
        isMulti: false
    });
    myupload({
        container:'upload-wrapper-file',
        browse:'pickfiles-file',
        url:'__PRO_PATH__/Media/upload?dir=result_file',
        img_types:'jpg,gif,png',
        zip_types:'zip',
        filelist:'filelist-file',
        uploadfiles:'uploadfiles-file',
        file_size:'10mb',
        onUploaded: function(up, file, result){
            $("input[name='file_origin']").val(file.name);
            var res = JSON.parse(result.response);
            $("input[name='file']").val(res.result.file);
        },
        isMulti:false
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
