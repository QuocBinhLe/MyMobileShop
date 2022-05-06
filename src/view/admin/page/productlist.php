<?php
	include_once '../../controller/productClass.php';
	$product = new ProductClass();

	if(isset($_SERVER['REQUEST_METHOD']) and $_SERVER['REQUEST_METHOD'] == 'GET' and isset($_GET['id']) and isset($_GET['action']) and $_GET['action'] == 'delete') {
		$product_del = $product->deleteProductById($_GET['id']);
	}

	$product_brand = $product->getNumberOfProduct();
	$product_pending = $product->getProductPending();

	$product_list = $product->getProductList();
	$length = count($product_list);
?>

<div class="content-wrapper">
	<div class="flex-col">
		<div class="">
			<div class="row">
				<div style="margin-left: 8px;"></div>
				<div class="strect-card purple-linear">
					<div class="card-body">
						<div class="card-heading">
							<span>Số sản phẩm</span>
						</div>
						<div class="card-content">
							<span>
								<?php echo $product_brand['brand']; ?>
							</span>
						</div>
					</div>
				</div>
				<div class="strect-card purple-linear">
					<div class="card-body">
						<div class="card-heading">
							<span>Tồn kho</span>
						</div>
						<div class="card-content">
							<span>
								<?php echo $product_brand['store']; ?>
							</span>
						</div>
					</div>
				</div>
				<div class="strect-card purple-linear">
					<div class="card-body">
						<div class="card-heading">
							<span>Đang vận chuyển</span>
						</div>
						<div class="card-content">
							<span>
								<?php echo $product_pending['pending']; ?>
							</span>
						</div>
					</div>
				</div>
				<div style="margin-right: 8px;"></div>
			</div>
		</div>
		<div class="content-wrapper height-auto">
			<div class="row">
				<div class="list-box">
					<div class="box-margin">
						<ul class="box-column">
							<li class="box-column-name width-42px"></li>
							<li class="box-column-name width-20">Tên sản phẩm</li>
							<li class="box-column-name width-20">Đơn giá</li>
							<li class="box-column-name width-20">Số lượng</li>
							<li class="box-column-name width-20">Hình ảnh</li>
							<li class="box-column-name width-20">Thao tác</li>
						</ul>
						<div class="box-user">
							<?php
								
								if ($length > 0) {
									for ($i=0; $i < $length ; $i++) { 
										$index = $i + 1;
										$htmlListProduct = '
														<ul class="product-record hover-08">
															<li class="product-info width-42px" style="color: 9d9b9e;">'.$index.'</li>
															<li class="product-info width-20">'.$product_list[$i]['name'].'</li>
															<li class="product-info width-20">'.number_format($product_list[$i]['price'], 0).'đ</li>
															<li class="product-info width-20">'.$product_list[$i]['number'].'</li>
															<li class="product-info width-20 product-img-wrapper">
																	<img src="../../asset/img/product/upload/'.$product_list[$i]['image'].'">
															</li>
															<li class="product-info width-20">
																<a class=modify-action href="productinfo.php?id='.$product_list[$i]['id'].'">
																	<i class="fas fa-pen"></i>
																</a>
																<a class=del-action href="productlist.php?action=delete&id='.$product_list[$i]['id'].'">
																	<i class="fa fa-times"></i>
																</a>
															</li>
														</ul>';
										echo $htmlListProduct;
									}
								}
							?>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
