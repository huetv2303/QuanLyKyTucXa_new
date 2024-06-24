<!DOCTYPE html>
<html>

<head>
    <title>Thống Kê Nước Theo Tháng</title>
</head>

<body>
    <div class="main">
        <form action="http://localhost/QuanLyKyTucXa_new/TKNuoc/thongkenuoc" method="POST">
            <h1 style="padding-left: 20px;">Thống Kê Nước Theo Tháng</h1>

            <div style="padding-left: 30px;" class="head_timkiem">

                <div>
                    <label>Mã phòng</label>
                    <select name="txtTKN" class="form-control tkn" id="txtTKN">
                        <option value="">-----Chọn mã phòng-----</option>
                        <?php
                        if (isset($data['dulieu1']) && mysqli_num_rows($data['dulieu1']) > 0) {
                            while ($c = mysqli_fetch_assoc($data['dulieu1'])) {
                                $selected = (isset($_POST['txtTKN']) && $_POST['txtTKN'] == $c['maPhong']) ? 'selected' : '';
                                echo "<option value='{$c['maPhong']}' $selected>{$c['maPhong']}</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="SearchMonth">Tháng</label>
                    <input type="month" name="SearchMonth" class="form-control tkn" id="SearchMonth" value="<?php echo isset($_POST['SearchMonth']) ? htmlspecialchars($_POST['SearchMonth']) : ''; ?>">
                </div>
                <div style="padding: 13px 0px;">
                    <button style="margin: 10px 0px" type="submit" class="btn btn-success" name="btnTKN">Tìm</button>
                </div>
            </div>
            <canvas id="waterUsageChart" width="350" height="120"></canvas>
            <?php
            $labels = [];
            $labels1 = [];
            $dataPoints = [];

            if (isset($data['dulieu'])) {
                while ($row = mysqli_fetch_assoc($data['dulieu'])) {
                    $labels1[] = $row['id_room'];
                    $labels[] = $row['month'];
                    $dataPoints[] = $row['tong_chi_phi_nuoc'];
                }
            }
            ?>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                var ctx = document.getElementById('waterUsageChart').getContext('2d');
                var waterUsageChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: <?php echo json_encode($labels); ?>,
                        datasets: [{
                            label: 'Tổng Chi Phí Nước (VND)',
                            data: <?php echo json_encode($dataPoints); ?>,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
        </form>
    </div>
</body>

</html>