<?php
include('libs/db.php');
session_start();
if (isset($_POST['submit'])){
  $query = $db->prepare("SELECT * FROM users WHERE email = :user AND password = :pass");
	$query->execute([
	'user'=>$_POST['username'],
	'pass'=>md5($_POST['password'])
  ]);
	if($query->rowCount()>0){
		$data = $query->fetch(PDO::FETCH_OBJ);
		if($data->status==1){
			$_SESSION['AUTHEN'] = [
        'UserId'=>$data->user_id,
				'UserName'=>$data->username,
				'Email'=>$data->email,
				'Picture'=>$data->picture,
				'LevelName'=>$data->level_name,
				'MemberDate'=>$data->member_date
			];
			//echo "เย้ลอกอินผ่าน";
			header('location: apps/backend/index.php');
      die();
		}else{
			echo "<script>
			alert('ผู้ใช้นี้ยังไม่ได้รับอนุญาตให้ใช้งาน !');
			</script>";
      die();
		}
	}else{
		# ล็อกอินไม่ผ่าน
		header('location: index.php?result=0');
    die();
	}
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>HMS | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="assets/plugins/iCheck/square/blue.css">

</head>
<body bgcolor="#ccffff">
<div class="login-box">
  <div class="login-logo">
    <a href=""><b>HMS</b> Login</a>
  </div>  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
    <form action="" method="post"><!--form login -->
      <div class="form-group has-feedback">
        <input type="text" name="username" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div><!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div><!-- /.col -->
      </div>
    </form><!--/.form login -->
    <a href="#">I forgot my password</a><br>
    <a href="apps/register.php" class="text-center">Register a new membership</a>
  </div>  <!-- /.login-box-body -->
</div><!-- /.login-box-->
<br>
<!-- Modal -->
<div id="warning" name="warning" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
					<h4 id="title" name="title" class="modal-title" ></h4>
				</div>
				<div id="msg" name="msg" class="modal-body"></div>
		<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
</div>

<!-- jQuery 2.2.3 -->
<script src="assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="assets/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
<script type="text/javascript">//javascript call modal
	$(document).ready(function() {
		var result = getParameterByName("result");
	if (result != null){
		if (result == 0){
			$("#title").html('Warning');
		$("#msg").html('<p>Authentication Fail. Please check again your email and password.</p>');
			$('#warning').modal('show');
			}
	}
		});

		function getParameterByName(name, url) {
			if (!url) {
			url = window.location.href;
		}
		name = name.replace(/[\[\]]/g, "\\$&");
		var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
		results = regex.exec(url);
		if (!results) return null;
		if (!results[2]) return '';
			return decodeURIComponent(results[2].replace(/\+/g, " "));
		}
</script>
</body>
</html>
