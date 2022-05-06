<div class="mrg-top-40"></div>
    <div class="mrg-top-40"></div>
    <footer class="footer">
        <div class="grid wide">
            <div class="footer-top">
                <div class="col l-8 m-8 c12">
                    <img src="../../asset/img/logo/logo-inverse.jpg" alt="">
                </div>
                <?php 
                    include_once '../../controller/pageClass.php';
                    $page_class = new PageClass();
                    $member = $page_class->getAllMember();
                    $socail = $page_class->getSocialNetwork();
                ?>
                <div class="col l-4 m-4 c-12">
                    <div class="row">
                        <div class="contact__way">
                            <label for="">
                                Hotline
                                <i class="fas fa-phone"></i>
                            </label>
                            <span><?php echo $socail['hotline'] ?></span>
                        </div>
                        <div class="contact__way">
                            <label for="">
                                Email
                                <i class="fas fa-envelope"></i>
                            </label>
                            <span><?php echo $socail['email'] ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="row" style="align-items: start;">
                    <div class="footer-col l-3 m-3 c-12">
                        <label>Sản phẩm</label>
                        <ul class="footer__list">
                            <li class="footer__list-item">Google Pixel</li>
                            <li class="footer__list-item">Iphone</li>
                            <li class="footer__list-item">Nokia</li>
                            <li class="footer__list-item">Sumsung</li>
                        </ul>
                    </div>
                    <div class="footer-col l-3 m-3 c-12">
                        <label>Chính sách</label>
                        <ul class="footer__list">
                            <li class="footer__list-item">
                                <a href="">
                                    Bảo mật
                                </a>
                            </li>
                            <li class="footer__list-item">
                                <a href="">
                                    Đổi trả
                                </a>
                            </li>
                            <li class="footer__list-item">
                                <a href="">
                                    Vận chuyển
                                </a>
                            </li>
                            <li class="footer__list-item">
                                <a href="">
                                    Thanh toán
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer-col l-3 m-3 c-12">
                        <label>Về Store</label>
                        <ul class="footer__list">
                            <li class="footer__list-item"><?php echo $member['member_1']; ?></li>
                            <li class="footer__list-item"><?php echo $member['member_2']; ?></li>
                        </ul>
                    </div>
                    <div class="footer-col l-3 m-3 c-12">
                        <label>Mạng xã hội</label>
                        <ul class="footer__list">
                            <li class="footer__list-item">
                                <a href="<?php echo $socail['facebook'] ?>">
                                    <i class="fab fa-facebook"></i>
                                    Facebook
                                </a>
                            </li>
                            <li class="footer__list-item">
                                <a href="<?php echo $socail['instagram'] ?>">
                                    <i class="fab fa-instagram"></i>
                                    Instagram
                                </a>
                            </li>
                            <li class="footer__list-item">
                                <a href="<?php echo $socail['youtube'] ?>">
                                    <i class="fab fa-youtube"></i>
                                    Youtube
                                </a>
                            </li>
                            <li class="footer__list-item">
                                <a href="<?php echo $socail['twitter'] ?>">
                                    <i class="fab fa-twitter"></i>
                                    Twitter
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>