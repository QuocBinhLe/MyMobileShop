<?php
    if (isset($_SESSION['cart'])) {
        include_once '../../controller/productClass.php';
        $product_class = new ProductClass();

        $products = array();
        $i = 0;
        $total_money = 0;
        $htmlProductsList = '';
        foreach($_SESSION['cart']['product'] as $key => $value) {
            $products[$i] = $product_class->getProductDetail($key);
            // biến html để đưa dữ liệu vào page
            $htmlProductsList .= '
                                <div class="profile__content__part-body">
                                    <div class="row">
                                        <div class="product__cart__image-box col l-3 m-3">
                                            <img class="" src="../../asset/img/product/upload/'.$products[$i]['image'].'" alt="product image">
                                        </div>
                                        <div class="product__cart__info col l-7 m-7">
                                            <h3 class="product__cart__name">'.$products[$i]['name'].'</h3>
                                            <div>
                                                <label>Số lượng: </label>
                                                <label class="product__cart__number">'.$value.'</label>
                                            </div>
                                            <div>
                                                <a class="cart__delete__product" href="client-api?action=delete-product&product='.$key.'">Xóa</a>
                                            </div>
                                        </div>
                                        <div class="product__cart__price col l-2 m-2">
                                            '.number_format(($value * $products[$i]['price']), 0).'đ
                                        </div>
                                    </div>
                                </div>';
            // tính thành tiền
            $total_money += ($value * $products[$i]['price']);
            $i++;
        }
    }
?>
<div class="main">
    <div class="mrg-header">
    </div>
    <div class="grid wide">
        <div class="row" style="align-items: start">
            <div class="profile__content__wrapper col l-9 m-9 c-12">
                <div class="profile__content__part">
                    <div class="profile__content__part-heading">
                        Giỏ hàng
                    </div>
                    <!-- đổ dữ liệu sản phẩm giỏ hàng ở đây -->
                    <?php echo $htmlProductsList ?>
                </div>
            </div>
            <div class="profile__content__wrapper col l-3 m-3 c-12">
                <div class="profile__content__part-body cart__total__price">
                    <div class="row flex-between">
                        <strong>Tạm tính</strong>
                        <label><?php echo number_format($total_money, 0) ?>đ</label>
                    </div>
                    <div class="row">
                        <!-- nút đi tới trang đặt hàng -->
                        <a class="order__button" href="buy-product.php">Đặt hàng</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>deleteProductFromCart()</script>