<?php
include('../includes/connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $maDonHang = $_POST['maDonHang'];
    $trangThai = $_POST['trangThai'];

    $sql = "UPDATE don_hang SET trangThai = '$trangThai' WHERE maDonHang = $maDonHang";
    $conn->query($sql);
}

header('Location: index.php');
exit;
