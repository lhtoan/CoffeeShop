<?php
    function getproducts(){
        $conn = connectdb();

        $sql = "SELECT * FROM sanpham ORDER BY ma_sp ASC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $list = $stmt->fetchAll();
        $conn = null;

        
        return $list;
    }

    function delproduct($id) {
        $conn = connectdb();
        $sql = "DELETE FROM sanpham WHERE ma_sp= ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);

    }

    function get_products_byid($id) {
        $conn = connectdb();
    
        $sql = "SELECT * FROM sanpham WHERE ma_sp = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
    
        // Lấy dữ liệu từ kết quả
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
    
        $conn = null;
    
        return $product;
    }

    function set_products($id, $name, $price, $image, $unit) {
        $conn = connectdb();
        $sql = "UPDATE sanpham SET ten_sp = :name, gia = :price, hinhanh_sp = :image, donvitinh = :unit WHERE ma_sp = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':price', $price);
        $stmt->bindValue(':image', $image);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':unit', $unit);
        
        $stmt->execute();
    }

    //Thêm sản phẩm mới
    function add_products($name, $price, $unit, $image) {
        $conn = connectdb();
    
        // Tạo một ID tự động
        // $id = uniqid();
        //INSERT INTO sanpham (ten_sp, gia, donvitinh, mota, hinhanh_sp) VALUES ('Cà phê sữa', '20000', 'Ly', 'Kết hợp hài hòa giữa cà phê đen và sữa', 'sp1.png');

        $sql = "INSERT INTO sanpham (ten_sp, gia, donvitinh, hinhanh_sp) VALUES (:name, :price, :unit, :image)";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':price', $price);
        $stmt->bindValue(':unit', $unit);
        $stmt->bindValue(':image', $image);

        $stmt->execute();
    }
    
    //find
    function find_product($tt) {
        $conn = connectdb();
    
        $sql = "SELECT * FROM sanpham WHERE ma_sp LIKE :tt OR ten_sp LIKE :tt OR gia LIKE :tt OR donvitinh = :tt";
        $stmt = $conn->prepare($sql);
    
        $tt = "%" . $tt . "%"; // Thêm dấu % vào trước và sau từ khóa để tìm kiếm bất kỳ từ nào chứa từ khóa
        $stmt->bindValue(':tt', $tt, PDO::PARAM_STR);
    
        $stmt->execute();
        $product = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $product;
    }
    
    
    
    

?>


