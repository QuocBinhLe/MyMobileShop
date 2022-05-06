function formatHeading() {
    let heading = document.querySelectorAll('.product__item-heading');
    for (let i = 0; i < heading.length; i++) {
        if (heading[i].innerText.length > 45) {
            let items = heading[i].innerText.split(' ');
            let value = items[0];
            let j = 1;
            while ((value.length + items[j].length) < 45) {
                value += ' ' + items[j];
                j++;
            }
            value += ' ...';
            heading[i].innerText = value; 
        }
    }
}
document.addEventListener("DOMContentLoaded", function() {
    formatHeading();
});

function formatMoney(element) {
    let formatter = (Number(document.querySelector(element).innerHTML).toLocaleString('us'));
    document.querySelector(element).innerHTML = formatter;
}

function validateCart() {
    if (document.querySelector('#number__add-cart').value < 1) {
        document.querySelector('#number__add-cart').value = 1;
    }
}


function increaseCart() {
    let increase = document.querySelector('#number__add-cart--increase');
    document.querySelector('#number__add-cart').value++;
}

function decreaseCart() {
    let decrease = document.querySelector('#number__add-cart--decrease');
    if (document.querySelector('#number__add-cart').value >= 2) {
        document.querySelector('#number__add-cart').value--; 
    }
}