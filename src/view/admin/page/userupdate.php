<?php
	include_once('../../controller/userClass.php');
	$user = new UserClass();	
	if (isset($_GET['action']) && $_GET['action'] == 'update' && isset($_GET['level']) && isset($_GET['email']) && isset($_GET['password']) && isset($_GET['username'])) {
		$level = $_GET['level'];
		$realname = $_GET['realname'];
		$email = $_GET['email'];
		$phone = $_GET['phone'];
		$pass = $_GET['password'];
		$date_create = $_GET['date_create'];
		$user->updateUserInfo($_GET['username'], $level, $email, $phone, $realname, $date_create, $pass);

	}
?>
<div class="content-wrapper flex-center">
	<div class="row">
		<div class="user-info-panel">
			<div class="box-margin">
				<div class="panel-heading">
					<h3>Thông tin tài khoản</h3>
				</div>
				<form class="panel-body" action="userupdate.php" method="GET">
					<?php
					if (isset($_GET['username'])) {
						$user_info = $user->getUserInfo($_GET['username']);
					} else {
						$user_info = array(
							'username' => '',
							'level' => '',
							'email' => '',
							'realname' => '',
							'phone' => '',
							'date_create' => '',
							'password' => '',
						);
					}
					?>
					<div class="panel-group">
						<label>Tài khoản</label>
						<div class="info-field input-field" style="max-width: 200px !important; cursor: default; font-size: 1.1rem;">
							<?php echo $user_info['username'] ?>
							<input type="hidden" name="username" value="<?php echo $user_info['username'] ?>">
						</div>					
					</div>
					<div class="panel-group">
						<label>Level</label>
						<div>
							<input class="info-field input-field" type="text" name="level" value="<?php echo $user_info['level'] ?>"></input>
							<i class="fas fa-pen"></i>
						</div>
					</div>
					<div class="panel-group">
						<label>Email</label>
						<div>
							<input class="info-field input-field" type="text" name="email" value="<?php echo $user_info['email'] ?>"></input>
							<i class="fas fa-pen"></i>
						</div>
					</div>
					<div class="panel-group">
						<label>Họ và tên</label>
						<div>
							<input class="info-field input-field" type="text" name="realname" value="<?php echo $user_info['realname'] ?>"></input>
							<i class="fas fa-pen"></i>
						</div>
					</div>
					<div class="panel-group">
						<label>Số điện thoại</label>
						<div>
							<input class="info-field input-field" type="text" name="phone" value="<?php echo $user_info['phone'] ?>"></input>
							<i class="fas fa-pen"></i>
						</div>
					</div>
					<div class="panel-group">
						<label>Ngày tạo tài khoản</label>
						<div>
							<input class="info-field input-field" type="date" name="date_create" value="<?php echo $user_info['date_create'] ?>"></input>
							<i class="fas fa-pen"></i>
						</div>
					</div>
					<input type="hidden" name="action" value="update">
					<div class="panel-group">
						<label>Mật khẩu</label>
						<div>
							<input class="info-field input-field" type="text" name="password" value="<?php echo base64_decode($user_info['password']) ?>"></input>
							<i class="fas fa-pen"></i>
						</div>
					</div>
					<div>
						<button type="submit" class="update-btn">Update</button>	
					</div>
				</form>
			</div>
		</div>
	</div>
</div>