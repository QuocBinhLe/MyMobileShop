<?php
	include_once '../../controller/productClass.php';
	$product = new ProductClass();
	$htmlProductInfo = '';

	if(isset($_SERVER['REQUEST_METHOD']) and $_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['name'])) {
		$id = isset($_POST['id']) ? $_POST['id'] : 0;
		$name = isset($_POST['name']) ? $_POST['name'] : '';
		$price = isset($_POST['price']) ? $_POST['price'] : '';
		$number = isset($_POST['number']) ? $_POST['number'] : '';
		$screen = isset($_POST['screen']) ? $_POST['screen'] : '';
		$ram = isset($_POST['ram']) ? $_POST['ram'] : '';
		$rom = isset($_POST['rom']) ? $_POST['rom'] : '';
		$cpu = isset($_POST['cpu']) ? $_POST['cpu'] : '';
		$gpu = isset($_POST['gpu']) ? $_POST['gpu'] : '';
		$camera_back = isset($_POST['camera_back']) ? $_POST['camera_back'] : '';
		$camera_font = isset($_POST['camera_font']) ? $_POST['camera_font'] : '';
		$pin = isset($_POST['pin']) ? $_POST['pin'] : '';
		$sim = isset($_POST['sim']) ? $_POST['sim'] : '';
		$operator = isset($_POST['operator']) ? $_POST['operator'] : '';
		$desc = isset($_POST['description']) ? $_POST['description'] : '';
		$image = isset($_FILES['image']['name']) ? $_FILES['image']['name'] : '';
		$save_img = isset($_FILES['image']['tmp_name']) ? $_FILES['image']['tmp_name'] : '';

		$product_update = $product->updateProducInfo($id, $name, $price, $number, $screen, $ram, $rom, $cpu, $gpu, $camera_back, $camera_font, $pin, $sim, $operator, $desc, $image, $save_img);
		if ($product_update['status'] == 1) {
			echo "<script>window.location.href='http://localhost/shop/view/admin/productlist.php'</script>";
		}
	} else {
		if(isset($_GET['id'])) {
			$product_info = $product->getProductInfo($_GET['id']);
		}
		if (isset($product_info)) {
			$htmlProductInfo = '
								<div class="form-group">
									<div class="form-product-info-label-box">
										<label>Sản phẩm</label>
									</div>
									<div class="form-product-info-input-box">
										<input type="text" required=""  class="" name="name" value="'.$product_info['name'].'">
									</div>	
									<i class="fas fa-pen"></i>
								</div>
								<div class="form-group">
									<div class="form-product-info-label-box">
										<label>Giá</label>
									</div>
									<div class="form-product-info-input-box">
										<input type="text" required=""  class="" name="price" value="'.$product_info['price'].'">
									</div>	
									<i class="fas fa-pen"></i>
								</div>
								<div class="form-group">
									<div class="form-product-info-label-box">
										<label>Số lượng</label>
									</div>
									<div class="form-product-info-input-box">
										<input type="number" required=""  class="" name="number" value="'.$product_info['number'].'">
									</div>	
									<i class="fas fa-pen"></i>
								</div>
								<div class="form-group">
									<div class="form-product-info-label-box">
										<label>Màn hình</label>
									</div>
									<div class="form-product-info-input-box">
										<input type="text"  class="" name="screen" value="'.$product_info['screen'].'">
									</div>	
									<i class="fas fa-pen"></i>
								</div>
								<div class="form-group">
									<div class="form-product-info-label-box">
										<label>RAM</label>
									</div>
									<div class="form-product-info-input-box">
										<input type="text"  class="" name="ram" value="'.$product_info['ram'].'">
									</div>	
									<i class="fas fa-pen"></i>
								</div>
								<div class="form-group">
									<div class="form-product-info-label-box">
										<label>Bộ nhớ trong</label>
									</div>
									<div class="form-product-info-input-box">
										<input type="text"  class="" name="rom" value="'.$product_info['rom'].'">
									</div>	
									<i class="fas fa-pen"></i>
								</div>
								<div class="form-group">
									<div class="form-product-info-label-box">
										<label>CPU</label>
									</div>
									<div class="form-product-info-input-box">
										<input type="text"  class="" name="cpu" value="'.$product_info['cpu'].'">
									</div>	
									<i class="fas fa-pen"></i>
								</div>
								<div class="form-group">
									<div class="form-product-info-label-box">
										<label>GPU</label>
									</div>
									<div class="form-product-info-input-box">
										<input type="text"  class="" name="gpu" value="'.$product_info['gpu'].'">
									</div>	
									<i class="fas fa-pen"></i>
								</div>
								<div class="form-group">
									<div class="form-product-info-label-box">
										<label>Camera sau</label>
									</div>
									<div class="form-product-info-input-box">
										<input type="text"  class="" name="camera_back" value="'.$product_info['camera_back'].'">
									</div>	
									<i class="fas fa-pen"></i>
								</div>
								<div class="form-group">
									<div class="form-product-info-label-box">
										<label>Pin</label>
									</div>
									<div class="form-product-info-input-box">
										<input type="text"  class="" name="pin" value="'.$product_info['pin'].'">
									</div>	
									<i class="fas fa-pen"></i>
								</div>
								<div class="form-group">
									<div class="form-product-info-label-box">
										<label>Sim</label>
									</div>
									<div class="form-product-info-input-box">
										<input type="text"  class="" name="sim" value="'.$product_info['sim'].'">
									</div>	
									<i class="fas fa-pen"></i>
								</div>
								<div class="form-group">
									<div class="form-product-info-label-box">
										<label>Hệ điều hành</label>
									</div>
									<div class="form-product-info-input-box">
										<input type="text"  class="" name="operator" value="'.$product_info['operator'].'">
									</div>	
									<i class="fas fa-pen"></i>
								</div>
								<div class="form-group">
									<div class="form-product-info-label-box">
										<label>Ảnh</label>
									</div>
									<div class="form-product-info-input-box">
										<input type="file" class="uploadfile" name="image">
									</div>	
									<i class="fas fa-upload"></i>	
								</div>
								<div class="mrg-top-20"></div>
								<div class="form-group">
									<div class="form-product-info-input-box">
										<textarea class="ckeditor" name="editor_desc"></textarea>
									</div>
									<input type="hidden" id="value-editor" name="description" value="'.htmlspecialchars($product_info['description']).'">	
								</div>
								<input type="hidden" name="id" value="'.$_GET['id'].'">
								<div class="mrg-top-20"></div>
								<div class="form-group">

								</div>
								<div class="mrg-top-20"></div>
								<div style="display: flex; flex-direction: row-reverse;">
								    <button class="product-info-save--btn hover-08" onclick="synEdit()">Lưu</button>
								    <div class="mrg-right-16"></div>
									<a class="cancel-product-btn hover-08" href="">Hủy</a>
								</div>';
		}
	}
?>
<script>window.location.href</script>
<div class="content-wrapper">
	<div class="row">
		<form class="form-panel" action="" method="POST" enctype="multipart/form-data">
			<div class="mrg-top-20"></div>
			<?php 
				if(isset($htmlProductInfo)) { 
					if ($htmlProductInfo != '' and $product_info['name'] != ''){
						echo $htmlProductInfo;
					} else {
						echo '<span style="font-size: 1.2rem;">Không có sản phẩm này<span>';
					}
				} 
			?>
		</form>
	</div>
</div>
<script>
	let value = $('#value-editor').val();
	$('.ckeditor').val(value);
	function synEdit() {
		for (instance in CKEDITOR.instances) {
			CKEDITOR.instances[instance].updateElement();
		}
		let syn = $('#value-editor').val($('.ckeditor').val());
	}
</script>