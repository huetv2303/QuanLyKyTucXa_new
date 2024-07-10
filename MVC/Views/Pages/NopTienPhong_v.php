<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý dịch vụ</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>
        #dd1 {
            text-align: center;
        }

        /* #wrapper {
            padding: 50px;
            background-color: #0dcaf02b;
            height: 100%;
            position: absolute;
            width: 87%;
            
        } */


        .form-inline {
            border-radius: 20px;
            background-color: white;
            padding: 40px;
            text-align: left;
        }

        .container-fluid {
            padding: 0px;
        }

        #tableTimKiem {
            margin-left: 400px;
            margin-bottom: 10px;
            margin-top: 10px;
        }



        #inputTenSinhVien {
            margin-left: 10px;
        }
    </style>

</head>



<body>
    <div class="main">
        <div class="header">
            <h3>Nộp tiền phòng</h3>
            <!-- Button trigger modal -->

            <form method="post" action="http://localhost/QuanLyKyTucXa_new/NopTienPhong/themmoi" id="addInvoiceForm">
                <!-- Modal -->
                <div class="modal-add">
                    <div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="addServiceModalLabel">Thêm hóa đơn</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="txtMaHD">Mã giao dịch</label>
                                        <input type="text" class="form-control" placeholder="Nhập mã dịch vụ" name="txtMaGiaoDich" id="txtMaHD1" required>
                                        <span class="error-message" id="errorTxtMaHD"></span>
                                        <br>


                                        <label>Mã tòa</label>
                                        <select name="txtMaToa" class="form-control maToa" id="maToa">
                                            <option value="">-------Chọn--------</option>
                                            <?php
                                            $toa = $this->noptienphong->get_all_toa();
                                            while ($row = mysqli_fetch_assoc($toa)) {
                                                echo "<option value='" . $row['maToa'] . "'>" . $row['maToa'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                        <br>

                                        <label>Mã phòng</label>
                                        <select name="txtMaPhong" class="form-control maPhong" id="maPhong">
                                            <option value="">-------Chọn--------</option>
                                            <?php
                                            $phong = $this->noptienphong->get_all_phong();
                                            while ($row = mysqli_fetch_assoc($phong)) {
                                                echo "<option value='" . $row['maPhong'] . "'>" . $row['maPhong'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                        <br>


                                        <!-- <label>Mã phòng</label>
                                        <select name="txtMaPhong" class="form-control maPhong" id="maPhong">
                                            <option value="">-------Chọn--------</option>
                                        </select>
                                        <br> -->


                                        <label for="tienphong">Số tiền phòng</label>
                                        <input type="text" class="form-control tienPhong" name="txtTienPhong" id="tienPhong" readonly style="background-color:#6666664a">


                                        <label for="thang">Tháng</label>
                                        <input type="text" class="form-control" name="txtThang" id="thang">

                                        <label for="nam">Năm</label>
                                        <input type="text" class="form-control" name="txtNam" id="nam">

                                        <label for="txtNgayTao">Ngày tạo:</label>
                                        <input type="date" class="form-control" name="txtNgayTao" id="txtNgayTao1" required>
                                        <span class="error-message" id="errorTxtNgayTao"></span>
                                        <br>

                                        <label for="txtNgayKT">Hạn nộp:</label>
                                        <input type="date" class="form-control" name="txtNgayKT" id="txtNgayKT1">
                                        <span class="error-message" id="errorTxtNgayKT"></span>
                                        <br>

                                        <label for="txtTrangThai">Trạng thái:</label>


                                        <select name="txtTrangThai" class="form-control" id="txtTrangThai1" required>
                                            <option value="">------Chọn------</option>
                                            <option value="Đã thanh toán">Đã thanh toán</option>
                                            <option value="Chưa thanh toán">Chưa thanh toán</option>
                                        </select>
                                        <span class="error-message" id="errorTxtTrangThai"></span>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="btnLuu" onclick="validateForm()">Lưu</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <script>
                $(document).ready(function() {
                    // Khi thay đổi mã tòa
                    // $('.maToa').change(function() {
                    //     var maToa = $(this).val();
                    //     if (maToa !== '') {
                    //         $.ajax({
                    //             url: 'http://localhost/QuanLyKyTucXa_new/NopTienPhong/get_phong_by_toa',
                    //             method: 'POST',
                    //             data: {
                    //                 maToa: maToa
                    //             },
                    //             dataType: 'json',
                    //             success: function(data) {
                    //                 $('.maPhong').html('<option value="">-------Chọn--------</option>');
                    //                 $.each(data, function(index, room) {
                    //                     $('.maPhong').append('<option value="' + room.maPhong + '">' + room.maPhong + '</option>');
                    //                 });

                    //                 // Reset giá trị tiền phòng khi thay đổi mã phòng
                    //                 $('.tienPhong').val('');
                    //             },
                    //             error: function(jqXHR, textStatus, errorThrown) {
                    //                 console.error(textStatus, errorThrown);
                    //             }
                    //         });
                    //     } else {
                    //         $('.maPhong').html('<option value="">-------Chọn--------</option>');
                    //         $('.tienPhong').val(''); // Clear tiền phòng nếu không có mã tòa được chọn
                    //     }
                    // });

                    // Khi thay đổi mã phòng
                    $('.maPhong').change(function() {
                        var maPhong = $(this).val();
                        if (maPhong !== '') {
                            $.ajax({
                                url: 'http://localhost/QuanLyKyTucXa_new/NopTienPhong/get_tienphong_by_phong',
                                method: 'POST',
                                data: {
                                    maPhong: maPhong
                                },
                                dataType: 'json',

                                success: function(data) {
                                    // Lấy giá trị tiền phòng từ dữ liệu nhận được
                                    var tienPhong = data.tienPhong;

                                    // Hiển thị giá trị tiền phòng đơn giản
                                    $('.tienPhong').val(tienPhong);
                                },

                                error: function(jqXHR, textStatus, errorThrown) {
                                    console.error(textStatus, errorThrown);
                                }
                            });
                        } else {
                            $('.tienPhong').val(''); // Clear giá trị tiền phòng nếu không có mã phòng được chọn
                        }
                    });
                });
            </script>



        </div>
        <form method="post" action="http://localhost/QuanLyKyTucXa_new/NopTienPhong/suadl">
            <!-- Modal -->
            <div class="modal-update">
                <div class="modal fade" id="editServiceModal" tabindex="-1" aria-labelledby="editServiceModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editServiceModalLabel">Sửa hóa đơn</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <label>Mã giao dịch:</label>
                                <input type="text" class="form-control" name="txtMaGiaoDich" id="txtMaGiaoDich" value="" readonly style="background-color:#6666664a">


                                <label>Mã tòa</label>
                                <select name="txtMaToa" class="form-control maToa" id="txtMaToa" require>
                                    <option value="">-------Chọn--------</option>
                                    <?php
                                    if (isset($data['toa_sua']) && mysqli_num_rows($data['toa_sua']) > 0) {
                                        while ($c = mysqli_fetch_assoc($data['toa_sua'])) {
                                    ?>
                                            <option value="<?php echo $c['maToa'] ?>"><?php echo $c['maToa'] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>

                                <label>Mã phòng</label>
                                <select name="txtMaPhong" class="form-control maPhong" id="txtMaPhong" require>
                                    <?php
                                    if (isset($data['maphong_sua']) && mysqli_num_rows($data['maphong_sua']) > 0) {
                                        while ($c = mysqli_fetch_assoc($data['maphong_sua'])) {
                                    ?>
                                            <option value="<?php echo $c['maPhong'] ?>"><?php echo $c['maPhong'] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <!-- <input type="text" name="txtMaPhong" class="form-control maPhong" id="txtMaPhong" require> -->

                                <label for="tienphong">Số tiền phòng</label>
                                <input type="text" class="form-control tienPhong" name="txtTienPhong" id="txtTienPhong" readonly style="background-color:#6666664a">

                                <table>
                                    <thead>
                                        <td>Tháng</td>
                                        <td>
                                            <p style="margin-left: 20px;">Năm</p>
                                        </td>
                                    </thead>

                                    <tbody>
                                        <td><input type="text" class="form-control" name="txtThang" id="txtThang" required></td>
                                        <td><input style="margin-left: 20px;" type="text" class="form-control" name="txtNam" id="txtNam" required></td>
                                    </tbody>
                                </table>
                                <label for="txtNgayTao">Ngày tạo:</label>
                                <input type="date" class="form-control" name="txtNgayTao" id="txtNgayTao" required>

                                <label>Hạn nộp</label>
                                <input type="date" class="form-control" name="txtNgayHetHan" id="txtNgayKT" value="">

                                <label>Trạng thái</label>
                                <select name="txtTrangThai" class="form-control" id="txtTrangThai" required>
                                    <option value="Đã thanh toán">Đã thanh toán</option>
                                    <option value="Chưa thanh toán">Chưa thanh toán</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="btnLuu" class="btn btn-primary">Lưu</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <script>
            function hienThiMaGiaoDich(data) {
                let newData = JSON.parse(data);
                // Target the specific modal by ID and update the input values
                document.getElementById('txtMaGiaoDich').value = newData.maGiaoDich;
                document.getElementById('txtMaPhong').value = newData.maPhong;
                document.getElementById('txtNgayTao').value = newData.ngayNop;
                document.getElementById('txtNgayKT').value = newData.ngayHetHan;
                document.getElementById('txtTrangThai').value = newData.trangThai;
                document.getElementById('txtThang').value = newData.thang;
                document.getElementById('txtNam').value = newData.nam;
                document.getElementById('txtMaToa').value = newData.maToa;
                document.getElementById('txtTienPhong').value = newData.tienPhong;
                console.log(newData);
            }
        </script>

        <!--Hóa đơn  -->
        <form action="http://localhost/QuanLyKyTucXa_new/NopTienPhong/timkiem" method="POST">
            <div class="modal fade" id="ExPortModal" tabindex="-1" aria-labelledby="ExPortModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ExPortModalLabel">Hóa đơn dịch vụ</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="card">
                                <div class="card-body mx-4">
                                    <div class="container">
                                        <div class="row">
                                            <ul class="list-unstyled">
                                                <li class="text-black" id="MaPhong"></li>
                                                <li class="text-black" id="MaGiaoDich"><span class="text-black"></li>
                                                <input type="hidden" name="MaPhong1" id="MaPhong1" value="">
                                                <input type="hidden" name="MaGiaoDich1" id="MaGiaoDich1" value="">
                                            </ul>
                                        </div>

                                        <div class="row">
                                            <hr style="border: 2px solid black;">

                                            <div class="col-xl-10">
                                                <br>
                                                <p>Tiền phòng</p>
                                                
                                            </div>
                                            <div class="col-xl-12">
                                                <p class="float-end" id="tienPhong1"></p>
                                                <br>
                                            </div>

                                            <hr style="border: 2px solid black;">
                                        </div>

                                        <br>

                                        <div class="row">
                                            <div class="col-xl-10">
                                                <p>Trạng thái</p>
                                            </div>
                                            <div class="col-xl-12">
                                                <p class="float-end" id="TrangThai"></p>
                                            </div>
                                            <hr style="border: 2px solid black;">
                                        </div>
                                        <br>
                                        <div class="row text-black">
                                            <div class="col-x1-12">
                                                <p class="float-end fw-bold" id="Tong">Total:</p>
                                            </div>
                                            <hr style="border: 2px solid black;">
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary" name="btnXuatHoaDon"><i class="fa-solid fa-file-invoice"></i> In hóa đơn</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <script>
            function hienThiDuLieuHoaDon(data) {
                let newData = JSON.parse(data);

                document.getElementById('MaGiaoDich').innerText = `Mã giao dịch: ${newData.maGiaoDich}`;
                document.getElementById('MaPhong').innerText = `Mã phòng: ${newData.maPhong}`;

                document.getElementById('TrangThai').innerText = newData.trangThai;
                document.getElementById('tienPhong1').innerText = `${newData.tienPhong} VND`;
                document.getElementById('Tong').innerText = `Tổng: ${newData.tienPhong} VND`;
                document.getElementById('MaGiaoDich1').value = newData.maGiaoDich;
                document.getElementById('MaPhong1').value = newData.maPhong;

                console.log(newData);
            }
        </script>

        <form method="post" action="http://localhost/QuanLyKyTucXa_new/NopTienPhong/timkiem">
            <div class="form-inline" id="wrapper1">
                <div class="head_timkiem" style = "padding-left: 260px;">
                    <div>
                        <label style="width: 100px;">Mã giao dịch</label>
                        <input type="text" placeholder="Tìm mã giao dịch" class="form-control" name="txtMaGiaoDich" value="<?php echo isset($_POST['txtMaGiaoDich']) ? htmlspecialchars($_POST['txtMaGiaoDich']) : ''; ?>">
                    </div>
                    <div>
                        <label style="width: 100px;">Mã phòng</label>
                        <input type="text" placeholder="Tìm mã phòng" class="form-control" name="txtMaPhong" value="<?php echo isset($_POST['txtMaPhong']) ? htmlspecialchars($_POST['txtMaPhong']) : ''; ?>">

                    </div>
                    <div>
                        <button type="submit" style="margin: 24px 0px" class="btn btn-success" name="btnTimKiem">Tìm kiếm</button>
                    </div>
                    <div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addServiceModal" style = "margin-top: 24px;"> Thêm </button>
                    </div>
                    <div>
                        <a href="http://localhost/QuanLyKyTucXa_new/NopTienPhong" style="margin: 24px 0px" class="btn btn-success" name="btnReLoad"><i class="fa-solid fa-rotate-right"></i> Reload</a>
                    </div>
                </div>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã giao dịch</th>
                            <th>Mã toà</th>
                            <th>Mã phòng</th>
                            <th>Tiền phòng</th>
                            <th>Tháng</th>
                            <th>Năm</th>
                            <th>Ngày tạo</th>
                            <th>Hạn nộp</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        if (isset($data['dulieu']) && mysqli_num_rows($data['dulieu']) > 0) {
                            while ($row = mysqli_fetch_assoc($data['dulieu'])) {
                        ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($i++) ?></td>
                                    <td><?php echo htmlspecialchars($row['maGiaoDich']) ?></td>
                                    <td><?php echo htmlspecialchars($row['maToa']) ?></td>
                                    <td><?php echo htmlspecialchars($row['maPhong']) ?></td>
                                    <td><?php echo htmlspecialchars($row['tienPhong']) ?></td>
                                    <td><?php echo htmlspecialchars($row['thang']) ?></td>
                                    <td><?php echo htmlspecialchars($row['nam']) ?></td>
                                    <td><?php echo htmlspecialchars($row['ngayNop']) ?></td>
                                    <td><?php echo htmlspecialchars($row['ngayHetHan']) ?></td>
                                    <td><?php echo htmlspecialchars($row['trangThai']) ?></td>

                                    <td>
                                        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ExPortModal" onclick="hienThiDuLieuHoaDon('<?php echo htmlspecialchars(json_encode($row)) ?>')"><i class="fa-solid fa-file-invoice"></i></a>
                                        <a class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editServiceModal" onclick="hienThiMaGiaoDich('<?php echo htmlspecialchars(json_encode($row)) ?>')"><i class="fa-regular fa-pen-to-square"></i></a>
                                        <a onclick="return confirm('Bạn có muốn xóa dịch vụ này không?');" href="http://localhost/QuanLyKyTucXa_new/NopTienPhong/xoa/<?php echo $row['maGiaoDich'] ?>" class="btn btn-outline-danger"><i style="color: red;" class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div>

</body>


</html>