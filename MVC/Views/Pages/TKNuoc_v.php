<!-- TKNuoc_v.php -->

<!DOCTYPE html>
<html>

<head>
    <title>Thống Kê Nước Theo Tháng</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <form action="http://localhost/QuanLyKyTucXa_new/TKNuoc/thongkenuoc" method="POST">

        <h1>Thống Kê Nước Theo Tháng</h1>

        <label>Mã phòng</label>
        <select name="txtTKN" class="form-control tkn" id="txtTKN">

            <option value="<?php if (isset($data['id_room'])) echo $data['id_room'] ?>">-----Chọn mã phòng-----</option>
            <?php

            if (isset($data['dulieu1']) && mysqli_num_rows($data['dulieu1']) > 0) {
                while ($c = mysqli_fetch_assoc($data['dulieu1'])) {
            ?>
                    <option value="<?php echo $c['id_room'] ?>"><?php echo $c['id_room'] ?></option>
            <?php
                }
            }

            ?>
        </select>
        <button style="margin: 10px 0px" type="submit" class="btn btn-success" name="btnTKN">Tìm</button>
        <a href="http://localhost/QuanLyKyTucXa_new/TKNuoc/" type="button" class="btn btn-success" >Quay về</a>
        <canvas id="waterUsageChart" width="400" height="120"></canvas>



        <?php
        $labels = [];
        $labels1 = [];
        $dataPoints = [];

        if (isset($data['dulieu'])) {
            while ($row = mysqli_fetch_assoc($data['dulieu'])) {
                var_dump($row);
                $labels1[] = $row['id_room'];
                $labels[] = $row['month'];
                $dataPoints[] = $row['tong_chi_phi_nuoc'];
            }
        }
        ?>

        <script>
            var ctx = document.getElementById('waterUsageChart').getContext('2d');
            var waterUsageChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($labels);  ?>,
                    labels1: <?php echo json_encode($labels1);  ?>,
                    
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
</body>

</html>