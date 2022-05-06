<div class="content-wrapper">
	<div class="row">
		<div class="list-box">
			<div class="box-margin">
				<ul class="box-column">
					<li class="box-column-name">Tài khoản</li>
					<li class="box-column-name growth-2">Email</li>
					<li class="box-column-name">Thao tác</li>

				</ul>
				<?php
				include_once('../../controller/userClass.php');
				$user = new UserClass();
				$list = $user->getListUsers();
				if (isset($_GET['action'])) {
					if ($_GET['action'] == 'del' && isset($_GET['username'])) {
						$user->deleteUser($_GET['username']);
						echo "<script>window.location.href='http://localhost/shop/view/admin/userlist.php'</script>";
					}
				}
				?>
				<script>window.location.href</script>
				<div class="box-user">
					<?php
						$length = count($list);
						if ($list) {
							for ($i = 0; $i < $length; $i++){
							$confirm = "Xóa tài khoản ".$list[$i]['username']."?";
							echo '<ul class="user-record">
									<li class="user-info">'.$list[$i]['username'].'</li>
									<li class="user-info growth-2">'.$list[$i]['email'].'</li>
									<li class="user-info">
										<a class=modify-action href="userupdate.php?action=update&username='.$list[$i]['username'].'">
											<i class="fas fa-pen"></i>
										</a>
										<a class=del-action href="userlist.php?action=del&username='.$list[$i]['username'].'">
											<i class="fa fa-times"></i>
										</a>
									</li>
								</ul>';
							}
						}
						
					?>
				</div>
			</div>
		</div>
	</div>
</div>