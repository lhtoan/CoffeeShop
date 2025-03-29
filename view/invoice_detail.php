<?php
    extract($bill_detail);
    $ngaylap_hd_formatted = date('d-m-Y H:i:s', strtotime($ngaylap_hd));
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="/css/bill.css">
        <title>Hóa đơn</title>
    </head>
    
    <body onload="printPageAndRedirect();">
        
        <div class="bill_container">
            <div class="header">
                <h1>Hốp Coffee</h1>
                <h3><i>Số 1A, phường An Khánh, quận Ninh Kiều, Thành phố Cần Thơ</i></h3>
                <h3>Hotline: 123456789</h3>
                <h3>hopcoffee.com</h3>
            </div>
            <div class="info">
                <?php
                    echo '<div class="info_content">
                            <div class="info_hoadon">
                                <p><strong>Mã HĐ: </strong>'.$ma_hd.'</p>
                                <p><strong>Ngày Lập: </strong>'.$ngaylap_hd_formatted.'</p>
                               
                            </div>

                            <div class="info_khachhang">
                                <p><strong>KH: </strong>'.$ten_kh.'</p>
                               
                            </div>


                        </div>';
                ?>
            </div>
            <table class="table">
                <tr>
                    <th>STT</th>
                    <th>SP</th>
                    <th>SL</th>
                    <th>ĐGia</th>
                    <th>TT</th>
                </tr>
                <?php
                    if(isset($bill_product) && (count($bill_product)>0)){
                        $i=1;
                        foreach ($bill_product as $item) {
                            extract($item);
                            echo    '<tr>
                                        <td>'.$i.'</td>
                                        <td>'.$ten_sp.'</td>
                                        <td>x'.$soluong.'</td>
                                        <td>'.number_format($gia, 0, '.', '.').'</td>
                                        <td>'.number_format($dongia, 0, '.', '.').'</td>
                                    </tr>';
                            $i++;
                        }
                    }
                        
                    
                ?>
                <tr>
                    <td colspan="3">Thành tiền</td>
                    <?php
                        echo '<td colspan="2" class="total">'.number_format($tong_tien, 0, '.', '.').'</td>';
                    ?>
                </tr>
                <tr>
                    <td colspan="3">Giảm</td>
                    <td colspan="2" class="total">0</td>
                </tr>
                <tr>
                    <td colspan="3">Thanh toán</td>
                    <?php
                        echo '<td colspan="2" class="total">'.number_format($tong_tien, 0, '.', '.').'</td>';
                    ?>
                </tr>
                <!-- <tr>
                    <td colspan="4">Tiền khách đưa</td>
                    
                        echo '<td class="total">'.number_format($tong_tien, 0, '.', '.').'</td>';
                    ?>
                </tr>
                <tr>
                    <td colspan="4">Tiền thối</td>
                    
                        echo '<td class="total">'.number_format($tong_tien, 0, '.', '.').'</td>';
                    ?>
                </tr> -->
            </table>
            <p><strong>Lưu ý:</strong></p>
            <ul>
                <li>Giá sản phẩm đã bao gồm VAT 10%.</li>
                <li>Password wifi: hopcoffee12345</li>
                <li>Miễn phí giao hàng hóa đơn trên 50.000 VNĐ.</li>
            </ul>
            <center><h3><i>Cảm ơn và hẹn gặp lại!</i></h3></center>
        </div>
        
    </body>
</html>

<script>
    function printPageAndRedirect() {
        window.print(); // In hóa đơn
        setTimeout(function() {
            window.location.href = 'index.php?success=1'; // Chuyển hướng về trang chủ
        }, 200); 
    }

    // onload="printPageAndRedirect();" 

    // function printPage() {
    //     window.print(); // In hóa đơn
    //     setTimeout(function() {
    //         window.location.href = 'index.php?success=1';
    //     }, 200); 
    // }
</script>
