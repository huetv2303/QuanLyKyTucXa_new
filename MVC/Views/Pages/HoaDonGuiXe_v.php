<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<script src="http://localhost/QuanLyKyTucXa_new/Public/JS/HoaDon.js">
</script>
<style>
    #text {
        margin-left: 10px;
        width: 200px;
    }
</style>

<body>
    <div class="main">
        <form action="http://localhost/QuanLyKyTucXa_new/HoaDonGuiXe/Search" method="post">
            <div>
                <div class="header">
                    <h3>Danh sách hóa đơn gửi xe</h3>
                </div>
                <br>
                <div class="form-inline" style="text-align: center">
                    <table style="margin: auto;">
                        <tr>
                            <td style="width: 200px;">
                                <input type="text" placeholder="Nhập mã hóa đơn" name="txtBillCode" id="text" class="form-control">
                            </td>

                            <td style="width: 200px;">
                                <input type="text" placeholder="Nhập mã sinh viên" name="txtID" id="text" class="form-control">
                            </td>

                            <td style="width: 200px;">
                                <select name="txtStatus" id="text" class="form-control" style="">
                                    <option value="">--- Chọn trạng thái ---</option>
                                    <option value="Chưa thanh toán">Chưa thanh toán</option>
                                    <option value="Đã thanh toán">Đã thanh toán</option>
                                    <option value="Quá hạn">Quá hạn</option>
                                </select>
                            </td>

                            <td>
                                <button class="btn btn-success" type="submit" name="" style="margin-left: 20px;"><i class="fa-solid fa-magnifying-glass">&nbsp;&nbsp;</i>Tìm kiếm</button>
                            </td>

                            <td>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal" style="margin-left: 20px;"><i class="fa-solid fa-plus">&nbsp;&nbsp;</i>Thêm mới</button>
                            </td>
                        </tr>
                    </table>
                </div>
                <table class="table table-hover" border="1px solid black" style="width: 95%; margin-left: 30px;">
                    <!-- Table header -->
                    <thead>
                        <th>STT</th>
                        <th>Mã hóa đơn</th>
                        <th>Mã sinh viên</th>
                        <th>Tên sinh viên</th>
                        <th>Tháng</th>
                        <th>Thành tiền</th>
                        <th>Ngày lập</th>
                        <th>Loại xe</th>
                        <th>Biển số xe</th>
                        <th>Trạng thái</th>
                        <th>Ghi chú</th>
                        <th>Thao tác</th>
                    </thead>

                    <!-- Table body -->
                    <tbody>
                        <?php
                        if (isset($data['dulieu']) && mysqli_num_rows($data['dulieu']) > 0) {
                            $i = 0;
                            while ($row = mysqli_fetch_assoc($data['dulieu'])) {
                        ?>
                                <tr>
                                    <td><?php echo (++$i) ?></td>
                                    <td><?php echo $row['billCode'] ?></td>
                                    <td><?php echo $row['ID'] ?></td>
                                    <td><?php echo $row['studentName'] ?></td>
                                    <td><?php echo $row['month'] ?></td>
                                    <td><?php echo $row['price'] ?></td>
                                    <td><?php echo $row['invoiceDate'] ?></td>
                                    <td><?php echo $row['vehicle'] ?></td>
                                    <td><?php echo $row['plate'] ?></td>
                                    <td><?php echo $row['status'] ?></td>
                                    <td><?php echo $row['note'] ?></td>
                                    <td>
                                        <a data-bs-toggle="modal" data-bs-target="#ExportModal" class="btn btn-success" onclick="showData('<?php echo htmlspecialchars(json_encode($row)) ?>')"><i class="fa-solid fa-file-invoice"></i></a>
                                        <a href="http://localhost/QuanLyKyTucXa_new/HoaDonGuiXe/Update/<?php echo $row['billCode'] ?>" class="btn btn-outline-primary"><i class="fa-solid fa-pen-to-square"></i></a> &nbsp;
                                        <a onclick="return confirm('Bạn chắc chắn muốn xóa hóa đơn này?')" href="http://localhost/QuanLyKyTucXa_new/HoaDonGuiXe/Delete/<?php echo $row['billCode'] ?>" class="btn btn-outline-danger"><i class="fa-solid fa-trash"></i></a>
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

<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="http://localhost/QuanLyKyTucXa_new/HoaDonGuiXe/Insert" method="post">
                <!-- Modal Header -->
                <div class="modal-header">
                        <h5>THÊM MỚI HÓA ĐƠN</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label>Mã hóa đơn :</label>
                        <input type="text" class="form-control" placeholder="Nhập mã hóa đơn" name="txtBillCode" require>
                        <label>Mã sinh viên :</label>
                        <!-- <input type="text" class="form-control" placeholder="Nhập mã sinh viên" name="txtID" require id=""> -->
                        <select name="txtID" id="txtID" class="form-control" onchange="myFunction(event)" require>
                            <option value="">--- Chọn mã sinh viên ---</option>
                            <?php
                            if (isset($data['id']) && mysqli_num_rows($data['id']) > 0) {
                                while ($row = mysqli_fetch_array($data['id'])) {
                            ?>
                                    <option value="<?php echo $row['ID'] ?>" valuea="<?php echo $row['studentName'] ?>" valueb="<?php echo $row['typeOfVehicle'] ?>" valuec="<?php echo $row['plate'] ?>"><?php echo $row['ID'] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        <label>Tên sinh viên :</label>
                        <input type="text" class="form-control" placeholder="Nhập tên sinh viên" name="txtName" require id="txtName">
                        <label>Tháng :</label>
                        <select name="txtMonth" id="" class="form-control">
                            <option value="">--- Chọn tháng ---</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                        <label>Thành tiền :</label>
                        <select name="txtPrice" id="" class="form-control">
                            <option value="70,000">70,000</option>
                            <option value="150,000">150,000</option>
                        </select>
                        <label>Ngày lập :</label>
                        <input type="date" class="form-control" placeholder="Nhập ngày lập" name="txtDay" require id="">
                        <label>Loại xe:</label>
                        <input type="text" class="form-control" placeholder="" name="txtType" id="txtType">
                        <label>Biển số xe :</label>
                        <input type="text" class="form-control" name="txtPlate" id="txtPlate">
                        <label>Trạng thái :</label>
                        <input type="text" value="Chưa thanh toán" name="txtStatus" id="" class="form-control" readonly>
                        <label>Ghi chú</label>
                        <input type="text" class="form-control" placeholder="Nhập ghi chú (nếu có)" name="txtNote">
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal" name="btnLuu">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Hóa đơn  -->
<form action="http://localhost/QuanLyKyTucXa_new/HoaDonGuiXe/ExportExcel" method="POST">
    <div class="modal fade" id="ExportModal" tabindex="-1" aria-labelledby="ExPortModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ExPortModalLabel">Hóa đơn chi tiết</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body mx-4">
                            <div class="container">
                                <div class="row">
                                    <ul class="list-unstyled">
                                        <li class="text-black" id="MaHD"></li>
                                        <li class="text-muted mt-1" id="MaSV"><span class="text-black"></li>
                                        <input type="hidden" name="MaHD1" id="MaHD1" value="">
                                        <input type="hidden" name="MaSV1" id="MaSV1" value="">
                                    </ul>
                                    <hr>
                                    <div class="col-xl-10">
                                        <p style="margin: 0;">Tên sinh viên</p>
                                    </div>
                                    <div style="padding:10px" class="col-xl-12">
                                        <p class="float-end" id="Name"></p>
                                    </div>
                                    <hr>
                                </div>


                                <div class="row">
                                    <div class="col-xl-10">
                                        <p>Loại xe</p>
                                    </div>
                                    <div style="padding:10px" class="col-xl-12">
                                        <p class="float-end" id="Type"></p>
                                    </div>
                                    <hr>
                                </div>

                                <div class="row">
                                    <div class="col-xl-10">
                                        <p>Biển số xe</p>
                                    </div>
                                    <div style="padding:10px" class="col-xl-12">
                                        <p class="float-end" id="Plate"></p>
                                    </div>
                                    <hr>
                                </div>

                                <div class="row">
                                    <div class="col-xl-10">
                                        <p>Ngày lập</p>
                                    </div>
                                    <div style="padding:10px" class="col-xl-12">
                                        <p class="float-end" id="Day"></p>
                                    </div>
                                    <hr>
                                </div>

                                <div class="row">
                                    <div class="col-xl-10">
                                        <p>Hóa đơn tháng</p>
                                    </div>
                                    <div style="padding:10px" class="col-xl-12">
                                        <p class="float-end" id="Month"></p>
                                    </div>
                                    <hr>
                                </div>

                                <div class="row">
                                    <div class="col-xl-10">
                                        <p>Trạng thái</p>
                                    </div>
                                    <div style="padding:10px" class="col-xl-12">
                                        <p class="float-end" id="Status"></p>
                                    </div>
                                    <hr style="border: 2px solid black;">
                                </div>

                                <div class="row text-black">
                                    <div style="padding:10px" class="col-x1-12">
                                        <p class="float-end fw-bold" id="Total">Thành tiền:</p>
                                    </div>
                                    <hr style="border: 2px solid black;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="btnXuatExcel"><i class="fa-solid fa-file-invoice"></i> In hóa đơn</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    function showData(data) {
        let newData = JSON.parse(data);

        document.getElementById('MaHD').innerText = `Mã hóa đơn: ${newData.billCode}`;
        document.getElementById('MaSV').innerText = `Mã sinh viên: ${newData.ID}`;
        document.getElementById('Name').innerText = `${newData.studentName}`;
        document.getElementById('Type').innerText = `${newData.vehicle}`;
        document.getElementById('Plate').innerText = newData.plate;
        document.getElementById('Day').innerText = `${newData.invoiceDate}`;
        document.getElementById('Month').innerText = `${newData.month}`;
        document.getElementById('Status').innerText = `${newData.status}`;
        // document.getElementById('TienCoc2').innerText = `${newData.advance_deposit} VND`;
        document.getElementById('Total').innerText = `Tổng: ${newData.price} VND`;
        // document.getElementById('month').innerText = newData.month;
        document.getElementById('MaHD1').value = newData.billCode;
        document.getElementById('MaSV1').value = newData.ID;

        console.log(newData);
    }
</script>

</html>