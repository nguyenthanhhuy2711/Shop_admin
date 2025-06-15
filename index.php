<?php
session_start();
if (!isset($_SESSION['admin_logged'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
        body {
            background: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }

        .dashboard-container {
            max-width: 500px;
            margin: 100px auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            padding: 30px;
            text-align: center;
        }

        h1 {
            color: #2c3e50;
        }

        p {
            color: #7f8c8d;
            margin-bottom: 20px;
        }

        a {
            display: inline-block;
            margin: 8px;
            padding: 10px 20px;
            text-decoration: none;
            background-color: #3498db;
            color: white;
            border-radius: 6px;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h1>Xin chào, <?= htmlspecialchars($_SESSION['admin_name']) ?>!</h1>
        <p>Chào mừng đến trang quản trị.</p>
        <a href="sanpham/index.php">📦 Quản lý sản phẩm</a>
        <a href="donhang/index.php">🧾 Quản lý đơn hàng</a>
        <a href="logout.php">🚪 Đăng xuất</a>
    </div>
</body>
</html>
