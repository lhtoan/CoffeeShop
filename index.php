<?php
    session_start();
    if(!isset($_SESSION['giohang'])) $_SESSION['giohang']=[];

    //Kết nối vói database
    require_once "model/connectdb.php";

    require_once "model/item.php";
    require_once "model/customer.php";
    require_once "model/order_bill.php";

    require_once "view/side_bar.php";
    
    if(isset($_GET['act'])){

        switch ($_GET['act']) {

            case 'catalog':
                require_once "view/products.php";
                break;
            //Thêm sảm phẩm mới
            case 'insert_product':
                require_once "view/product_insert.php";   
                break;
    

            case 'addproduct':
                if (isset($_POST['btn_addproduct'])&&($_POST['btn_addproduct'])) {
                    $name = $_POST['name'];
                    $price = $_POST['price']; 
                    $unit = $_POST['unit'];   
                    
                    // Kiểm tra xem người dùng đã chọn một tập hình ảnh hay không
                    if($_FILES['image']['name']!=""){
                        $target_dir = "images/products/";
                        $image_path = basename($_FILES['image']['name']);
                        $target_file = $target_dir.$image_path;

                        if(move_uploaded_file($_FILES['image']['tmp_name'], $target_file)){
                            
                            add_products($name, $price, $unit, $image_path);
                        }else {
                            echo "error";
                        }
                
                    }
                    
                    
                }
                $listproducts=getproducts();
                require_once "view/products.php";
                break;

            //Thay đổi thông tin sản phẩm
           
            case 'update_product':
                if (isset($_POST['btnupdate'])&&($_POST['btnupdate'])) {
                    $id = $_POST['id'];
                    $name = $_POST['name'];
                    $price = $_POST['price']; 
                    $unit = $_POST['unit'];   
                    
                    // Kiểm tra xem người dùng đã chọn một tập tin hình ảnh mới hay không
                    if($_FILES['image']['name']!=""){
                        $target_dir = "images/products/";
                        $image_path = basename($_FILES['image']['name']);
                        $target_file = $target_dir.$image_path;

                        if(move_uploaded_file($_FILES['image']['tmp_name'], $target_file)){
                            
                            set_products($id, $name, $price, $image_path, $unit);
                        }else {
                            // echo "error";
                        }
              
                    }else {
                        $current_image = $_POST['image'];
                        set_products($id, $name, $price, $current_image, $unit);
                        
                    }
                    $listproducts=getproducts();
                    // require_once "view/products.php";
                    header("Location: index.php?act=catalog&success=1");
                    
                }
                
                break;

           
            case 'edit_product':
                if (isset($_GET['id'])&&($_GET['id']>0)) {
                    $id = $_GET['id'];
                    // Lấy thông tin sản phẩm cần chỉnh sửa từ cơ sở dữ liệu
                    $product_one = get_products_byid($id);
                    require_once "view/product_update.php";
                }else{
                    // require_once "view/404.php";
                }
                
                break;
            
            // Chuyển đến quản lý khách hàng
            case 'customer';
                require_once "view/customers.php";
                break;
            case 'find_customer':
                //Kiểm tra có dữ liệu trong ô input thongtinkhachhang hay chưa
                if(isset($_POST['thongtinkhachhang']) && ($_POST['thongtinkhachhang'])) {
                    $thongtinkhachhang = $_POST['thongtinkhachhang'];
                    $ttkh = get_customer_bytt($thongtinkhachhang);
                    if(isset($ttkh) && !empty($ttkh)){
                        extract($ttkh);
                        require_once "view/cart_detail.php";
                    }else{
                        require_once "view/customer_insert.php";
                    }
                    


                }else {
                    require_once "view/cart_detail.php";
                }
                

                break;
            // Thêm khách hang mới
            case 'insert_customer':
                require_once "view/customer_insert.php";   
                break;
            
            case 'addcustomer':
                if (isset($_POST['btn_addcustomer'])&&($_POST['btn_addcustomer'])) {
                    
                    $name = $_POST['name'];
                    $phone = $_POST['phone'];
                    $gender = $_POST['gender']; 
                    $birthdate = $_POST['birthdate']; 
                    
                    $name = $_POST['name'];

                    // Tách họ tên thành các từ riêng biệt
                    $words = explode(' ', $name);

                    // Khai báo biến để lưu chuỗi gồm các chữ cái đầu của từ đầu tiên của mỗi từ
                    $initials = '';

                    // Lặp qua mỗi từ và lấy chữ cái đầu
                    foreach ($words as $word) {
                        $initials .= substr($word, 0, 1); // Lấy chữ cái đầu của từ
                    }

                    // Chuyển kết quả thành chữ hoa
                    $nameupper = strtoupper($initials);

                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                    $ngay_gio_hien_tai = date("dmYHis");

                    // Tạo ID
                    $id = "KH" . $nameupper . $ngay_gio_hien_tai;
                    
                    add_customer($id, $name, $phone, $gender, $birthdate);

                    $ttkh = get_customer_byid($id);

                    if ($ttkh) {
                        require_once "view/cart_detail.php";
                    }

                    
                }
                else {
                    // Trường hợp không có dữ liệu được gửi đi
                    $listcustomers = getcustomers();
                    require_once "view/cart_detail.php";
                    // header('location: view/cart_detail.php');
                }
                break;
            
            // Chỉnh sửa thông tin khách hàng 
            case 'edit_customer':
                if (isset($_GET['id'])&&($_GET['id']>0)) {
                    $id = $_GET['id'];
                    // Lấy thông tin sản phẩm cần chỉnh sửa từ cơ sở dữ liệu
                    $customer_one = get_customer_byid($id);
                    require_once "view/customer_update.php";
                }else{
                    // require_once "view/404.php";
                }
                
                break;

            
            case 'update_customer':
                if (isset($_POST['btn_update_customer'])&&($_POST['btn_update_customer'])) {
                    $id = $_POST['id'];
                    $name = $_POST['name'];
                    $gender = $_POST['gender']; 
                    $birthdate = $_POST['birthdate'];
                    $points = $_POST['points'];
                    $phone = $_POST['phone'];

                    set_customer($id, $name, $gender, $birthdate, $points, $phone);
                    
                }
                $listcustomers=getcustomers();
                require_once "view/customers.php";
                break;
            
            
            case 'add_order':
                //lấy dữ liệu lưu vào giỏ hàng
                if(isset($_POST['addtoCart']) && ($_POST['addtoCart'])){
                    $id = $_POST['id'];
                    $name = $_POST['name'];
                    $price = $_POST['price'];
                    $soluong = 1;

                    //Nếu check=0 thì số lượng không thay đổi --> không có sản phẩm trùng trong giỏ hàng
                    $check=0;

                    //Kiểm tra sản phẩm có tồn tại trong giỏ hàng hay chưa
                    $i=0;
                    foreach ($_SESSION['giohang'] as $item) {
                        if($item[1] == $name){
                            $soluongmoi=$soluong+$item[3];
                            $_SESSION['giohang'][$i][3]=$soluongmoi;
                            $check=1;
                            break;
                        }
                        $i++;
                    }

                    //khởi tạo mảng
                    if($check==0){
                        $item=array($id,$name,$price,$soluong);
                        $_SESSION['giohang'][]=$item;
                    }
                }
                header('location: index.php');   
                break;

            
            
            //Xóa sản phẩm trong sanh sách order
            case 'del_order':
                if(isset($_GET['i']) && ($_GET['i']>=0)){
                    array_splice($_SESSION['giohang'],$_GET['i'],1);
                    // require_once "view/home.php"; 
                    header('location: index.php');
                }
                break;


            //Đi tới danh sách các sản phẩm đã order
            case 'order_detail':
                require_once "view/cart_detail.php";
                break;
            
            //Thanh toán
            case 'thanhtoan':
                if (isset($_POST['btn_thanhtoan'])&&($_POST['btn_thanhtoan'])){
                    //Lấy dữ liệu
                    $tongtien = $_POST['tongtien'];

                    $diemtichluy = ($tongtien/10000);

                    $ma_kh = $_POST['id_kh'];

                    //timezone Việt Nam
                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                    $ngaylap_hd = date('Y-m-d H:i:s');

                    // Lấy ngày giờ hiện tại
                    $ngay_gio_hien_tai = date("dmYHis");
                    $ma_hd = "HD" . $ngay_gio_hien_tai;
                    if(isset($_SESSION['giohang'])&&(count($_SESSION['giohang']))>0){
                        if($ma_kh=='null'){
                            add_orderbill_no_customer($ma_hd,$ngaylap_hd,$tongtien);
                            update_point($ma_kh,$diemtichluy);
                        }else {
                            add_orderbill($ma_hd,$ngaylap_hd,$tongtien,$ma_kh);
                            update_point($ma_kh,$diemtichluy);
                        }
                        
                    }
                    
                    
                    if(isset($_SESSION['giohang'])&&(count($_SESSION['giohang']))>0){
                        foreach ($_SESSION['giohang'] as $item) {
                            // $item=array($id,$name,$price,$soluong);
                            add_detailbill($ma_hd,$item[0],$item[3],($item[2]*$item[3]));
                            
                        }
                        header("Location: index.php?act=print_bill&id=$ma_hd");
                        unset($_SESSION['giohang']);
                    }else {
                        header("Location: index.php?success=2");
                    }
                    
                
                }
                
                break;

            //Hóa đơn
            case 'bill':
                require_once "view/list_bill.php";
                break;

            case 'print_bill':
                if (isset($_GET['id'])&&($_GET['id']>0)) {
                    $id = $_GET['id'];

                    // Lấy thông tin sản phẩm cần chỉnh sửa từ cơ sở dữ liệu
                    $bill_detail = getbilLby_id($id);
                    $bill_product = get_listbill_byid($id);
                    require_once "view/invoice_detail.php";

                    
                    
                }else{
                    // require_once "view/404.php";
                }
                break;
            
            
            case 'thongke':
                require_once "view/thongke.php";
                
                break;

            case 'find_product':
                //Kiểm tra có dữ liệu trong ô input thongtinkhachhang hay chưa
                if(isset($_POST['thongtinsp']) && ($_POST['thongtinsp'])) {
                    $thongtinsp = $_POST['thongtinsp'];
                    $sp = find_product($thongtinsp);
                    if(isset($sp) && !empty($sp)){
                        extract($sp);
                        require_once "view/products.php";
                    }else{
                        require_once "view/products.php";
                    }
                    


                }else {
                    require_once "view/products.php";
                }
                

                break;
            
            default:
                require_once "view/home.php";
                break;
       
        }
    } else {
        require_once "view/home.php";

    }
?>