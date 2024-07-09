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

                    <label>Mã Tòa</label>
                    <!-- <input type="input" name="SearchToa" class="form-control tkn" placeholder="Tìm tòa" id="SearchToa" value="<?php echo isset($_POST['SearchToa']) ? htmlspecialchars($_POST['SearchToa']) : ''; ?>"> -->
                    <label>Mã tòa</label>
                    <select name="txtMaToa" class="form-control maToa" id="maToa">
                        <option value="">-------Chọn--------</option>
                        <?php
                        if (isset($data['toa']) && mysqli_num_rows($data['toa']) > 0) {
                            while ($c = mysqli_fetch_assoc($data['toa'])) {
                                $selected = (isset($_POST['txtMaToa']) && $_POST['txtMaToa'] == $c['maToa']) ? 'selected' : '';
                                echo "<option value='{$c['maToa']}' $selected>{$c['maToa']}</option>";
                            }
                        }
                        ?>
                    </select>
<!-- 
                    <select name="SearchToa" class="form-control tkn" id="SearchToa">
                        <option value="">-----Chọn mã phòng-----</option>
                        <?php
                        if (isset($data['phong']) && mysqli_num_rows($data['phong']) > 0) {
                            while ($c = mysqli_fetch_assoc($data['toa'])) {
                                $selected = (isset($_POST['SearchToa']) && $_POST['SearchToa'] == $c['maToa']) ? 'selected' : '';
                                echo "<option value='{$c['maToa']}' $selected>{$c['maToa']}</option>";
                            }
                        }
                        ?>
                    </select> -->

                </div>

                <div>
                    <label>Mã phòng</label>
                    <select name="txtMaPhong" class="form-control maPhong" id="maPhong">
                        <option value="">-------Chọn--------</option>
                        <?php
                        if (isset($data['phong']) && mysqli_num_rows($data['phong']) > 0) {
                            while ($c = mysqli_fetch_assoc($data['phong'])) {
                                $selected = (isset($_POST['txtMaPhong']) && $_POST['txtMaPhong'] == $c['maPhong']) ? 'selected' : '';
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
                $(document).ready(function() {
                    $('.maToa').change(function() {
                        var maToa = $(this).val();
                        if (maToa != '') {
                            $.ajax({
                                url: 'http://localhost/QuanLyKyTucXa_new/TKNuoc/get_phong_by_toa_hopdong',
                                method: 'POST',
                                data: {
                                    maToa: maToa
                                },
                                dataType: 'json',
                                success: function(data) {
                                    $('.maPhong').html('<option value="">-------Chọn--------</option>');
                                    $.each(data, function(index, room) {
                                        $('.maPhong').append('<option value="' + room.maPhong + '">' + room.maPhong + '</option>');
                                    });
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    console.error(textStatus, errorThrown);
                                }
                            });
                        } else {
                            $('.maPhong').html('<option value="">-------Chọn--------</option>');
                        }
                    });
                });
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