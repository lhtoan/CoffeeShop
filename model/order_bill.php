<?php
    //thêm hóa đơn
    function add_orderbill($ma_hd,$ngaylap_hd,$tongtien,$ma_kh) {
        $conn = connectdb();

        $sql = "INSERT INTO hoadon (ma_hd, ngaylap_hd, tong_tien, ma_kh) VALUES (:ma_hd, :ngaylap_hd, :tongtien, :ma_kh)";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':ma_hd', $ma_hd);
        $stmt->bindValue(':ngaylap_hd', $ngaylap_hd);
        $stmt->bindValue(':tongtien', $tongtien);
        $stmt->bindValue(':ma_kh', $ma_kh);

        $stmt->execute();
    }

    function add_orderbill_no_customer($ma_hd,$ngaylap_hd,$tongtien) {
        $conn = connectdb();

        $sql = "INSERT INTO hoadon (ma_hd, ngaylap_hd, tong_tien) VALUES (:ma_hd, :ngaylap_hd, :tongtien)";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':ma_hd', $ma_hd);
        $stmt->bindValue(':ngaylap_hd', $ngaylap_hd);
        $stmt->bindValue(':tongtien', $tongtien);

        $stmt->execute();
    }

    function add_detailbill($ma_hd,$ma_sp,$soluong,$dongia) {
        $conn = connectdb();

        $sql = "INSERT INTO chitiethoadon VALUES (:ma_hd, :ma_sp, :soluong, :dongia)";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':ma_hd', $ma_hd);
        $stmt->bindValue(':ma_sp', $ma_sp);
        $stmt->bindValue(':soluong', $soluong);
        $stmt->bindValue(':dongia', $dongia);

        $stmt->execute();
    }

    function getbill(){
        $conn = connectdb();

        $sql = "SELECT * FROM hoadon hd LEFT JOIN khachhang kh on hd.ma_kh = kh.ma_kh ORDER BY hd.ngaylap_hd DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $list = $stmt->fetchAll();
        $conn = null;

        
        return $list;
    }

    function get_listbill_byid($id) {
        $conn = connectdb();
    
        $sql = "SELECT * FROM chitiethoadon ct JOIN sanpham sp ON ct.ma_sp = sp.ma_sp WHERE ct.ma_hd = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
    
        // Lấy tất cả các hàng từ kết quả truy vấn
        $bills = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $conn = null;
    
        return $bills;
    }
    

    function getbilLby_id($id){
        $conn = connectdb();

        $sql = "SELECT * FROM hoadon hd LEFT JOIN khachhang kh on hd.ma_kh = kh.ma_kh WHERE hd.ma_hd = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);

        // set the resulting array to associative
        $bill = $stmt->fetch(PDO::FETCH_ASSOC);
        $conn = null;
    
        return $bill;
    }
?>