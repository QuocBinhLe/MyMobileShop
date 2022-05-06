                <?php
                    include_once '../../controller/orderClass.php';
                    $order = new OrderClass();
                    $order_list = $order->getUserOrderList($_SESSION['username']);
                    $order_success = 0;
                    $order_pendding = 0;;
                    $order_number = 0;
                    $money_spend = 0;
                    $htmlTable = '';
                    foreach($order_list as $item) {
                        $order_number++;
                        $htmlState = '';
                        if ($item['state'] == 0) {
                            $order_pendding++;
                            $htmlState = 'Đang giao';
                        }
                        if ($item['state'] == 1) {
                            $money_spend += $item['total_price'];
                            $htmlState = 'Đã hoàn thành';
                        }
                        if ($item['state'] == -1) {
                            $htmlState = 'Đã hủy';
                        }
                        $htmlTable .= '
                                         <tr class="profile__history__table-row">
                                            <td>'.$item['id'].'</td>
                                            <td>'.$item['date'].'</td>
                                            <td>'.number_format($item['total_price'], 0).'</td>
                                            <td>'.$htmlState.'</td>
                                            <td><a href="order-detail.php?id='.$item['id'].'">Chi tiết</a></td>
                                        </tr>';
                    }
                ?>
                <div class="profile__content__wrapper col l-10 m-10">
                    <div class="profile__content__part">
                        <div class="profile__content__part-heading">
                            Lịch sử đặt hàng
                        </div>
                        <div class="mrg-top-40"></div>
                        <div class="row row__card__box">
                            <div class="card__box col l-3 m-3 c-12">
                                <div class="card__box-heading">Tổng số đơn hàng</div>
                                <div class="card__box-body"><?php echo $order_number; ?></div>
                            </div>
                            <div class="card__box col l-3 m-3 c-12">
                                <div class="card__box-heading">Số đơn hàng đang giao</div>
                                <div class="card__box-body"><?php echo $order_pendding; ?></div>
                            </div>
                            <div class="card__box col l-3 m-3 c-12">
                                <div class="card__box-heading">Tổng tiền giao dịch</div>
                                <div class="card__box-body"><?php echo number_format($money_spend, 0); ?></div>
                            </div>
                        </div>
                        <div class="mrg-top-40"></div>
                        <table class="profile__history__table">
                            <tr class="profile__history__table-row">
                                <td>
                                    <strong>Đơn hàng</strong>
                                </td>
                                <td>
                                    <strong>Thời gian mua</strong>
                                </td>
                                <td>
                                    <strong>Tổng tiền</strong>
                                </td>
                                <td>
                                    <strong>Trạng thái</strong>
                                </td>
                                <td>
                                </td>
                            </tr>
                            <?php echo $htmlTable; ?>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>