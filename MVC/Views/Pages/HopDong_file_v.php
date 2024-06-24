<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhập excel Hợp đồng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <link rel="stylesheet" href="/Public/CSS/style.css"> -->

</head>

<body>
<div class="main">
<div class="content">
    <form class = "content1" action="http://localhost/QuanLyKyTucXa_new/HopDongFile/themmoi" method="post" enctype="multipart/form-data">
        <br>
        <a  style="margin: 20px;" class="text-black" href="http://localhost/QuanLyKyTucXa_new/HopDong">
            << Quay lại</a>
                <br>
        <div class="mb-3">
            <!-- <label for="formFile" class="form-label">Chọn file nhập danh sách hợp đồng</label> -->
            <h3>Chọn file nhập danh sách hợp đồng</h3>
            <input class="form-control" name ="txtFile" type="file" id="">
            <button type="submit" class="btn btn-primary" name="btnUpload">Upload</button>
        </div>
    </form>
</div>
</div>
</body>

</html>