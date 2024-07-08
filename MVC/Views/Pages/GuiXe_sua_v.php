<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="post" action="http://localhost:9090/QuanLyKyTucXa_new/QLyGuiXe/updateData">
        <div class="form-group">
            <?php
            if (isset($data['dulieu']) && mysqli_num_rows($data['dulieu']) > 0) {
                while ($row = mysqli_fetch_array($data['dulieu'])) {
            ?>
                    <label>Mã sinh viên</label>
                    <input type="text" class="form-control" placeholder="Mã sinh viên" name="txtMaSv" value="<?php echo $row['ID'] ?>" readonly>
                    <label>Tên sinh viên</label>
                    <input type="text" class="form-control" placeholder="Tên sinh viên" name="txtTenSv" value="<?php echo $row['studentName'] ?>" readonly>
                    <label>Mã phòng</label>
                    <input type="text" name="txtMaPhong" class="form-control" placeholder="Nhập mã phòng" value="<?php echo $row['roomCode']?>" readonly>
                    <label>Mã tòa</label>
                    <input type="text" class="form-control" placeholder="" name="txtMaToa" value="<?php echo $row['buildingCode'] ?>" readonly>
                    <label>Số điện thoại</label>
                    <input type="number" class="form-control" placeholder="" name="txtSdt" value="<?php echo $row['phoneNumber'] ?>">
                    <label>Email</label>
                    <input type="email" class="form-control" placeholder="" name="txtEmail" value="<?php echo $row['email'] ?>">
                    <label>Ngày bắt đầu</label>
                    <input type="date" class="form-control" name="txtDate" value="<?php echo $row['registerDate'] ?>">
                    <label>Loại xe</label>
                    <select name="txtType" id="" class="form-control">
                        <option value="">--- Chọn loại xe ---</option>
                        <option value="Xe máy" <?php if($row['typeOfVehicle'] == 'Xe máy') echo 'selected'?>>Xe máy</option>
                        <option value="Xe máy điện" <?php if($row['typeOfVehicle'] == 'Xe máy điện') echo 'selected'?>>Xe máy điện</option>
                        <option value="Xe dạp" <?php if($row['typeOfVehicle'] == 'Xe đạp') echo 'selected'?>>Xe đạp</option>
                        <option value="Ô tô" <?php if($row['typeOfVehicle'] == 'Ô tô') echo 'selected'?>>Ô tô</option>
                    </select>
                    <label>Biển kiểm soát</label>
                    <input type="text" class="form-control" name="txtPlate" value="<?php echo $row['plate'] ?>">
            <?php
                }
            }
            ?>
            <br>
            <button type="submit" class="btn btn-primary" name="btnCapNhat">Cập nhật</button>
            <button type="submit" class="btn btn-primary" name="btnBack">Quay lại</button>
        </div>
    </form>
</body>
</html>