<?php
    $thongtinkhachhang = $_POST['thongtinkhachhang'];
?>

<section class="insert_form">
    
    <h1>THÊM SẢN KHÁCH HÀNG MỚI</h1>


    <div class="form_insert_container">
        <form action="index.php?act=addcustomer" method="POST" enctype="multipart/form-data">

            <!-- <div class="form_row">
                <label for="id">Mã KH:</label>
                <input type="text" id="id" name="id" placeholder="Mã khách hàng">
            </div> -->

            <div class="form_row">
                <label for="name">Tên KH:</label>
                <input type="text" id="name" name="name" placeholder="Tên khách hàng">
            </div>

            <div class="form_row">
                <label for="name">SĐT:</label>
                <input type="tel" id="phone" name="phone" placeholder="Số điện thoại" pattern="[0-9]{10,11}" value="<?=$thongtinkhachhang?>">
            </div>

            <div class="form_row">
                <label for="gender">Giới tính:</label>
                <input type="radio" id="male" name="gender" value="Nam">
                <label for="male">Nam</label>
                <input type="radio" id="female" name="gender" value="Nữ">
                <label for="female">Nữ</label>
            </div>

            <div class="form_row">
                <label for="birthdate">Ngày sinh:</label>
                <input type="date" id="birthdate" name="birthdate">
            </div>

            
            
            <input class="btnadd" type="submit" name="btn_addcustomer" value="Thêm mới">
            
            
        </form>
    </div>

</section>