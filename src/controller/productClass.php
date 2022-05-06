<?php
// Include thư viện database và format
include_once('../../lib/database.php');
include_once('../../helper/format.php');
class ProductClass {
	private $db;
	private $fm;
	private $product_tbl = DB_PRODUCT_TABLE;
	private $product_hot_tbl = DB_PRODUCT_HOT_TABLE;
	private $order_tbl = DB_ORDER_TABLE;
	private $order_info_tbl = DB_ORDER_INFO_TABLE;

	// Hàm khởi tạo
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}

	// Hàm lấy tất cả số lượng sản phẩm
	public function getNumberOfProduct() {
		$query = "SELECT count(*) AS brand, SUM($this->product_tbl.number) AS store FROM $this->product_tbl";
		$result = $this->db->select($query);
		if ($result) {
			$response = $result->fetch_assoc();
			return $response;
		} else {
			return false;
		}
	}

	// Hàm lấy số lượng sản phẩm đang được xử lý
	public function getProductPending() {
		$query = "SELECT SUM($this->order_info_tbl.number) AS pending FROM $this->order_info_tbl JOIN $this->order_tbl on $this->order_info_tbl.id = $this->order_tbl.id WHERE $this->order_tbl.state = 0";
		$result = $this->db->select($query);
		if ($result) {
			$response = $result->fetch_assoc();
			return $response;
		} else {
			return false;
		}
	}

	// Hàm lấy thông tin các sản phẩm đang bán chạy
	public function getProductHot()
	{
		$response = array();
		$query = "SELECT COUNT(*) AS number FROM $this->product_hot_tbl";
		$result = $this->db->select($query);
		if ($result) {
			$response['number'] = $result->fetch_assoc();
		}

		$response['product'] = array();
		$query = "SELECT $this->product_tbl.id, $this->product_tbl.name, $this->product_tbl.price, $this->product_tbl.number, $this->product_tbl.image FROM $this->product_tbl WHERE $this->product_tbl.id in (SELECT * FROM $this->product_hot_tbl)";
		$result2 = $this->db->select($query);
		if ($result2) {
			while ($value = $result2->fetch_assoc()) {
				$item = array(
					'id' => $value['id'],
					'name' => $value['name'],
					'price' => $value['price'],
					'number' => $value['number'],
					'image' => $value['image']
				);
				array_push($response['product'], $item);
			}
		}

		return $response;
	}

	// Hàm lấy thông tin các sản phẩm không bán chạy
	public function getProductNotHot()
	{
		$query = "SELECT $this->product_tbl.id, $this->product_tbl.name, $this->product_tbl.price, $this->product_tbl.number, $this->product_tbl.image FROM $this->product_tbl WHERE $this->product_tbl.id NOT IN (SELECT id FROM $this->product_hot_tbl)";
		$result = $this->db->select($query);
		$response = array();
		if ($result) {
			while($value = $result->fetch_assoc()) {
				$item = array(
					'id' => $value['id'],
					'name' => $value['name'],
					'price' => $value['price'],
					'number' => $value['number'],
					'image' => $value['image']
				);
				array_push($response, $item);
			}
		}
		return $response;
	}

	// Hàm lấy chi tiết tất cả thông tin sản phẩm
	public function getProductList() {
		$query = "SELECT * FROM $this->product_tbl ORDER BY id ASC";
		$result = $this->db->select($query);
		if ($result) {
			$response = array();
			while ($value = $result->fetch_assoc()) {
				$item = array(
					'id' => $value['id'],
					'name' => $value['name'],
					'price' => $value['price'],
					'number' => $value['number'],
					'screen' => $value['screen'],
					'ram' => $value['ram'],
					'rom' => $value['rom'],
					'cpu' => $value['cpu'],
					'gpu' => $value['gpu'],
					'camera_back' => $value['camera_back'],
					'camera_front' => $value['camera_front'],
					'pin' => $value['pin'],
					'operator' => $value['operator'],
					'description' => $value['description'],
					'image' => $value['image']
				);
				array_push($response, $item);
			}

			return $response;
		} else {
			return false;
		}
	}

	// Hàm lấy sản phẩm theo giá
	public function getProductListByPrice($low, $high) {
		$query = "SELECT * FROM $this->product_tbl WHERE ($this->product_tbl.price >= $low AND $this->product_tbl.price <= $high AND $this->product_tbl.number > 0) ORDER BY $this->product_tbl.price";
		$result = $this->db->select($query);
		$response = array();
		if ($result) {
			while ($value = $result->fetch_assoc()) {
				$item = array(
					'id' => $value['id'],
					'name' => $value['name'],
					'price' => $value['price'],
					'number' => $value['number'],
					'image' => $value['image']
				);
				array_push($response, $item);
			}
			return $response;
		} else {
			return false;
		}
	}

	public function getProductListByName($name)
	{
		$query = "SELECT * FROM $this->product_tbl WHERE $this->product_tbl.name LIKE '%$name%'";
		$result = $this->db->select($query);
		$response = array();
		if ($result) {
			while ($value = $result->fetch_assoc()) {
				$item = array(
					'id' => $value['id'],
					'name' => $value['name'],
					'price' => $value['price'],
					'number' => $value['number'],
					'image' => $value['image']
				);
				array_push($response, $item);
			}
		} 
		return $response;
	}

	// Hàm lấy thông tin 1 sản phẩm bằng id
	public function getProductInfo($id) {
		$query = "SELECT * FROM $this->product_tbl WHERE id=$id";
		$result = $this->db->select($query);
		if ($result) {
			$response = $result->fetch_assoc();
			return $response;
		} else {
			return false;
		}
	}

	// Hàm lấy thông tin 1 sản phẩm bằng id
	public function getProductDetail($id)
	{
		$query = "SELECT * FROM $this->product_tbl WHERE id=$id";
		$result = $this->db->select($query);
		if ($result) {
			$response = $result->fetch_assoc();
			return $response;
		} else {
			return false;
		}
	}

	// Hàm thêm 1 sản phẩm mới vào database
	public function insertNewProduct($name, $price, $number, $screen, $ram, $rom, $cpu, $gpu, $camera_back, $camera_front, $pin, $sim, $operator, $desc, $image, $save_img) {
		$response = array();

		if ($name == '') {
			$response['status'] = 0;
			$response['msg'] = 'Nhập tên sản phẩm';
			return $response;
		}
		if ($price == '') {
			$response['status'] = 0;
			$response['msg'] = 'Nhập giá sản phẩm';
			return $response;
		}
		if ($number == '') {
			$response['status'] = 0;
			$response['msg'] = 'Nhập số lượng';
			return $response;
		}

		$query = "INSERT INTO $this->product_tbl (name, price, number, screen, ram, rom, cpu, gpu, camera_back, camera_front, pin, sim, operator, description, image) 
					VALUES('$name', '$price', '$number', '$screen', '$ram', '$rom', '$cpu', '$gpu', '$camera_back', '$camera_front', '$pin',
					'$sim', '$operator', '$desc', '$image')";
		$result = $this->db->insert($query);

		if ($result) {
			if ($image != '') {
				$targetFile = basename($image);
			    if (move_uploaded_file($save_img, '../../asset/img/product/upload/'.$targetFile)) {
		
			    }
			}
			$response['status'] = 1;
			$response['msg'] = 'Thêm sản phẩm thành công';
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Thêm sản phẩm thất bại';
		}
		return $response;

	}

	// Hàm thêm 1 sản phẩm vào danh sách bán chạy
	public function insertHotProduct($id)
	{
		$query = "INSERT INTO $this->product_hot_tbl (id) VALUES($id)";
		$result = $this->db->insert($query);
		if ($result) {
			return true;
		} else {
			return false;
		}
	}

	// Hàm xóa sản phẩm theo id
	public function deleteProductById($id) {
		$query = "DELETE FROM $this->product_tbl WHERE id=$id";
		$result = $this->db->delete($query);
		if($result) {
			return true;
		} else {
			return false;
		}
	}

	// Hàm xóa sản phẩm khỏi danh sách bán chạy
	public function deleteHotProduct($id)
	{
		$query = "DELETE FROM $this->product_hot_tbl WHERE id=$id";
		$result = $this->db->delete($query);
		if ($result) {
			return true;
		} else {
			return false;
		}
	}

	// Hàm update thông tin sản phẩm
	public function updateProducInfo($id, $name, $price, $number, $screen, $ram, $rom, $cpu, $gpu, $camera_back, $camera_font, $pin, $sim, $operator, $desc, $image, $save_img) {
		$response = array();
		if ($name == '') {
			$response['status'] = 0;
			$response['message'] = 'Điền tên sản phẩm';
			return $response; 
		}
		if ($price == '') {
			$response['status'] = 0;
			$response['message'] = 'Điền giá sản phẩm'; 
			return $response; 
		}
		if ($number == '') {
			$response['status'] = 0;
			$response['message'] = 'Điền số lượng sản phẩm'; 
			return $response; 
		}
		if ($image == '') {
			$query = "UPDATE $this->product_tbl SET name='$name', price='$price', number='$number', screen='$screen', 
						ram='$ram', rom='$rom', cpu='$cpu', gpu='$gpu', camera_back='$camera_back', camera_front='$camera_font', 
						pin='$pin', sim='$sim', operator='$operator', description='$desc' WHERE id=$id";
		} else {
			$query = "UPDATE $this->product_tbl SET name='$name', price='$price', number='$number', screen='$screen', 
						ram='$ram', rom='$rom', cpu='$cpu', gpu='$gpu', camera_back='$camera_back', camera_front='$camera_font', 
						pin='$pin', sim='$sim', operator='$operator', description='$desc', image='$image' WHERE id=$id";
		}
		$result = $this->db->update($query);
		if ($result) {
			if ($image != '') {
				$targetFile = basename($image);
			    if (move_uploaded_file($save_img, '../../asset/img/product/upload/'.$targetFile)) {
		
			    }
			}
			$response['status'] = 1;
			$response['msg'] = 'Cập nhập sản phẩm thành công';
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Cập nhập sản phẩm thất bại';
		}
		return $response; 
	}
}
?>