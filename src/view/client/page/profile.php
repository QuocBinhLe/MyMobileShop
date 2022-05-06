                <?php
                    include_once '../../controller/userClass.php';
                    $user = new UserClass();

                    // Lấy thông tin user qua biến $_SESSION['username']
                    $user_info = $user->getUserInfo($_SESSION['username']);
                ?>
                
                <div class="profile__content__wrapper col l-10 m-10">
                    <div class="profile__content__part">
                        <div class="profile__content__part-heading">
                            Thông tin tài khoản
                        </div>
                        <div class="profile__content__part-body">
                            <!-- Form để update thông tin cá nhân user -->
                            <form class="row" id="profile__form__update-detail" method="POST">
                                <div class="profile__detail col l-5 m-5 c-12">
                                    <label>Tài khoản</label>
                                    <input class="profile__detail-input" name="username" readonly type="text" value="<?php echo $_SESSION['username']; ?>">
                                </div>
                                <div class="profile__detail col l-5 m-5 c-12">
                                    <label>Họ và tên</label>
                                    <input class="profile__detail-input" name="realname" type="text" value="<?php echo $user_info['realname']; ?>">
                                </div>
                                <div class="profile__detail col l-5 m-5 c-12">
                                    <label>Số điện thoại</label>
                                    <input class="profile__detail-input" name="phone" type="number" value="<?php echo $user_info['phone']; ?>">
                                </div>
                                <div class="profile__detail col l-5 m-5 c-12">
                                    <label>Email</label>
                                    <input class="profile__detail-input" name="email" type="text" value="<?php echo $user_info['email']; ?>">
                                </div>
                                <div class="profile__detail col l-12 m-12 c-1">
                                    <span class="profile__form__response" id="profile__form__update-detail--response"></span>
                                </div>
                                <input type="hidden" name="action" value="update-detail">
                                <div class="profile__detail col l-12 m-12 c-12">
                                    <!-- Nút update thông tin -->
                                    <button class="profile__update-button">Cập nhập</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="mrg-top-40"></div>
                    <div class="mrg-top-40"></div>
                    <div class="profile__content__part">
                        <div class="profile__content__part-heading">
                            Đổi mật khẩu
                        </div>
                        <div class="profile__content__part-body">
                            <!-- Form để đổi mật khẩu user -->
                            <form class="row" id="profile__form__update-password">
                                <div class="profile__detail col l-12 m-12 c-12">
                                    <label>Mật khẩu hiện tại</label>
                                    <input class="profile__detail-input" name="password" type="password" placeholder="Nhập mật khẩu hiện tại">
                                </div>
                                <div class="profile__detail col l-5 m-5 c-12">
                                    <label>Mật khẩu mới</label>
                                    <input class="profile__detail-input" name="new-pw" type="password">
                                </div>
                                <div class="profile__detail col l-5 m-5 c-12">
                                    <label>Nhập lại mật khẩu mới</label>
                                    <input class="profile__detail-input" name="re_new-pw" type="password">
                                </div>
                                <div class="profile__detail col l-12 m-12 c-1">
                                    <span class="profile__form__response" id="profile__form__update-password--response"></span>
                                </div>
                                <input type="hidden" name="action" value="update-pw">
                                <input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>">
                                <div class="profile__detail col l-12 m-12 c-12">
                                    <!-- Nút đổi mật khẩu -->
                                    <button class="profile__update-button">Cập nhập</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <script>
                    updateUserDetail();
                    updateUserPassword();
                </script>
            </div>
        </div>
    </div>
</div>