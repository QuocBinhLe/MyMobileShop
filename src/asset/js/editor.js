// Lấy dữ check editor
function fetchValue() {
	let value = document.querySelector('#value-editor');
	console.log(value.value);
	$('.ckeditor').ckeditor();
	console.log($('.ckeditor').ckeditor())
}