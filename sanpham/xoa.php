<?php
include('../includes/connect.php');
$id = $_GET['id'];

// Xóa ảnh liên quan đến sản phẩm trước
$conn->query("DELETE FROM anh_bien_the WHERE maSanPham = $id");

// Sau đó xóa sản phẩm
$conn->query("DELETE FROM san_pham WHERE maSanPham = $id");

header('Location: index.php');
