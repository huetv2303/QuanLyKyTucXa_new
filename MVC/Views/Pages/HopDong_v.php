<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách hợp đồng</title>

    <link rel="stylesheet" href="/Public/CSS/style.css">
    <style>
        .search-box {
            /* border: 1px solid black;
            border-radius: 45px; */
            padding: 5px;
        }

        .inputSearch {
            width: 400px;
            height: 60px
        }

        .input-td {
            padding: 5px 10px;
        }

        .padd {
            padding: 10px 0px;
        }

        .dd2 {
            padding-left: 10px !important;
        }
    </style>
</head>

<body>
    <div class="main">
    <h3 class="header">Danh sách hợp đồng</h3>
        <div>

            <div class="search-box">
                <!-- <h3 class="text-center align-middle">Tìm kiếm</h3> -->
                <form class="content1" action="http://localhost/QuanLyKyTucXa_new/HopDong/timkiem" class="text-center padd" method="post"> <!-- form tìm kiếm -->
                    <table  class="">
                        <tbody>
                            <tr>
                                <td class="input-td">
                                    <div class="form-floating">
                                        <input type="text" name="txtMaHopDong" id="mhd" class="form-control" placeholder="" value="<?php if (isset($data['maHopDong'])) echo $data['maHopDong'] ?>">
                                        <label for="mhd">Mã hợp đồng</label>
                                    </div>
                                </td>
                                <td class="input-td">
                                    <div class="form-floating">
                                        <input type="text" name="txtMaNhanVien" id="mnv" placeholder="" class="form-control" value="<?php if (isset($data['maNhanVien'])) echo $data['maNhanVien'] ?>">
                                        <label for="mnv">Mã nhân viên</label>
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td class="input-td">
                                    <div class="form-floating">
                                        <input type="text" name="txtMaTruongNhom" id="msv" placeholder="" class="form-control inputSearch" value="<?php if (isset($data['maSinhVien'])) echo $data['maSinhVien'] ?>">
                                        <label for="msv">Mã trưởng nhóm</label>
                                    </div>
                                </td>
                                <td class="input-td">
                                    <div class="form-floating">
                                        <input type="text" name="txtMaPhong" id="mp" placeholder="" class="form-control inputSearch" value="<?php if (isset($data['maPhong'])) echo $data['maPhong'] ?>">
                                        <label for="mp">Mã phòng</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-center align-middle padd">
                                    <button type="submit" class="btn btn-success" name="btnTimkiem"><i class="fa-solid fa-magnifying-glass">&nbsp;&nbsp;</i>Tìm kiếm</button>
                                    <button type="submit" class="btn-outline-success btn" name="btnXuatExcel"><i class="fa-regular fa-file-excel">&nbsp;&nbsp;</i>Xuất excel</button>
                                    <a class="btn-outline-success btn" href="http://localhost/QuanLyKyTucXa_new/HopDongFile">Nhập excel</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- thẻ div chứa các button thêm mới, nhập, xuất excel
                    <div class="text-center">
                        <a href="http://localhost/QuanLyKyTucXa_new/HopDongThem" class="btn btn-primary">+ Thêm mới</a>
                        <a href="http://localhost/QuanLyKyTucXa_new/HopDongFile" class="btn btn-outline-primary">Nhập excel</a>
                        <button type="submit" class="btn-outline-primary btn" name="btnXuatExcel">Xuất excel</button>
                    </div> -->

                </form>
            </div>
            
            <table class="table table-striped">
                <thead>
                    <tr class="thead-light">
                        <th>STT</th>
                        <th>Mã HĐ</th>
                        <th>Mã NV</th>
                        <th>Mã trưởng nhóm</th>
                        <th>Mã tòa</th>
                        <th>Mã phòng</th>
                        <th>Ngày bắt đầu</th>
                        <th>Ngày kết thúc</th>
                        <th>Tình trạng</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    if (isset($data['dulieu']) && mysqli_num_rows($data['dulieu']) > 0) {
                        $i = 0;
                        while ($row = mysqli_fetch_assoc($data['dulieu'])) {
                    ?>
                            <tr>
                                <td><?php echo (++$i) ?></td>
                                <td><?php echo $row['maHopDong'] ?></td>
                                <td><?php echo $row['MaNhanVien'] ?></td>
                                <td><?php echo $row['maTruongNhom'] ?></td>
                                <td><?php echo $row['maToa'] ?></td>
                                <td><?php echo $row['maPhong'] ?></td>
                                <td><?php echo $row['ngayBatDau'] ?></td>
                                <td><?php echo $row['ngayKetThuc'] ?></td>
                                <td><?php echo $row['tinhTrang'] ?></td>
                                <td>
                                    <!-- <a href="">Xóa</a> -->
                                    <a href="http://localhost/QuanLyKyTucXa_new/HopDong/sua/<?php echo $row['maHopDong'] ?>" class="btn btn-outline-primary">Sửa</a>
                                    <a href="http://localhost/QuanLyKyTucXa_new/HopDong/xoa/<?php echo $row['maHopDong'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa ko?')" class="btn btn-outline-danger">Xóa</a>

                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>