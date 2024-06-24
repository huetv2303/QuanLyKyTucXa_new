<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="post" action="http://localhost/QuanLyKyTucXa_new/DanhsachPhong_c/suadl">
            <!-- Modal -->
            <!-- <div class="modal-update">
                <div class="modal fade" id="editServiceModal" tabindex="-1" aria-labelledby="editServiceModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editServiceModalLabel">Sửa Phòng</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div> -->
                            
                            <div class="form-group">
                                        <?php 
                                            if(isset($data['dulieu']) && mysqli_num_rows($data['dulieu'])>0){
                                                while($row=mysqli_fetch_array($data['dulieu'])){
                                        ?>
                                        <table>
                                            <tr>
                                                <td>
                                                    <label for="myid">Mã phòng</label>
                                                </td>
                                                <td>
                                                    <input type="text" id = "myid" class="form-control dd1" style="width:150%" placeholder="Nhập mã phòng" name="txtMaphong" value="<?php echo $row['maPhong'] ?>" readonly>
                                                </td>
                                            </tr>
                                        
                                            <tr>
                                                <td>
                                                    <label for="mysonguoi">Số người</label>
                                                </td>
                                                <td>
                                                    <input type="text" id="mysonguoi" class="form-control" style="width:150%"  placeholder="Nhập số lượng người" name="txtSonguoi" value="<?php echo $row['soNguoi'] ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="mytienphong">Tiền Phòng</label>
                                                </td>
                                                <td>
                                                    <input type="text" id="mytienphong" class="form-control" style="width:150%"  placeholder="Nhập tiền phòng" name="txtTienphong" value="<?php echo $row['tienPhong'] ?>">      
                                                </td>
                                                <td>
                                                    <input type="text" id="mytrangthai" class="form-control" style="width:150%"  placeholder="Nhập trạng thái phòng" name="txtTrangthai" value="<?php echo $row['trangThai'] ?>">      
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Mã tòa</td>
                                                <!-- id là cái bạn muốn truyền ra phải thay theo bài của bạn  -->
                                                <td>
                                                    <select name="cboMa" id="myMa" style="width:150%" class="form-control" >
                                                        <option value="<?php echo $row['maToa'] ?>" style="margin-bottom: 10px;"><?php echo $row['maToa'] ?></option>
                                                        <?php 
                                                            if (isset($data['ma']) && mysqli_num_rows($data['ma']) > 0) {// chữ ma ở đây bạn xem trong ds_c nó là tên gán
                                                                while ($r1 = mysqli_fetch_assoc($data['ma'])) {
                                                                    echo '<option value="' . $r1["maToa"] . '">' . $r1["maToa"] . '</option>';
                                                                }
                                                            }
                                                        ?>
                                                    
                                                        
                                                    </select>
                                                </td>
                                            </tr>
                                            <?php            
                                                }
                                            }
                                            ?>  
                                        </table>
                                  
                                </div>
                            </div>
                            
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="btnLuu" class="btn btn-primary">Lưu</button>
                           
                        </div>
                    </div>
                </div>
            </div>
        </form>
</body>
</html>