<?php
	include_once('../../controller/orderClass.php');
	$order = new OrderClass();
	if (isset($_GET['action']) && isset($_GET['id'])) {
		if ($_GET['action'] == 're-order') {
			$update = $order->updateOrderState($_GET['action'], $_GET['id']);
			if ($update) {
				echo "<script>window.location.href='http://localhost/shop/view/admin/orderpending.php'</script>";
			}
		}
		if ($_GET['action'] == 'done' or $_GET['action'] == 'cancel') {
			$update = $order->updateOrderState($_GET['action'], $_GET['id']);
			if ($update) {
				$id = $_GET['id'];
				echo "<script>window.location.href='http://localhost/shop/view/admin/orderinfo.php?id=$id'</script>";
			}
		}
	}
?>
<script><?php echo("window.location.href"); ?></script>
<div class="content-wrapper">
	<div class="row">
		<div class="list-box">
			<div class="box-margin-40-80">	
				<?php
					if (isset($_GET['id'])){
						$order_info = $order->getOrderInfo($_GET['id']);
						$order_detail = $order->getOrderDetail($_GET['id']);

						$detail_rows = count($order_detail);
						$total_money = 0;
						for ($i=0; $i < $detail_rows; $i++) { 
							$total_money += $order_detail[$i]['money'];
						}
					}
					if (isset($order_info) && $order_info != null) {
						$state = $order_info['state'];
						if ($state == 0) {
							$htmlState = 'Đang xử lý';
							$classState = 'order-state-pending';
						}
						if ($state == -1) {
							$htmlState = 'Đã hủy';
							$classState = 'order-state-cancel';
						}
						if ($state == 1) {
							$htmlState = 'Đã thành công';
							$classState = 'order-state-success';
						}
						$htmlOrderInfo = '
										<div class="box-heading">
											Thông tin hóa đơn
										</div>
										<div class="box">
											<div class="box-group">
												<div>
													<label>ID:</label>
												</div>	
												<span>'.$order_info['id'].'</span>
											</div>
											<div class="box-group">
												<div>
													<label>Tài khoản:</label>
												</div>						
												<span>'.$order_info['username'].'</span>
											</div>
											<div class="box-group">
												<div>
													<label>Email:</label>
												</div>					
												<span>'.$order_info['email'].'</span>						
											</div>
											<div class="box-group">
												<div>
													<label>Số điện thoại:</label>
												</div>					
												<span>'.$order_info['phone'].'</span>						
											</div>
											<div class="box-group">
												<div>
													<label>Địa chỉ giao:</label>
												</div>					
												<span>'.$order_info['address'].'</span>						
											</div>
											<div class="box-group">
												<div>
													<label>Ngày đặt hàng:</label>
												</div>					
												<span>'.$order_info['date'].'</span>						
											</div>
											<div class="box-group">
												<div>
													<label>Tổng giá trị:</label>
												</div>					
												<span>'.number_format($total_money, 0).'đ'.'</span>						
											</div>
											<div class="box-group">
												<div>
													<label>Trạng thái:</label>
												</div>					
												<span class="'.$classState.'">'.$htmlState.'</span>						
											</div>
											<div class="box-group">
												<div>
													<label>Ghi chú:</label>
												</div>
												<span>'.$order_info['note'].'</span>
											</div>	
										</div>';
						echo $htmlOrderInfo;
					}				
				?>
				<?php
					if ($order_detail != null) {
						$htmlOrderDetailHeading = '
													<div class="order_detail">
														<div class="box-margin">
															<ul class="box-column">
																<li class="box-column-name">Tên sản phẩm</li>
																<li class="box-column-name">Số lượng</li>
																<li class="box-column-name">Đơn giá</li>
																<li class="box-column-name">Thành tiền</li>
															</ul>
															<div class="box-user">';
						$htmlOrderDetailFooter = '
															</div>
														</div>
													</div>';
						$htmlTotalMoney = '
											<ul class="order-record border-top">
												<li class="order-info"></li>
												<li class="order-info"></li>
												<li class="order-info"></li>
												<li class="order-info">'.number_format($total_money, 0).'đ'.'</li>
											</ul>';
						if ($state == 0) {
							$htmlAction = '
										<div class="box-action">
											<a class="order-done-act hover-08" href="orderinfo.php?action=done&id='.$_GET['id'].'">
												Hoàn thành
												<i class="fa fa-check"></i>
											</a>
											<div class="mrg-right-16"></div>
											<a class="order-cancel-act hover-08" href="orderinfo.php?action=cancel&id='.$_GET['id'].'">
												Hủy đơn
												<i class="fa fa-times"></i>
											</a>
										</div>';
						} else if ($state == 1) {
							$htmlAction = '<div class="box-action"></div>';
						} else if ($state == -1) {
							$htmlAction = '<div class="box-action">
											<a class="order-done-act hover-08" href="orderinfo.php?action=re-order&id='.$_GET['id'].'">
												Đặt lại
												<i class="fa fa-check"></i>
											</a>
										</div>';
						}
						
						echo $htmlOrderDetailHeading;
						for ($i=0; $i < $detail_rows ; $i++) { 
							$htmlOrderDetail = '
												<ul class="order-record">
													<li class="order-info">'.$order_detail[$i]['name'].'</li>
													<li class="order-info">'.$order_detail[$i]['number'].'</li>
													<li class="order-info">'.number_format($order_detail[$i]['price'], 0).'đ'.'</li>
													<li class="order-info">'.number_format($order_detail[$i]['money'], 0).'đ'.'</li>
												</ul>';
							echo $htmlOrderDetail;
						}
						echo $htmlTotalMoney;
						echo $htmlOrderDetailFooter;
						echo $htmlAction;
					}
				?>
				
			</div>
		</div>
	</div>
</div>