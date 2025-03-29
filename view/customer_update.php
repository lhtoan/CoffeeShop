<section class="update_form">
    
    <h1>CHỈNH SỦA THÔNG TIN KHÁCH HÀNG MỚI</h1>

    <?php
        extract($customer_one);
        $gender = $gioitinh;
        
    ?>
    <div class="form_insert_container">
        <form action="index.php?act=update_customer" method="POST" enctype="multipart/form-data">

            <div class="form_row">
                <!-- <label for="id">Mã KH:</label> -->
                <input type="hidden" id="id" name="id" placeholder="Mã khách hàng" value="<?=$ma_kh?>">
            </div>

            <div class="form_row">
                <label for="name">Tên KH:</label>
                <input type="text" id="name" name="name" placeholder="Tên khách hàng" value="<?=$ten_kh?>">
            </div>

            <div class="form_row">
                <label for="name">SĐT:</label>
                <input type="tel" id="phone" name="phone" placeholder="Tên khách hàng" value="<?=$sdt?>">
            </div>

            <div class="form_row">
                <label for="gender">Giới tính:</label>
                <input type="radio" id="male" name="gender" value="Nam" <?php echo ($gender == 'Nam') ? 'checked' : ''; ?>>
                <label for="male">Nam</label>
                <input type="radio" id="female" name="gender" value="Nữ" <?php echo ($gender == 'Nữ') ? 'checked' : ''; ?>>
                <label for="female">Nữ</label>
            </div>

            <div class="form_row">
                <label for="birthdate">Ngày sinh:</label>
                <input type="date" id="birthdate" name="birthdate" value="<?=$ngay_sinh?>">
            </div>

            <div class="form_row">
                <label for="points">Điểm:</label>
                <input type="text" id="points" name="points" value="<?=$diemtichluy?>">
            </div>

            
            
            <input class="btnadd" type="submit" name="btn_update_customer" value="Cập nhật">
            
            
        </form>
    </div>

</section>