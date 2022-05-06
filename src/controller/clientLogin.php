<?php
include_once '../../lib/session.php';
//Session::checkClientLogin();
include_once '../../lib/database.php';
include_once '../../helper/format.php';
?>

<?php
class ClientLogin
{
    private $db;
    private $fm;
    private $user_tbl = DB_USER_TABLE;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    // Hàm đăng nhập user
    public function login($username, $password)
    {
        $username = $this->fm->filter($username);
        $password = $this->fm->filter($password);
        $hash_pw = base64_encode($password);

        $response = array();
        if (empty($username) or empty($hash_pw)) {
            $response['status'] = 0;
            $response['username'] = null;
            $response['message'] = 'Vui lòng điền đẩy đủ tên tài khoản và mật khẩu';
        } else {
            $query = "SELECT * FROM $this->user_tbl WHERE username='$username' AND password='$hash_pw' LIMIT 1";
            $result = $this->db->select($query);
            if ($result) {
                $value = $result->fetch_assoc();
                $response['status'] = 1;
                $response['username'] = $value['username'];
                $response['message'] = 'Đăng nhập thành công';
                // set session sau khi khiểm tra đăng nhập hơp lệ
                Session::set('userlogin', true);
                Session::set('user', $value['username']);
            } else {
                $response['status'] = 0;
                $response['username'] = null;
                $response['message'] = 'Tài khoản hoặc mật khẩu không chính xác';
            }
        }

        return $response;
    }

    public function logout()
    {
        session_destroy();
        header('Location:index.php');
    }
}
?>