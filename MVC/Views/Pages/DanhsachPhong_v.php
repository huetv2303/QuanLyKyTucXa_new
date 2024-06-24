<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        .center-dulieu {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    padding-top: 10px;
}
.td2{
    width: 250px;
}

    </style>
</head>

<body>
    <div>
        <div class="header">
            <h3>Danh sách phòng</h3>
            <!-- Button trigger modal -->



        </div>
        <!-- Thêm mới -->
        <form method="post" action="http://localhost/QuanLyKyTucXa_new/themPhong_c/themmoi">
    <div class="modal-add">
        <div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addServiceModalLabel">Thêm phòng</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <h4>Thêm phòng</h4>

                            <label>Mã phòng</label>
                            <input type="text" class="form-control" placeholder="Nhập mã phòng" name="txtMaphong">
                            <label>Mã tòa</label>
                            <select name="txtMatoa" id="" class="form-control" >
                                <option value="">---Chọn---</option>
                                <?php
                                if (isset($data['ma']) && mysqli_num_rows($data['ma']) > 0) {
                                    while ($r1 = mysqli_fetch_assoc($data['ma'])) {
                                        echo '<option value="' . $r1["maToa"] . '">' . $r1["maToa"] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                            <label>Số người</label>
                            <input type="text" class="form-control" placeholder="Nhập số lượng người" name="txtSonguoi">
                            <label>Tiền phòng</label>
                            <input type="text" class="form-control" placeholder="Nhập tiền phòng" name="txtTienphong">
                            <label>Trạng thái</label>
                            <input type="text" class="form-control" placeholder="Nhập trạng thái phòng" name="txtTrangthai">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="btnLuuPhong">Lưu</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<form method="post" action="http://localhost/QuanLyKyTucXa_new/DanhsachPhong_c/suadl">
            <!-- Modal Sửa dữ liệu phòng --> 
            <div class="modal-update">
                <div class="modal fade" id="editServiceModal" tabindex="-1" aria-labelledby="editServiceModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editServiceModalLabel">Sửa phòng</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <label>Mã phòng</label>
                                <input type="text" class="form-control" name="txtMaphong" id="txtMaphong" value="">
                                <label>Mã tòa</label>
                            <select name="txtMatoa" id="txtMatoa" class="form-control" >
                            <?php

                            if (isset($data['ma1']) && mysqli_num_rows($data['ma1']) > 0) {
                                while ($row = mysqli_fetch_assoc($data['ma1'])) {
                                    ?>
                                        <option value="<?php echo $row['maToa'] ?>"><?php echo $row['maToa'] ?></option>
                                <?php
                                }
                            }

                            ?>
                            </select>
                                <!-- <label>Mã tòa</label>
                                <input type="text" class="form-control" name="txtMatoa" id="txtMatoa" value=""> -->
                                <label>Số người</label>
                                <input type="text" class="form-control" name="txtSonguoi" id="txtSonguoi" value="">
                                <label>Tiền phòng</label>
                                <input type="text" class="form-control" name="txtTienphong" id="txtTienphong" value="">
                                <label>Trạng thái</label>
                                <input type="text" class="form-control" name="txtTrangthai" id="txtTrangthai" value="">
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


        <!-- Nhập excel -->
        <form action="http://localhost/QuanLyKyTucXa_new/DanhsachPhong_c/import" enctype="multipart/form-data" method="post">
            <label for="myFile2"></label>
            <table>
                <tr>
                    <td class="dv">
                        <div class="file">
                            <input type="file" class="btn btn-outline-primary" name="txtfile">
                            <button style="padding-rigt: 300px" type="submit" class="btn btn-primary" name="btnUpLoad">Lưu</button>
                        </div>
                        
                    </td>
                </tr>
            </table>
            
        </form>

        <!-- Tìm kiếm -->
        <form method="post" action="http://localhost/QuanLyKyTucXa_new/DanhsachPhong_c/timkiem">
            <div class="form-inline">
            <div class="center-dulieu">
            <table style=" text-align:center">
                <tr></tr>
                <tr >
                    
                    <td class="td2" ><input type="text" class="form-control dd2" name="txtTimkiem" value=""placeholder="Tìm kiếm "></td>
                    <td></td>
                    <td>
                        <button type="submit" class="btn btn-primary" name="btnTimkiem" id="btnTimkiem"><i class="fa-solid fa-magnifying-glass">&nbsp;&nbsp;</i></button>
                    </td>
                    </tr>
            </table>
            </div>
            <br>
            <br>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addServiceModal">Thêm mới </button>
       
            
            <br>
            
         <br>
         
         <br>
            <div class="form-inline" >
        <table class="table table-striped" style="text-align:center " >        
                <tr style="background:ccc">
                    <th>STT</th>
                    <th>Mã phòng</th>
                    <th>Mã tòa</th>
                    <th>Số người</th>
                    <th>Tiền phòng</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
                <?php
                if (isset($data['dulieu']) && mysqli_num_rows($data['dulieu']) > 0) {
                    $i = 0;
                    while ($row = mysqli_fetch_assoc($data['dulieu'])) {
                        ?>
                                                                <tr >
                                                                   <td><?php echo (++$i) ?></td>
                                                                   <td><?php echo $row['maPhong'] ?></td>
                                                                   <td><?php echo $row['maToa'] ?></td>
                                                                   <td><?php echo $row['soNguoi'] ?></td>
                                                                   <td><?php echo $row['tienPhong'] ?></td>
                                                                   <td><?php echo $row['trangThai'] ?></td>
                                                                   <td>
                                                                   <button onclick="updateDataP('<?php echo htmlspecialchars(json_encode($row)) ?>')" type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editServiceModal"><i style="color: green; background: white;" class="fa-solid fa-pen-to-square"></i></button>
                                                                   <a onclick="return confirm('Bạn có muốn xóa dịch vụ này không?');" href="http://localhost/QuanLyKyTucXa_new/DanhsachPhong_c/xoa/<?php echo $row['maPhong'] ?>" class="btn btn-outline-danger"><i style="color: red;" class="fa-solid fa-trash"></i></a>
                                                                   </td>
                                                                </tr>
                                                        <?php
                    }
                }
                ?>
        </table>
        </div>
            
</body>
<script>
    function updateDataP(data) {
    let newData = JSON.parse(data);

    // Target the specific modal by ID and update the input values
    document.getElementById('txtMaphong').value = newData.maPhong;
     document.getElementById('txtMatoa').value = newData.maToa;
    document.getElementById('txtSonguoi').value = newData.soNguoi;
    document.getElementById('txtTienphong').value = newData.tienPhong;
    document.getElementById('txtTrangthai').value = newData.trangThai;
    
}

</script>
</html>