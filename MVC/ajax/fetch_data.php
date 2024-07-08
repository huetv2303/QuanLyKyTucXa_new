<?php
include_once './MVC/Core/connectDB.php';
include_once './MVC/Controllers/QLyGuiXe.php';
 $controller = new QLyGuiXe();
 if (isset($_POST['maSinhVien'])) {
    $maSinhVien = $_POST['maSinhVien'];
    $studentData = $controller->getInfo($maSinhVien);
    echo json_encode($studentData);
}
?>