function subMenu() {
	$('.side-bar-dropdown.product-dropdown').click(function(){
		$('.side-bar-item-droplist.product-dropdown').toggleClass('drop-show');
	});
	$('.side-bar-dropdown.account-dropdown').click(function(){
		$('.side-bar-item-droplist.account-dropdown').toggleClass('drop-show');
	});
	$('.side-bar-dropdown.order-dropdown').click(function(){
		$('.side-bar-item-droplist.order-dropdown').toggleClass('drop-show');
	});
	$('.side-bar-dropdown.homepage-dropdown').click(function(){
		$('.side-bar-item-droplist.homepage-dropdown').toggleClass('drop-show');
	});
}
