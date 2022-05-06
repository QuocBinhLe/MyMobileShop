<?php
    include_once '../../lib/session.php';
    Session::checkClientLogin();
    include_once 'layout/header.php';
    include_once 'page/buy-product.php';
    include_once 'layout/footer.php';
?>