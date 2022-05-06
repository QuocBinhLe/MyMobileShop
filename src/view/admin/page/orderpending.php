<div class="content-wrapper">
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
				<?php
					include_once('../../controller/orderClass.php');
					$order = new OrderClass();
					$order_list = $order->getOrdersPending();
				?>
				<div class="box-user">
					<?php
						$length = count($order_list);
						if($length > 0 && $order_list[0]['id'] != '') {
							for ($i = 0; $i < $length; $i++) {
								$html = '
										<ul class="order-record" onclick="createOrderInfoLink('.$order_list[$i]['id'].')">
											<li class="order-info width-20">'.$order_list[$i]['id'].'</li>
											<li class="order-info width-20">'.$order_list[$i]['username'].'</li>
											<li class="order-info width-20">'.number_format($order_list[$i]['total_price'], 0).'</li>
											<li class="order-info width-20">'.$order_list[$i]['date'].'</li>
											<li class="order-info width-20">
												<span class=pending-state href="">
													pending
												</span>
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