<?php
	include_once '../../controller/productClass.php';
	$product = new ProductClass();
	$message = '';
	if(isset($_SERVER['REQUEST_METHOD']) and $_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['name'])) {
		$product_add = $product->insertNewProduct($_POST['name'], $_POST['price'], $_POST['number'], $_POST['screen'], $_POST['ram'],
													$_POST['rom'], $_POST['cpu'], $_POST['gpu'], $_POST['camera_back'], $_POST['camera_front'],
													$_POST['pin'], $_POST['sim'], $_POST['operator'],
									 				$_POST['description'], $_FILES['image']['name'], $_FILES['image']['tmp_name']);
		if ($product_add['status'] == 1) {
			//echo "<script>window.location.href='http://localhost/shop/view/admin/productlist.php'</script>";
		} else {
			$message = $product_add['msg'];
		}
	}
?>

<div class="content-wrapper">
	<div class="row">
		<form class="form-panel" action="" method="POST" enctype="multipart/form-data">
			<div class="mrg-top-20"></div>
			<div class="form-group">
				<div class="form-product-info-label-box">
					<label>Sản phẩm</label>
				</div>
				<div class="form-product-info-input-box">
					<input type="text" required=""  class="" name="name">
				</div>	
				<i class="fas fa-pen"></i>
			</div>
			<div class="form-group">
				<div class="form-product-info-label-box">
					<label>Giá</label>
				</div>
				<div class="form-product-info-input-box">
					<input type="number" required=""  class="" name="price">
				</div>	
				<i class="fas fa-pen"></i>
			</div>
			<div class="form-group">
				<div class="form-product-info-label-box">
					<label>Số lượng</label>
				</div>
				<div class="form-product-info-input-box">
					<input type="number" required=""  class="" name="number">
				</div>	
				<i class="fas fa-pen"></i>
			</div>
			<div class="form-group">
				<div class="form-product-info-label-box">
					<label>Màn hình</label>
				</div>
				<div class="form-product-info-input-box">
					<input type="text" class="" name="screen">
				</div>	
				<i class="fas fa-pen"></i>
			</div>
			<div class="form-group">
				<div class="form-product-info-label-box">
					<label>Ram</label>
				</div>
				<div class="form-product-info-input-box">
					<input type="text" class="" name="ram">
				</div>	
				<i class="fas fa-pen"></i>
			</div>
			<div class="form-group">
				<div class="form-product-info-label-box">
					<label>Bộ nhớ trong</label>
				</div>
				<div class="form-product-info-input-box">
					<input type="text" class="" name="rom">
				</div>	
				<i class="fas fa-pen"></i>
			</div>
			<div class="form-group">
				<div class="form-product-info-label-box">
					<label>CPU</label>
				</div>
				<div class="form-product-info-input-box">
					<input type="text" class="" name="cpu">
				</div>	
				<i class="fas fa-pen"></i>
			</div>
			<div class="form-group">
				<div class="form-product-info-label-box">
					<label>GPU</label>
				</div>
				<div class="form-product-info-input-box">
					<input type="text" class="" name="gpu">
				</div>	
				<i class="fas fa-pen"></i>
			</div>
			<div class="form-group">
				<div class="form-product-info-label-box">
					<label>Camera sau</label>
				</div>
				<div class="form-product-info-input-box">
					<input type="text" class="" name="camera_back">
				</div>	
				<i class="fas fa-pen"></i>
			</div>
			<div class="form-group">
				<div class="form-product-info-label-box">
					<label>Camera trước</label>
				</div>
				<div class="form-product-info-input-box">
					<input type="text" class="" name="camera_front">
				</div>	
				<i class="fas fa-pen"></i>
			</div>
			<div class="form-group">
				<div class="form-product-info-label-box">
					<label>Pin</label>
				</div>
				<div class="form-product-info-input-box">
					<input type="text" class="" name="pin">
				</div>	
				<i class="fas fa-pen"></i>
			</div>
			<div class="form-group">
				<div class="form-product-info-label-box">
					<label>Sim</label>
				</div>
				<div class="form-product-info-input-box">
					<input type="text" class="" name="sim">
				</div>	
				<i class="fas fa-pen"></i>
			</div>
			<div class="form-group">
				<div class="form-product-info-label-box">
					<label>Hệ điều hành</label>
				</div>
				<div class="form-product-info-input-box">
					<input type="text" class="" name="operator">
				</div>	
				<i class="fas fa-pen"></i>
			</div>
			<div class="form-group">
				<div class="form-product-info-label-box">
					<label>Ảnh</label>
				</div>
				<div class="form-product-info-input-box">
					<input type="file" required="" class="uploadfile" name="image">
				</div>	
				<i class="fas fa-upload"></i>	
			</div>
			<div class="mrg-top-20"></div>
			<div class="form-group">
				<div class="form-product-info-input-box">
					<textarea class="ckeditor" name="editor_desc"></textarea>
				</div>
				<input type="hidden" id="value-editor" name="description">	
			</div>
			<input type="hidden" name="id" value="'.$_GET['id'].'">
			<div class="mrg-top-20"></div>
			<div class="form-group">
				<span class="show-msg error"><?php echo $message ?></span>
			</div>
			<div class="mrg-top-20"></div>
			<div style="display: flex; flex-direction: row-reverse;">
			    <button class="product-info-save--btn hover-08" onclick="synEdit()">Lưu</button>
			    <div class="mrg-right-16"></div>
			</div>
		</form>
	</div>
</div>
<script>
	function synEdit() {
		for (instance in CKEDITOR.instances) {
			CKEDITOR.instances[instance].updateElement();
		}
		let syn = $('#value-editor').val($('.ckeditor').val());
	}
</script>