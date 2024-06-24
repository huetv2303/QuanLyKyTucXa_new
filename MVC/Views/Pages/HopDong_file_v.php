<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhập excel Hợp đồng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <form action="http://localhost/qlktx/HopDongFile/themmoi" method="post" enctype="multipart/form-data">
        <!-- <label for="myFile">Chọn file</label>
        <input type="file" name="txtFile" id="myFile">
        <button type="submit" class="btn btn-primary" name="btnUpload">Upload</button> -->
        <a class="text-black" href="http://localhost/qlktx/HopDong">
            << Quay lại</a>
                <br>
        <div class="mb-3">
            <!-- <label for="formFile" class="form-label">Chọn file nhập danh sách hợp đồng</label> -->
            <h2>Chọn file nhập danh sách hợp đồng</h2>
            <input class="form-control" name ="txtFile" type="file" id="">
            <button type="submit" class="btn btn-primary" name="btnUpload">Upload</button>
        </div>
    </form>
</body>

</html>