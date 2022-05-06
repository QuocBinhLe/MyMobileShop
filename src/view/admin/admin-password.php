<?php
	include 'layout/header.php';
	include 'layout/sidebar.php';

	include '../../controller/userClass.php';
	if($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['current-pw'])) {
		$admin = new UserClass();
		$result = $admin->updateAdminPassword($_POST['current-pw'], $_POST['new-pw'], $_POST['renew-pw']);
	}
?>
<div class="content-wrapper">
	<div class="row">
		<div class="list-box">
			<div class="box-margin-40-80 flex-col">
				<div class="panel-heading">
					<h3>Đổi mật khẩu admin</h3>
				</div>
				<form class="form-body" action="admin-password.php" method="POST">
					<div class="form-group">
						<div class="form-admin-pw-label-box">
							<label>Mật khẩu hiện tại</label>
						</div>
						<div class="form-admin-pw-input-box">
							<input type="password" required=""  class="" name="current-pw">
						</div>
					</div>
					<div class="form-group">
						<div class="form-admin-pw-label-box">
							<label>Mật khẩu mới</label>
						</div>
						<div class="form-admin-pw-input-box">
							<input type="password" required="" class="" name="new-pw">
						</div>
					</div>
					<div class="form-group">
						<div class="form-admin-pw-label-box">
							<label>Nhập lại mật khẩu mới</label>
						</div>
						<div class="form-admin-pw-input-box">
							<input type="password" required="" class="" name="renew-pw">
						</div>
					</div>
					<div class="form-group">
						<?php
							if (isset($result)) {
								if ($result['status'] == 0) {
									$msgClass = 'error';
								} else {
									$msgClass = 'success';
								}

								$htmlMessage = '<span class="show-msg '.$msgClass.'">'.$result['msg'].'</span>';
								echo $htmlMessage;
							}
						?>			
					</div>
					<div class="form-btn-box">
						<button type="submit" class="change-pass-btn hover-08">Lưu</button>
						<div class="mrg-right-16">
						</div>
						<a class="cancel-pass-btn hover-08" href="admin-password.php">Hủy</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>