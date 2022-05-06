<?php
    include_once '../../controller/userClass.php';
    include_once '../../controller/productClass.php';
    $user_class = new UserClass();
    $product_class = new ProductClass();

    // lấy thông tin user qua $_SESSION['username']
    $user = $user_class->getUserInfo($_SESSION['username']);

    $products = array();
    $i = 0;
    $total_money = 0;
    $htmlProductsList = '';
    
    foreach($_SESSION['cart']['product'] as $key => $value) {
        $products[$i] = $product_class->getProductDetail($key);
        // biến html để đưa dữ liệu vào page
        $htmlProductsList .= '
                            <div class="row align-start ">
                                <div class="buy__product__detail l-8 m-8 c-9">
                                    <label class="buy__product__number">'.$value.' x </label>
                                    <label class="buy__product__name">'.$products[$i]['name'].'</label>
                                </div>
                                <div class="buy__price__detail buy__product__price l-4 m-4 c-3">
                                    '.number_format(($value * $products[$i]['price']), 0).'
                                </div>
                            </div>';
        // tính thành tiền
        $total_money += ($value * $products[$i]['price']);
        $i++;
    }
    $_SESSION['cart']['total_money'] = $total_money;
?>
<div class="main">
    <div class="mrg-header">
    </div>
    <div class="grid wide">
        <div class="row" style="align-items: start">
            <div class="profile__content__wrapper col l-9 m-9 c-12">
                <div class="profile__content__part">
                    <div class="profile__content__part-heading">
                        Đặt hàng
                    </div>
                    <div class="profile__content__part-body">
                        <!-- form để đặt sản phẩm -->
                        <form class="row" id="form__buy__product" action="" method="POST">
                            <div class="profile__detail col l-5 m-5 c-12">
                                <label>Họ và tên</label>
                                <input class="profile__detail-input" readonly type="text" value="<?php echo $user['realname'] ?>">
                            </div>
                            <div class="profile__detail col l-5 m-5 c-12">
                                <label>Số điện thoại</label>
                                <input class="profile__detail-input" readonly type="number" value="<?php echo $user['phone'] ?>">
                            </div>
                            <div class="profile__detail col l-12 m-12 c-12">
                                <label>Địa chỉ nhận</label>
                                <input class="profile__detail-input width-90pr" name="address" type="text" value="" placeholder="Tỉnh, thành phố, phường">
                            </div>
                            <div class="profile__detail col l-12 m-12 c-12">
                                <label>Ghi chú cho shipper</label>
                                <textarea class="profile__detail-input width-90pr" name="note" id="" cols="30" rows="10" placeholder="Giao anh abc..."></textarea>
                            </div>
                            <input type="hidden" name="action" value="buy">
                        </form>
                    </div>
                </div>
            </div>
            <div class="profile__content__wrapper col l-3 m-3 c-12">
                <!-- chi tiết hóa đơn -->
                <div class="profile__content__part">
                    <div class="profile__content__part-heading">
                        Đơn hàng
                    </div>
                    <div class="profile__content__part-body">
                        <!-- đổ dữ liệu đơn hàng vào đây -->
                        <?php echo $htmlProductsList; ?>
                        <div class="row border-top-light">
                            <div class="col l-5 m-5 c-6 buy__total__price-label">Thành tiền</div>
                            <div class="l-7 m-7 c-6 buy__total__price-value"><?php echo number_format($total_money, 0) ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- nút submit đơn hàng -->
            <button class="buy__product__button">Đặt mua</button>
        </div>
    </div>
</div>
<script>
    buyProduct();
</script>