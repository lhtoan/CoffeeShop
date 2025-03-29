<?php
    //doanh thu theo ngày
    function get_total_daily($day) {
        $conn = connectdb();

        $sql = "SELECT DATE(ngaylap_hd) AS ngay, SUM(tong_tien) AS tong_doanh_thu
                FROM HoaDon
                WHERE DATE(ngaylap_hd) = :day
                GROUP BY DATE(ngaylap_hd);";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':day', $day);
        $stmt->execute();
        $total = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $total;
    }

    function get_product_sales_total($date) {
        $conn = connectdb();
    
        $sql = "SELECT SUM(chitiethoadon.soluong) AS total_sales
                FROM chitiethoadon
                INNER JOIN hoadon ON chitiethoadon.ma_hd = hoadon.ma_hd
                WHERE DATE(hoadon.ngaylap_hd) =:date";
            
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':date', $date);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $result;
    }

    function get_product_sales_data($date) {
        $conn = connectdb();
    
        $sql = "SELECT sanpham.ten_sp AS product_name, 
                       SUM(chitiethoadon.soluong) AS total_sales
                FROM chitiethoadon
                INNER JOIN sanpham ON chitiethoadon.ma_sp = sanpham.ma_sp
                INNER JOIN hoadon ON chitiethoadon.ma_hd = hoadon.ma_hd
                WHERE DATE(hoadon.ngaylap_hd) = :date
                GROUP BY sanpham.ten_sp";
    
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':date', $date);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $result;
    }
    


    function get_total_monthly_for_year($year) {
        $conn = connectdb();
    
        // Khởi tạo mảng để lưu trữ kết quả
        $monthlyData = [];
    
        // Vòng lặp qua từng tháng trong năm
        for ($i = 1; $i <= 12; $i++) {
            // Tạo ngày bắt đầu và ngày kết thúc cho mỗi tháng
            $start_date = date('Y-m-01', mktime(0, 0, 0, $i, 1, $year));
            $end_date = date('Y-m-t', mktime(0, 0, 0, $i, 1, $year));
    
            // Truy vấn SQL để lấy tổng doanh thu cho tháng hiện tại
            $sql = "SELECT DATE_FORMAT(ngaylap_hd, '%Y-%m') AS thang, SUM(tong_tien) AS tong_doanh_thu
                    FROM HoaDon
                    WHERE ngaylap_hd BETWEEN :start_date AND :end_date
                    GROUP BY DATE_FORMAT(ngaylap_hd, '%Y-%m')";
    
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':start_date', $start_date);
            $stmt->bindValue(':end_date', $end_date);
            $stmt->execute();
    
            // Lấy kết quả từ truy vấn và thêm vào mảng kết quả
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (!empty($result)) {
                $monthlyData[] = $result[0]; // Chỉ lấy kết quả đầu tiên vì chỉ có một kết quả cho mỗi tháng
            } else {
                // Nếu không có dữ liệu cho tháng hiện tại, thêm một mục với doanh thu bằng 0
                $monthlyData[] = array('thang' => date('Y-m', mktime(0, 0, 0, $i, 1, $year)), 'tong_doanh_thu' => 0);
            }
        }
    
        // Trả về mảng chứa tổng doanh thu của tất cả các tháng trong năm
        return $monthlyData;
    }
    

    function get_billtotal_daily($day) {
        $conn = connectdb();

        $sql = "SELECT COUNT(*) AS tong_so_hoa_don
        FROM HoaDon
        WHERE DATE(ngaylap_hd) = :day";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':day', $day);
        $stmt->execute();
        $total = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $total;
    }

    function get_customer_total_daily($day) {
        $conn = connectdb();

        $sql = "SELECT COUNT(ma_kh) AS tong_so_khach_hang
                FROM HoaDon
                WHERE DATE(ngaylap_hd) = :day";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':day', $day);
        $stmt->execute();
        $total = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $total;
    }

    function get_product_sales_day($date) {
        $conn = connectdb();
    
        $sql = "SELECT sp.ten_sp, COALESCE(SUM(ct.soluong), 0) AS so_luong_da_ban
                FROM sanpham sp
                LEFT JOIN 
                    chitiethoadon ct ON sp.ma_sp = ct.ma_sp
                    AND EXISTS (SELECT 1 FROM hoadon hd WHERE ct.ma_hd = hd.ma_hd AND DATE(hd.ngaylap_hd) = :date)
                GROUP BY sp.ten_sp
                ORDER BY so_luong_da_ban DESC;";
    
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':date', $date);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $result;
    }
    

    
?>