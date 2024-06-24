<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý phòng</title>
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
                                    <input type="text" class="form-control" placeholder="Nhập mã tòa" name="cboMatoa">
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

        <!-- Sửa -->
        <form method="post" action="http://localhost/QuanLyKyTucXa_new/DanhsachPhong_c/suadl">
            <!-- Modal -->
            <div class="modal-update">
                <div class="modal fade" id="editServiceModal" tabindex="-1" aria-labelledby="editServiceModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editServiceModalLabel">Sửa Phòng</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                    <label>Mã phòng</label>
                                    <input type="text" id="txtMaphong" class="form-control" placeholder="Nhập mã dịch vụ" name="txtMaphong">
                                    <label>Mã tòa</label>
                                    <input type="text" class="form-control" placeholder="Nhập tên dịch" name="cboMatoa">
                                    <label>Số người</label>
                                    <input type="text" class="form-control" placeholder="Nhập giá" name="txtSonguoi">
                                    <label>Tiền phòng</label>
                                    <input type="text" class="form-control" placeholder="Nhập đơn vị" name="txtTienphong">
                                    <label>Trạng thái</label>
                                    <input type="text" class="form-control" placeholder="Nhập ghi chú" name="txtTrangthai">

                                </div>
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
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addServiceModal">Thêm mới </button>
                    </td>
                </tr>
            </table>
        </form>

        <!-- Tìm kiếm -->
        <form method="post" action="http://localhost/QuanLyKyTucXa_new/DanhsachPhong_c/timkiem">
            <div class="form-inline">
            <div class="center-dulieu">
            <table>
                <tr></tr>
                <tr>
                    <td><label style="width: 100px;">Mã phòng</label></td>
                    <td><input type="text" class="form-control dd2" name="txtTimkiem" value="<?php if(isset($data['maphong'])) echo $data['maphong'] ?>"></td>
                </tr>
                
                <tr>
                    <td></td>
                    <td><button type="submit" class="btn btn-success" name="btnTimkiem" style="background-color: blue">🔍Tìm kiếm</button></td>
                </tr>
            </table>
        </div>
            
            <br>
            
         <br>
         <a href="http://localhost/QLKTX1/themPhong_c" class="btn btn-secondary" style="background-color: blue">Thêm mới</a>
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
                </tr>
                <?php 
                    if(isset($data['dulieu']) && mysqli_num_rows($data['dulieu'])>0){
                        $i=0;
                        while($row=mysqli_fetch_assoc($data['dulieu'])){
                ?>
                        <tr >
                           <td><?php echo (++$i) ?></td>
                           <td><?php echo $row['maPhong'] ?></td>
                           <td><?php echo $row['maToa'] ?></td>
                           <td><?php echo $row['soNguoi'] ?></td>
                           <td><?php echo $row['tienPhong'] ?></td>
                           <td><?php echo $row['trangThai'] ?></td>
                           <td>
                                <a href="http://localhost/QuanLyKyTucXa_new/DanhsachPhong_c/sua/<?php echo $row['maPhong'] ?>" style="background-color: blue ; color: white" class="btn btn-outline-primary" >Sửa</a> &nbsp;
                                <a href="http://localhost/QuanLyKyTucXa_new/DanhsachPhong_c/xoa/<?php echo $row['maPhong'] ?>" style="background-color: red ;color: white" onclick="return confirm('Bạn có chắc chắn muốn xóa ?')" class="btn btn-outline-danger" >Xóa</a>
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