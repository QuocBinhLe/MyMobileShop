<?php
include_once('../../controller/userClass.php');
$user = new UserClass();
if (isset($_POST['action']) && $_POST['action'] == 'create') {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$realname = $_POST['realname'];
	$date = $_POST['date_create'];
	$level = $_POST['level'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];

	$insert = $user->createUserByAdmin($username, $level, $email, $phone, $realname, $date, $password);
	if ($insert) {
		echo "<script>window.location.href='http://localhost/shop/view/admin/userlist.php'</script>";
	} else {
		echo "<script>alert('tạo tài khoản thất bại')</script>";
	}
}
?>
<script>window.location.href</script>
<div class="content-wrapper flex-center">
	<div class="row">
		<div class="user-info-panel">
			<div class="box-margin">
				<div class="panel-heading">
					<h3>Thêm tài khoản</h3>
				</div>
				<form class="panel-body" action="useradd.php" method="POST">
					<div class="panel-group">
						<label>Tài khoản</label>
						<div>
							<input class="info-field input-field" type="text" required="" name="username" value="" placeholder="example">
							<i class="fas fa-pen"></i>
						</div>
					</div>
					<div class="panel-group">
						<label>Level</label>
						<div>
							<input class="info-field input-field" type="text" required="" name="level" value="" placeholder="level (0,1)">
							<i class="fas fa-pen"></i>
						</div>
					</div>
					<div class="panel-group">
						<label>Email</label>
						<div>
							<input class="info-field input-field" type="email" required="" name="email" value="" placeholder="example@gmail.com">
							<i class="fas fa-pen"></i>
						</div>
					</div>
					<div class="panel-group">
						<label>Số điện thoại</label>
						<div>
							<input class="info-field input-field" type="text" required="" name="phone" value="" placeholder="">
							<i class="fas fa-pen"></i>
						</div>
					</div>
					<div class="panel-group">
						<label>Họ và tên</label>
						<div>
							<input class="info-field input-field" type="text" required="" name="realname" value="" placeholder="">
							<i class="fas fa-pen"></i>
						</div>
					</div>
					<div class="panel-group">
						<label>Mật khẩu</label>
						<div>
							<input class="info-field input-field" type="text" required="" name="password" value="" placeholder="">
							<i class="fas fa-pen"></i>
						</div>
					</div>
					<input type="hidden" required="" name="date_create" value="<?php echo date('Y-m-d'); ?>">
					<input type="hidden" name="action" value="create">
					<div>
						<button type="submit" class="create-btn hover-08">Create</button>	
					</div>
				</form>
			</div>
		</div>
	</div>
</div>