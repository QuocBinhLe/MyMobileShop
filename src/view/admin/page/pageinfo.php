<?php
    include_once '../../controller/pageClass.php';
    $page_class = new PageClass();
    $content_intro = $page_class->getContentInro();
    $member = $page_class->getAllMember();
    $social = $page_class->getSocialNetwork();
?>
<div class="content-wrapper">
    <div class="row">
        <div class="list-box">
            <div class="margin-box">
                <div class="box__wrap">
                    <div class="box__title">
                        <h3>Giới thiệu</h3>
                    </div>
                    <form class="box__content" id="form__content" method="POST" action="">
                        <div class="content__group">
                            <div class="pad-ver--10px">
                                <label class="content__group-label">
                                    Slogan
                                </label>
                                <i class="fas fa-pen" style="margin-left: 8px"></i>
                            </div>
                            <textarea required name="slogan" cols="30" rows="3"><?php echo $content_intro['slogan'] ?></textarea>
                        </div>
                        <div class="content__group">
                            <div class="pad-ver--10px">
                                <label class="content__group-label">
                                    Content 1
                                </label>
                                <i class="fas fa-pen" style="margin-left: 8px"></i>
                            </div>
                            <textarea required name="content_1" cols="30" rows="3"><?php echo $content_intro['content_1'] ?></textarea>
                        </div>
                        <div class="content__group">
                            <div class="pad-ver--10px">
                                <label class="content__group-label">
                                    Content 2
                                </label>
                                <i class="fas fa-pen" style="margin-left: 8px"></i>
                            </div>
                            <textarea required name="content_2" cols="30" rows="3"><?php echo $content_intro['content_2'] ?></textarea>
                        </div>
                        <input type="hidden" name="content" value="update">
                        <div class="content__group">
                            <button class="form__submit-btn" id="update__content">Cập nhập nội dung</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="list-box">
            <div class="margin-box">
                <div class="box__wrap">
                    <div class="box__title">
                        <h3>Thông tin</h3>
                    </div>
                    <div class="flex-row">
                        <div class="l-6 m-6 c-12 border-radius-8 gutter-5px pad-bot-20px">
                            <form class="box__content" id="form__member" method="POST" action="">
                                <div class="content__group">
                                    <div class="pad-ver--10px">
                                        <label class="content__group-label">
                                             <strong>Thành viên</strong>
                                        </label>
                                    </div>
                                </div>
                                <div class="content__group">
                                    <div class="pad-ver--10px">
                                        <label class="content__group-label">
                                            Thành viên 1
                                        </label>
                                    </div>
                                    <input type="text" class="content__group-input" name="member_1" value="<?php echo $member['member_1'] ?>">
                                </div>
                                <div class="content__group">
                                    <div class="pad-ver--10px">
                                        <label class="content__group-label">
                                            Thành viên 2
                                        </label>
                                    </div>
                                    <input type="text" class="content__group-input" name="member_2" value="<?php echo $member['member_2'] ?>">
                                </div>
                                <input type="hidden" name="member" value="update">
                                <div class="content__group">
                                    <button class="form__submit-btn" id="update__menber">Cập nhập</button>
                                </div>
                            </form>
                        </div>
                        <div class="l-6 m-6 c-12 border-radius-8 gutter-5px pad-bot-20px">
                            <form class="box__content" id="form__social" method="POST" action="">
                                <div class="content__group">
                                    <div class="pad-ver--10px">
                                        <label class="content__group-label">
                                            <strong>Mạng xã hội</strong>
                                        </label>
                                    </div>
                                </div>
                                <div class="content__group">
                                    <div class="pad-ver--10px">
                                        <label class="content__group-label">
                                            Hotline
                                        </label>
                                    </div>
                                    <input type="text" class="content__group-input" name="hotline" value="<?php echo $social['hotline'] ?>">
                                </div>
                                <div class="content__group">
                                    <div class="pad-ver--10px">
                                        <label class="content__group-label">
                                            Email
                                        </label>
                                    </div>
                                    <input type="text" class="content__group-input" name="email" value="<?php echo $social['email'] ?>">
                                </div>
                                <div class="content__group">
                                    <div class="pad-ver--10px">
                                        <label class="content__group-label">
                                            Facebook
                                        </label>
                                    </div>
                                    <input type="text" class="content__group-input" name="facebook" value="<?php echo $social['facebook'] ?>">
                                </div>
                                <div class="content__group">
                                    <div class="pad-ver--10px">
                                        <label class="content__group-label">
                                            Youtube
                                        </label>
                                    </div>
                                    <input type="text" class="content__group-input" name="youtube" value="<?php echo $social['youtube'] ?>">
                                </div>
                                <div class="content__group">
                                    <div class="pad-ver--10px">
                                        <label class="content__group-label">
                                            Instagram
                                        </label>
                                    </div>
                                    <input type="text" class="content__group-input" name="instagram" value="<?php echo $social['instagram'] ?>">
                                </div>
                                <div class="content__group">
                                    <div class="pad-ver--10px">
                                        <label class="content__group-label">
                                            Twitter
                                        </label>
                                    </div>
                                    <input type="text" class="content__group-input" name="twitter" value="<?php echo $social['twitter'] ?>">
                                </div>
                                <input type="hidden" name="social" value="update">
                                <div class="content__group">
                                    <button class="form__submit-btn" id="update__social">Cập nhập</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    updateContentIntro();
    updateMember();
</script>