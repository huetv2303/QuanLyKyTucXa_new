<!-- TKNuoc_v.php -->

<!DOCTYPE html>
<html>

<head>
    <title>Thống Kê Điện Theo Tháng</title>
</head>
<style>

</style>

<body>
    <div class="main">
        <form action="http://localhost:9090/QuanLyKyTucXa_new/TKDien/thongkedien" method="POST">
            <div style="padding-left: 30px;" class="head_tkdien">
                <h1>Thống Kê Điện Theo Tháng</h1>

                <label>Mã phòng</label>
                <select name="txtTKD" class="form-control tkn" id="txtTKD">

                    <option value="<?php if (isset($data['maPhong'])) echo $data['maPhong'] ?>">-----Chọn mã phòng-----</option>
                    <?php

                    if (isset($data['dulieu1']) && mysqli_num_rows($data['dulieu1']) > 0) {
                        while ($c = mysqli_fetch_assoc($data['dulieu1'])) {
                    ?>
                            <option value="<?php echo $c['maPhong'] ?>"><?php echo $c['maPhong'] ?></option>
                    <?php
                        }
                    }

                    ?>
                </select>
                <button style="margin: 10px 0px" type="submit" class="btn btn-success" name="btnTKD">Tìm</button>
            </div>
            <canvas id="bieudo" width="350" height="120"></canvas>



            <?php
            $labels = [];
            $labels1 = [];
            $dataPoints = [];

            if (isset($data['dulieu'])) {
                while ($row = mysqli_fetch_assoc($data['dulieu'])) {

                    $labels1[] = $row['id_room'];
                    $labels[] = $row['month'];
                    $dataPoints[] = $row['tong_chi_phi_dien'];
                }
            }
            ?>

            <script>
                var ctx = document.getElementById('bieudo').getContext('2d');
                var waterUsageChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: <?php echo json_encode($labels);  ?>,
                        labels1: <?php echo json_encode($labels1);  ?>,

                        datasets: [{
                            label: 'Tổng Chi Phí Điện (VND)',
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