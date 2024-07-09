<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .form-container {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
</style>

<body>
    <div class="main">
        <div class="form-container">
            <form method="post" action="http://localhost/QuanLyKyTucXa_new/HoaDonGuiXe/UpdateData">
                <div class="form-group" style="">
                    <?php
                    if (isset($data['dulieu']) && mysqli_num_rows($data['dulieu']) > 0) {
                        while ($row = mysqli_fetch_array($data['dulieu'])) {
                    ?>
                            <label>Mã hóa đơn</label>
                            <input type="text" class="form-control" name="txtBillCode" value="<?php echo $row['billCode'] ?>" readonly style="width: 500px;">
                            <label>Mã sinh viên</label>
                            <input type="text" class="form-control" name="txtID" value="<?php echo $row['ID'] ?>" readonly id="text" style="width: 500px;">
                            <label>Tên sinh viên</label>
                            <input type="text" name="txtName" class="form-control" value="<?php echo $row['studentName'] ?>" readonly style="width: 500px;">
                            <label>Tháng</label>
                            <select name="txtMonth" class="form-control" style="width: 500px;">
                                <option value="">--- Chọn tháng ---</option>
                                <option value="1" <?php if ($row['month'] == '1') echo 'selected' ?>>1</option>
                                <option value="2" <?php if ($row['month'] == '2') echo 'selected' ?>>2</option>
                                <option value="3" <?php if ($row['month'] == '3') echo 'selected' ?>>3</option>
                                <option value="4" <?php if ($row['month'] == '4') echo 'selected' ?>>4</option>
                                <option value="5" <?php if ($row['month'] == '5') echo 'selected' ?>>5</option>
                                <option value="6" <?php if ($row['month'] == '6') echo 'selected' ?>>6</option>
                                <option value="7" <?php if ($row['month'] == '7') echo 'selected' ?>>7</option>
                                <option value="8" <?php if ($row['month'] == '8') echo 'selected' ?>>8</option>
                                <option value="9" <?php if ($row['month'] == '9') echo 'selected' ?>>9</option>
                                <option value="10" <?php if ($row['month'] == '10') echo 'selected' ?>>10</option>
                                <option value="11" <?php if ($row['month'] == '11') echo 'selected' ?>>11</option>
                                <option value="12" <?php if ($row['month'] == '12') echo 'selected' ?>>12</option>
                            </select>
                            <label>Thành tiền</label>
                            <select name="txtPrice" id="" class="form-control" style="width: 500px;">
                                <option value="">--- Chọn giá tiền ---</option>
                                <option value="70,000" <?php if ($row['price'] == '70,000') echo 'selected' ?>>70,000</option>
                                <option value="150,000" <?php if ($row['price'] == '150,000') echo 'selected' ?>>150,000</option>
                            </select>
                            <label>Ngày lập</label>
                            <input type="date" class="form-control" name="txtDay" value="<?php echo $row['invoiceDate'] ?>" style="width: 500px;">
                            <label>Loại xe</label>
                            <input type="text" class="form-control" name="txtType" value="<?php echo $row['vehicle'] ?>" readonly style="width: 500px;">
                            <label>Biển số xe</label>
                            <input type="text" class="form-control" name="txtPlate" value="<?php echo $row['plate'] ?>" readonly style="width: 500px;">
                            <label>Trạng thái</label>
                            <select name="txtStatus" id="" class="form-control" style="width: 500px;">
                                <option value="Chưa thanh toán" <?php if ($row['status'] == 'Chưa thanh toán') echo 'selected' ?>>Chưa thanh toán</option>
                                <option value="Đã thanh toán" <?php if ($row['status'] == 'Đã thanh toán') echo 'selected' ?>>Đã thanh toán</option>
                                <option value="Quá hạn" <?php if ($row['status'] == 'Quá hạn') echo 'selected' ?>>Quá hạn</option>
                            </select>
                            <label>Ghi chú</label>
                            <input type="text" class="form-control" name="txtNote" value="<?php echo $row['note'] ?>" style="width: 500px;">
                    <?php
                        }
                    }
                    ?>
                    <br>
                    <button type="submit" class="btn btn-primary" name="btnCapNhat">Cập nhật</button>
                    <button type="submit" class="btn btn-primary" name="btnBack">Quay lại</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>