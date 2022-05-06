<?php
    /**
     * Trang API cho client
     */
    if (isset($_SERVER['REQUEST_METHOD'])) {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (isset($_GET['filter'])) {
                // Lọc sản phẩm theo giá
                filterProductByPrice($_GET['filter']);
            }
            else if (isset($_GET['username']) and isset($_GET['password'])) {
                // Đăng nhập user 
                logInClient($_GET['username'], $_GET['password']);
            }
            else if (isset($_GET['action']) and $_GET['action'] == 'logout') {
                // Đăng xuất user
                logOutClient();
            }
            else if (isset($_GET['action']) and isset($_GET['product']) and $_GET['action'] == 'delete-product') {
                // Xóa sản phẩm khỏi giỏ hàng
                deleteProductFromCart($_GET['product']);
            }
            else if (isset($_GET['product'])) {
                // Lấy thông tin sản phẩm bằng ID
                getProductDetail($_GET['product']);
            }
            else if (isset($_GET['search'])) {
                // Hàm tìm kiến sản phẩn bằng tên
                filterProductByName($_GET['search']);
            }
        }
        else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['action']) and $_POST['action'] == 'signup') {
                if (isset($_POST['username']) and isset($_POST['email']) and isset($_POST['password']) and isset($_POST['re_password'])) {
                    // Đăng ký tài khoản user mới
                    insertUser($_POST['username'], $_POST['email'], $_POST['password'], $_POST['re_password']);
                }
            }
            else if (isset($_POST['action']) and $_POST['action'] == 'update-detail') {
                if (isset($_POST['username']) and isset($_POST['email']) and isset($_POST['phone']) and isset($_POST['realname'])) {
                    // Update thông tin cá nhân user
                    updateUserDetail($_POST['username'], $_POST['email'], $_POST['phone'], $_POST['realname']);
                }
            }
            else if (isset($_POST['action']) and $_POST['action'] == 'update-pw') {
                if (isset($_POST['username']) and isset($_POST['password']) and isset($_POST['new-pw']) and isset($_POST['re_new-pw'])) {
                    // Đôi mật khẩu user
                    updateUserPassword($_POST['username'], $_POST['password'], $_POST['new-pw'], $_POST['re_new-pw']);
                }
            }
            else if (isset($_POST['action']) and $_POST['action'] == 'add-cart') {
                if (isset($_POST['id']) and isset($_POST['number'])) {
                    // Thêm sản phẩm vào giỏ hàng
                    addCartProduct($_POST['id'], $_POST['number']);
                }
            }
            else if (isset($_POST['action']) and $_POST['action'] == 'buy') {
                if (true){
                    // Hàm thêm đơn hàng
                    $address = isset($_POST['address']) ? $_POST['address'] : '';
                    $note = isset($_POST['note']) ? $_POST['note'] : '';
                    insertOrder($address, $note);
                }
            }
            else if (isset($_POST['feedback']) and $_POST['feedback'] == 'send') {
                if (isset($_POST['id_product']) and isset($_POST['message'])) {
                    // Hàm gửi feedback
                    sendFeedback($_POST['id_product'], $_POST['message']);
                }
            }
        } 
    }

    // Hàm đăng xuất
    function logOutClient() {
        session_start();
        if (isset($_SESSION['username'])) {
            unset($_SESSION['username']);
            if (isset($_SESSION['cart'])) {
                unset($_SESSION['cart']);
            }
        }
        session_destroy();
        header('Location:index.php');
    }

    // Hàm đăng nhập
    function logInClient($username, $pw)
    {
        include_once '../../lib/session.php';
        include_once '../../helper/format.php';
        include_once '../../controller/clientLogin.php';
    
        $log = new ClientLogin();
        $user = $log->login($username, $pw);

        if ($user['status'] == 1) {
            Session::init();
            Session::set('username', $user['username']);
        }
        echo json_encode($user);
    }

    // Hàm thêm user
    function insertUser($username, $email, $password, $re_password) {
        include_once '../../controller/userClass.php';
        $insert = new UserClass();
        $response = $insert->insertNewUser($username, $email, $password, $re_password);
        echo json_encode($response);
    }

    // Hàm thêm đơn hàng
    function insertOrder($address, $note) {
        session_start();
        include_once '../../controller/orderClass.php';
        include_once '../../controller/productClass.php';
        $order_class = new OrderClass();
        $product_class = new ProductClass();

        $total_money = 0;

        if (isset($_SESSION['username']) and isset($_SESSION['cart']) and count($_SESSION['cart']['product']) > 0) {
            $i = 0;
            foreach($_SESSION['cart']['product'] as $id=>$number) {
                $store = $product_class->getProductDetail($id);
                $number_in_store = $store['number'];
                if (($number_in_store - $number) < 0) {
                    unset($_SESSION['cart']['product'][$id]);
                    $product_cancel[$i] = $store['name'];
                    $i++;
                } else {
                    $total_money += $number * $store['price'];
                }
            }
            $response = $order_class->insertOrder($_SESSION['username'], $total_money, $address, $note, $_SESSION['cart']['product']);
            if ($response['status'] == 1) {
                unset($_SESSION['cart']);

                $warning = '';
                $iswarn = 0;
                if (isset($product_cancel)) {
                    $warning = 'Sản phẩm';
                    foreach($product_cancel as $key) {
                        $warning .= " ".$key;
                    }
                    $iswarn = 1;
                    $warning .= ' không đủ số lượng nên đã hủy';
                }

                $response += array('iswarn'=>$iswarn, 'warning'=>$warning);
            } 
        } 
        else {
            $response['status'] = 0;
            $response['message'] = 'Có chọn cái nào đâu mà đòi mua ?';
        }
        echo json_encode($response);
    }

    // Gửi feedback của khách hàng
    function sendFeedback($id_product, $message){
        session_start();
        $response = array();
        if (isset($_SESSION['username'])) {
            include_once '../../controller/feedbackClass.php';
            $feedback_class = new FeedbackClass();
            if (isset($id_product) and isset($message)) {
                $response = $feedback_class->insertFeedback($id_product, $_SESSION['username'], $message);
            }
        } else {
            $response['status'] = 0;
            $response['message'] = 'Vui lòng đăng nhập để gửi phản hồi';
        }

        echo json_encode($response);
    }

    // Hàm update thông tin user
    function updateUserDetail($username, $email, $phone, $realname) {
        include_once '../../controller/userClass.php';
        $update = new UserClass();
        $response = $update->updateUserDetail($username, $email, $phone, $realname);
        echo json_encode($response);
    }

    // Hàm update mật khẩu user
    function updateUserPassword($username, $password, $new_password, $re_newpw) {
        include_once '../../controller/userClass.php';
        $update = new UserClass();
        $response = $update->updateUserPassword($username, $password, $new_password, $re_newpw);
        echo json_encode($response);
    }

    // Hàm lọc sản phẩm theo giá
    function filterProductByPrice($f) {
        include_once '../../controller/productClass.php';
        $product = new ProductClass();

        $response = array();
        $low = 0;
        $high = 0;
        switch($f) {
            case 0:
                $low = 0;
                $high = 5000000;
                break;
            case 1:
                $low = 5000000;
                $high = 10000000;
                break;
            case 2:
                $low = 10000000;
                $high = 15000000;
                break;
            case 3: 
                $low = 15000000;
                $high = 20000000;
                break;
            case 4: 
                $low = 20000000;
                $high = 100000000;
                break;
            default:
                $low = 0;
                $high = 100000000;
                break;
        }
        $response = $product->getProductListByPrice($low, $high);
        echo json_encode($response);
    }

    function filterProductByName($search) {
        include_once '../../controller/productClass.php';
        $product_class = new ProductClass();
        $response = $product_class->getProductListByName($search);
        echo json_encode($response);
    }

    // Hàm lấy thông tin sản phẩm theo id
    function getProductDetail($id) {
        include_once '../../controller/productClass.php';
        $product = new ProductClass();
        $response = $product->getProductDetail($id);
        echo json_encode($response);
    }

    // Hàm thêm sản phẩm vào giỏ hàng
    function addCartProduct($id, $number) {
        session_start();
        
        $response = array();
        if (isset($_SESSION['cart'])) {
            include_once '../../controller/productClass.php';
            $product = new ProductClass();
            $product_detail = $product->getProductDetail($id);
        
            if (isset($_SESSION['cart']['product'][$id])) {
                $_SESSION['cart']['product'][$id] += $number; 
                if ($_SESSION['cart']['product'][$id] > 0) {
                    $response['status'] = 1;
                    $response['message'] = 'Cập nhập giỏ hàng thành công';
                    $response['id'] = $id;
                    $response['number'] = $_SESSION['cart']['product'][$id];
                    $response['name'] = $product_detail['name'];
                    $response['price'] = $product_detail['price'];
                    $response['image'] = $product_detail['image'];
                } else {
                    $response['status'] = 0;
                    $response['message'] = 'Thêm vào giỏ hàng thất bại';
                }
            } else {
                $_SESSION['cart']['product'][$id] = $number;
                $response['status'] = 1;
                $response['message'] = 'Thêm vào giỏ hàng thành công';
                $response['id'] = $id;
                $response['number'] = $_SESSION['cart']['product'][$id];
                $response['name'] = $product_detail['name'];
                $response['price'] = $product_detail['price'];
                $response['image'] = $product_detail['image'];
            }
        } else {
            $response['status'] = 0;
            $response['message'] = 'Thêm vào giỏ hàng thất bại';
        }

        echo json_encode($response);
    }

    // Hàm xóa sản phẩm khỏi giỏ hàng
    function deleteProductFromCart($id)
    {
        session_start();
        $response = array();
        if (isset($_SESSION['cart'])) {
            if (isset($_SESSION['cart']['product'][$id])) {
                unset($_SESSION['cart']['product'][$id]);
                $response['status'] = 1;
                $response['message'] = 'Xóa sản phẩm khỏi giỏ hàng thành công';
            } else {
                $response['status'] = 0;
                $response['message'] = 'Xóa sản phẩm thất bại'; 
            }
        } else {
            $response['status'] = 0;
            $response['message'] = 'session error';
        }

        echo json_encode($response);
    }
