<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .link{
            width: auto;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            background-color: #4988e6;
            color: white;
            cursor: pointer;
            text-decoration: none;
        }
        label{
            width: 100px;
            font-weight: bold;
        
        }
        input[type="text"], textarea, input[type="number"],input[type="date"],select,input[type="email"],input[type="file"]{
            width: 500px;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            outline: none;
            
        }
    </style>
    
</head>
<body>
<form method="post" action="http://localhost/QuanLyKyTucXa_new/DanhsachPhong_c/timkiem">
    
        <br>
        <div class="form-inline" >
        <div>
                <?php
                if(isset($data['dulieu'])&& mysqli_num_rows($data['dulieu'])>0){
                    while($row=mysqli_fetch_array($data['dulieu'])){
                        
                ?>
                <br>
                
                    <div style="padding-left: 230px">
                        <label  for="txtMaphong">Mã phòng:</label> 
                        <input type="text"  name="txtMaphong" value="<?php echo $row['maPhong'] ?> "  readonly>
                        <!--  -->
                        <br>
                        <label  for="txtMatoa">Mã tòa:</label> 
                        <input type="text" name="txtMatoa" value="<?php echo $row['maToa'] ?>"  readonly>
                        <!--  -->
                        <br>
                        <label  for="txtSonguoi">Số người:</label> 
                        <input type="text" name="txtSonguoi" value="<?php echo $row['soNguoi'] ?>"  readonly>
                        <!--  -->
                        <br>
                        <label  for="txtTienphong">Tiền phòng:</label> 
                        <input type="text" name="txtTienphong" value="<?php echo $row['tienPhong'] ?>"  readonly>
                        <!--  -->
                        <br>
                        <label  for="txtTrangthai">Trạng thái:</label> 
                        <input type="text" name="txtTrangthai" value="<?php echo $row['trangThai'] ?>" readonly >
                        
                        <!--  -->
                        
                        <!--  -->
                    </div>
                
                
                <?php  
                    }
                }
                ?>
        <br>  
        <br>
        <table class="table table-striped" style="text-align:center " >        
                <tr style="background:ccc">
                    <th>STT</th>
                    <th>Mã sinh viên</th>
                    <th>Họ tên</th>
                   
                    <th>Số điện thoại</th>
                    
                    <th>Giới tính</th>
                   
                    
                </tr>
                <?php
                if (isset($data['dulieu1']) && mysqli_num_rows($data['dulieu1']) > 0) {
                    $i = 0;
                    while ($row = mysqli_fetch_assoc($data['dulieu1'])) {
                        ?>
                    <tr >
                         <td><?php echo (++$i) ?></td>
                        <td><?php echo $row['maSinhVien'] ?></td>
                         <td><?php echo $row['hoTen'] ?></td>
                        
                         <td><?php echo $row['soDienThoai'] ?></td>
                     
                         <td><?php echo $row['gioiTinh'] ?></td>
                        
                     </tr>
                         <?php
                    }
                }
                ?>
        </table>
        </div>
        <br>
        <br>
        <br>
        <a class="link" href="javascript:history.go(-1);" >↩ Trở về</a>
      </form>
</body>
</html>