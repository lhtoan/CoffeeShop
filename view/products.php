<?php
    require_once "model/connectdb.php";
    require_once "model/item.php";
    
    // Kiểm tra xem nút "Tìm" đã được nhấn chưa
    if(isset($_POST['thongtinsp']) && !empty($_POST['thongtinsp'])) {
        // Nếu có dữ liệu tìm kiếm, gọi hàm find_product để tìm kiếm sản phẩm
        $thongtinsp = $_POST['thongtinsp'];
        $listproducts = find_product($thongtinsp);
            // Kiểm tra xem có sản phẩm nào được tìm thấy không
        if(empty($listproducts)) {
            // Nếu không tìm thấy sản phẩm, hiển thị thông báo bằng JavaScript
            echo '<script>';
            echo 'alert("Không tìm thấy sản phẩm.");';
            echo '</script>';
            $listproducts = getproducts();
        }
    } else {
        // Nếu không có dữ liệu tìm kiếm, lấy tất cả sản phẩm
        $listproducts = getproducts();
    }
?>

    <section class="catalog">
        <div class="header_product">

            <h1>Quản lý sản phẩm</h1>
            <div class="find_sp">
                <form action="index.php?act=find_product" method="post">
                    <input class="input_ttsp" type="text" name="thongtinsp" placeholder="Thông tin sản phẩm">
                    <input class="btn_timkiem" type="submit" value="Tìm">
                </form>
            </div>
            <a href="index.php?act=insert_product" class="add_product">Thêm mới</a>

        </div>
        <table class="table_list_products">
            <tr>
                <td style="width: 5%;">STT</td>
                <td style="width: 10%;">Mã SP</td>
                <td style="width: 30%;">Tên sản phẩm</td>
                <td style="width: 16%;">Hình ảnh</td>
                <td style="width: 15%;">Giá</td>
                <td style="width: 100px;">Hành động</td>
            </tr>
                    
            <?php


                if(isset($listproducts) && (count($listproducts)>0)){
                    $i=1;
                    foreach ($listproducts as $item) {
                        extract($item);
                        echo 
                            '<tr>
                                <td>'.$i.'</td>
                                <td>'.$ma_sp.'</td>
                                <td>'.$ten_sp.'</td>
                                <td><img src="/images/products/'.$hinhanh_sp.'" alt=""></td>
                                <td>'.number_format($gia, 0, '.', '.').' / '.$donvitinh.'</td>
                                <td><a style="font-weight: bold; color: #007F73;" href="index.php?act=edit_product&id='.$ma_sp.'">Edit</a></td>
                            </tr>';

                            $i++;
                    }
                }
                
            ?>
            
        </table>
        
    </section>

    <div id="popup_insert" class="popup_insert">
        <p>Cập nhật thành công!</p>
    </div>

    </body>
</html>


<script>
    // Function để hiển thị thông báo popup
    function showPopup1() {
        var popup = document.getElementById("popup_insert");
        popup.style.display = "block"; // Hiển thị popup

        // Tự động ẩn popup sau 5 giây
        setTimeout(function(){
            popup.style.display = "none"; // Ẩn popup
        }, 2000);
    }

    // Kiểm tra giá trị tham số 'success' trong URL và hiển thị popup tương ứng
    if (window.location.search.includes('success=1')) {
        showPopup1();
    } 
</script>


