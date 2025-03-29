<section class="update_form">
    
    <h1>CẬP NHẬT SẢN PHẨM</h1>

    <?php
        extract($product_one);
    ?>

    <div class="form_update_container">
        <form action="index.php?act=update_product" method="POST" enctype="multipart/form-data">
            
            <div class="form_row">
                <label for="name">Tên sản phẩm:</label>
                <input type="text" id="name" name="name" value="<?=$ten_sp?>" placeholder="Tên sản phẩm">
            </div>
            <div class="form_row">
                <label for="price">Giá:</label>
                <input type="text" id="price" name="price" value="<?=number_format($gia, 0, '', '')?>" placeholder="Giá">
            </div>

            <div class="form_row">
                <label for="unit">Đơn vị tính:</label>
                <input type="text" id="unit" name="unit" value="<?=$donvitinh?>" placeholder="Đơn vị tính">
            </div>

            <!-- Ô cho người dùng tải lên hình ảnh -->
            <div class="form_row">
                <label for="image">Hình ảnh:</label>
                <div>
                    
                    <img src="images/products/<?=$hinhanh_sp?>" alt="Hình ảnh demo">
                    <input type="file" id="image" name="image">
                    <input type="hidden" name="image" value="<?=$hinhanh_sp?>">
                </div>
            </div>
            

            <!-- Thêm các trường dữ liệu khác của sản phẩm cần chỉnh sửa -->
            <input type="hidden" name="id" value="<?=$id?>">
            <input class="btnupdate" type="submit" name="btnupdate" value="Cập nhật">
            
            
        </form>
    </div>

</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const image = document.querySelector("img");
        const input = document.querySelector("input[type=file]");

        input.addEventListener("change", function() {
            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    image.src = e.target.result;
                }

                reader.readAsDataURL(input.files[0]);
            }
        });
    });
</script>
