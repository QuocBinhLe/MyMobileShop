<?php 
	include_once('../../lib/session.php');
	Session::checkSession();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Admin</title>
	<link rel="icon" type="image/icon" href="../../asset/img/logo/icon-store.png">
	<link rel="stylesheet" href="../../asset/css/main.css">
	<link rel="stylesheet" href="../../asset/css/admin/admin-header.css">
	<link rel="stylesheet" href="../../asset/css/admin/admin-sidebar.css">
	<link rel="stylesheet" href="../../asset/css/admin/admin-content-wrapper.css">
	<link href='https://css.gg/menu.css' rel='stylesheet'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <script src="http://cdn.ckeditor.com/4.11.1/full/ckeditor.js"></script>
	<script type="text/javascript" src="../../asset/js/admin-sidebar.js"></script>
	<script type="text/javascript" src="../../asset/js/active-sidebar.js"></script>
	<script type="text/javascript" src="../../asset/js/format-href.js"></script>
	<script type="text/javascript" src="../../asset/js/editor.js"></script>
	<script type="text/javascript" src="../../asset/js/ajax_admin.js"></script>
	<script type="text/javascript" src="../../asset/js/ajax.js"></script>
	<script type="text/javascript" src="../../asset/js/asteroid-alert.js"></script>
</head>
<body>
	<header>
		<div class="header">
			<div class="logo-box">
				<a href="index.php">
					<img class="logo-img" src="../../asset/img/logo/store-logo.png" alt="logo">
				</a>		
			</div>
			<div class="header-user">
				<div></div>
				<div class="header-user-dropdown">
					<i class="fa fa-user"></i>
					<span class="user-name">
						<?php 
							echo Session::get('admin');
						?>
					</span>
					<i class="fa fa-angle-down"></i>
					<ul class="user-action-list">
						<?php 
							if(isset($_GET['action']) && $_GET['action']=='logout') {
								Session::destroy();
							}
							if(isset($_GET['action']) && $_GET['action']=='change-password') {
								header('Location:admin-password.php');
							}
							if(isset($_GET['action']) && $_GET['action']=='edit-info') {
								header('Location:admin-info.php');
							}
						?>
						<li class="user-action-selection">
							<a class="admin-info" href="?action=edit-info">
								Thông tin
								<i class="far fa-file-alt"></i>
							</a>
						</li>
						<li class="user-action-selection">
							<a class="admin-change-pass" href="?action=change-password">
								Đổi mật khẩu
								<i class="fas fa-key"></i>
							</a>
						</li>
						<li class="user-action-selection">
							<a class="admin-logout" href="?action=logout">
								Đăng xuất
								<i class="fas fa-sign-out-alt"></i>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</header>
	
