<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<body>
    <form action="http://localhost/QuanLyKyTucXa_new/HoaDonGuiXe/Search" method="post">
        <div>
            <h3>DANH SÁCH HÓA ĐƠN GỬI XE</h3>
            <br>
            <div class="form-inline">
                <table>
                    <tr>
                        <td>
                            <input type="text" placeholder="Nhập mã hóa đơn" name="txtBillCode" id="" class="form-control">
                        </td>

                        <td>
                            <input type="text" placeholder="Nhập mã sinh viên" name="txtID" id="txtID" class="form-control">
                        </td>

                        <td>
                            <select name="txtStatus" id="" class="form-control">
                                <option value="">--- Chọn trạng thái ---</option>
                                <option value="Chưa thanh toán">Chưa thanh toán</option>
                                <option value="Đã thanh toán">Đã thanh toán</option>
                                <option value="Quá hạn">Quá hạn</option>
                            </select>
                        </td>

                        <td>
                            <button class="btn btn-success" type="submit" name=""><i class="fa-solid fa-magnifying-glass">&nbsp;&nbsp;</i>Tìm kiếm</button>
                        </td>

                        <td>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal"><i class="fa-solid fa-plus">&nbsp;&nbsp;</i>Thêm mới</button>
                        </td>
                    </tr>
                </table>
            </div>
            <table class="table table-hover" border="1px solid black">
                <!-- Table header -->
                <thead>
                    <th>STT</th>
                    <th>Mã hóa đơn</th>
                    <th>mã sinh viên</th>
                    <th>tên sinh viên</th>
                    <th>tháng</th>
                    <th>thành tiền</th>
                    <th>Ngày lập</th>
                    <th>loại xe</th>
                    <th>biển số xe</th>
                    <th>trạng thái</th>
                    <th>ghi chú</th>
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
</body>

<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="http://localhost/QuanLyKyTucXa_new/HoaDonGuiXe/Insert" method="post">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">THÊM MỚI HÓA ĐƠN</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label>Mã hóa đơn :</label>
                        <input type="text" class="form-control" placeholder="Nhập mã hóa đơn" name="txtBillCode" require>
                        <label>Mã sinh viên :</label>
                        <input type="text" class="form-control" placeholder="Nhập mã sinh viên" name="txtID" require id="">
                        <label>Tên sinh viên :</label>
                        <input type="text" class="form-control" placeholder="Nhập tên sinh viên" name="txtName" require id="">
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
                        <input type="text" class="form-control" placeholder="" name="txtType">
                        <label>Biển số xe :</label>
                        <input type="text" class="form-control" name="txtPlate">
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

</html>