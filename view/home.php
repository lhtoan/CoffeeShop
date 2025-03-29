<?php
    require_once "model/connectdb.php";
    require_once "model/item.php";
    $newproduct=getproducts();
?>

<section class="product">
    <div class="heading">
        <div class="heading_content">
            <h2>Danh sách sản phẩm</h2></div>
    </div>
    <!-- Hiện danh mục sản phẩm -->
    <div class="product_container">
        <div class="list_products_container">
            <?php
                $kq = "";
                foreach ($newproduct as $item) {
                    extract($item);
                    $kq.=
                        '<a class="item">
                            <div class="sanpham_img">
                                <img src="/images/products/'.$hinhanh_sp.'" alt="Sản phẩm">
                            </div>
                            <div class="sanpham_ten"><h2>'.$ten_sp.'</h2></div>
                            
                            
                            <form id="addtoCartForm" action="index.php?act=add_order" method="post">
                                
                                <input type="hidden" name="id" value="'.$ma_sp.'">
                                <input type="hidden" name="name" value="'.$ten_sp.'">
                                <input type="hidden" name="price" value="'.$gia.'">
                                
                                <div class="btn_order">
                                    <input class="btn_order" type="submit" name="addtoCart" value="'.number_format($gia, 0, '.', '.').'">
                                </div>
                            </form>

                            
                        </a>';
                }
                echo $kq;
            ?>

            
        </div>
    </div>

</section>


<div class="order_list">
    <header><h1>Chi tiết đơn hàng</h1></header>

    <div class="order_detail">
        <table class="list_order">
            <tr>
                <td style="width: 3%;">SL</td>
                <td style="width: 20%;">SP</td>
                <td style="width: 15%;">Giá</td>
                <td style="width: 15%;">TT</td>
                <td style="width: 2%;"></td>
                
            </tr>
            <?php
                $i=0;
                $tongtien=0;
                
                foreach($_SESSION['giohang'] as $item){
                    $tt=$item[2]*$item[3];
                    $tongtien+=$tt;
                    echo
                        '<tr class="tr_list">
                            <td>x'.$item[3].'</td>
                            <td style="text-align: left">'.$item[1].'</td>
                            <td>'.number_format($item[2], 0, '.', '.').'</td>
                            <td>'.number_format($tt, 0, '.', '.').'</td>
                            <td><a href="index.php?act=del_order&i='.$i.'">X</a></td>
                        </tr>';
                    $i++;
                }
                echo '</table>';


                echo
                   '<div class="footer">
                        <table class="footer_detail">
                            <tr>
                                <td style="width: 150px">Tổng:</td>
                                <td style="text-align: right; ">'.number_format($tongtien, 0, '.', '.').'đ</td>
                            </tr>



                            <tr>
                                <td style="width: 150px">Thanh toán:</td>
                                <td style="text-align: right; ">'.number_format($tongtien, 0, '.', '.').'đ</td>
                            </tr>
                        </table>

                        <div class="thanhtoan">
                                <a href="index.php?act=order_detail">Thanh toán</a>
                        </div>


                    </div>';
            ?>
        
    </div>            
</div>

    <!-- Thông báo popup -->
    <div id="popup1" class="popup1">
        <p>Thanh toán thành công!</p>
    </div>

    <div id="popup2" class="popup2">
        <p>Thanh toán không thành công!</p>
    </div>

    <!-- Script để hiển thị thông báo và tự động ẩn nó sau 5 giây -->
<script>
    // Function để hiển thị thông báo popup
    function showPopup1() {
        var popup = document.getElementById("popup1");
        popup.style.display = "block"; // Hiển thị popup

        // Tự động ẩn popup sau 5 giây
        setTimeout(function(){
            popup.style.display = "none"; // Ẩn popup
        }, 2000);
    }

    function showPopup2() {
        var popup = document.getElementById("popup2");
        popup.style.display = "block"; // Hiển thị popup

        // Tự động ẩn popup sau 5 giây
        setTimeout(function(){
            popup.style.display = "none"; // Ẩn popup
        }, 2000);
    }

    // Kiểm tra giá trị tham số 'success' trong URL và hiển thị popup tương ứng
    if (window.location.search.includes('success=1')) {
        showPopup1();
    } else if (window.location.search.includes('success=2')) {
        showPopup2();
    }

    
</script>




