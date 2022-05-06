<?php
	include_once('../../controller/orderClass.php');
	$order = new OrderClass();
	$order_list = $order->getAllOrder();
	$number_order = $order->getNumberOrder();
	$number_success = $order->getNumberOrderSuccess();
	$number_pending = $order->getNumberOrderPending();
?>
<div class="content-wrapper">
	<div class="">
		<div class="flex-col">
			<div class="">
				<div class="row">
					<div style="margin-left: 8px;"></div>
					<div class="strect-card blue-linear">
						<div class="card-body">
							<div class="card-heading">
								<span>Tổng số đơn hàng</span>
							</div>
							<div class="card-content">
								<span>
									<?php echo $number_order['number']; ?>
								</span>
							</div>
						</div>
					</div>
					<div class="strect-card blue-linear">
						<div class="card-body">
							<div class="card-heading">
								<span>Đã xong</span>
							</div>
							<div class="card-content">
								<span>
									<?php echo $number_success['number']; ?>
								</span>
							</div>
						</div>
					</div>
					<div class="strect-card blue-linear">
						<div class="card-body">
							<div class="card-heading">
								<span>Đang thực hiện</span>
							</div>
							<div class="card-content">
								<span>
									<?php echo $number_pending['number']; ?>
								</span>
							</div>
						</div>
					</div>
					<div style="margin-right: 8px;"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="content-wrapper height-auto">
		<div class="row">
			<div class="list-box">
				<div class="box-margin">
					<ul class="box-column">
						<li class="box-column-name width-20">Mã đơn hàng</li>
						<li class="box-column-name width-20">Tài khoản khách hàng</li>
						<li class="box-column-name width-20">Giá trị</li>
						<li class="box-column-name width-20">Ngày đặt hàng</li>
						<li class="box-column-name width-20">Trạng thái</li>
					</ul>
					<div class="box-user">
						<?php
							$length = count($order_list);
							if($length > 0 && $order_list[0]['id'] != '') {
								for ($i = 0; $i < $length; $i++) {
									$state = $order_list[$i]['state'];
									if ($state == 0) {
										$htmlState = '
													<span class=pending-state>
														pending
														
													</span>';
									}
									if ($state == 1) {
										$htmlState = '
													<span class=success-state>
														success
														
													</span>';
									}
									if ($state == -1) {
										$htmlState = '
													<span class=cancel-state>
														cancel
														
													</span>';
									}
									$html = '
											<ul class="order-record" onclick="createOrderInfoLink('.$order_list[$i]['id'].')">
												<li class="order-info width-20">'.$order_list[$i]['id'].'</li>
												<li class="order-info width-20">'.$order_list[$i]['username'].'</li>
												<li class="order-info width-20">'.number_format($order_list[$i]['total_price'], 0).'</li>
												<li class="order-info width-20">'.$order_list[$i]['date'].'</li>
												<li class="order-info width-20">
													'.$htmlState.'
												</li>
											</ul>';
									echo $html;
								}
							}
						?>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

