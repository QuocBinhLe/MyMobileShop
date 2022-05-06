
<?php
    include_once '../../controller/productClass.php';
    $product = new ProductClass();
    $all_product = $product->getProductList();
    $hot_product = $product->getProductHot();

    $htmlAllProduct = '';
    $htmlHotProduct = '';
    foreach($all_product as $product_item) {
        if ($product_item['name'] != '' and $product_item['number'] > 0) {
            $htmlAllProduct .= '
                                <div class="product__item__wrapper col l-2-4 m-3 c-12">
                                    <a href="product-detail.php?id='.$product_item['id'].'" class="product__item ">
                                        <div class="product__item-img">
                                            <img src="../../asset/img/product/upload/'.$product_item['image'].'" alt="">
                                        </div>
                                        <div class="product__item-body">
                                            <div class="product__item-heading">
                                                '.$product_item['name'].'
                                            </div>
                                            <div class="product__item-content">
                                                <span class="product__item-price">'.number_format($product_item['price'], 0).'đ</span>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="add__cart__box">
                                        <span class="add__cart-btn">Thêm vào giỏ hàng</span>
                                    </div>
                                </div>`';
        }
    }
    foreach($hot_product['product'] as $item) {
        if ($item['number'] > 0) {
            $htmlHotProduct .= '
                                <div class="product__item__wrapper col l-2-4 m-3 c-12">
                                    <a href="product-detail.php?id='.$item['id'].'" class="product__item ">
                                        <div class="product__item-img">
                                            <img src="../../asset/img/product/upload/'.$item['image'].'" alt="">
                                        </div>
                                        <div class="product__item-body">
                                            <div class="product__item-heading">
                                                '.$item['name'].'
                                            </div>
                                            <div class="product__item-content">
                                                <span class="product__item-price">'.number_format($item['price'], 0).'đ</span>
                                                <span class="product__item-gift">
                                                    <i class="fas fa-gift"></i>
                                                    Quà tặng kèm
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="add__cart__box">
                                        <span class="add__cart-btn">Thêm vào giỏ hàng</span>
                                    </div>
                                </div>';
        }
    }

    include_once '../../controller/pageClass.php';
    $page_class = new PageClass();
    $content = $page_class->getContentInro();
?>
    <div class="main">
        <div class="mrg-header"></div>
        <div class="grid wide">
            <!-- slide show && introduction -->
            <div class="introduction row">
                <!-- Slide show -->
                <div class="slide__box col c-12 m-8 l-8">
                    <div class="slides">
                        <img class="slide__img" src="../../asset/img/slider/apple-slide1.jpg" alt="">
                        <img class="slide__img" src="../../asset/img/slider/apple-slide2.jpg" alt="">
                        <img class="slide__img" src="../../asset/img/slider/pixel-slide1.jpg" alt="">
                    </div>
                </div>
                <!-- Introduction -->
                <div class="intro__box col c-0 m-4 l-4">
                    <div class="intro__item">
                        <span class="intro__content"><?php echo $content['slogan']; ?></span>
                    </div>
                    <div class="intro__item">
                        <span class="intro__content"><?php echo $content['content_1']; ?></span>
                    </div>
                    <div class="intro__item">
                        <span class="intro__content"><?php echo $content['content_2']; ?></span>
                    </div>
                </div>
            </div>
            <!-- hot product -->
            <div class="mrg-top-40"></div>
            <div class="product__wrapper col l-12 m-12 c-12">
                <div class="product__wrapper-title">
                    <h3>Sản phẩm hot</h3>
                </div>
                <div class="product__wrapper-display">
                    <div id="product__hot" class="row flow-y">
                        <!-- đổ dữ liệu vào đây -->
                        <?php echo $htmlHotProduct; ?>
                    </div>
                </div>
            </div>
            <!-- product -->
            <div class="mrg-top-40"></div>
            <div class="product__wrapper col l-12 m-12 c-12">
                <div class="product__wrapper-title">
                    <h3>Sản phẩm thông thường</h3>
                </div>
                <div class="filter__price">
                    <div class="row">
                        <div class="filter__price-box col l-2 m-2 c-2">
                            <label>Khoảng giá</label>
                        </div>
                        <div class="filter__price-box col l-10 m-10 c-10">
                            <div class="row">
                                <div class="filter__price__selection col l-2-4 m-3 c-3">
                                    <button class="filter__price-btn" id="filter__price__level_0">Dưới 5 triệu</button>
                                </div>
                                <div class="filter__price__selection col l-2-4 m-3 c-3">
                                    <button class="filter__price-btn" id="filter__price__level_1">5-10 triệu</button>
                                </div>
                                <div class="filter__price__selection col l-2-4 m-3 c-3">
                                    <button class="filter__price-btn" id="filter__price__level_2">10-15 triệu</button>
                                </div>
                                <div class="filter__price__selection col l-2-4 m-3 c-3">
                                    <button class="filter__price-btn" id="filter__price__level_3">15-20 triệu</button>
                                </div>
                                <div class="filter__price__selection col l-2-4 m-3 c-3">
                                    <button class="filter__price-btn" id="filter__price__level_4">Trên 20 triệu</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product__wrapper-display">
                    <div id="product__all" class="row">
                        <!-- đổ dữ liệu sản phẩm vào đây -->
                        <?php echo $htmlAllProduct; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        filterProduct();
        addToCart();
    </script>