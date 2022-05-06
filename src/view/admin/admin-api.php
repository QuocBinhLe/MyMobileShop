<?php
    if (isset($_SERVER['REQUEST_METHOD'])) {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (isset($_GET['action']) and isset($_GET['id'])) {
                switch ($_GET['action']) {
                    case 'delete':
                        dropHotProduct($_GET['id']);
                        (getHotProductResponse());
                        break;
                    case 'add':
                        pushHotProduct($_GET['id']);
                        (getHotProductResponse());
                        break;
                    default:
                        break;
                }
            }
        }
        else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['content']) and $_POST['content'] == 'update') {
                if (isset($_POST['slogan']) and isset($_POST['content_1']) and isset($_POST['content_2'])){
                    updateContentIntro($_POST['slogan'], $_POST['content_1'], $_POST['content_2']);
                }
            }
            else if (isset($_POST['member']) and $_POST['member'] == 'update') {
                $member1 = isset($_POST['member_1']) ? $_POST['member_1'] : '';
                $member2 = isset($_POST['member_2']) ? $_POST['member_2'] : '';
                updateMember($member1, $member2);
            }
            else if (isset($_POST['social']) and $_POST['social'] == 'update') {
                $hotline = isset($_POST['hotline']) ? $_POST['hotline'] : '';
                $email = isset($_POST['email']) ? $_POST['email'] : '';
                $facebook = isset($_POST['facebook']) ? $_POST['facebook'] : '';
                $instagram = isset($_POST['instagram']) ? $_POST['instagram'] : '';
                $youtube = isset($_POST['youtube']) ? $_POST['youtube'] : '';
                $twitter = isset($_POST['twitter']) ? $_POST['twitter'] : '';
                updateSocial($hotline, $email, $facebook, $instagram, $youtube, $twitter);
            }
        }
    }

    /**
     * Những sản phẩm bán chạy
     */
    function pushHotProduct($id) {
        include_once '../../controller/productClass.php';
        $push = new ProductClass();
        $push->insertHotProduct($id);
    }

    function dropHotProduct($id) {
        include_once '../../controller/productClass.php';
        $drop = new ProductClass();
        $drop->deleteHotProduct($id);
    }

    function getHotProductResponse() {
        include_once '../../controller/productClass.php';
        $product = new ProductClass();
        $response = array();
        $response['hot'] = $product->getProductHot();
        $response['not-hot'] = $product->getProductNotHot();
        
        echo json_encode($response);
    }

    /**
     * Content của page index
     */

    function updateContentIntro($slogan, $content_1, $content_2) {
        include_once '../../controller/pageClass.php';
        $page_class = new PageClass();
        $response = $page_class->updateContentIntro($slogan, $content_1, $content_2);
        echo json_encode($response);
    }

    function updateMember($member1, $member2)
    {
        include_once '../../controller/pageClass.php';
        $page_class = new PageClass();
        $response = $page_class->updateMember($member1, $member2);
        echo json_encode($response);
    }

    function updateSocial($hotline, $email, $facebook, $instagram, $youtube, $twitter) {
        include_once '../../controller/pageClass.php';
        $page_class = new PageClass();
        $response = $page_class->updateSocialNetwork($hotline, $email, $facebook, $instagram, $youtube, $twitter);
        echo json_encode($response);
    }
?>