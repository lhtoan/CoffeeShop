<?php
    function getcustomers(){
        $conn = connectdb();

        $sql = "SELECT * FROM khachhang ORDER BY ma_kh ASC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $list = $stmt->fetchAll();
        $conn = null;

        
        return $list;
    }

    function get_customer_byid($id) {
        $conn = connectdb();
    
        $sql = "SELECT * FROM khachhang WHERE ma_kh = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
    
        // Lấy dữ liệu từ kết quả
        $customer = $stmt->fetch(PDO::FETCH_ASSOC);
    
        $conn = null;
    
        return $customer;
    }

    function get_customer_bytt($tt) {
        $conn = connectdb();
    
        $sql = "SELECT * FROM khachhang WHERE ma_kh = :tt OR sdt = :tt";
        $stmt = $conn->prepare($sql);
    
        $stmt->bindValue(':tt', $tt);
    
        $stmt->execute();
        $customer = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $customer;
    }
    


    //thêm khách hàng
    function add_customer($id, $name, $phone, $gender, $birthdate) {
        $conn = connectdb();

        $sql = "INSERT INTO khachhang (ma_kh, ten_kh, sdt, gioitinh, ngay_sinh) VALUES (:id, :name, :phone, :gender, :birthdate)";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':phone', $phone);
        $stmt->bindValue(':gender', $gender);
        $stmt->bindValue(':birthdate', $birthdate);

        $stmt->execute();
    }

    //Xóa khách HÀNG
    function delcustomer($id) {
        $conn = connectdb();
        $sql = "DELETE FROM khachhang WHERE ma_kh= ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);

    }

    //Chỉnh sửa thông tin khách hàng
    function set_customer($id, $name, $gender, $birthdate, $points, $phone) {
        $conn = connectdb();
        $sql = "UPDATE khachhang SET ten_kh = :name, gioitinh = :gender, ngay_sinh = :birthdate, diemtichluy = :points, sdt = :phone WHERE ma_kh = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':gender', $gender);
        $stmt->bindValue(':birthdate', $birthdate);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':points', $points);
        $stmt->bindValue(':phone', $phone);
        
        $stmt->execute();
    }
    //Lấy điểm hiện tại
    function get_current_points($id) {
        $conn = connectdb();
        
        $sql = "SELECT diemtichluy FROM khachhang WHERE ma_kh = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['diemtichluy'];
    }

    //Cập nhật điểm mới
    function update_point($id, $points) {
        $conn = connectdb();
        
        //Điểm hiện tại
        $current_points = get_current_points($id);
        // Cộng điểm mới tích lũy vào số điểm đã có
        $total_points = $current_points + $points;


        $sql = "UPDATE khachhang SET diemtichluy = :points WHERE ma_kh = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':points', $total_points);

        
        $stmt->execute();
    }
?>