<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Quản lý dịch vụ</title>

</head>

<body>
    <div class="main">
        <div class="header">
            <h3>Danh sách hóa đơn dịch vụ</h3>
            <!-- Button trigger modal -->


            <form method="post" action="http://localhost/QuanLyKyTucXa_new//DanhsachHDDV/themmoi" id="addInvoiceForm">
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
                                        <label for="txtMaHD">Mã hóa đơn:</label>
                                        <input type="text" class="form-control" placeholder="Nhập mã dịch vụ" name="txtMaHD" id="txtMaHD1" required>
                                        <span class="error-message" id="errorTxtMaHD"></span>
                                        <br>
                                        <table>
                                            <thead>
                                                <td>Tháng</td>
                                                <td>
                                                    <p style="margin-left: 20px;">Năm</p>
                                                </td>
                                            </thead>

                                            <tbody>
                                                <td><input type="text" placeholder="Nhập tháng" class="form-control" name="txtThang" id="txtThang" required></td>
                                                <td><input style="margin-left: 13px;" type="text" placeholder="Nhập năm" class="form-control" name="txtNam" id="txtNam" required></td>
                                            </tbody>
                                        </table>
                                        <label>Mã tòa</label>
                                        <select name="txtMaToa" class="form-control maToa" id="maToa" require>
                                            <option value="">-------Chọn--------</option>
                                            <?php
                                            if (isset($data['toa']) && mysqli_num_rows($data['toa']) > 0) {
                                                while ($c = mysqli_fetch_assoc($data['toa'])) {
                                            ?>
                                                    <option value="<?php echo $c['maToa'] ?>"><?php echo $c['maToa'] ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>

                                        <label>Mã phòng</label>
                                        <select name="txtMaPhong" class="form-control maPhong" id="maPhong" require>
                                            <option value="">-------Chọn--------</option>
                                        </select>
                                        <br>

                                        <label for="txtDien">Số điện ban đầu:</label>
                                        <input type="number" class="form-control" placeholder="Nhập số điện ban đầu" name="txtDienBD" id="txtDienBD1" require>

                                        <label for="txtDien">Điện:</label>
                                        <input type="number" class="form-control" placeholder="Nhập khối điện hiện tại" name="txtDien" id="txtDien1" require>
                                        <span class="error-message" id="errorTxtDien"></span>
                                        <br>



                                        <label for="txtNuoc">Khối nước ban đầu:</label>
                                        <input type="number" class="form-control" placeholder="Nhập số nước ban đầu" name="txtNuocBD" id="txtNuocBD1" require>

                                        <label for="txtNuoc">Nước:</label>
                                        <input type="number" class="form-control" placeholder="Nhập số nước hiện tại" name="txtNuoc" id="txtNuoc1" required>
                                        <span class="error-message" id="errorTxtNuoc"></span>
                                        <br>

                                        <label for="">Tổng tiền điện nước</label>
                                        <input type="number" readonly style="background-color: darkgrey" class="form-control" name="total_dn" id="total_dn" required>
                                        <br>


                                        <label for="">Tổng tiền dịch vụ</label>
                                        <input type="number" readonly style="background-color: darkgrey" class="form-control" name="total_service" id="total_service" required>

                                        <!-- <label for="">Tổng tiền </label>
                                        <input type="number" readonly class="form-control" name="total" id="total" required> -->

                                        <span class="error-message" id="errorTxtThang"></span>

                                        <label for="txtNgayKT">Hạn nộp:</label>
                                        <input type="date" class="form-control" name="txtNgayKT" id="txtNgayKT1">
                                        <span class="error-message" id="errorTxtNgayKT"></span>
                                        <br>

                                        <input type="hidden" class="form-control" name="txtTrangThai" id="txtTrangThai1" value="Chưa thanh toán">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="btnLuu">Lưu</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
        <form method="post" action="http://localhost/QuanLyKyTucXa_new//DanhsachHDDV/suadl">
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
                                <label>Mã hóa đơn:</label>
                                <input type="text" class="form-control" name="txtMaHD" id="txtMaHD" value="" readonly>


                                <label>Mã tòa</label>
                                <select name="txtMaToa" class="form-control maToa" id="txtMaToa" require>
                                    <option value="">-------Chọn--------</option>
                                    <?php
                                    if (isset($data['toa1']) && mysqli_num_rows($data['toa1']) > 0) {
                                        while ($c = mysqli_fetch_assoc($data['toa1'])) {
                                    ?>
                                            <option value="<?php echo $c['maToa'] ?>"><?php echo $c['maToa'] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>

                                <label>Mã phòng</label>
                                <select type name="txtMaPhong" class="form-control maPhong" id="txtMaPhong" require>
                                    <?php
                                    if (isset($data['phong']) && mysqli_num_rows($data['phong']) > 0) {
                                        while ($c = mysqli_fetch_assoc($data['phong'])) {
                                    ?>
                                            <option value="<?php echo $c['maPhong'] ?>"><?php echo $c['maPhong'] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <!-- <input type="text" name="txtMaPhong" class="form-control maPhong" id="txtMaPhong" require> -->


                                <label for="txtDienDB">Số điện ban đầu:</label>
                                <input type="number" class="form-control" name="txtDienBD" id="txtDienBD">

                                <label for="txtDien">Điện hiện tại:</label>
                                <input type="number" class="form-control" name="txtDien" id="txtDien">
                                <span class="error-message" id="errorTxtDien"></span>
                                <br>

                                <label for="txtNuocDB">Khối nước ban đầu:</label>
                                <input type="number" class="form-control" name="txtNuocBD" id="txtNuocBD">

                                <label for="txtNuoc">Nước hiện tại:</label>
                                <input type="number" class="form-control" name="txtNuoc" id="txtNuoc">
                                <span class="error-message" id="errorTxtNuoc"></span>
                                <br>

                                <table>
                                    <thead>
                                        <td>Tháng</td>
                                        <td>
                                            <p style="margin-left: 20px;">Năm</p>
                                        </td>
                                    </thead>

                                    <tbody>
                                        <td><input type="text" class="form-control" name="txtThang" id="Thang" required></td>
                                        <td><input style="margin-left: 20px;" type="text" class="form-control" name="txtNam" id="Nam" required></td>
                                    </tbody>
                                </table>
                                <label for="txtNgayTao">Ngày tạo:</label>
                                <input type="date" class="form-control" name="txtNgayTao" id="txtNgayTao" required>

                                <label>Hạn nộp</label>
                                <input type="date" class="form-control" name="txtNgayKT" id="txtNgayKT" value="">
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

        <!--Hóa đơn  -->
        <form action="http://localhost/QuanLyKyTucXa_new//DanhsachHDDV/timkiem" method="POST">
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
                                                <li class="text-muted mt-1" id="MaHD"><span class="text-black"></li>
                                                <input type="hidden" name="MaPhong1" id="MaPhong1" value="">
                                                <input type="hidden" name="MaHD1" id="MaHD1" value="">
                                                <input type="hidden" name="month1" id="month1" value="">
                                                <input type="hidden" name="year1" id="year1" value="">
                                                <input type="hidden" name="TrangThai1" id="TrangThai1" value="">
                                            </ul>
                                            <hr>
                                            <div class="col-xl-10">
                                                <p style="margin: 0;">Số Điện đã dùng</p>
                                            </div>
                                            <div class="col-xl-12">
                                                <p class="float-end" id="Dien"><span>kWh</span></p>
                                            </div>
                                            <hr>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-10">
                                                <p>Số Nước đã dùng</p>
                                            </div>
                                            <div class="col-xl-12">
                                                <p class="float-end" id="Nuoc"></p>
                                            </div>
                                            <hr>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-10">
                                                <p>Tổng điện nước</p>
                                            </div>
                                            <div class="col-xl-12">
                                                <p class="float-end" id="TongDN"></p>
                                            </div>
                                            <hr>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-10">
                                                <p>Tổng dịch vụ khác</p>
                                            </div>
                                            <div class="col-xl-12">
                                                <p class="float-end" id="TongDV"></p>
                                            </div>
                                            <hr style="border: 2px solid black;">
                                        </div>


                                        <div class="row">
                                            <div class="col-xl-10">
                                                <p>Tiền tháng</p>
                                            </div>
                                            <div class="col-xl-12">
                                                <p class="float-end" id="year"></p>
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
                            <button type="submit" class="btn btn-primary" name="btnXuat"><i class="fa-solid fa-file-invoice"></i> In hóa đơn</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <form method="post" action="http://localhost/QuanLyKyTucXa_new//DanhsachHDDV/timkiem">
            <div style="padding: 20px" class="form-inline">
                <div class="head_timkiem">
                    <div>
                        <label style="width: 100px;">Mã hóa đơn</label>
                        <input type="text" placeholder="Tìm mã hóa đơn" class="form-control" name="txtMaHD" value="<?php echo isset($_POST['txtMaHD']) ? htmlspecialchars($_POST['txtMaHD']) : ''; ?>">
                    </div>
                    <div>
                        <label style="width: 100px;">Mã phòng</label>
                        <input type="text" placeholder="Tìm tên mã phòng" class="form-control" name="txtMaPhong" value="<?php echo isset($_POST['txtMaPhong']) ? htmlspecialchars($_POST['txtMaPhong']) : ''; ?>">

                    </div>
                    <div>
                        <label style="width: 50px;">Tháng</label>
                        <input style="width: 50px;" type="text" placeholder="Tìm tháng" class="form-control" name="txtThang" value="<?php echo isset($_POST['txtThang']) ? htmlspecialchars($_POST['txtThang']) : ''; ?>">

                    </div>
                    <div>
                        <label style="width: 50px;">Năm</label>
                        <input style="width: 80px;" type="text" placeholder="Tìm năm" class="form-control" name="txtNam" value="<?php echo isset($_POST['txtNam']) ? htmlspecialchars($_POST['txtNam']) : ''; ?>">

                    </div>
                    <div>
                        <label style="width: 150px;">Trang thái</label>
                        <select name="TrangThai" id="" class="form-control">

                            <option value="">-------Chọn--------</option>
                            <option value="Đã thanh toán" <?php echo isset($_POST['TrangThai']) && $_POST['TrangThai'] == 'Đã thanh toán' ? 'selected' : ''; ?>>Đã thanh toán</option>
                            <option value="Chưa thanh toán" <?php echo isset($_POST['TrangThai']) && $_POST['TrangThai'] == 'Chưa thanh toán' ? 'selected' : ''; ?>>Chưa thanh toán</option>
                            <option value="Hóa đơn quá hạn" <?php echo isset($_POST['TrangThai']) && $_POST['TrangThai'] == 'Hóa đơn quá hạn' ? 'selected' : ''; ?>>Hóa đơn quá hạn</option>

                        </select>

                    </div>
                    <div>
                        <button type="submit" style="margin: 24px 0px" class="btn btn-success" name="btnTimKiem">Tìm kiếm</button>
                        <a href="http://localhost/QuanLyKyTucXa_new//DanhsachHDDV/" style="margin: 24px 0px" class="btn btn-success" name="btnReLoad"><i class="fa-solid fa-rotate-right"></i> Reload</a>
                    </div>
                </div>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addServiceModal"> <i class="fa-solid fa-plus"></i> Thêm mới </button>
                <table class="table table-striped table-hover" style="text-align:center">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã hóa đơn</th>
                            <th>Mã phòng</th>
                            <th>Tổng điện nước</th>
                            <th>Tổng dịch vụ khác</th>
                            <th>Tổng</th>
                            <th>Tháng</th>
                            <th>Năm</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        if (isset($data['dulieu']) && mysqli_num_rows($data['dulieu']) > 0) {
                            while ($row = mysqli_fetch_assoc($data['dulieu'])) {
                                // Determine the class for the notification
                                $notificationClass = '';
                                $notificationText = '';
                                if ($row['notifications'] == 'Hóa đơn quá hạn') {
                                    $notificationClass = 'btn btn-danger';
                                    $notificationText = 'Hóa đơn quá hạn';
                                } elseif ($row['notifications'] == 'Đã thanh toán') {
                                    $notificationClass = 'btn btn-success';
                                    $notificationText = 'Đã thanh toán';
                                } else {
                                    $notificationClass = 'btn btn-warning';
                                    $notificationText = 'Chưa thanh toán';
                                }
                        ?>
                                <tr>
                                    <td><?php echo htmlspecialchars(($data['page_number'] - 1) * $data['limit'] + $i) ?></td>
                                    <td><?php echo htmlspecialchars($row['id_invoice']) ?></td>
                                    <td style="display:none;"><?php echo htmlspecialchars($row['maToa']) ?></td>
                                    <td><?php echo htmlspecialchars($row['id_room']) ?></td>
                                    <td><?php echo htmlspecialchars($row['total_electricity_water_cost']) ?></td>
                                    <td style="display:none;"><?php echo htmlspecialchars($row['electricity']) ?></td>
                                    <td style="display:none;"><?php echo htmlspecialchars($row['soDien']) ?></td>
                                    <td style="display:none;"><?php echo htmlspecialchars($row['khoiNuoc']) ?></td>
                                    <td style="display:none;"><?php echo htmlspecialchars($row['water']) ?></td>
                                    <td style="display:none;"><?php echo htmlspecialchars($row['created_day']) ?></td>
                                    <td style="display:none;"><?php echo htmlspecialchars($row['ended_day']) ?></td>
                                    <td style="display:none;"><?php echo htmlspecialchars($row['electricity_cost']) ?></td>
                                    <td style="display:none;"><?php echo htmlspecialchars($row['water_cost']) ?></td>
                                    <td><?php echo htmlspecialchars($row['total_service_cost']) ?></td>
                                    <td><?php echo htmlspecialchars($row['total_cost']) ?></td>
                                    <td><?php echo htmlspecialchars($row['month']) ?></td>
                                    <td><?php echo htmlspecialchars($row['year']) ?></td>
                                    <!-- <td><?php echo htmlspecialchars($row['notifications']) ?></td> -->
                                    <td><span class="<?php echo $notificationClass; ?>"><?php echo $notificationText; ?></span></td>
                                    <td style="display:none;"><?php echo htmlspecialchars($row['status']) ?></td>
                                    <td>
                                        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ExPortModal" onclick="updateDataExportHDDV('<?php echo htmlspecialchars(json_encode($row)) ?>')"><i class="fa-solid fa-file-invoice"></i></a>
                                        <a class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editServiceModal" onclick="updateDataHDDV('<?php echo htmlspecialchars(json_encode($row)) ?>')"><i class="fa-regular fa-pen-to-square"></i></a>
                                        <a onclick="return confirm('Bạn có muốn xóa dịch vụ này không?');" href="http://localhost/QuanLyKyTucXa_new//DanhsachHDDV/xoa/<?php echo $row['id_invoice'] ?>" class="btn btn-outline-danger"><i style="color: red;" class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>
                        <?php
                                $i++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </form>
        <?php
        if (isset($_POST['btnTimKiem'])) {
        } else {

        ?>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?php if ($data['page_number'] <= 1) echo 'disabled'; ?>">
                        <a class="page-link" href="<?php if ($data['page_number'] > 1) echo "?page=" . ($data['page_number'] - 1);
                                                    else echo '#'; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php for ($i = 1; $i <= $data['total_page']; $i++) { ?>
                        <li style="padding: 0px;" class="page-item <?php if ($data['page_number'] == $i) echo 'active'; ?>">
                            <a class="page-link" href="?page=<?php echo ($i); ?>"><?php echo ($i); ?></a>
                        </li>
                    <?php } ?>
                    <li style="padding: 0px;" class="page-item <?php if ($data['page_number'] >= $data['total_page']) echo 'disabled'; ?>">
                        <a class="page-link" href="<?php if ($data['page_number'] < $data['total_page']) echo "?page=" . ($data['page_number'] + 1);
                                                    else echo '#'; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        <?php
        }
        ?>
    </div>

</body>
<script>
    const priceElectricity = 4000;
    const priceWater = 15000;

    function calculateTotal() {
        const electricityUsage = parseFloat(document.getElementById('txtDien1').value) - parseFloat(document.getElementById('txtDienBD1').value);
        const waterUsage = parseFloat(document.getElementById('txtNuoc1').value) - parseFloat(document.getElementById('txtNuocBD1').value);
        // const total_service = parseFloat(document.getElementById('total_service').value);

        const totalElectricityCost = electricityUsage * priceElectricity;
        const totalWaterCost = waterUsage * priceWater;


        const total_Cost_dn = totalElectricityCost + totalWaterCost;

        // const totalCost = total_Cost_dn + total_service;


        if (!isNaN(total_Cost_dn)) {
            document.getElementById('total_dn').value = total_Cost_dn;
        }

        // if (!isNaN(totalCost)) {
        //     document.getElementById('total').value = totalCost;
        // }

    }

    // Gắn hàm tính tổng tiền vào sự kiện thay đổi của các ô nhập liệu
    document.getElementById('txtDien1').addEventListener('input', calculateTotal);
    document.getElementById('txtDienBD1').addEventListener('input', calculateTotal);
    document.getElementById('txtNuoc1').addEventListener('input', calculateTotal);
    document.getElementById('txtNuocBD1').addEventListener('input', calculateTotal);
    // document.getElementById('total_service').addEventListener('input', calculateTotal);



    $(document).ready(function() {
        $('.maToa').change(function() {
            var maToa = $(this).val();
            if (maToa != '') {
                $.ajax({
                    url: 'http://localhost/QuanLyKyTucXa_new/DanhsachHDDV/get_phong_by_toa_hopdong',
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

        $('.maPhong').change(function() {
            var maPhong = $(this).val();
            var thang = $('#txtThang').val();
            var nam = $('#txtNam').val();
            if (maPhong != '' && thang != '' && nam != '') {
                $.ajax({
                    url: 'http://localhost/QuanLyKyTucXa_new/DanhsachHDDV/get_total_service_cost',
                    method: 'POST',
                    data: {
                        maPhong: maPhong,
                        thang: thang,
                        nam: nam
                    }, // Corrected parameter names
                    dataType: 'json',
                    success: function(data) {
                        if (data.total_service_cost !== undefined) {
                            $('#total_service').val(data.total_service_cost);
                        } else {
                            $('#total_service').val(0);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error(textStatus, errorThrown);
                    }
                });
            } else {
                $('#total_service').val(0);
            }
        });
    });
</script>

</html>