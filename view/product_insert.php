<section class="insert_form">
    
    <h1>THÊM SẢN PHẨM MỚI</h1>


    <div class="form_insert_container">
        <form action="index.php?act=addproduct" method="POST" enctype="multipart/form-data">
            <!-- <div class="form_row">
                <label for="id">Mã SP:</label>
                <input type="text" id="id" name="id" placeholder="Mã sản phẩm">
            </div> -->
            <div class="form_row">
                <label for="name">Tên sản phẩm:</label>
                <input type="text" id="name" name="name" placeholder="Tên sản phẩm">
            </div>
            <div class="form_row">
                <label for="price">Giá:</label>
                <input type="text" id="price" name="price" placeholder="Giá">
            </div>

            <div class="form_row">
                <label for="unit">Đơn vị tính:</label>
                <input type="text" id="unit" name="unit" placeholder="Đơn vị tính">
            </div>

            <!-- Ô cho người dùng tải lên hình ảnh -->
            <div class="form_row">
                <label for="image">Hình ảnh:</label>
                <div>
                    
                    <img src="../images/upload.png" alt="Hình ảnh demo">
                    <input type="file" id="image" name="image">
                    <input type="hidden" name="image" value="<?=$hinhanh_sp?>">
                </div>
            </div>
            
            <input class="btnadd" type="submit" name="btn_addproduct" value="Thêm sản phẩm">
            
            
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