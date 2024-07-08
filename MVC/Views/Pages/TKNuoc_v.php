<!DOCTYPE html>
<html>

<head>
    <title>Thống Kê Nước Theo Tháng</title>
</head>

<body>
    <div class="main">
        <form action="http://localhost:9090/QuanLyKyTucXa_new/TKNuoc/thongkenuoc" method="POST">
            <h1 style="padding-left: 20px;">Thống Kê Nước Theo Tháng</h1>

            <div style="padding-left: 30px;" class="head_timkiem">

                <div>

                    <label>Mã Tòa</label>
                    <!-- <input type="input" name="SearchToa" class="form-control tkn" placeholder="Tìm tòa" id="SearchToa" value="<?php echo isset($_POST['SearchToa']) ? htmlspecialchars($_POST['SearchToa']) : ''; ?>"> -->
                    <select name="SearchToa" class="form-control tkn" id="SearchToa">
                        <option value="">-----Chọn mã phòng-----</option>
                        <?php
                        if (isset($data['toa']) && mysqli_num_rows($data['toa']) > 0) {
                            while ($c = mysqli_fetch_assoc($data['toa'])) {
                                $selected = (isset($_POST['SearchToa']) && $_POST['SearchToa'] == $c['maToa']) ? 'selected' : '';
                                echo "<option value='{$c['maToa']}' $selected>{$c['maToa']}</option>";
                            }
                        }
                        ?>
                    </select>

                </div>

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
                    <input type="input" name="SearchMonth" class="form-control tkn" placeholder="Tìm tháng" id="SearchMonth" value="<?php echo isset($_POST['SearchMonth']) ? htmlspecialchars($_POST['SearchMonth']) : ''; ?>">
                </div>
                <div>
                    <label for="SearchMonth">Năm</label>
                    <input type="year" name="SearchYear" class="form-control tkn" placeholder="Tìm năm" id="SearchYear" value="<?php echo isset($_POST['SearchYear']) ? htmlspecialchars($_POST['SearchYear']) : ''; ?>">
                </div>
                <div>
                    <button style="margin: 10px 0px" type="submit" class="btn btn-success" name="btnTKN">Tìm</button>
                    <a href="http://localhost/QuanLyKyTucXa_new/TKNuoc" style="margin: 24px 0px" class="btn btn-success" name="btnReLoad"><i class="fa-solid fa-rotate-right"></i> Reload</a>
                </div>
            </div>
            <canvas id="waterUsageChart" width="350" height="120"></canvas>
            <?php
            $labelMonth = [];
            $labelsYear = [];
            $dataPoints = [];

            if (isset($data['dulieu'])) {
                while ($row = mysqli_fetch_assoc($data['dulieu'])) {
                    $labelsYear[] = $row['year'];
                    $labelMonth[] = $row['month'];
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
                        labels: <?php echo json_encode(array_map(function ($labelMonth, $labelsYear) {
                                    return $labelMonth . ' - ' . $labelsYear;
                                }, $labelMonth, $labelsYear)); ?>,
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
                        },

                    }
                });
            </script>
        </form>
    </div>
</body>

</html>