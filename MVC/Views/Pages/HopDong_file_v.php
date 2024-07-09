<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhập Excel Hợp đồng</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .main {
            /* display: flex; */
            justify-content: center;
            align-items: center;
            /* height: 100vh; */
            background-color: #f8f9fa;
        }
        .content {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .content h3 {
            margin-bottom: 20px;
        }
        .content a {
            margin-bottom: 20px;
            display: inline-block;
        }
    </style>
</head>

<body>
<div class="main">
    <div class="content">
        <a class="btn btn-secondary mb-3" href="http://localhost/QuanLyKyTucXa_new/HopDong">
            &laquo; Quay lại
        </a>
        <h3>Chọn file nhập danh sách hợp đồng</h3>
        <form action="http://localhost/QuanLyKyTucXa_new/HopDongFile/nhapexcel" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <input class="form-control" name="txtFile" type="file" id="formFile" required>
            </div>
            <button type="submit" class="btn btn-primary" name="btnUpload">Upload</button>
        </form>
    </div>
</div>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>
