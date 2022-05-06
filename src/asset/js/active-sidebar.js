function addActiveClass() {
	let sidebar_items = document.querySelectorAll('a.link');
	let currentPage = getCurrentURL();
	if (getCurrentURL() == 'userupdate.php') {
		currentPage = 'userlist.php';
	}
	if (getCurrentURL() == 'orderinfo.php') {
		currentPage = 'orderpending.php';
	}
	if (getCurrentURL() == 'productinfo.php') {
		currentPage = 'productlist.php';
	}
	for (var i = sidebar_items.length - 1; i >= 0; i--) {
		if (getPage(sidebar_items[i].href) == currentPage) {
			if (sidebar_items[i].classList.value.includes('side-bar-item-droplist-link')) {
				sidebar_items[i].parentElement.parentElement.classList.add('drop-show');
				let parent = sidebar_items[i].parentElement.parentElement.parentElement;
				parent.querySelector('span').classList.add('active');
			}
			sidebar_items[i].classList.add('active');
		}
	}


	// Lấy trang hiện tại 
	function getPage(link) {
		let params = link.split('/');
		let page = params[6];
		return page;
	}

	// Lấy url
	function getCurrentURL() {
		let url = window.location.href;
		let param = url.split('/');
		let page = param[6].split('?');
		return page[0];
	}
}
