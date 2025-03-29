<?php
    require_once "model/connectdb.php";
    require_once "model/order_bill.php";
    
    $listbill=getbill();
?>

    <section class="list_bill">
        <div class="header_addproduct">

        <h1>Quản lý hóa đơn</h1>
        <!-- <a href="index.php?act=insert_customer" class="add_product">Thêm mới</a> -->

        </div>
        <table class="table_list_bill">
            <tr>
                <td style="width: 5%;">STT</td>
                <td style="width: 15%;">Mã HD</td>
                <td style="width: 20%;">Tên khách hàng</td>
                <td style="width: 20%;">Ngày lập</td>
                <td style="width: 15%;">Tổng tiền (VNĐ)</td>
                <td style="width: 100px;">Hành động</td>
            </tr>
                    
            <?php


                if(isset($listbill) && (count($listbill)>0)){
                    $i=1;
                    foreach ($listbill as $item) {
                        extract($item);
                        echo 
                            '<tr>
                                <td>'.$i.'</td>
                                <td style="text-align: left;">'.$ma_hd.'</td>
                                <td>'.$ten_kh.'</td>
                                <td>'.$ngaylap_hd.'</td>
                                <td>'.number_format($tong_tien, 0, '.', '.').'</td>
                                <td><a style="font-weight: bold; color: #007F73;" href="index.php?act=detail_bill&id='.$ma_hd.'">Print</a>
                            </tr>';

                            $i++;
                    }
                }
                // var_dump($list);
                
            ?>
            
        </table>
        
    </section>

    </body>
</html>