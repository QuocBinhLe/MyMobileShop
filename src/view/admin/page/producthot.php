<?php
    include_once '../../controller/productClass.php';
	$product = new ProductClass();

    $product_hot = $product->getProductHot();
    $length = count($product_hot['product']);

	$product_not_hot = $product->getProductNotHot();
?>
<div class="content-wrapper">
    <div class="flex-col">
        <div>
            <div class="row" style="justify-content: start">
                <div style="margin-left: 8px;"></div>
                <div class="strect-card purple-linear">
                    <div class="card-body">
                        <div class="card-heading">
                            <span>Số sản phẩm đang bán chạy</span>
                        </div>
                        <div class="card-content">
                            <span id="card-content-value">
                                <?php echo $product_hot['number']['number'] ?>
                            </span>
                        </div>
                    </div>
                </div>
				<div style="margin-right: 8px;"></div>
            </div>
        </div>
    </div>
    <div class="content-wrapper height-auto">
        <div class="row">
            <div class="list-box">
                <div class="box-margin">
                    <div class="box-heading" style="padding: 20px 10px;">Sản phẩm đang bán chạy</div>
                    <ul class="box-column" style="margin-top: 10px">
                        <li class="box-column-name width-42px"></li>
                        <li class="box-column-name width-20">Tên sản phẩm</li>
                        <li class="box-column-name width-20">Đơn giá</li>
                        <li class="box-column-name width-20">Số lượng</li>
                        <li class="box-column-name width-20">Hình ảnh</li>
                        <li class="box-column-name width-20">Thao tác</li>
                    </ul>
                    <div class="box-user" id="hot__product__content">
                        <?php
                            if($length > 0) {
                                $index = 0;
                                foreach($product_hot['product'] as $item) {
                                    $index++;
                                    $htmlListProduct = '
                                                    <ul class="product-record hover-08">
                                                        <li class="product-info width-42px" style="color: 9d9b9e;">'.$index.'</li>
                                                        <li class="product-info width-20">'.$item['name'].'</li>
                                                        <li class="product-info width-20">'.number_format($item['price'], 0).'đ</li>
                                                        <li class="product-info width-20">'.$item['number'].'</li>
                                                        <li class="product-info width-20 product-img-wrapper">
                                                                <img src="../../asset/img/product/upload/'.$item['image'].'">
                                                        </li>
                                                        <li class="product-info width-20">
                                                            <a class=del-action href=".php?action=delete&id='.$item['id'].'" onclick="return pushProductToHot('.$item['id'].')">
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
        <div class="row">
            <div class="list-box">
                <div class="box-margin">
                    <div class="box-heading" style="padding: 20px 10px;">Danh sách sản phẩm có thể thêm</div>
                    <ul class="box-column" style="margin-top: 10px">
                        <li class="box-column-name width-42px"></li>
                        <li class="box-column-name width-20">Tên sản phẩm</li>
                        <li class="box-column-name width-20">Đơn giá</li>
                        <li class="box-column-name width-20">Số lượng</li>
                        <li class="box-column-name width-20">Hình ảnh</li>
                        <li class="box-column-name width-20">Thao tác</li>
                    </ul>
					<div class="box-user" id="not-hot__product__content">
                        <?php
                            if(count($product_not_hot) > 0) {
                                $index = 0;
                                foreach($product_not_hot as $item) {
                                    $index++;
                                    $htmlListProduct = '
                                                    <ul class="product-record hover-08">
                                                        <li class="product-info width-42px" style="color: 9d9b9e;">'.$index.'</li>
                                                        <li class="product-info width-20">'.$item['name'].'</li>
                                                        <li class="product-info width-20">'.number_format($item['price'], 0).'đ</li>
                                                        <li class="product-info width-20">'.$item['number'].'</li>
                                                        <li class="product-info width-20 product-img-wrapper">
                                                                <img src="../../asset/img/product/upload/'.$item['image'].'">
                                                        </li>
                                                        <li class="product-info width-20">
                                                            <a class=add-action href="producthot.php?action=add&id='.$item['id'].'" onclick="return dropHotProduct('.$item['id'].')">
																<i class="fas fa-plus"></i>
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