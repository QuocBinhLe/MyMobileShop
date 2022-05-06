		<?php
		include_once('../../controller/dashBoard.php');
		$dashBoard = new Dashboard();
		?>
		<div class="content-wrapper">
			<div class="row">
				<div class="strect-card">
					<div class="card-body">
						<div class="card-heading">
							<span>Doanh thu trong tháng</span>
						</div>
						<div class="card-content">
							<span>
								<?php
								$money = $dashBoard->getTotalIncome();
								if (isset($money)) {
									echo number_format($money, 0).'đ';
								} else {
									echo '0 đ';
								}
								?>
							</span>
						</div>
					</div>
				</div>
				<div class="strect-card">
					<div class="card-body">
						<div class="card-heading">
							<span>Số đơn hàng trong tháng</span>
						</div>
						<div class="card-content">
							<span>
							<?php
							$orderNumber = $dashBoard->getOrderNumber();
							if (isset($orderNumber)) {
								echo $orderNumber;
							} else {
								echo '0';
							}
							?>
							</span>
						</div>
					</div>
				</div>
				<div class="strect-card">
					<div class="card-body">
						<div class="card-heading">
							<span>Số lượng tài khoản</span>
						</div>
						<div class="card-content">
							<span>
								<?php 
									$userNumber = $dashBoard->getUserNumber();
									if(isset($userNumber)) {
										echo $userNumber;
									} else {
										echo '0';
									}
								?>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</body>
</html>