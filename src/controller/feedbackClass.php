<?php
// Include thư viện database và format
include_once('../../lib/database.php');
include_once('../../helper/format.php');

class FeedbackClass {
    private $db;
    private $fm;
    private $feedback_tbl = DB_FEEDBACK_TABLE;

    //  Hàm khởi tạo
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function getFeedbackById($id)
    {
        $query = "SELECT * FROM $this->feedback_tbl WHERE id_product='$id'";
        $result = $this->db->select($query);
        $response = array();
        if ($result) {
            while ($value = $result->fetch_assoc()) {
                $item = array(
                    'id' => $value['id'],
                    'id_product' => $value['id_product'],
                    'username' => $value['username'],
                    'message' => $value['message'],
                    'date' => $value['date']
                );
                array_push($response, $item);
            }
            return $response;
        } else {
            return false;
        }

    }

    public function insertFeedback($id_product, $username, $message) {
        $username = $this->fm->filter($username);
        $message = $this->fm->filter($message);

        $response = array();
        if (empty($message) or empty($username) or empty($id_product)) {
            $response['status'] = 0;
            $response['message'] = 'Vui điền đủ thông tin';
        }
        else {
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $today = date('Y-m-d h:i:s');
            $query = "INSERT INTO $this->feedback_tbl (id_product, username, message, date) VALUES ($id_product, '$username', '$message', '$today')";
            $result = $this->db->insert($query);
            if ($result) {
                $response['status'] = 1;
                $response['message'] = 'Gửi phản hồi thành công';
            } else {
                $response['status'] = 0;
                $response['message'] = 'Gửi phản hồi thất bại';
            }
        }
        return $response;
    }
}
?>