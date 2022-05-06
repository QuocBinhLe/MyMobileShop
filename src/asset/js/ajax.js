// Link api để gọi tới
var hostname = window.location.hostname
var link_client_api = `http://localhost:80/view/client/client-api.php`
var link_admin_api = `http://localhost:80/view/admin/admin-api.php`

// Dưới đây là các hàm Ajax

// Thêm 1 sản phẩm vào danh sách bán chạy
function pushProductToHot(id) {
  $.ajax({
    url: `${link_admin_api}?action=delete&id=${id}`,
    type: 'GET',
    success: function (data) {
      renderHotProduct(JSON.parse(data))
    }
  })
  return false
}

// Xóa 1 sản phẩm khỏi danh sách bán chạy
function dropHotProduct(id) {
  $.ajax({
    url: `${link_admin_api}?action=add&id=${id}`,
    type: 'GET',
    success: function (data) {
      renderHotProduct(JSON.parse(data))
    }
  })
  return false
}

// render html sản phẩm trên trang index.php
function renderHotProduct(productObj) {
  document.querySelector('#card-content-value').innerText =
    productObj['hot']['number']['number']
  var htmlHotProduct = '',
    htmlNotHotProduct = ''
  htmlHotProduct = productObj['hot']['product'].map((product, index) => {
    return `
            <ul class="product-record hover-08">
                <li class="product-info width-42px" style="color: 9d9b9e;">${
                  index + 1
                }</li>
                <li class="product-info width-20">${product.name}</li>
                <li class="product-info width-20">${product.price}đ</li>
                <li class="product-info width-20">${product.number}</li>
                <li class="product-info width-20 product-img-wrapper">
                    <img src="../../asset/img/product/upload/${product.image}">
                </li>
                <li class="product-info width-20">
                    <a class=del-action href="admin-api.php?action=delete&id=${
                      product.id
                    }" onclick="return pushProductToHot(${product.id})">
                        <i class="fa fa-times"></i>
                    </a>
                </li>
            </ul>`
  })

  htmlNotHotProduct = productObj['not-hot'].map((product, index) => {
    return `
            <ul class="product-record hover-08">
                <li class="product-info width-42px" style="color: 9d9b9e;">${
                  index + 1
                }</li>
                <li class="product-info width-20">${product.name}</li>
                <li class="product-info width-20">${product.price}đ</li>
                <li class="product-info width-20">${product.number}</li>
                <li class="product-info width-20 product-img-wrapper">
                    <img src="../../asset/img/product/upload/${product.image}">
                </li>
                <li class="product-info width-20">
                    <a class=add-action href="admin-api.php?action=add&id=${
                      product.id
                    }" onclick="return dropHotProduct(${product.id})">
                        <i class="fas fa-plus"></i>
                    </a>
                </li>
            </ul>`
  })

  document.querySelector('#hot__product__content').innerHTML =
    htmlHotProduct.join('')
  document.querySelector('#not-hot__product__content').innerHTML =
    htmlNotHotProduct.join('')
}

// Lọc sản phẩm trên trang index.php
function filterProduct() {
  let link = ''
  let options = document.querySelectorAll('.filter__price-btn')
  options.forEach((element, index) => {
    element.onclick = () => {
      link = link_client_api
      link += `?filter=${index}`
      $.ajax({
        url: link,
        type: 'GET',
        success: (data) => {
          renderProductFilter(JSON.parse(data))
        }
      })
    }
  })
}

// render html lọc sản phẩm trên index.php
function renderProductFilter(obj) {
  if (!obj) {
    document.querySelector('#product__all').innerHTML = ''
  } else {
    let html = obj.map((item, index) => {
      return `
                    <div class="product__item__wrapper col l-2-4 m-3 c-12">
                        <a href="product-detail.php?id=${
                          item.id
                        }" class="product__item ">
                            <div class="product__item-img">
                                <img src="../../asset/img/product/upload/${
                                  item.image
                                }" alt="">
                            </div>
                            <div class="product__item-body">
                                <div class="product__item-heading">
                                    ${item.name}
                                </div>
                                <div class="product__item-content">
                                    <span class="product__item-price">${Number(
                                      item.price
                                    ).toLocaleString('us')}đ</span>
                                </div>
                            </div>
                        </a>
                        <div class="add__cart__box">
                            <span class="add__cart-btn">Thêm vào giỏ hàng</span>
                        </div>
                    </div>`
    })
    document.querySelector('#product__all').innerHTML = html.join('')
  }
}

// Hàm login user
function login() {
  var form = document.querySelector('#form__modal-log')
  form.onsubmit = (event) => {
    event.preventDefault()
    $.ajax({
      url: link_client_api,
      data: $('#form__modal-log').serialize(),
      type: 'GET',
      success: (data) => {
        console.log(data)
        data = JSON.parse(data)
        console.log(data)
        getResponseUserForm(data, '#modal__error__message-login')
        if (data.status == 1) {
          window.location.reload()
        }
      }
    })
  }
}

// Hàm đăng ký user
function signup() {
  var form = document.querySelector('#form__modal-sign')
  form.onsubmit = (event) => {
    event.preventDefault()
    $.ajax({
      url: link_client_api,
      type: 'POST',
      data: $('#form__modal-sign').serialize(),
      success: (data) => {
        if (data.includes('message')) {
          getResponseUserForm(JSON.parse(data), '#modal__error__message-signup')
        } else {
          document.querySelector('#modal__error__message-signup').innerHTML =
            'Tài khoản đã tồn tại'
        }
      }
    })
  }
}

// Hàm lấy response khi đăng nhập, đăng ký
function getResponseUserForm(data, element) {
  if (data.status == 0) {
    document.querySelector(element).innerHTML = data.message
  } else {
    document.querySelector(element).innerHTML = data.message
    document.querySelector(element).style.color = '#306d8a'
  }
}

// Hàm update thông tin tài khoản
function updateUserDetail() {
  var form = document.querySelector('#profile__form__update-detail')
  form.onsubmit = (event) => {
    event.preventDefault()
    $.ajax({
      url: link_client_api,
      type: 'POST',
      data: $('#profile__form__update-detail').serialize(),
      success: (data) => {
        data = JSON.parse(data)
        renderResponseUserProfile(
          data,
          '#profile__form__update-detail--response'
        )
      }
    })
  }
}

// Hàm update mật khẩu tài khoản
function updateUserPassword() {
  var form = document.querySelector('#profile__form__update-password')
  form.onsubmit = (event) => {
    event.preventDefault()
    $.ajax({
      url: link_client_api,
      type: 'POST',
      data: $('#profile__form__update-password').serialize(),
      success: (data) => {
        data = JSON.parse(data)
        renderResponseUserProfile(
          data,
          '#profile__form__update-password--response'
        )
        $('#profile__form__update-password .profile__detail-input').val('')
      }
    })
  }
}

// Hàm render html khi cập nhật thông tin, mật khẩu của user
function renderResponseUserProfile(data, element) {
  document.querySelector(element).innerHTML = data.message
  if (data.status == 0) {
    document.querySelector(element).style.color = 'red'
  } else {
    document.querySelector(element).style.color = '#306d8a'
  }
}

// Hàm thêm sản phẩm vào giỏ hàng
function addToCart() {
  var addButton = document.querySelectorAll('.add__cart-btn')
  var addButtonWithNumber = document.querySelector('#add__cart-number')
  if (addButton.length > 1) {
    addButton.forEach((item) => {
      item.onclick = () => {
        let url = item.parentElement.parentElement
          .querySelector('a')
          .href.split('?id=')
        $.ajax({
          url: link_client_api,
          type: 'POST',
          data: `action=add-cart&id=${url[1]}&number=1`,
          success: (data) => {
            data = JSON.parse(data)
            renderCart(data)
          }
        })
      }
    })
  } else if (addButtonWithNumber) {
    if (
      (addButtonWithNumber.onclick = () => {
        let number = document.querySelector('#number__add-cart').value
        let url = window.location.href.split('?id=')
        $.ajax({
          url: link_client_api,
          type: 'POST',
          data: `action=add-cart&id=${url[1]}&number=${number}`,
          success: (data) => {
            console.log(data)
            data = JSON.parse(data)
            renderCart(data)
          }
        })
      })
    );
  }
}

// Hàm render html giỏ hàng
function renderCart(data) {
  if (data.status == 1) {
    var html = `
                    <li class="cart__nav__list-item" id="cart__item-${data.id}">
                        <a class="cart__nav__list-link" href="">
                            ${data.name}
                            <div class="cart__nav__list-item--info">
                                <span class="cart__item-price">${Number(
                                  data.price
                                ).toLocaleString('us')}</span>
                                <span class="cart__item-number">x${
                                  data.number
                                }</span>
                            </div>
                        </a>                             
                    </li>`
    var elementItem = `#cart__item-${data.id}`
    if (document.querySelector(elementItem)) {
      html = `
                        <a class="cart__nav__list-link" href="">
                            ${data.name}
                            <div class="cart__nav__list-item--info">
                                <span class="cart__item-price">${Number(
                                  data.price
                                ).toLocaleString('us')}</span>
                                <span class="cart__item-number">x${
                                  data.number
                                }</span>
                            </div>
                        </a> `
      document.querySelector(elementItem).innerHTML = html
    } else {
      document.querySelector('.cart__nav-list').innerHTML += html
    }

    if (!document.querySelector('.cart__link')) {
      document.querySelector('.cart__nav-list').innerHTML += `
                                                                <li class="cart__nav__list-item cart__link">
                                                                    <a href="cart.php">
                                                                        Xem giỏ hàng
                                                                        <i class="fas fa-shopping-bag"></i>
                                                                    </a>
                                                                </li>`
    }

    window.location.reload()
    document.querySelector('.cart__empty').innerHTML = ''
    document.querySelector('.cart__empty').classList.remove('cart__empty')
  } else {
    $confirm('Đăng nhập để thêm sản phẩm vào giỏ', '#06c1d4')
  }
}

// Hàm xóa sản phẩm khỏi giỏ hàng
function deleteProductFromCart() {
  var deleteButton = document.querySelectorAll('.cart__delete__product')
  deleteButton.forEach((element) => {
    element.onclick = (event) => {
      event.preventDefault()
      let param = element.href.split('?')
      $.ajax({
        url: link_client_api,
        type: 'GET',
        data: param[1],
        success: (data) => {
          data = JSON.parse(data)
          window.location.reload()
        }
      })
    }
  })
}

// Hàm đặt mua sản phẩm (thêm đơn hàng vào database)
function buyProduct() {
  var buyButton = document.querySelector('.buy__product__button')
  buyButton.onclick = () => {
    $.ajax({
      url: link_client_api,
      type: 'POST',
      data: $('#form__buy__product').serialize(),
      success: (data) => {
        console.log(data)
        data = JSON.parse(data)
        if (data.status == 1) {
          if (data.iswarn == 1) {
            $alert(data.warning, '#06c1d4')
            setTimeout(() => {}, 3000)
          }
          $toast(data.message, '#06c1d4')
          setTimeout(() => {
            window.location.reload()
          }, 3000)
        } else {
          $alert(data.message, '#06c1d4')
        }
      }
    })
  }
}

// Hàm tìm kiếm (ô search)
function searchProduct() {
  var search_box = document.querySelector('.search__box')
  search_box.onkeyup = () => {
    $.ajax({
      url: link_client_api,
      type: 'GET',
      data: {
        search: search_box.value
      },
      success: (data) => {
        data = JSON.parse(data)
        renderSearchBox(data)
      }
    })
  }
}

// Render html ô search
function renderSearchBox(data) {
  var search_list = document.querySelector('.search__result-list')
  console.log(data)
  if (data.length > 0) {
    var html = data.map((item) => {
      return `<li class="search__result-item">
                        <a href="product-detail.php?id=${
                          item.id
                        }" class="search__result-link">
                            <div class="row">
                                <div class="l-2 m-2 c-2 search__result-img">
                                    <img src="../../asset/img/product/upload/${
                                      item.image
                                    }" alt="">
                                </div>
                                <div class="l-7 m-7 c-7 search__result-name">
                                    ${item.name}
                                </div>
                                <div class="l-2 m-2 c-2 search__result-price">
                                    ${Number(item.price).toLocaleString('us')}
                                </div>
                            </div>
                        </a>
                    </li>`
    })
    search_list.innerHTML = html.join('')
  } else {
  }
}

// Gửi feedback
function sendFeedback() {
  var sendButton = document.querySelectorAll('.send__review__button')
  sendButton.forEach((item) => {
    item.onclick = () => {
      $.ajax({
        url: link_client_api,
        type: 'POST',
        data: $(`#feedback__customer-product-${Number(item.id)}`).serialize(),
        success: (data) => {
          data = JSON.parse(data)
          if (data.status == 1) {
            $alert(data.message, '#06c1d4')
            document.querySelector(
              `#feedback__customer-product-${Number(
                item.id
              )} textarea[name=message]`
            ).value = ''
          } else {
            $alert(data.message, '#fe3838')
          }
        }
      })
    }
  })
  // sendButton.onclick = () => {
  //     $.ajax({
  //         url: link_client_api,
  //         type: 'POST',
  //         data: $('#feedback__customer').serialize(),
  //         success: (data) => {
  //             data = JSON.parse(data);
  //             if (data.status == 1) {
  //                 $alert(data.message, '#06c1d4');
  //                 document.querySelector('textarea[name=message]').value = '';
  //             } else {
  //                 $alert(data.message, '#fe3838');
  //             }
  //         }
  //     });
  // }
}
