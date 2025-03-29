<?php
    require_once "model/connectdb.php";
    require_once "model/customer.php";
    
    $listcustomers=getcustomers();
?>

    <section class="customer">
        <div class="header_customer">

            <h1>Quản lý khách hàng</h1>
            <!-- <a href="index.php?act=insert_customer" class="add_product">Thêm mới</a> -->
            <!-- <div class="find_kh">
                <form action="index.php?act=find_product" method="post">
                    <input class="input_kh" type="text" name="thongtinkh" placeholder="Thông tin khách hàng">
                    <input class="btn_timkiem" type="submit" value="Tìm">
                </form>
            </div> -->
        </div>
        <table class="table_list_customers">
            <tr>
                <td style="width: 5%;">STT</td>
                <td style="width: 15%;">Mã KH</td>
                <td style="width: 20%;">Tên khách hàng</td>
                <td style="width: 15%;">Điểm tích lũy</td>
                <td style="width: 100px;">Hành động</td>
            </tr>
                    
            <?php


                if(isset($listcustomers) && (count($listcustomers)>0)){
                    $i=1;
                    foreach ($listcustomers as $item) {
                        extract($item);
                        echo 
                            '<tr>
                                <td>'.$i.'</td>
                                <td style="text-align: left;">'.$ma_kh.'</td>
                                <td>'.$ten_kh.'</td>
                                <td>'.$diemtichluy.'</td>
                                <td><a style="font-weight: bold; color: #007F73;" href="index.php?act=edit_customer&id='.$ma_kh.'">Edit</a></td>
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

<!-- '<tr>
                            <td>'.$i.'</td>
                            <td>'.$id_sp.'</td>
                            <td><input type="text" value="'.$ten.'" style="border: none;"></td>
                            <td>
                    <img src="/images/san_pham/'.$hinhanh.'" alt="">
                    <input type="file" accept="image/*">
                </td>
                            <td><input type="text" value="'.$gia.'" style="border: none;"></td>
                            <td><input type="text" value="'.$mota.'" style="border: none;"></td>
                                <td><a style="font-weight: bold; color: #007F73;" href="indexadmin.php?act=edit&id='.$id_sp.'">Edit</a> | 
                                <a style="font-weight: bold; color: #E72929;" href="indexadmin.php?act=deleteproduct&id='.$id_sp.'" onclick="return confirm(\'Bạn muốn xóa sản phẩm?\')">Delete</a></td>
                            </tr>'; -->