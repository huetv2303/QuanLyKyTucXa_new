<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sinh viên</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>
        #dd1 {
            text-align: center;
        }

        .form-inline {
            border-radius: 20px;
            background-color: white;
            padding: 40px;
            text-align: left;
            border: groove
        }

        .container-fluid {
            padding: 0px;
        }

        #tableTimKiem {
            margin-left: 450px;
            margin-bottom: 10px;
            margin-top: 10px;
        }



        #inputTenSinhVien {
            margin-left: 10px;
        }
    </style>
</head>

<body>
    <form method="post" action="http://localhost/QuanLyKyTucXa_new/SinhVien/themmoi">
        <div id="wrapper" style="height: -webkit-fill-available;">

            <!-- <div class="header" style="color: #08449b">
                <h2 style="margin-left: 300px;">Thêm sinh viên</h2>
            </div> -->

            <div class="form-inline" style="width: 60%; margin-left: 220px; text-align: left;">
                <label>Mã sinh viên</label>
                <input type="text" class="form-control dd1" placeholder="Nhập mã sinh viên" name="txtMaSinhVien" required>

                <label>Họ tên</label>
                <input type="text" class="form-control" placeholder="Nhập họ tên" name="txtHoTen" required>

                <!-- <label>Mã tòa</label>
                <select name="txtMaToa" class="form-control" id="maToa">
                    <option value="">-------Chọn--------</option>
                    <?php
                    $toa = $this->sinhvien->get_all_toa();
                    while ($row = mysqli_fetch_assoc($toa)) {
                        echo "<option value='" . $row['maToa'] . "'>" . $row['maToa'] . "</option>";
                    }
                    ?>
                </select>

                <label>Mã phòng</label>
                <select name="txtMaPhong" class="form-control" id="maPhong">
                    <option value="">-------Chọn--------</option>
                </select> -->

                <label>Email</label>
                <input type="email" class="form-control" placeholder="Nhập email" name="txtEmail" required>

                <label>Số điện thoại</label>
                <input type="number" class="form-control" placeholder="Nhập số điện thoại" name="txtSoDienThoai" required>

                <label>Ngày sinh</label>
                <input type="date" class="form-control" placeholder="Nhập ngày sinh" name="txtNgaySinh" required>

                <label>Giới tính</label>
                <br>
                <select name="txtGioiTinh" id="" class="form-control" required>
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                    <option value="Khác">Khác</option>
                </select>
                <br>

                <label>CCCD</label>
                <input type="number" class="form-control" placeholder="Nhập cccd" name="txtCccd" required>

                <label>Địa chỉ</label>
                <input type="text" class="form-control" placeholder="Nhập địa chỉ" name="txtDiaChi" required>

                <br>
                <button type="submit" class="btn btn-success" name="btnLuu" style="margin-left: 400px;">Lưu</button>
            </div>
        </div>
    </form>

    <script>
        $(document).ready(function() {
            $('#maToa').change(function() {
                var maToa = $(this).val();
                if (maToa != '') {
                    $.ajax({
                        url: 'http://localhost/QuanLyKyTucXa_new/SinhVien/get_phong_by_toa',
                        method: 'POST',
                        data: {
                            maToa: maToa
                        },
                        dataType: 'json',
                        success: function(data) {
                            $('#maPhong').html('<option value="">-------Chọn--------</option>');
                            $.each(data, function(index, room) {
                                $('#maPhong').append('<option value="' + room.maPhong + '">' + room.maPhong + '</option>');
                            });
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error(textStatus, errorThrown);
                        }
                    });
                } else {
                    $('#maPhong').html('<option value="">-------Chọn--------</option>');
                }
            });
        });
    </script>
</body>

</html>