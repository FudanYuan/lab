<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:78:"/Applications/XAMPP/xamppfiles/htdocs/lab/server/app/view/UserAdmin/login.html";i:1503214013;s:80:"/Applications/XAMPP/xamppfiles/htdocs/lab/server/app/view/Common/popup_warn.html";i:1503219129;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>实验室后台管理</title>
    <link rel="shortcut icon" href="__PUBLIC__/images/logo.ico"/>
    <link rel="bookmark" href="__PUBLIC__/images/logo.ico"/>
    <link href="__PUBLIC__/js/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="__PUBLIC__/js/jquery-1.11.1.min.js"></script>
    <script src='__PUBLIC__/js/jquery.popupoverlay.min.js'></script>
    <link href="__PUBLIC__/css/simplify.min.css" rel="stylesheet">
    <style>
        .syh_bg {
            width: 100%;
            height: 100%;
            position: fixed;
            left: 0;
            top: 0;
            z-index: -1;
        }

        .syh_main {
            width: 380px;
            height: 380px;
            margin: 180px auto;
        }
    </style>
</head>
<body>
<div class="syh_main">
    <form action="" method="post" id="main-form">
        <div class="form-group">
            <h3>实验室后台管理系统</h3>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                <input class="form-control input-lg" type="text" placeholder="账号" name="username"/>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                <input class="form-control input-lg" type="password" placeholder="密码" name="pass"/>
            </div>
        </div>
        <div class="form-group">
            <button type="button" class="btn btn-primary btn-lg btn-block" id="login-btn">登录</button>
        </div>
    </form>
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
        $('#login-btn').on('click', function () {
            var username = $('input[name="username"]').val();
            var pass = $('input[name="pass"]').val();
            if (!username) {
                popWarn('用户名不能为空');
                return;
            }
            if (!pass) {
                popWarn('密码不能为空');
                return;
            }
            $.post('', {username: username, pass: pass}, function (res) {
                if (res.errorcode == 0) {
                    window.location.href = '__PRO_PATH__/';
                } else {
                    popWarn(res.msg);
                    return;
                }
            });
        });
    </script>
</div>
</body>
</html>