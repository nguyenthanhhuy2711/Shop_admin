<?php
include('../includes/connect.php');
$id = $_GET['id'];
$conn->query("DELETE FROM san_pham WHERE maSanPham = $id");
header('Location: index.php');
