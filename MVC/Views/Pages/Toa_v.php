<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <!-- <style>
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

    </style> -->
</head>


<body>
    
        <!-- Thêm mới -->
        <form method="post" action="http://localhost/QuanLyKyTucXa_new/themToa_c/themmoi">
          
    <div class="modal-add">
        <div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addServiceModalLabel">Thêm tòa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        
                        <div class="form-group">
                            <h4>Thêm tòa</h4>

                            <label>Mã tòa</label>
                            <input type="text" class="form-control" placeholder="Nhập mã tòa" name="txtMatoa">
                           
                            <label>Số phòng</label>
                            <input type="text" class="form-control" placeholder="Nhập số lượng phòng" name="txtSophong">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="btnLuuToa">Lưu</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<form method="post" action="http://localhost/QuanLyKyTucXa_new/Toa_c/suadl">
            <!-- Modal Sửa dữ liệu phòng --> 
            <div class="modal-update">
                <div class="modal fade" id="editServiceModal" tabindex="-1" aria-labelledby="editServiceModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editServiceModalLabel">Sửa tòa</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <label>Mã tòa</label>
                                <input type="text" class="form-control" name="txtMatoa" id="txtMatoa" value="">
                                <label>Số phòng</label>
                                <input type="text" class="form-control" name="txtSophong" id="txtSophong" value="">
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

        <!-- Tìm kiếm -->
    <form>  
        <div class="main">
        <div class="header">
            <h2>Tòa</h2>
            <!-- Button trigger modal -->
        </div>
           
            <div>
            <div class="center-dulieu">
            <table style=" text-align:center">
            </table>
            </div>
            <a href="http://localhost/QuanLyKyTucXa_new/Toa_c/" style="margin: 10px 0px; background-color: #0d6efd;" class="btn btn-success" name="btnReLoad"><i class="fa-solid fa-rotate-right"></i> Reload</a>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addServiceModal">Thêm mới </button>
            <br>
         <br>
        <div class="form-inline" >
            <table class="table table-striped" style="text-align:center " >        
                    <tr style="background:ccc">
                        <th>STT</th>
                        <th>Mã tòa</th>
                        <th>Số lượng phòng</th>
                        <th>Thao tác</th>
                        
                    </tr>
                    <?php
                    if (isset($data['dulieu']) && mysqli_num_rows($data['dulieu']) > 0) {
                        $i = 0;
                        while ($row = mysqli_fetch_assoc($data['dulieu'])) {
                            ?>
                        <tr >
                            <td><?php echo (++$i) ?></td>
                            <td><?php echo $row['maToa'] ?></td>
                            <td><?php echo $row['soPhong'] ?></td>
                        
                            <td>
                            <button onclick="updateDataT('<?php echo htmlspecialchars(json_encode($row)) ?>')" type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editServiceModal"><i style="color: green; background: white;" class="fa-solid fa-pen-to-square"></i></button>
                            <a onclick="return confirm('Bạn có muốn xóa tòa này không?');" href="http://localhost/QuanLyKyTucXa_new/Toa_c/xoa/<?php echo $row['maToa'] ?>" class="btn btn-outline-danger"><i style="color: red;" class="fa-solid fa-trash"></i></a>
                            <a href="http://localhost/QuanLyKyTucXa_new/Toa_c/lien_ket/<?php echo $row['maToa'] ?>" class="btn btn-outline-danger"><i style="color: red;" ></i>Chi tiết</a> 
                            </td>
                        </tr>
                            <?php
                        }
                    }
                    ?>
            </table>
        </div>
       
      </form>
</body>
<script>
    function updateDataT(data) {
    let newData = JSON.parse(data);

    // Target the specific modal by ID and update the input values
    document.getElementById('txtMatoa').value = newData.maToa;
    document.getElementById('txtSophong').value = newData.soPhong;
    
}

</script>
</html>
