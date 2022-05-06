<?php 
// Include thư viện database và format
include_once('../../lib/database.php');
include_once('../../helper/format.php');
class Dashboard {
	private $db;
    private $fm;
    private $user_tbl = DB_USER_TABLE;
    private $order_tbl = DB_ORDER_TABLE;

    // Hàm khởi tạo
    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }

    // Hàm lấy số lượng user
    public function getUserNumber() {
    	$query = "SELECT COUNT(*) AS number FROM $this->user_tbl";
    	$result = $this->db->select($query);
        $value = $result->fetch_assoc();
        return $value['number'];
    }

    // Hàm lấy số lượng hóa đơn
    public function getOrderNumber() {
    	$month = date('m');
    	$query = "SELECT COUNT(*) AS number FROM $this->order_tbl WHERE month(date)=$month AND(state = 0 or state = 1)";
    	$result = $this->db->select($query);
    	$value = $result->fetch_assoc();
    	return $value['number'];
    }

    // Hàm lấy thu nhập của shop
    public function getTotalIncome() {
        $month = date('m');
        $query = "SELECT sum(total_price) AS money FROM $this->order_tbl WHERE month(date)=$month and state = 1";
        $result = $this->db->select($query);
        $value = $result->fetch_assoc();
        return $value['money'];
    }
}

?>