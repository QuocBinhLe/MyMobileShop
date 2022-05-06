<?php
include_once('../../controller/adminLogin.php');
?>

<?php
$admin = new adminLogin();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['username'];
    $pass = base64_encode($_POST['password']);
    $isLog = $admin->login($user, $pass);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="icon" type="image/icon" href="../../asset/img/logo/icon-store.png">
    <link rel="stylesheet" href="../../asset/css/main.css">
    <link rel="stylesheet" type="text/css" href="../../asset/css/admin/log-admin.css">
</head>

<body>
    <div class="main">
        <section class="content">
            <form action="login.php" method="POST">
                <div class="form-heading">
                    <h3>Đăng nhập</h3>
                </div>
                <div class="form-group">
                    <input type="text" name="username" required="" placeholder="Tên đăng nhập">
                </div>
                <div class="form-group">
                    <input type="password" name="password" required="" placeholder="Mật khẩu">
                </div>
                <div class="msg-box">
                    <span class="show-msg">
                        <?php
                        if (isset($isLog)) {
                            echo $isLog;
                        }
                        ?>
                    </span>
                </div>
                <input type="submit" class="submit-form" value="Đăng nhập">
            </form>
        </section>
    </div>
</body>

</html>