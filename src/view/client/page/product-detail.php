<?php
    include_once '../../controller/productClass.php';
    $product = new ProductClass();
    $htmlProductDetail = '';
    if (isset($_GET['id'])) {
        $product_detail = $product->getProductDetail($_GET['id']);
        $htmlProductDetail .= '
                        <h3 class="product__heading">'.$product_detail['name'].'</h3>
                        <div class="row">
                            <div class="product__detail l-7 m-7 c-12">
                                <ul class="product__detail-list">
                                    <li class="product__detail-item">
                                        <strong>Màn hình:</strong>
                                        '.$product_detail['screen'].'
                                    </li>
                                    <li class="product__detail-item">
                                        <strong>RAM:</strong>
                                        '.$product_detail['ram'].'
                                    </li>
                                    <li class="product__detail-item">
                                        <strong>Bộ nhớ trong:</strong>
                                        '.$product_detail['rom'].'
                                    </li>
                                    <li class="product__detail-item">
                                        <strong>CPU:</strong>
                                        '.$product_detail['cpu'].'
                                    </li>
                                    <li class="product__detail-item">
                                        <strong>GPU:</strong>
                                        '.$product_detail['gpu'].'
                                    </li>
                                    <li class="product__detail-item">
                                        <strong>Camera sau:</strong>
                                        '.$product_detail['camera_back'].'
                                    </li>
                                    <li class="product__detail-item">
                                        <strong>Pin:</strong>
                                        '.$product_detail['pin'].'
                                    </li>
                                    <li class="product__detail-item">
                                        <strong>Thẻ sim:</strong>
                                        '.$product_detail['sim'].'
                                    </li>
                                    <li class="product__detail-item">
                                        <strong>Hệ điều hành:</strong>
                                        '.$product_detail['operator'].'
                                    </li>
                                </ul>
                            </div>
                            <div class="l-5 m-5 c-12">
                                <div class="product__detail-more">
                                    <strong>Bảo hành</strong>
                                    <ul>
                                        <li>Bảo hành trong 24 tháng tại các của hàng</li>
                                        <li>Đổi trả trong vòng 15 ngày</li>
                                    </ul>
                                </div>
                                <div class="product__detail-more">
                                    Giảm
                                    <span style="color: red;">150.000</span>
                                    khi mua trực tiếp tại cửa hàng
                                </div>
                            </div>
                        </div>';
    }
?>
<div class="main">
        <div class="mrg-header"></div>
        <div class="grid wide">
            <div class="row sm-gutter">
                <div class="product__box col l-6 m-5 c-12">
                    <figure class="product__box__image">
                        <img src="../../asset/img/product/upload/<?php echo $product_detail['image']; ?>" alt="">
                    </figure>
                </div>
                <div class="product__box col l-6 m-5 c-12">
                    <div class="product__box__detail">
                        <!-- đổ dữ liệu product detaill ở đây -->
                        <?php echo $htmlProductDetail; ?>
                    </div>
                </div>
            </div>
            <div class="mrg-top-40"></div>
            <div class="row sum-gutter">
                <div class="desc_heading l-12 m-12 c-12">Mô tả</div>
                <div class="desc_content l-12 m-12 c-12">
                    <?php echo $product_detail['description']; ?>
                    <!-- Iphone 12 pro max với hiệu năng mạnh mẽ, khả năng tối ưu sẽ mang lại cho bạn trải nghiệm tuyệt vời -->
                </div>
            </div>
            <div class="mrg-top-40"></div>
            <div class="mrg-top-40"></div>
            <div class="row sm-gutter">
                <div class="review__comment-heading l-12 m-12 c-12">
                    Đánh giá khách hàng
                </div>
                <div class="review__comment-content l-12 m-12 c-12">
                    <!-- Dữ liệu bài đánh giá khách hàng -->
                    <?php
                        include_once '../../controller/feedbackClass.php';
                        $feedback_class = new FeedbackClass();
                        $htmlFeedback = '';
                        if (isset($_GET['id'])) {
                            $feedbacks = $feedback_class->getFeedbackById($_GET['id']);
                            if ($feedbacks) {
                                foreach($feedbacks as $feedback) {
                                    $htmlFeedback .= '
                                                    <div class="user__feedback">
                                                        <i class="far fa-user"></i>
                                                        <label class="user__feedback-name">'.$feedback['username'].'</label>
                                                        <label class="user__feedback-datetime">'.$feedback['date'].'</label>
                                                        <textarea class="profile__detail-input width-100pr" readonly id="" cols="30" rows="3">'.$feedback['message'].'</textarea>
                                                    </div>';
                                }
                            }
                        }
                        echo $htmlFeedback;
                    ?>
                    
                </div>
            </div>
            <div class="mrg-top-40"></div>
            <div class="mrg-top-40"></div>
        </div>
    </div>

    <div class="add__cart__sticky">
        <div class="grid wide">
            <div class="row">
                <div class="add__number c-0 m-4 l-2">
                    <div id="number__add-cart--decrease" onclick="decreaseCart()">-</div>
                    <input type="number" name="number__add-cart" id="number__add-cart" value="1" onchange="validateCart()">
                    <div id="number__add-cart--increase" onclick="increaseCart()">+</div>
                </div>
                <div class="l-2 m-4 c-0">
                    <div class="sticky__price">
                        <span id="sticky__product__price"><?php echo $product_detail['price'] ?></span>
                        <input type="hidden" id="product__price" value="<?php echo $product_detail['price'] ?>"></input>
                    </div>
                </div>
                <div class="l-3 m-4 c-12">
                    <button class="add__cart-btn" id="add__cart-number">
                        <i class="fas fa-shopping-bag"></i>
                        Thêm vào giỏ hàng
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        formatMoney('#sticky__product__price');
        addToCart();
    </script>