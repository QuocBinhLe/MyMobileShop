<?php 
// Include thư viện database và format
include_once('../../lib/database.php');
include_once('../../helper/format.php');
class UserClass {
	private $db;
	private $fm;
	private $admin_tbl = DB_ADMIN_TABLE;
	private $user_tbl = DB_USER_TABLE;

	// Hàm khởi tạo
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}

	// Hàm lấy danh sách user
	public function getListUsers() {
		$query = "SELECT username, email FROM $this->user_tbl ORDER BY username";
		$result = $this->db->select($query);
		if ($result) {
			$response = array();
			while ($value = $result->fetch_assoc()) {
				$item = array(
					'username' => $value['username'],
					'email' => $value['email']
				);
				array_push($response, $item);
			}
		return $response;
		} else {
			return false;
		}		
	}

	// Hàm lấy thông tin admin
	public function getAdminInfo($username)
	{
		$query = "SELECT * FROM $this->admin_tbl WHERE username = '$username'";
		$result = $this->db->select($query);
		if ($result) {
			$response = $result->fetch_assoc();
			return $response;
		} else {
			return false;
		}
	}

	// Hàm lấy thông tin user
	public function getUserInfo($username) {
		$query = "SELECT * FROM $this->user_tbl WHERE username='$username'";
		$result = $this->db->select($query);
		if ($result) {
			$response = $result->fetch_assoc();
			return $response;
		} else {
			return false;
		}
	}

	// Hàm thêm user của Admin
	public function createUserByAdmin($username, $level, $email, $phone, $realname, $date, $password) {
		$password = base64_encode($password);
		$query = "INSERT INTO $this->user_tbl (username, email, phone, password, realname, date_create, level) VALUES('$username', '$email', $phone, '$password', '$realname', '$date', $level)";
		$result = $this->db->insert($query);
		if ($result) {
			$status = 1;
		} else {
			$status = 0;
		}
		return $status;
	}

	// Hàm tạo tài khoản mới của user
	public function insertNewUser($username, $email, $password, $re_password)
	{
		$username = $this->fm->filter($username);
		$email = $this->fm->filter($email);
		$password = $this->fm->filter($password);
		$re_password = $this->fm->filter($re_password);

		$password = base64_encode($password);
		$re_password = base64_encode($re_password);

		$response = array();

		if (empty($username) or empty($email) or empty($password) or empty($re_password)) {
			$response['status'] = 0;
			$response['message'] = 'Vui lòng nhập đầy đủ các trường';
		}
		else if ($password != $re_password) {
			$response['status'] = 0;
			$response['message'] = 'Mật khẩu không khớp';
		} else {
			$query = "INSERT INTO $this->user_tbl (username, email, password) VALUES ('$username', '$email', '$password')";
			$result = $this->db->insert($query);
			if ($result) {
				$response['status'] = 1;
				$response['message'] = 'Thêm tài khoản thành công';
			} else {
				$response['status'] = 0;
				$response['message'] = 'Tài khoản đã tồn tại';
			}
		}

		return $response;
	}

	// Hàm update mật khẩu admin
	public function updateAdminPassword($password, $new_password, $re_password) {

		$response = array();

		if ($password == '' or $new_password == '' or $re_password == '') {
			$response['msg'] = 'Nhập đầy các trường';
			$response['status'] = 0;
			return $response;
		}

		if ($new_password != $re_password) {
			$response['msg'] = 'Mật khẩu nhập không trùng khớp';
			$response['status'] = 0;
			return $response;
		}

		$password = base64_encode($password);
		$new_password = base64_encode($new_password);

		$admin_pw = $this->db->select('SELECT password from admin');
		$admin_pw = $admin_pw->fetch_assoc();
		if ($password != $admin_pw['password']) {
			$response['msg'] = 'Mật khẩu không chính xác';
			$response['status'] = 0;
			return $response;
		}

		$query = "UPDATE $this->admin_tbl SET admin.password = '$new_password' WHERE admin.password = '$password'";
		$result = $this->db->update($query);
		if ($result == 1) {
			$response['msg'] = 'Cập nhập mật khẩu thành công';
			$response['status'] = 1;
		} 
		return $response;
	}

	// Hàm update thông tin admin
	public function updateAdminInfo($name, $email, $phone, $address) {
		if ($name == '' or $email == '' or $phone == '') {
			return false;
		}
		$query = "UPDATE $this->admin_tbl SET name='$name', email='$email', phone='$phone', address='$address' WHERE username='admin'";
		$result = $this->db->update($query);
		if ($result) {
			$admin_info = self::getAdminInfo('admin');
			return $admin_info;
		} else {
			return false;
		}
	}

	// Hàm update thông tin user của Admin
	public function updateUserInfo($username, $level, $email, $phone, $realname, $date, $password) {
		$password = base64_encode($password);
		$date = $this->fm->formatDate($date);
		$query = "UPDATE $this->user_tbl SET level=$level, email='$email', phone='$phone', realname='$realname', date_create='$date', password='$password' WHERE username='$username'";
		$result = $this->db->update($query);
		if ($result) {
			$userinfo = self::getUserInfo($username);
			return $userinfo;
		} else {
			return false;
		}
	}

	// Hàm update thông tin user của client
	public function updateUserDetail($username, $email, $phone, $realname) 
	{
		$response = array();
		if (empty($username) or empty($email) or empty($phone) or empty($realname)) {
			$response['status'] = 0;
			$response['message'] = 'Vui lòng điền đầy đủ thông tin';
		} else {
			$username = $this->fm->filter($username);
			$email = $this->fm->filter($email);
			$phone = $this->fm->filter($phone);
			$realname = $this->fm->filter($realname);
			$query = "UPDATE $this->user_tbl SET email='$email', phone='$phone', realname='$realname' WHERE username='$username'";
			$result = $this->db->update($query);
			$response = array();
			if ($result) {
				$response['status'] = 1;
				$response['message'] = 'Cập nhập thông tin thành công';
			} else {
				$response['status'] = 0;
				$response['message'] = 'Vui lòng điền đầy đủ thông tin';
			}
		}
		return $response;
	}

	// Hàm update mật khẩu user
	public function updateUserPassword($username, $password, $new_password, $re_newpw) {
		$response = array();
		if (empty($username) or empty($password) or empty($new_password) or empty($re_newpw)) {
			$response['status'] = 0;
			$response['message'] = 'Vui lòng điền đầy đủ thông tin';
		} else if ($new_password != $re_newpw) {
			$response['status'] = 0;
			$response['message'] = 'Mật khẩu không trùng khớp';
		} else {
			$username = $this->fm->filter($username);
			$password = base64_encode($this->fm->filter($password));
			$new_password = base64_encode($this->fm->filter($new_password));
			$re_newpw = base64_encode($this->fm->filter($re_newpw));

			$query = "SELECT * FROM $this->user_tbl WHERE username='$username' AND password='$password'";
			if (!$this->db->select($query)) {
				$response['status'] = 0;
				$response['message'] = 'Mật khẩu không đúng';
			} else {
				$query = "UPDATE $this->user_tbl SET password='$new_password' WHERE username='$username'";
				$result = $this->db->update($query);
				if ($result) {
					$response['status'] = 1;
					$response['message'] = 'Cập nhật mật khẩu thành công';
				} else {
					$response['status'] = 0;
					$response['message'] = 'Cập nhập mật khẩu thất bại';
				}
			}
		}
		return $response;
	}

	// Hàm xóa tài khoản của Admin
	public function deleteUser($username) {
		$query = "DELETE FROM $this->user_tbl WHERE username='$username'";
		$result = $this->db->delete($query);
	}
}
?>