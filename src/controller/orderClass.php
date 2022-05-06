<?php
// Include thư viện database và format
include_once('../../lib/database.php');
include_once('../../helper/format.php');

class OrderClass {
	private $db;
	private $fm;
	private $product_tbl = DB_PRODUCT_TABLE;
	private $order_tbl = DB_ORDER_TABLE;
	private $order_info_tbl = DB_ORDER_INFO_TABLE;

	// Hàm khởi tạo
	public function __construct() {
		$this->db = new Database();
		$this->fm = new Format();
	}

	// Hàm lấy số đơn hàng trong database (chỉ số lượng)
	public function getNumberOrder() {
		$query = "SELECT COUNT(*) as number FROM $this->order_tbl";
		$result = $this->db->select($query);
		if ($result) {
			$response = $result->fetch_assoc();
			return $response;
		} else {
			return false;
		}
	}

	// Hàm lấy số lượng đơn hàng đã giao dịch thành công
	public function getNumberOrderSuccess() {
		$query = "SELECT COUNT(*) as number FROM $this->order_tbl WHERE $this->order_tbl.state = 1";
		$result = $this->db->select($query);
		if ($result) {
			$response = $result->fetch_assoc();
			return $response;
		} else {
			return false;
		}
	}

	// Hàm lấy lượng số đơn hàng đang thực hiện
	public function getNumberOrderPending() {
		$query = "SELECT COUNT(*) as number FROM $this->order_tbl WHERE $this->order_tbl.state = 0";
		$result = $this->db->select($query);
		if ($result) {
			$response = $result->fetch_assoc();
			return $response;
		} else {
			return false;
		}
	}

	// Hàm lấy lượng số đơn hàng đã hủy
	public function getNumberOrderCancel() {
		$query = "SELECT COUNT(*) as number FROM $this->order_tbl WHERE $this->order_tbl.state = -1";
		$result = $this->db->select($query);
		if ($result) {
			$response = $result->fetch_assoc();
			return $response;
		} else {
			return false;
		}
	}

	// Hàm lấy tất cả đơn hàng
	public function getAllOrder() {
		$query = "SELECT id, date, username, total_price, state FROM $this->order_tbl ORDER BY date DESC";
		$result = $this->db->select($query);
		if ($result) {
			$response = array();
			while ($value = $result->fetch_assoc()) {
				if ($value['id'] != '' && $value['id'] != null) {
					$item = array(
					'id' => $value['id'],
					'date' => $value['date'],
					'username' => $value['username'],
					'total_price' => $value['total_price'],
					'state' => $value['state']
					);
					array_push($response, $item);
				}	
			}
			return $response;
		} else {
			return false;
		}
	}

	// Hàm lấy tất cả đơn hàng đang thực hiện
	public function getOrdersPending() {
		$query = "SELECT id, date, username, total_price, state FROM $this->order_tbl WHERE state=0 ORDER BY date";
		$result = $this->db->select($query);
		if ($result) {
			$response = array();
			while ($value = $result->fetch_assoc()) {
				if ($value['id'] != '' && $value['id'] != null) {
					$item = array(
					'id' => $value['id'],
					'date' => $value['date'],
					'username' => $value['username'],
					'total_price' => $value['total_price'],
					'state' => $value['state']
					);
					array_push($response, $item);
				}	
			}
			return $response;
		} else {
			return false;
		}
	}

	// Hàm lấy thông tin đơn hàng
	public function getOrderInfo($id) {
		$query = "SELECT * FROM $this->order_tbl INNER JOIN user on $this->order_tbl.username = user.username WHERE id = $id";
		$result = $this->db->select($query);
		if($result) {
			$response = $result->fetch_assoc();
			return $response;
		} else {
			return false;
		}
	}

	// Hàm lấy chỉ tiết 
	public function getOrderDetail($id) {
		$query = "SELECT $this->product_tbl.id, $this->product_tbl.name, $this->order_info_tbl.number, $this->product_tbl.price, ($this->product_tbl.price*$this->order_info_tbl.number) as money FROM $this->product_tbl JOIN $this->order_info_tbl on $this->product_tbl.id = $this->order_info_tbl.id_product WHERE $this->order_info_tbl.id = $id ORDER BY $this->product_tbl.name ASC";
		$result = $this->db->select($query);
		if ($result) {
			$response = array();
			while ($value = $result->fetch_assoc()) {
				$item = array(
					'id' => $value['id'],
					'name' => $value['name'],
					'number' => $value['number'],
					'price' => $value['price'],
					'money' => $value['money']
				);
				array_push($response, $item);
			}
			return $response;
		} else {
			return false;
		}
	}

	// Hàm lấy danh sách các đơn hàng của khách hàng
	public function getUserOrderList($username)
	{
		$query = "SELECT * FROM $this->order_tbl WHERE $this->order_tbl.username='$username'";
		$result = $this->db->select($query);
		$response = array();
		if ($result) {
			while ($value = $result->fetch_assoc()) {
				$item = array(
					'id' => $value['id'],
					'total_price' => $value['total_price'],
					'date' => $value['date'],
					'state' => $value['state'],
					'address' => $value['address'],
					'note' => $value['note']
 				);
				 array_push($response, $item);
			}
			return $response;
		} else {
			return false;
		}
	}

	// Hàm thêm đơn hàng vào database
	public function insertOrder($username, $total_price, $address, $note, $product)
	{
		$response = array();
		$date = date('Y-m-d');
		$query_insert = "INSERT INTO $this->order_tbl (username, total_price, date, state, address, note) VALUES ('$username', 
					$total_price, '$date', 0, '$address', '$note')";
		$this->db->insert($query_insert);
		$query_getid = "SELECT MAX($this->order_tbl.id) AS id FROM $this->order_tbl";
		$result = $this->db->select($query_getid);
		if ($result) {
			$id_inserted = $result->fetch_assoc();
			foreach($product as $key => $value) {
				$number = (int)($value);
				$id = (int)($id_inserted['id']);
				$query_insert = "INSERT INTO $this->order_info_tbl (id, id_product, number) VALUES ($id, $key, $number)";
				$this->db->insert($query_insert);

				$query_update = "UPDATE $this->product_tbl SET $this->product_tbl.number = ($this->product_tbl.number - $number) WHERE $this->product_tbl.id = $key";
				$this->db->update($query_update);

				$response['status'] = 1;
				$response['message'] = 'Mua sản phẩm thành công';
			}
		} 
		else {
			$response['status'] = 0;
			$response['message'] = 'Mua sản phẩm thất bại'; 
		}
		return $response;
	}

	// Hàm thêm vào chi tiết đơn hàng
	public function insertOrderInfo($id, $product, $number)
	{
		$query = "INSERT INTO $this->order_info_tbl (id, product_id, number) VALUES ($id, $product, $number)";
		$result = $this->db->insert($query);
		if ($result) {
			return true;
		} else {
			return false;
		}
	}

	// hàm update trạng thái đơn hàng 
	public function updateOrderState($action, $id) {
		if ($action == 'cancel') {
			$state = -1;
		}
		if ($action == 're-order') {
			$state = 0;
		}
		if ($action == 'done') {
			$state = 1;
		}

		$query = "UPDATE $this->order_tbl SET state = $state WHERE id = $id";
		$result = $this->db->update($query);
		if ($result) {
			return true;
		} else {
			return false;
		}
	}
}
?>