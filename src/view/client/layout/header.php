<?php
if (version_compare(phpversion(), '5.4.0', '<')) {
    if (session_id() == "") {
        session_start();
    }
} else {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="icon" type="image/icon" href="../../asset/img/logo/icon-store.png">
    <link rel="stylesheet" href="../../asset/css/base.css">
    <link rel="stylesheet" href="../../asset/css/grid.css">
    <link rel="stylesheet" href="../../asset/css/main.css">
    <link rel="stylesheet" href="../../asset/css/style.css">
    <script src="../../asset/js/app.js"></script>
    <script src="../../asset/js/slide.js"></script>
    <script src="../../asset/js/format.js"></script>
    <script src="../../asset/js/ajax.js"></script>
    <script src="../../asset/js/asteroid-alert.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link href="https://css.gg/shopping-cart.css" rel="stylesheet">
</head>

<body>
    <!-- header -->
    <header class="header">
        <div class="grid wide">
            <div class="header__nav">
                <div class="logo__box">
                    <a href="index.php">
                        <img src="../../asset/img/logo/store-logo.png" alt="">
                    </a>
                </div>
                <div class="header__search">
                    <div class="flex-wrapper align-center search__wrapper">
                        <input type="text" class="search__box" placeholder="Tìm kiếm">
                        <a class="search-button" href="">
                            <i class="fas fa-search search-button"></i>
                        </a>
                        <div class="search__result-box">
                            <ul class="search__result-list">
                                <!-- Dữ liệu search sản phẩm -->
                            </ul>
                        </div>
                    </div>
                </div>
                <ul class="right__nav">
                    <li class="right__nav__item cart__nav">
                        <i class="fas fa-shopping-cart"></i>
                        <?php
                        $htmlCartBox = '';
                        if (isset($_SESSION['username'])) {
                            if (!isset($_SESSION['cart'])) {
                                $_SESSION['cart'] = array(
                                    'id' => md5($_SESSION['username']),
                                    'product' => array()
                                );
                                $htmlCartBox = '
                                                    <ul class="cart__nav-list">
                                                        <div class="cart__empty">
                                                            <span>Bạn không có sản phẩm nào trong giỏ hàng</span>
                                                        </div>
                                                    </ul>';
                            } else if (count($_SESSION['cart']['product']) > 0) {
                                include_once '../../controller/productClass.php';
                                $product = new ProductClass();
                                $htmlCartItem = '';
                                foreach ($_SESSION['cart']['product'] as $key => $value) {
                                    $product_detail = $product->getProductDetail($key);
                                    $htmlCartItem .= '
                                                        <li class="cart__nav__list-item" id="cart__item-' . $key . '">
                                                            <a class="cart__nav__list-link" href="product-detail.php?id=' . $key . '">
                                                                ' . $product_detail['name'] . '
                                                                <div class="cart__nav__list-item--info">
                                                                    <span class="cart__item-price">' . number_format($product_detail['price'], 0) . '</span>
                                                                    <span class="cart__item-number">x' . $value . '</span>
                                                                </div>
                                                            </a>                         
                                                        </li>';
                                }
                                $number_cart = 0;
                                foreach ($_SESSION['cart']['product'] as $item => $value) {
                                    $number_cart += $value;
                                }
                                $htmlCartBox = '
                                                    <span class="span__cart__number">' . $number_cart . '</span>
                                                    <ul class="cart__nav-list">
                                                        ' . $htmlCartItem . '
                                                        <li class="cart__nav__list-item cart__link">
                                                            <a href="cart.php">
                                                                Xem giỏ hàng
                                                                <i class="fas fa-shopping-bag"></i>
                                                            </a>
                                                        </li>
                                                    </ul>';
                            } else {
                                $htmlCartBox = '
                                                    <ul class="cart__nav-list">
                                                        <div class="cart__empty">
                                                            <span>Bạn không có sản phẩm nào trong giỏ hàng</span>
                                                        </div>
                                                    </ul>';
                            }
                        } else {
                            if (isset($_SESSION['cart'])) {
                                unset($_SESSION['cart']);
                            }
                            $htmlCartBox = '
                                                <ul class="cart__nav-list">
                                                    <div class="cart__empty">
                                                        <span>Bạn không có sản phẩm nào trong giỏ hàng</span>
                                                    </div>
                                                </ul>';
                        }
                        echo $htmlCartBox;
                        ?>
                    </li>
                    <li class="right__nav__item user__nav not__log-action">
                        <i class="far fa-user"></i>
                        <ul class="user__nav-list">
                            <?php
                            $htmlUser = '';
                            if (!isset($_SESSION['username'])) {
                                $htmlUser = '
                                            <li class="user__nav__list-item">
                                                <span class="user__nav__list-link" id="log-in__action">Đăng nhập</span>
                                            </li>
                                            <li class="user__nav__list-item">
                                                <span class="user__nav__list-link" id="sign-up__action">Tạo tài khoản</span>
                                            </li>';
                            } else {
                                $htmlUser = '
                                                <li class="user__nav__list-item">
                                                    <a class="user__nav__list-link" id="" href="profile.php">Tài khoản</a>
                                                </li>
                                                <li class="user__nav__list-item">
                                                    <a class="user__nav__list-link" id="log-out__action" href="client-api.php?action=logout">Đăng xuất</a>
                                                </li>';
                            }
                            echo $htmlUser;
                            ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="modal" style="display: none;">
        <div class="modal__overlay">
            <div class="modal__body">
                <div class="modal__form__heading">
                    <div class="form__heading__box active__form" id="log__form">
                        Đăng nhập
                    </div>
                    <div class="form__heading__box" id="sign__form">
                        Đăng ký
                    </div>
                </div>
                <form id="form__modal-log" class="modal__form">
                    <div class="form-group">
                        <label>
                            Tên tài khoản
                        </label>
                        <input class="form-input" required type="text" name="username">
                    </div>
                    <div class="form-group">
                        <label>
                            Mật khẩu
                        </label>
                        <input class="form-input" required type="password" name="password">
                    </div>
                    <div class="form-group">
                        <span class="modal__error__message" id="modal__error__message-login"></span>
                    </div>
                    <div class="form-group">
                        <button class="modal__form__submit-button">Đăng nhập</button>
                    </div>

                    <div class="form-group forgot__pass">
                        <a href="">Bạn quên mật khẩu ?</a>
                    </div>
                </form>
                <form id="form__modal-sign" class="modal__form" style="display: none;">
                    <div class="form-group">
                        <label>
                            Tên tài khoản
                        </label>
                        <input class="form-input" required type="text" name="username">
                    </div>
                    <div class="form-group">
                        <label>
                            Email
                        </label>
                        <input class="form-input" required type="email" name="email">
                    </div>
                    <div class="form-group">
                        <label>
                            Mật khẩu
                        </label>
                        <input class="form-input" required type="password" name="password">
                    </div>
                    <div class="form-group">
                        <label>
                            Nhập lại mật khẩu
                        </label>
                        <input class="form-input" required type="password" name="re_password">
                    </div>
                    <div class="form-group">
                        <span class="modal__error__message" id="modal__error__message-signup"></span>
                    </div>
                    <input type="hidden" name="action" value="signup">
                    <div class="form-group">
                        <button class="modal__form__submit-button">Đăng ký</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        searchProduct();
        catchEventLog();
        login();
        signup();
        logout();
    </script>