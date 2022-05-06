<?php
include_once('../../lib/session.php');
Session::checkLogin();
include_once('../../lib/database.php');
include_once('../../helper/format.php');
?>

<?php
/**
 * 
 */
class adminLogin
{

    private $db;
    private $fm;
    private $admin_tbl = DB_ADMIN_TABLE;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    // Hàm đăng nhập admin
    public function login($username, $password)
    {
        $username = $this->fm->filter($username);
        $password = $this->fm->filter($password);

        $username = mysqli_real_escape_string($this->db->link, $username);
        $password = mysqli_real_escape_string($this->db->link, $password);

        if (empty($username) || empty($password)) {
            $errorMsg = 'Điền tên tài khoản và mật khẩu';
            return $errorMsg;
        } else {
            $query = "SELECT * FROM $this->admin_tbl WHERE username='$username' AND password='$password'";
            $result = $this->db->select($query);
            if ($result != false) {
                $value = $result->fetch_assoc();
                // set session cho admin sau khỉ kiểm tra dăng nhập
                Session::set("adminlogin", true);
                Session::set('admin', $value['name']);
                header('Location:index.php');
            } else {
                $errorMsg = 'Tài khoản hoặc mật khẩu không đúng';
                return $errorMsg;
            }
        }
    }
}
