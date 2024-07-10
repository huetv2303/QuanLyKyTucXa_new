<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm hợp đồng mới</title>
    <link rel="stylesheet" href="/Public/CSS/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        .lable_tb {
            width: 200px;
        }

        .input_tb {
            width: 350px;
        }

        .dd1 {
            margin-left: 100px;
        }

        .inputSearch {
            width: 400px;
            height: 60px;
        }

        .input-td {
            padding: 5px 10px;
        }
    </style>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="main">
        <br>
        <a style="margin: 20px;" class="btn btn-secondary mb-3" href="http://localhost/QuanLyKyTucXa_new/HopDong">&laquo; Quay lại</a>
        <br>
        <h3 class="content1">Thêm hợp đồng mới</h3>

        <form action="http://localhost/QuanLyKyTucXa_new/HopDongThem/them" class="content1" method="POST">
            <!-- Mã hợp đồng -->
            <div class="row mb-3">
                <div class="col-2">
                    <label for="mhd" class="form-label">Mã hợp đồng</label>
                </div>
                <div class="col">
                    <input required style="width:700px" type="text" name="txtMaHopDong" class="form-control"  id="mhd" value="<?php if (isset($data['maHopDong'])) echo $data['maHopDong'] ?> ">
                </div>
            </div>

            <!-- Nhân viên -->
            <div class="row mb-3">
                <div class="col-2">
                    <label for="mnv" class="form-label">Mã nhân viên</label>
                </div>
                <div class="col">
                    <select data-live-search="true" required style="width:700px" class="selectpicker form-select" name="txtMaNhanVien" id="nhanvien" value="<?php if (isset($data['manNhanVien'])) echo $data['manNhanVien'] ?>">
                        <option value="">-------Chọn--------</option>
                        <?php
                        if (isset($data['nhanvien']) && mysqli_num_rows($data['nhanvien']) > 0) {
                            while ($c = mysqli_fetch_assoc($data['nhanvien'])) {
                        ?>
                                <option value="<?php echo $c['MaNhanVien'] ?>" <?php if (isset($data['MaNhanVien']) && $data['MaNhanVien'] == $c['MaNhanVien']) echo 'selected'; ?>>
                                    <?php echo $c['TenNhanVien']; ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>

            <!-- Chọn trưởng phòng -->
            <div class="row mb-3">
                <div class="col-2">
                    <label for="maTruongNhom" class="form-label">Tên trưởng nhóm</label>
                </div>
                <div class="col">
                    <select required style="width:700px" class="form-select maTruongNhom" name="txtMaTruongNhom" id="maTruongNhom" value="<?php if (isset($data['maTruongNhom'])) echo $data['maTruongNhom'] ?>">
                        <option value="">-------Chọn---------</option>
                        <?php
                        if (isset($data['truongnhom']) && mysqli_num_rows($data['truongnhom']) > 0) {
                            while ($c = mysqli_fetch_assoc($data['truongnhom'])) {
                        ?>
                                <option value="<?php echo $c['maTruongNhom'] ?>" <?php if (isset($data['maTruongNhom']) && $data['maTruongNhom'] == $c['maTruongNhom']) echo 'selected'; ?>>
                                    <?php echo $c['hoTen']; ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>

            <!-- Mã sinh viên -->
            <div class="row mb-3">
                <div class="col-2">
                    <label for="msv" class="form-label">Mã sinh viên</label>
                </div>
                <div class="col">
                    <input style="width:700px" type="text" name="txtMaSinhVien" class="form-control" id="msv" readonly value="<?php if (isset($data['maSinhVien'])) echo $data['maSinhVien'] ?>">
                </div>
            </div>

            <!-- Mã tòa -->
            <div class="row mb-3">
                <div class="col-2">
                    <label for="maToa" class="form-label">Mã tòa</label>
                </div>
                <div class="col">
                    <select required style="width:700px" class="form-select maToa" name="txtMaToa" id="maToa" value="<?php if (isset($data['maToa'])) echo $data['maToa'] ?>">
                        <option value="">-------Chọn--------</option>
                        <?php
                        if (isset($data['toa']) && mysqli_num_rows($data['toa']) > 0) {
                            while ($c = mysqli_fetch_assoc($data['toa'])) {
                        ?>
                                <option value="<?php echo $c['maToa'] ?>" <?php if (isset($data['maToa']) && $data['maToa'] == $c['maToa']) echo 'selected'; ?>>
                                    <?php echo $c['maToa']; ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>

            <!-- Mã phòng -->
            <div class="row mb-3">
                <div class="col-2">
                    <label for="maPhong" class="form-label">Mã phòng</label>
                </div>
                <div class="col">
                    <select required style="width:700px" class="form-select maPhong" name="txtMaPhong" id="maPhong" value="<?php if (isset($data['maPhong'])) echo $data['maPhong'] ?>">
                        <option value="">-------Chọn--------</option>
                        <?php
                        if (isset($data['phong']) && mysqli_num_rows($data['phong']) > 0) {
                            while ($c = mysqli_fetch_assoc($data['phong'])) {
                        ?>
                                <option value="<?php echo $c['maPhong'] ?>" <?php if (isset($data['maPhong']) && $data['maPhong'] == $c['maPhong']) echo 'selected'; ?>>
                                    <?php echo $c['maPhong']; ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>

            <!-- Ngày bắt đầu -->
            <div class="row mb-3">
                <div class="col-2">
                    <label for="nbd" class="form-label">Ngày bắt đầu</label>
                </div>
                <div class="col">
                    <input required type="date" name="txtNgayBatDau" class="form-control" id="nbd" style="width:700px" value="<?php if (isset($data['ngayBatDau'])) echo $data['ngayBatDau'] ?>">
                </div>
            </div>

            <!-- Ngày kết thúc -->
            <div class="row mb-3">
                <div class="col-2">
                    <label for="nkt" class="form-label">Ngày kết thúc</label>
                </div>
                <div class="col">
                    <input required type="date" name="txtNgayKetThuc" class="form-control" id="nkt" style="width:700px" value="<?php if (isset($data['ngayKetThuc'])) echo $data['ngayKetThuc'] ?>">
                </div>
            </div>

            <!-- Tiền cọc -->
            <div class="row mb-3">
                <div class="col-2">
                    <label for="tienPhong" class="form-label">Tiền phòng</label>
                </div>
                <div class="col">
                    <input type="text" name="txtTienPhong" class="form-control" id="tienPhong" style="width:700px" readonly value="<?php if (isset($data['tienPhong'])) echo $data['tienPhong'] ?>">
                </div>
            </div>


            <div class="row mb-3">
                <div class="col">
                    <button type="submit" class="btn btn-primary" name="btnLuu" value="Thêm">Thêm</button>
                </div>
            </div>




        </form>

        <script>
            $(document).ready(function() {
                // Khi thay đổi mã tòa
                $('.maToa').change(function() {
                    var maToa = $(this).val();
                    if (maToa !== '') {
                        $.ajax({
                            url: 'http://localhost/QuanLyKyTucXa_new/HopDongThem/get_phong_by_toa',
                            method: 'POST',
                            data: {
                                maToa: maToa
                            },
                            dataType: 'json',
                            success: function(data) {
                                $('.maPhong').html('<option value="">-------Chọn--------</option>');
                                $.each(data, function(index, room) {
                                    $('.maPhong').append('<option value="' + room.maPhong + '">' + room.maPhong + '</option>');
                                });
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                console.error(textStatus, errorThrown);
                            }
                        });
                    } else {
                        $('.maPhong').html('<option value="">-------Chọn--------</option>');
                        $('#tienPhong').val(''); // Clear giá trị tiền phòng nếu không có mã phòng được chọn
                    }
                });

                $('.maPhong').change(function() {
                    var maPhong = $(this).val();
                    if (maPhong !== '') {
                        $.ajax({
                            url: 'http://localhost/QuanLyKyTucXa_new/HopDongThem/get_tien_phong_by_phong',
                            method: 'POST',
                            data: {
                                maPhong: maPhong
                            },
                            dataType: 'json',
                            success: function(data) {
                                console.log(data); // Log data for debugging
                                // Lấy giá trị tiền phòng từ dữ liệu nhận được
                                var tienPhong = data.tienPhong;
                                // Hiển thị giá trị tiền phòng đơn giản
                                $('#tienPhong').val(tienPhong);
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                console.error(textStatus, errorThrown);
                            }
                        });
                    } else {
                        $('#tienPhong').val(''); // Clear giá trị tiền phòng nếu không có mã phòng được chọn
                    }
                });
            });

            $('.maTruongNhom').change(function() {
                var selectedValue = $(this).val();
                $('#msv').val(selectedValue);
            });
        </script>
    </div>
</body>

</html>