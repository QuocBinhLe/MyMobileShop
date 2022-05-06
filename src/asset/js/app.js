// Bật tắt form login, đăng ký client
function catchEventLog() {
    var modal = document.querySelector('.modal');
    var modal_overlay = document.querySelector('.modal__overlay');
    var log_form = document.querySelector('#log__form');
    var sign_form = document.querySelector('#sign__form');
    
    document.querySelector('#log-in__action').onclick = () => {
        modal.style.display = 'block';
        document.querySelector('#form__modal-log').style.display = 'block';
        document.querySelector('#form__modal-sign').style.display = 'none';
        log_form.classList.add('form__active');
        sign_form.classList.remove('form__active');
    }
    
    document.querySelector('#sign-up__action').onclick = () => {
        modal.style.display = 'block';
        document.querySelector('#form__modal-log').style.display = 'none';
        document.querySelector('#form__modal-sign').style.display = 'block';
        log_form.classList.remove('form__active');
        sign_form.classList.add('form__active');
    }

    document.querySelector('#log__form').onclick = () => {
        document.querySelector('#form__modal-log').style.display = 'block';
        document.querySelector('#form__modal-sign').style.display = 'none';
        log_form.classList.add('form__active');
        sign_form.classList.remove('form__active');
    }
    document.querySelector('#sign__form').onclick = () => {
        document.querySelector('#form__modal-log').style.display = 'none';
        document.querySelector('#form__modal-sign').style.display = 'block';
        log_form.classList.remove('form__active');
        sign_form.classList.add('form__active');
    }

    window.onclick = (event) => {
        if (event.target == modal_overlay) {
            modal.style.display = 'none';
        }
    }
}