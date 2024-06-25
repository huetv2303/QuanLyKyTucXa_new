<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý phòng</title>
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
select:hover{
    color: blue;
}
/* .cbo{
    background-color: lightblue; 
    color: black; 
    border: 1px solid #ccc; 
    padding: 5px; 
} */
    </style>
</head>

<body>
    
        <div class="header">
            <h3>Thông tin tòa KTX</h3>
            <!-- Button trigger modal -->



        </div>
      
 <!-- Thông tin tòa -->
 <form method="post" action="http://localhost/QuanLyKyTucXa_new/Toa_c/thongtin">
            <div class="form-inline">
            <div class="center-dulieu">
    
        <table style="margin: auto; background-color:blue">
            <tr>
                <td>
                    
                    <select id="txtMatoa" name="txtMatoa" onchange="this.form.submit()" class="form-control" >
                        <option value="">Chọn mã tòa</option>
                        <?php
                        if (isset($data['ma']) && mysqli_num_rows($data['ma']) > 0) {
                            while ($r1 = mysqli_fetch_assoc($data['ma'])) {
                                echo '<option value="' . $r1["maToa"] . '">' . $r1["maToa"] . '</option>';
                            }
                        }
                       
                        ?>
                    </select>
                </td>
            </tr>
        </table>
    
</div>

            <br>
            
         <br>
         
         <br>
            <div class="form-inline" >
        <table class="table table-striped" style="text-align:center " >        
                <tr style="background:ccc">
                    <th>STT</th>
                    <th>Mã tòa</th>
                    <th>Số phòng</th>
                    <th>Tên nhân viên</th>
                    <th>Số điện thoại</th>
                    <th>Tác vụ</th>
                   
                </tr>
                <?php 
                    if(isset($data['dulieu']) && mysqli_num_rows($data['dulieu'])>0){
                        $i=0;
                        while($row=mysqli_fetch_assoc($data['dulieu'])){
                ?>
                        <tr >
                           <td><?php echo (++$i) ?></td>
                          
                           <td><?php echo $row['maToa'] ?></td>
                           <td><?php echo $row['soPhong'] ?></td>
                           <td><?php echo $row['TenNhanVien'] ?></td>
                           <td><?php echo $row['SoDienThoai'] ?></td>
                           <td>
                           <button onclick="updateDataT('<?php echo htmlspecialchars(json_encode($row)) ?>')" type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editServiceModal"><i style="color: green; background: white;" class="fa-solid fa-pen-to-square"></i></button>
                           
                           <a onclick="return confirm('Bạn có muốn xóa nhanvien này không?');" href="http://localhost/QuanLyKyTucXa_new/Toa_c/xoa/<?php echo $row['TenNhanVien'] ?>" class="btn btn-outline-danger"><i style="color: red;" class="fa-solid fa-trash"></i></a>
                           </td>
                        </tr>
                <?php
                        }
                    }
                ?>
        </table>
        </div>
            

    </form>

    <form method="post" action="http://localhost/QuanLyKyTucXa_new/Toa_c/suadl">
            <!-- Modal Sửa dữ liệu tòa --> 
            <div class="modal-update">
                <div class="modal fade" id="editServiceModal" tabindex="-1" aria-labelledby="editServiceModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editServiceModalLabel">Sửa thông tin</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <label>Mã tòa</label>
                                <input type="text" class="form-control" name="txtMatoa" id="txtMatoa1" value="" readonly>

                                <label>Số phòng</label>
                                <input type="text" class="form-control" name="txtSophong" id="txtSophong" value="">
                                <label>Mã nhân viên</label>
                                <input type="text" class="form-control" name="txtManv" id="txtManv" value="" >
                                <label>Tên nhân viên</label>
                                <input type="text" class="form-control" name="txtTennv" id="txtTennv" value="">
                                <label>SĐT</label>
                                <input type="text" class="form-control" name="txtSDT" id="txtSDT" value="">
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

        

            
</body>
<script>
    function updateDataT(data) {
    let newData = JSON.parse(data);

    // Target the specific modal by ID and update the input values
    document.getElementById('txtMatoa1').value = newData.maToa;
    document.getElementById('txtSophong').value = newData.soPhong;
    document.getElementById('txtManv').value = newData.MaNhanVien;
    document.getElementById('txtTennv').value = newData.TenNhanVien;
    document.getElementById('txtSDT').value = newData.SoDienThoai;
    
}

</script>
</html>