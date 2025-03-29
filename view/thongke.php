<?php
    require_once "model/connectdb.php";
    require_once "model/thongkechitiet.php";
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $current_day = date("Y-m-d");
    $total_daily = get_total_daily($current_day);
    $total_bill = get_billtotal_daily($current_day);
    $total_customer = get_customer_total_daily($current_day);
    $total_product_day = get_product_sales_total($current_day);
    

?>

<section class="thongke">
    <div class="header_addproduct">
        <?php
            echo '<h1>THỐNG KÊ NGÀY: '.date("d/m/Y", strtotime($current_day)).'</h1>';
        ?>
    </div>



    <!-- Main -->
    <main class="main-container">

        <div class="main-cards">

            <div class="card">
                <div class="card-inner">
                    <h2>DOANH THU</h2>
                    
                </div>
                
                <?php
                    if (!empty($total_daily) && isset($total_daily[0]["tong_doanh_thu"])) {
                        echo '<h1>' . number_format($total_daily[0]["tong_doanh_thu"], 0, '.', '.') . 'đ</h1>';
                    } else {
                        echo '<h1>0đ</h1>'; 
                    }
                ?>
            </div>

            <div class="card">
                <div class="card-inner">
                    <h2>HÓA ĐƠN</h2>
                    
                </div>
                <?php  
                    if (!empty($total_bill) && isset($total_bill[0]["tong_so_hoa_don"])) {
                        echo '<h1>' . number_format($total_bill[0]["tong_so_hoa_don"], 0, '.', '.') . '</h1>';
                    } else {
                        echo '<h1>0</h1>';
                    }
                ?>
            </div>

            <div class="card">
                <div class="card-inner">
                    <h2>LƯỢT KHÁCH</h2>
                    
                </div>
                <?php  
                    if (!empty($total_bill) && isset($total_bill[0]["tong_so_hoa_don"])) {
                        echo '<h1>' . number_format($total_bill[0]["tong_so_hoa_don"], 0, '.', '.') . '</h1>';
                    } else {
                        echo '<h1>0</h1>';
                    }
                ?>
            </div>

        </div>

    </main>
    <!-- End Main -->
    <div class="charts">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <div class="bar_pie_chart">
            <div class="bar_chart">
                <h2>DOANH THU THEO NGÀY</h2>
                <canvas id="revenueChart" width="800" height="400"></canvas>
            </div>

            <div class="pie_chart">
                <?php
                    
                    if (!empty($total_product_day) && isset($total_product_day[0]["total_sales"])) {
                        echo '<h2><span>'.$total_product_day[0]["total_sales"].'</span> SẢN PHẨM ĐÃ BÁN RA</h2>';
                    } else {
                        echo '<h2>0 SẢN PHẨM ĐÃ BÁN RA</h2>'; 
                    }
                ?>
                <canvas id="productSalesChart" width="400px" height="200px"></canvas>
            </div>
        </div>
        <div class="product-sales-table">
            <h2>BẢNG THỐNG KÊ SẢN PHẨM BÁN RA</h2>
            <table class="table_slbanra">
                <tr>
                    <th>STT</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Số Lượng Đã Bán</th>
                </tr>

                <?php
                    // Lấy dữ liệu từ cơ sở dữ liệu cho các sản phẩm đã bán ra
                    $productSalesData = get_product_sales_day($current_day);

                    // Kiểm tra nếu mảng dữ liệu trống, gán một giá trị mặc định
                    if(empty($productSalesData)) {
                        echo '<tr><td colspan="3">Không có sản phẩm được bán ra</td></tr>';
                    } else {
                        $count = 1;
                        foreach ($productSalesData as $data) {
                            echo '<tr>';
                            echo '<td>' . $count . '</td>';
                            echo '<td>' . $data['ten_sp'] . '</td>';
                            echo '<td>' . $data['so_luong_da_ban'] . '</td>';
                            echo '</tr>';
                            $count++;
                        }
                    }
                ?>
            </table>
        </div>


        <div class="line_chart">
            <h2>DOANH THU THEO THÁNG</h2>
            <canvas id="monthlyRevenueChart" width="800" height="400"></canvas>
        </div>
        
    </div>

</section>

</body>

</html>

<script>
    
    //Bar chart
    var revenueData = [
        <?php
        
        for ($i = -6; $i <= 0; $i++) {
            $date = date('Y-m-d', strtotime("-$i days"));
            $total_daily = get_total_daily($date);
            $revenue = (!empty($total_daily) && isset($total_daily[0]["tong_doanh_thu"])) ? $total_daily[0]["tong_doanh_thu"] : 0;
            echo $revenue;
            if ($i < 0) {
                echo ",";
            }
        }
        ?>
    ];

    
    var labels = [
        <?php
         for ($i = -6; $i <= 0; $i++) {
            $date = date('Y-m-d', strtotime("-$i days"));
            echo "'" . date('d/m', strtotime($date)) . "'";
            if ($i < 0) {
                echo ",";
            }
        }
        ?>
    ];

    
    var ctx = document.getElementById('revenueChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Doanh thu ngày',
                data: revenueData,
                backgroundColor: '#ff6361', 
                borderColor: '#ff6361',
                borderWidth: 1,
            }]
        },
        options: {
            scales: {
                x: {
                grid: {
                    display: false 
                }
                },
                // y: {
                //     beginAtZero: true,
                //     grid: {
                //     display: false // Ẩn lưới trên trục y
                //     }
                // },
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    //Line chart
    <?php
        // Lấy dữ liệu từ cơ sở dữ liệu cho tất cả các tháng trong năm
        $monthlyData = get_total_monthly_for_year(date("Y", strtotime($current_day))); // Thay thế hàm này bằng hàm thực sự lấy dữ liệu từ cơ sở dữ liệu

        // Tạo mảng dữ liệu và nhãn từ dữ liệu cơ sở dữ liệu
        $monthlyRevenueData = [];
        $monthlyLabels = [];
        foreach ($monthlyData as $data) {
            $monthlyLabels[] = date("m-Y", strtotime($data['thang']));
            $monthlyRevenueData[] = $data['tong_doanh_thu'];
        }
    ?>

    var monthlyRevenueData = <?php echo json_encode($monthlyRevenueData); ?>;
    var monthlyLabels = <?php echo json_encode($monthlyLabels); ?>;

    var ctx = document.getElementById('monthlyRevenueChart').getContext('2d');
    var monthlyChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: monthlyLabels,
            datasets: [{
                label: 'Tổng doanh thu tháng',
                data: monthlyRevenueData,
                fill: false,
                // backgroundColor: 'rgba(7, 102, 173, 0.2)',
                borderColor: '#007F73',
                pointBackgroundColor: '#FF9800',
                tension: 0.1
            }]
        },
        options: {
            scales: {
                // x: {
                // grid: {
                //     display: true // Ẩn lưới trên trục x
                // }
                // },
                y: {
                    beginAtZero: true,
                    grid: {
                    display: false // Ẩn lưới trên trục y
                    }
                }
            }
        }
    });


    //pie chart

    // Lấy dữ liệu từ cơ sở dữ liệu cho các sản phẩm đã bán ra
    <?php
        $productSalesData = get_product_sales_data($current_day);

        $productNames = [];
        $salesPercentages = [];

        // Kiểm tra nếu mảng dữ liệu trống, gán một giá trị mặc định
        if(empty($productSalesData)) {
            $productNames[] = 'Không có sản phẩm';
            $salesPercentages[] = 100;
        } else {
            foreach ($productSalesData as $data) {
                $productNames[] = $data['product_name'];
                $salesPercentages[] = $data['total_sales'];
            }
        }
    ?>

    var salesPercentages = <?php echo json_encode($salesPercentages); ?>;
    var productNames = <?php echo json_encode($productNames); ?>;

    var ctx = document.getElementById('productSalesChart').getContext('2d');
    var productSalesChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: productNames,
            datasets: [{
                data: salesPercentages,
                backgroundColor: Chart.defaults.colorScheme,
                borderColor: Chart.defaults.colorScheme,
                borderWidth: 1
            }]
        },
        options: {
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var dataset = data.datasets[tooltipItem.datasetIndex];
                        var currentValue = dataset.data[tooltipItem.index];
                        return currentValue + ' sản phẩm đã bán';
                    }
                }
            }
        }
    });


</script>
