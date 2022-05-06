function createOrderInfoLink(param) {
	let url = window.location.href;
	let admin_url = url.split('admin/');
	admin_url[0] += 'admin/orderinfo.php?id=' + param;
	let result = admin_url[0];
	window.location.href=result;
}