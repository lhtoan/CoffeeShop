
<section class="cart_detail">
    <div class="cart_detail_container">
        <div class="heading"><h1>Chi tiết đơn hàng</h1></div>
        <div class="find_ttkh">
            <form action="index.php?act=find_customer" method="post">
                <input class="input_ttkh" type="text" name="thongtinkhachhang" placeholder="Mã KH/Số điện thoại">
                <input class="btn_timkiem" type="submit" value="Tìm">
            </form>
        </div>
        <div class="ttkhach_hang_container">
            <?php
                if(isset($ttkh) && !empty($ttkh)) {
                    // Hiển thị thông tin khách hàng nếu có
                    extract($ttkh);
                    echo
                        '
                        <div class="ttkhach_hang">
                                <h3>Ma: <span>'.$ma_kh.'</span></h3>
                            <h3>KH: <span>'.$ten_kh.'</span></h3>
                            <h3>Điểm: <span>'.$diemtichluy.'</span></h3>
                        </div>
                        ';
                }

            ?>
        </div>
                 
            

            <div class="cart_order_detail">
                <table class="cart_list_order">
                    <tr>
                        <td style="width: 3%;">STT</td>
                        <td style="width: 20%;">Sản phẩm</td>
                        <td style="width: 15%;">Giá</td>
                        <td style="width: 3%;">SL</td>
                        <td style="width: 15%;">Thành tiền</td>
                        
                    </tr>
                    <?php
                        $i=0;
                        $tongtien=0;
                        
                        foreach($_SESSION['giohang'] as $item){
                            $tt=$item[2]*$item[3];
                            $tongtien+=$tt;
                            echo
                                '<tr class="tr_list">
                                    <td>'.($i+1).'</td>
                                    <td style="text-align: left">'.$item[1].'</td>
                                    <td>'.number_format($item[2], 0, '.', '.').'</td>
                                    <td>x'.$item[3].'</td>
                                    <td>'.number_format($tt, 0, '.', '.').'</td>
                                </tr>';
                            $i++;
                        }
                        echo '</table>';
                    echo '</div>';

                        echo
                        '<div class="cart_footer">
                                <table class="cart_footer_detail">
                                    <tr>
                                        <td>Tổng:</td>
                                        <td>'.number_format($tongtien, 0, '.', '.').'đ</td>
                                    </tr>

                                    <tr>
                                        <td>Tích lũy được:</td>
                                        <td>'.($tongtien/10000).' điểm</td>
                                    </tr>

                                    <tr>
                                        <td>Giảm KM:</td>
                                        <td>(0)đ</td>
                                    </tr>

                                    

                                    <tr>
                                        <td>Giảm TV:</td>
                                        <td>(0)đ</td>
                                    </tr>

                                    <tr>
                                        <td>Thanh toán:</td>
                                        <td>'.number_format($tongtien, 0, '.', '.').'đ</td>
                                    </tr>
                                </table>';

                                


                            
                    ?>
            
                    <div class="cart_thanhtoan">
                        
                        <form action="index.php?act=thanhtoan" method="post" onsubmit="confirmThanhToan(); return false;">
                            <input type="hidden" id="id_kh" name="id_kh" placeholder="Mã KH" value="<?= isset($ttkh['ma_kh']) ? $ttkh['ma_kh'] : 'null' ?>">

                            <input type="hidden" name="tongtien" placeholder="Tổng tiền" value="<?=$tongtien?>">
                            <!-- <input type="text" name="tiennhan" id="tiennhan" placeholder="Tiền nhận"> -->
                            <input type="submit" name="btn_thanhtoan" id="btn_thanhtoan" value="Thanh toán" onclick="printPage()">

                        </form>
                    </div>
            </div>
    </div>



</section>

<!-- <script src="../js/main.js"></script> -->

