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
<form method="post" action="">
    
        <br>
        <div class="form-inline" >
        <div>
                <?php
                if(isset($data['dulieu'])&& mysqli_num_rows($data['dulieu'])>0){
                    while($row=mysqli_fetch_array($data['dulieu'])){
                        
                ?>
                <br>
                
                    <div style="padding-left: 230px">
                        <label  for="txtMatoa">Mã tòa:</label> 
                        <input type="text"  name="txtMatoa" value="<?php echo $row['maToa'] ?> "  readonly>
                        <!--  -->
                        <br>
                        <label  for="txtSophong">Số phòng:</label> 
                        <input type="number" name="txtSophong" value="<?php echo $row['soPhong'] ?>"  readonly>
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
                    <th>Mã nhân viên</th>
                    <th>Họ tên</th>
                    <th>Giới tính</th>
                    <th>Số điện thoại</th>
                   
                    
                </tr>
                <?php
                if (isset($data['dulieu1']) && mysqli_num_rows($data['dulieu1']) > 0) {
                    $i = 0;
                    while ($row = mysqli_fetch_assoc($data['dulieu1'])) {
                        ?>
                    <tr >
                         <td><?php echo (++$i) ?></td>
                        <td><?php echo $row['MaNhanVien'] ?></td>
                        <td><?php echo $row['TenNhanVien'] ?></td>
                        <td><?php echo $row['GioiTinh'] ?></td>
                        <td><?php echo $row['SoDienThoai'] ?></td>
                        
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