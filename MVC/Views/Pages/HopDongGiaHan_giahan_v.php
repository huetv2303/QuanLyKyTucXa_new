<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm hợp đồng mới</title>

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
    </style>
</head>

<body>
    <div class="main">
        <div class="content">
            <br>
            <a style="margin: 20px;" class="text-black content1" href="http://localhost/QuanLyKyTucXa_new/HopDongGiaHan">
                << Quay lại</a>
                    <br>
                    <div class="header">
                        <h3>Gia hạn hợp đồng</h3>
                    </div>
                    <form class="content1" action="http://localhost/QuanLyKyTucXa_new/HopDongGiaHan/giahanhd" method="post">
                        <?php
                        if (isset($data['dulieu']) && mysqli_num_rows($data['dulieu']) > 0) {
                            while ($row = mysqli_fetch_array($data['dulieu'])) {
                        ?>
                                <!-- Mã hợp đồng -->
                                <div class="row mb-3">
                                    <div class="col-2">
                                        <label for="mhd" class="form-label">Mã hợp đồng</label>
                                    </div>
                                    <div class="col">
                                        <input style="width:700px" type="text" name="txtMaHopDong" class="form-control" id="mhd" value="<?php echo $row['maHopDong'] ?>" readonly>
                                    </div>
                                </div>

                                <!-- Nhân viên -->
                                <div class="row mb-3">
                                    <div class="col-2">
                                        <label for="mnv" class="form-label">Mã nhân viên</label>
                                    </div>
                                    <div class="col">
                                        <select disabled required style="width:700px" class="selectpicker form-select" name="txtMaNhanVien" id="nhanvien">
                                            <option value="">-----Chọn nhân viên-----</option>
                                            <?php
                                            if (isset($data['nhanvien']) && mysqli_num_rows($data['nhanvien']) > 0) {
                                                while ($c = mysqli_fetch_assoc($data['nhanvien'])) {
                                            ?>
                                                    <option value="<?php echo $c['MaNhanVien'] ?>" <?php if ($c['MaNhanVien'] == $row['MaNhanVien']) echo "selected"; ?>>
                                                        <?php echo $c['TenNhanVien'] ?>
                                                    </option>
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
                                        <label for="mtn" class="form-label">Tên trưởng nhóm</label>
                                    </div>
                                    <div class="col">
                                        <select disabled style="width:700px" class="maTruongNhom form-select" name="txtMaTruongNhom" id="mtn">
                                            <option value="">-----Chọn-----</option>
                                            <?php
                                            if (isset($data['truongnhom']) && mysqli_num_rows($data['truongnhom']) > 0) {
                                                while ($c = mysqli_fetch_assoc($data['truongnhom'])) {
                                            ?>
                                                    <option value="<?php echo $c['maTruongNhom'] ?>" <?php if ($c['maTruongNhom'] == $row['maTruongNhom']) echo "selected"; ?>>
                                                        <?php echo $c['hoTen'] ?>
                                                    </option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>


                                    </div>
                                </div>

                                <!-- ô input Mã trg phòng -->
                                <div class="row mb-3">
                                    <div class="col-2">
                                        <label for="msv" class="form-label">Mã trưởng phòng</label>
                                    </div>
                                    <div class="col">
                                        <input style="width:700px" type="text" name="txtMaSinhVien" class="form-control" id="msv" readonly value="<?php echo $row['maTruongNhom']; ?>">
                                    </div>
                                </div>

                                <!-- Mã tòa -->
                                <div class="row mb-3">
                                    <div class="col-2">
                                        <label for="maToa" class="form-label">Mã tòa</label>
                                    </div>
                                    <div class="col">
                                        <select disabled style="width:700px" class="form-select maToa" name="txtMaToa" id="maToa">
                                            <option value="">-------Chọn--------</option>
                                            <?php
                                            if (isset($data['toa']) && mysqli_num_rows($data['toa']) > 0) {
                                                while ($c = mysqli_fetch_assoc($data['toa'])) {
                                            ?>
                                                    <option value="<?php echo $c['maToa'] ?>" <?php if ($c['maToa'] == $row['maToa']) echo "selected"; ?>>
                                                        <?php echo $c['maToa']; ?>
                                                    </option>
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
                                        <select disabled style="width:700px" class="form-select maPhong" name="txtMaPhong" id="maPhong">
                                            <option value="">-------Chọn--------</option>
                                            <?php
                                            // Nếu có dữ liệu phòng từ controller
                                            if (isset($data['phong']) && mysqli_num_rows($data['phong']) > 0) {
                                                while ($phong = mysqli_fetch_assoc($data['phong'])) {
                                            ?>
                                                    <option value="<?php echo $phong['maPhong']; ?>" <?php if ($phong['maPhong'] == $row['maPhong']) echo "selected"; ?>>
                                                        <?php echo $phong['maPhong']; ?>
                                                    </option>
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
                                        <input readonly type="date" name="txtNgayBatDau" class="form-control" id="nbd" style="width:700px" value="<?php echo $row['ngayBatDau'] ?>">
                                    </div>
                                </div>

                                <!-- Ngày kết thúc -->
                                <div class="row mb-3">
                                    <div class="col-2">
                                        <label for="nkt" class="form-label">Ngày kết thúc</label>
                                    </div>
                                    <div class="col">
                                        <input readonly type="date" name="txtNgayKetThuc" class="form-control" id="nkt" style="width:700px" value="<?php echo $row['ngayKetThuc'] ?>">
                                    </div>
                                </div>

                                <!-- Ngày gia hạn thêm -->
                                <div class="row mb-3">
                                    <div class="col-2">
                                        <label for="gh" class="form-label">Ngày gia hạn</label>
                                    </div>
                                    <div class="col">
                                        <input required type="date" name="txtNgayGiaHan" class="form-control" id="gh" style="width:700px">
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

                                <!-- tình trạng -->
                                <!-- <div class="row mb-3">
                                    <div class="col-2">
                                        <label for="tinhtrang" class="form-label">Tình trạng</label>
                                    </div>
                                    <div class="col">
                                        <select required style="width:700px" class="input_tb form-select" name="txtTinhTrang" id="tinhtrang">
                                            <option value="Còn hạn" <?php if ($row['tinhTrang'] == "Còn hạn") echo "selected"; ?>>Còn hạn</option>
                                            <option value="Hết hạn" <?php if ($row['tinhTrang'] == "Hết hạn") echo "selected"; ?>>Hết hạn</option>

                                            <?php if ($row['tinhTrang'] == "Gia hạn") echo '<option selected value="Gia hạn">Gia hạn</option>'; ?>
                                        </select>
                                    </div>
                                </div> -->


                        <?php
                            }
                        }
                        ?>
                        <div class="row mb-3">
                            <div class="col">
                                <button type="submit" class="btn btn-primary" name="btnLuu" value="">Gia hạn</button>
                            </div>
                        </div>
                    </form>
        </div>
    </div>


    <script>
        $(document).ready(function() {

            //Lấy giá trị tiền phòng theo phòng đã chọn
            function getRoomRent(maPhong) {
                $.ajax({
                    url: 'http://localhost/QuanLyKyTucXa_new/HopDongThem/get_tien_phong_by_phong',
                    method: 'POST',
                    data: {
                        maPhong: maPhong
                    },
                    dataType: 'json',
                    success: function(data) {
                        console.log(data); // Log dữ liệu để kiểm tra
                        var tienPhong = data.tienPhong;
                        $('#tienPhong').val(tienPhong);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error(textStatus, errorThrown);
                    }
                });
            }

            // kích hoạt hàm getRoomRent -> on document ready
            var selectedMaPhong = $('#maPhong').val(); // Lấy giá trị mã phòng hiện tại
            if (selectedMaPhong !== '') {
                getRoomRent(selectedMaPhong); // Gọi hàm Ajax khi trang web được tải lần đầu
            }


            // Khi thay đổi mã tòa
            $('.maToa').change(function() {
                var maToa = $(this).val();
                if (maToa !== '') {
                    $.ajax({
                        url: 'http://localhost/QuanLyKyTucXa_new/HopDong/get_phong_by_toa',
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
                    $('#tienPhong').val(''); // Xóa giá trị tiền phòng nếu không có mã phòng được chọn
                }
            });

            // Khi thay đổi mã phòng
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
                            console.log(data); // Log dữ liệu để kiểm tra
                            var tienPhong = data.tienPhong;
                            $('#tienPhong').val(tienPhong);
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error(textStatus, errorThrown);
                        }
                    });
                } else {
                    $('#tienPhong').val('');
                }
            });
            $('.maTruongNhom').change(function() {
                var selectedValue = $(this).val();
                $('#msv').val(selectedValue);
            });

        });
    </script>
</body>

</html>