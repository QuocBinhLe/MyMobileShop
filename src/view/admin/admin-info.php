<?php
	include_once('layout/header.php');
	include_once('layout/sidebar.php');

	include_once('../../controller/userClass.php');
	$admin = new UserClass();
	
	if (isset($_SERVER['REQUEST_METHOD']) and $_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['email'])) {
		$update_info = $admin->updateAdminInfo($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['address']);
	}

?>
<div class="content-wrapper">
	<div class="row">
		<form class="form-panel" action="admin-info.php" method="POST">
			<div class="form-heading">
				<h3>Thông tin admin</h3>
			</div>
			<div class="mrg-top-20"></div>
			<?php $admin_info = $admin->getAdminInfo('admin'); ?>
			<div class="form-group">
				<div class="form-admin-info-label-box">
					<label>Tên</label>
				</div>
				<div class="form-admin-info-input-box">
					<input type="text" required=""  class="" name="name" value="<?php echo $admin_info['name'] ?>">
				</div>	
				<i class="fas fa-pen"></i>
			</div>
			<div class="form-group">
				<div class="form-admin-info-label-box">
					<label>Email</label>
				</div>
				<div class="form-admin-info-input-box">
					<input type="email" required=""  class="" name="email" value="<?php echo $admin_info['email'] ?>">
				</div>
				<i class="fas fa-pen"></i>
			</div>
			<div class="form-group">
				<div class="form-admin-info-label-box">
					<label>Số điện thoại</label>
				</div>
				<div class="form-admin-info-input-box">
					<input type="text" required=""  class="" name="phone" value="<?php echo $admin_info['phone'] ?>">
				</div>
				<i class="fas fa-pen"></i>
			</div>
			<div class="form-group">
				<div class="form-admin-info-label-box">
					<label>Địa chỉ</label>
				</div>
				<div class="form-admin-info-input-box">
					<input type="text" class="" name="address" value="<?php echo $admin_info['address'] ?>">
				</div>
				<i class="fas fa-pen"></i>
			</div>
			<div class="mrg-top-20"></div>
			<div class="form-group">
				<?php
					$htmlMessage = '';
					if (isset($update_info)) {
						$htmlMessage = '<span class="show-msg success">Cập nhật thông tin thành công</span>';
						Session::set('admin', $_POST['name']);
						require('layout/header.php');
					} else {
						if (isset($_SERVER['REQUEST_METHOD']) and $_SERVER['REQUEST_METHOD'] == 'POST') {
							$htmlMessage = '<span class="show-msg error">Cập nhật thông tin thất bại</span>';
						}
						
					}
					
					echo $htmlMessage;
				?>
				
			</div>
			<div class="mrg-top-20"></div>
			<div>
			    <button class="admin-info-save--btn hover-08">Lưu</button>
			</div>
		</form>
	</div>
</div>
