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
            <h3>Gom nhóm sinh viên</h3>
        </div>
        <!-- Button trigger modal -->

        <form method="post" action="http://localhost/QuanLyKyTucXa_new/NhomSV/themmoi" id="addInvoiceForm">
            <!-- Modal -->
            <div class="modal-add">
                <div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="addServiceModalLabel">Thêm nhóm sinh viên</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="txtMaNhom">Mã nhóm</label>
                                    <input type="text" class="form-control" placeholder="Nhập mã nhóm" name="txtMaNhom" id="txtMaHD1" required>
                                    <br>

                                    <label for="txtMaTruongNhom">Mã trưởng nhóm</label>
                                    <input type="text" class="form-control" placeholder="Nhập mã trưởng nhóm" name="txtMaTruongNhom" id="txtMaHD1" required>
                                    <br>

                                    <!-- <label>Mã tòa</label>
                                    <select name="txtMaToa" class="form-control maToa" id="maToa">
                                        <option value="">-------Chọn--------</option>
                                        <?php
                                        $toa = $this->nhomsinhvien->get_all_toa();
                                        while ($row = mysqli_fetch_assoc($toa)) {
                                            echo "<option value='" . $row['maToa'] . "'>" . $row['maToa'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                    <br> -->

                                    <label>Mã phòng</label>
                                    <select name="txtMaPhong" class="form-control maPhong" id="maPhong">
                                        <option value="">-------Chọn--------</option>
                                        <?php
                                        $phong = $this->nhomsinhvien->get_all_phong();
                                        while ($row = mysqli_fetch_assoc($phong)) {
                                            echo "<option value='" . $row['maPhong'] . "'>" . $row['maPhong'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                    <br>
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
                $('.maToa').change(function() {
                    var maToa = $(this).val();
                    if (maToa !== '') {
                        $.ajax({
                            url: 'http://localhost/QuanLyKyTucXa_new/NhomSV/get_phong_by_toa',
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

                                // Reset giá trị tiền phòng khi thay đổi mã phòng
                                $('.tienPhong').val('');
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                console.error(textStatus, errorThrown);
                            }
                        });
                    } else {
                        $('.maPhong').html('<option value="">-------Chọn--------</option>');
                        $('.tienPhong').val(''); // Clear tiền phòng nếu không có mã tòa được chọn
                    }
                });
            });
        </script>


        <!-- gom nhom modal -->
        <form method="post" action="http://localhost/QuanLyKyTucXa_new/NhomSV/update_nhomsv_ttsv" id="addInvoiceForm">
            <!-- Modal -->
            <div class="modal-add">
                <div class="modal fade" id="addGroup" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="addServiceModalLabel">Gom nhóm sinh viên</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">

                                    <label for="txtMaNhom">Mã sinh viên</label>
                                    <select name="txtMaSinhVien" class="form-control maNhom" id="maSinhVien" required>
                                        <option value="">-------Chọn--------</option>
                                        <?php
                                        $masv = $this->nhomsinhvien->get_all_masv_noGroup();
                                        while ($row = mysqli_fetch_assoc($masv)) {
                                            echo "<option value='" . $row['maSinhVien'] . "'>" . $row['maSinhVien'] . "</option>";
                                        }
                                        ?>
                                    </select>

                                    <label for="txtMaNhom">Mã nhóm</label>
                                    <select name="txtMaNhom" class="form-control maNhom" id="maNhom" require>
                                        <option value="">-------Chọn--------</option>
                                        <?php
                                        $manhom = $this->nhomsinhvien->get_all_nhom();
                                        while ($row = mysqli_fetch_assoc($manhom)) {
                                            echo "<option value='" . $row['maNhomSinhVien'] . "'>" . $row['maNhomSinhVien'] . "</option>";
                                        }
                                        ?>
                                    </select>

                                    <!-- <label>Mã tòa</label>
                                    <select name="txtMaToa" class="form-control maToa" id="maToa">
                                        <option value="">-------Chọn--------</option>
                                        <?php
                                        $toa = $this->nhomsinhvien->get_all_toa();
                                        while ($row = mysqli_fetch_assoc($toa)) {
                                            echo "<option value='" . $row['maToa'] . "'>" . $row['maToa'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                    <br> -->

                                    <!-- <label>Mã phòng</label>
                                    <select name="txtMaPhong" class="form-control maPhong" id="maPhong">
                                        <option value="">-------Chọn--------</option>
                                        <?php
                                        $phong = $this->nhomsinhvien->get_all_phong();
                                        while ($row = mysqli_fetch_assoc($phong)) {
                                            echo "<option value='" . $row['maPhong'] . "'>" . $row['maPhong'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                    <br> -->
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="btnLuuGomNhom" onclick="validateForm()">Lưu</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </form>


        <!-- xoa sv khoi nhom modal -->
        <form method="post" action="http://localhost/QuanLyKyTucXa_new/NhomSV/xoa_sv_khoi_nhom" id="addInvoiceForm">
            <!-- Modal -->
            <div class="modal-add">
                <div class="modal fade" id="delSinhVien" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="addServiceModalLabel">Xóa sinh viên khỏi nhóm</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">

                                    <label for="txtMaNhom">Mã nhóm</label>
                                    <select name="txtMaNhom" class="form-control maNhom" id="maNhom" require>
                                        <option value="">-------Chọn--------</option>
                                        <?php
                                        $manhom = $this->nhomsinhvien->get_all_nhom();
                                        while ($row = mysqli_fetch_assoc($manhom)) {
                                            echo "<option value='" . $row['maNhomSinhVien'] . "'>" . $row['maNhomSinhVien'] . "</option>";
                                        }
                                        ?>
                                    </select>

                                    <label>Mã sinh viên</label>
                                    <select name="txtMaSinhVien" class="form-control maSinhVien" id="maSinhVien">
                                        <option value="">-------Chọn--------</option>
                                    </select>
                                    <br>


                                    <!-- <label for="txtMaNhom">Mã sinh viên</label>
                                    <select name="txtMaSinhVien" class="form-control maNhom" id="maSinhVien" required>
                                        <option value="">-------Chọn--------</option>
                                        <?php
                                        $masv = $this->nhomsinhvien->get_all_masv_noGroup();
                                        while ($row = mysqli_fetch_assoc($masv)) {
                                            echo "<option value='" . $row['maSinhVien'] . "'>" . $row['maSinhVien'] . "</option>";
                                        }
                                        ?>
                                    </select> -->

                                    <!-- <label>Mã tòa</label>
                                    <select name="txtMaToa" class="form-control maToa" id="maToa">
                                        <option value="">-------Chọn--------</option>
                                        <?php
                                        $toa = $this->nhomsinhvien->get_all_toa();
                                        while ($row = mysqli_fetch_assoc($toa)) {
                                            echo "<option value='" . $row['maToa'] . "'>" . $row['maToa'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                    <br> -->

                                    <!-- <label>Mã phòng</label>
                                    <select name="txtMaPhong" class="form-control maPhong" id="maPhong">
                                        <option value="">-------Chọn--------</option>
                                        <?php
                                        $phong = $this->nhomsinhvien->get_all_phong();
                                        while ($row = mysqli_fetch_assoc($phong)) {
                                            echo "<option value='" . $row['maPhong'] . "'>" . $row['maPhong'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                    <br> -->
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="btnXoa" onclick="validateForm()">Xóa</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </form>

        <script>
            $(document).ready(function() {
                // Khi thay đổi mã nhóm
                $('.maNhom').change(function() {
                    var maNhom = $(this).val();
                    if (maNhom !== '') {
                        $.ajax({
                            url: 'http://localhost/QuanLyKyTucXa_new/NhomSV/get_masv_by_nhom',
                            method: 'POST',
                            data: {
                                maNhom: maNhom
                            },
                            dataType: 'json',
                            success: function(data) {
                                $('.maSinhVien').html('<option value="">-------Chọn--------</option>');
                                $.each(data, function(index, id) {
                                    $('.maSinhVien').append('<option value="' + id.maSinhVien + '">' + id.maSinhVien + '</option>');
                                });
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                console.error(textStatus, errorThrown);
                            }
                        });
                    } else {
                        $('.maSinhVien').html('<option value="">-------Chọn--------</option>');
                    }
                });
            });
        </script>



        <form method="post" action="http://localhost/QuanLyKyTucXa_new/NhomSV/suadl">
            <!-- Modal -->
            <div class="modal-update">
                <div class="modal fade" id="editServiceModal" tabindex="-1" aria-labelledby="editServiceModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editServiceModalLabel">Sửa nhóm sinh viên</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <label>Mã nhóm:</label>
                                <input type="text" class="form-control" name="txtMaNhom" id="txtMaNhom" value="" readonly style="background-color:#6666664a">

                                <label>Mã trưởng nhóm:</label>
                                <input type="text" class="form-control" name="txtMaTruongNhom" id="txtMaTruongNhom" value="">


                                <!-- <label>Mã tòa</label>
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
                                </select> -->

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
                document.getElementById('txtMaNhom').value = newData.maNhomSinhVien;
                document.getElementById('txtMaTruongNhom').value = newData.maTruongNhom;
                document.getElementById('txtMaPhong').value = newData.maPhong;

                console.log(newData);
            }
        </script>

        <!--Hóa đơn  -->
        <form action="http://localhost/QuanLyKyTucXa_new/NhomSV/timkiem" method="POST">
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
                                                <p>Tiền phòng</p>
                                            </div>
                                            <div class="col-xl-12">
                                                <p class="float-end" id="tienPhong1"></p>
                                            </div>

                                            <hr style="border: 2px solid black;">
                                        </div>

                                        <div class="row">
                                            <div class="col-xl-10">
                                                <p>Trạng thái</p>
                                            </div>
                                            <div class="col-xl-12">
                                                <p class="float-end" id="TrangThai"></p>
                                            </div>
                                            <hr style="border: 2px solid black;">
                                        </div>
                                        <div class="row text-black">
                                            <div class="col-x1-12">
                                                <p class="float-end fw-bold" id="Tong">Total:</p>
                                            </div>
                                            <hr style="border: 2px solid black;">
                                        </div>
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

        <form method="post" action="http://localhost/QuanLyKyTucXa_new/NhomSV/timkiem">
            <div class="form-inline">
                <div class="head_timkiem" style="padding-left: 150px;">
                    <div>
                        <label style="width: 100px;">Mã nhóm</label>
                        <input type="text" placeholder="Tìm mã nhóm" class="form-control" name="txtMaNhom" value="<?php echo isset($_POST['txtMaNhom']) ? htmlspecialchars($_POST['txtMaNhom']) : ''; ?>">
                    </div>
                    <div>
                        <label style="width: 100px;">Mã phòng</label>
                        <input type="text" placeholder="Tìm mã phòng" class="form-control" name="txtMaPhong" value="<?php echo isset($_POST['txtMaPhong']) ? htmlspecialchars($_POST['txtMaPhong']) : ''; ?>">

                    </div>

                    <div>
                        <button type="submit" style="margin: 24px 0px" class="btn btn-success" name="btnTimKiem">Tìm kiếm</button>
                    </div>
                    
                    <div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addServiceModal" style="margin-top: 24px;">Thêm nhóm</button>
                    </div>

                    <div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addGroup" style="margin-top: 24px;">Gom nhóm</button>
                    </div>

                    <div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#delSinhVien" style="margin-top: 24px;">Xóa SV khỏi nhóm</button>
                    </div>

                    <div>
                        <a href="http://localhost/QuanLyKyTucXa_new/NhomSV" style="margin: 24px 0px" class="btn btn-success" name="btnReLoad"><i class="fa-solid fa-rotate-right"></i> Reload</a>
                    </div>
                </div>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã nhóm sinh viên</th>
                            <th>Mã trưởng nhóm</th>
                            <th>Mã phòng</th>
                            <th>Số lượng</th>

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
                                    <td><?php echo htmlspecialchars($row['maNhomSinhVien']) ?></td>
                                    <td><?php echo htmlspecialchars($row['maTruongNhom']) ?></td>
                                    <td><?php echo htmlspecialchars($row['maPhong']) ?></td>
                                    <td><?php echo htmlspecialchars($row['soLuong']) ?></td>
                                    <td>

                                    <td>
                                        <a class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editServiceModal" onclick="hienThiMaGiaoDich('<?php echo htmlspecialchars(json_encode($row)) ?>')"><i class="fa-regular fa-pen-to-square"></i></a>
                                        <!-- <a onclick="return confirm('Bạn có muốn xóa dịch vụ này không?');" href="http://localhost/QuanLyKyTucXa_new/NhomSV/xoa/<?php echo $row['maNhomSinhVien'] ?>" class="btn btn-outline-danger"><i style="color: red;" class="fa-solid fa-trash"></i></a> -->
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