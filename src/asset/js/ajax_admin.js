// link api admin
var hostname = window.location.hostname;
var link_admin_api = `http://localhost:80/shop/view/admin/admin-api.php`;

// Hàm update content intro
function updateContentIntro() {
    var button = document.querySelector('#update__content');
    button.onclick = (event) => {
        event.preventDefault();
        $.ajax({
            url: link_admin_api,
            type: 'POST',
            data: $('#form__content').serialize(),
            success: (data) => {
                data = JSON.parse(data);
                if (data.status == 1){
                    $alert(data.message, '#06c1d4');
                } else {
                    $alert(data.message, '#fe3838');
                }
            }
        });
    }
}

// Hàm update member
function updateMember() {
    var button = document.querySelector('#update__menber');
    button.onclick = (event) => {
        event.preventDefault();
        $.ajax({
            url: link_admin_api,
            type: 'POST',
            data: $('#form__member').serialize(),
            success: (data) => {
                data = JSON.parse(data);
                if (data.status == 1){
                    $alert(data.message, '#06c1d4');
                } else {
                    $alert(data.message, '#fe3838');
                }
            }
        });
    }
}

// Hàm update social network
function updateMember() {
    var button = document.querySelector('#update__social');
    button.onclick = (event) => {
        event.preventDefault();
        $.ajax({
            url: link_admin_api,
            type: 'POST',
            data: $('#form__social').serialize(),
            success: (data) => {
                data = JSON.parse(data);
                if (data.status == 1){
                    $alert(data.message, '#06c1d4');
                } else {
                    $alert(data.message, '#fe3838');
                }
            }
        });
    }
}