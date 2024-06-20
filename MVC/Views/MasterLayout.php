<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý thông tin sinh viên</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/7c35a47a4f.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="http://localhost/QuanLyKyTucXa_new/Public/CSS/style.css?v= <?php echo time() ?>">
    <script src="http://localhost/QuanLyKyTucXa_new/Public/JS/DichVu_js.js?v=1"> </script>
</head>

<body>
    <div class="container-fluid">
        <div class="header1">
            <h2>Danh sách dịch vụ</h2>
        </div>
        <div class="menu1">
           
        </div>
       
            <div class="row">
                <div class="content1">
                    <?php include_once './MVC/Views/Pages/'.$data['page'].'.php'; ?>
                </div>
            </div>
        </div>
    </div>
  
</body>

</html>