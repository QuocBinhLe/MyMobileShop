                <?php
                    include_once '../../controller/productClass.php';
                    include_once '../../controller/orderClass.php';

                    $product_class = new ProductClass();
                    $order_class = new OrderClass();

                    $total_money = 0;
                    $state = '';
                    $htmlProductsList = '';
                    if (isset($_GET['id'])) {
                        $order_info = $order_class->getOrderInfo($_GET['id']);
                        $order_detail = $order_class->getOrderDetail($_GET['id']);

                        switch($order_info['state']){
                            case 0:
                                $state = 'Đang xử lý';
                                break;
                            case 1:
                                $state = 'Hoàn thành';
                                break;
                            case -1:
                                $state = 'Bị hủy';
                                break;
                            default:
                                $state = 'Bị hủy';
                                break;
                        }

                        
                        }

                        $i = 0;
                        foreach($order_detail as $item) {
                            $total_money += $item['money'];
                            $products = $product_class->getProductDetail($item['id']);
                            $htmlFeedback = '';
                            if ($order_info['state'] == 1) {
                                    $htmlFeedback = '
                                            <div class="profile__content__part-heading">
                                                Đánh giá sản phẩm '.$products['name'].'
                                            </div>
                                            <div class="profile__content__part-body">
                                                <form class="row" id="feedback__customer-product-'.$products['id'].'" method="POST" action="">
                                                    <textarea class="profile__detail-input width-100pr" name="message" cols="30" rows="10" placeholder="Để lại đánh giá sản phẩm ..."></textarea>
                                                    <input type="hidden" name="id_product" value="'.$products['id'].'">
                                                    <input type="hidden" name="feedback" value="send">
                                                </form>
                                                <button class="buy__product__button send__review__button" id="'.$products['id'].'">Gửi đánh giá</button>
                                            </div>';
                            $htmlProductsList .= '
                                            <div class="profile__content__part-body">
                                                <div class="row">
                                                    <div class="product__cart__image-box col l-3 m-3">
                                                        <img class="" src="../../asset/img/product/upload/'.$products['image'].'" alt="product image">
                                                    </div>
                                                    <div class="product__cart__info col l-7 m-7">
                                                        <h3 class="product__cart__name">'.$products['name'].'</h3>
                                                        <div style="margin-top: 10px; font-size: 1.6rem">
                                                            <label>Số lượng: </label>
                                                            <label class="product__cart__number">'.$order_detail[$i]['number'].'</label>
                                                        </div>
                                                    </div>
                                                    <div class="product__cart__price col l-2 m-2">
                                                        '.number_format(($order_detail[$i]['number'] * $products['price']), 0).'đ
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mrg-top-40"></div>
                                            '.$htmlFeedback.'
                                            <div class="mrg-top-40"></div>
                                            <div class="mrg-top-40"></div>';

                            $i++;
                        }
                    }
                ?>
                <div class="profile__content__wrapper col l-10 m-10">
                    <div class="profile__content__part">
                        <div class="profile__content__part-heading">
                            Thông tin đơn hàng
                        </div>
                        <div class="profile__content__part-body">
                            <div class="row">
                                <div class="profile__detail col l-5 m-5 c-12">
                                    <label>ID đơn hàng</label>
                                    <input class="profile__detail-input" readonly type="text" value="<?php echo $order_info['id'] ?>">
                                </div>
                                <div class="profile__detail col l-5 m-5 c-12">
                                    <label>Số điện thoại</label>
                                    <input class="profile__detail-input" readonly type="text" value="<?php echo $order_info['phone'] ?>">
                                </div>
                                <div class="profile__detail col l-5 m-5 c-12">
                                    <label>Tổng giá trị</label>
                                    <input class="profile__detail-input" readonly type="text" value="<?php echo number_format($total_money, 0) ?>">
                                </div>
                                <div class="profile__detail col l-5 m-5 c-12">
                                    <label>Ngày đặt</label>
                                    <input class="profile__detail-input" readonly type="text" value="<?php echo $order_info['date'] ?>">
                                </div>
                                <div class="profile__detail col l-5 m-5 c-12">
                                    <label>Địa chỉ</label>
                                    <input class="profile__detail-input" readonly type="text" value="<?php echo $order_info['address'] ?>">
                                </div>
                                <div class="profile__detail col l-5 m-5 c-12">
                                    <label>Trạng thái</label>
                                    <input class="profile__detail-input" readonly type="text" value="<?php echo $state; ?>">
                                </div>
                                <div class="profile__detail col l-12 m-12 c-12">
                                    <label>Lời nhắn</label>
                                    <textarea class="profile__detail-input width-100pr" readonly id="" cols="30" rows="10"><?php echo $order_info['note']; ?></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- dữ liệu product của hóa đơn -->
                        <?php echo $htmlProductsList; ?>
                    </div>
                    <!-- <div class="profile__content__part">
                        
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
<script>sendFeedback()</script>