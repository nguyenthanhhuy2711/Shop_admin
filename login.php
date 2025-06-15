<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include 'includes/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $matKhau = $_POST['matKhau'];

    $sql = "SELECT * FROM nguoi_dung WHERE email='$email' AND matKhau='$matKhau' AND vaiTro='admin'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $_SESSION['admin_logged'] = true;
        $_SESSION['admin_name'] = $row['tenNguoiDung'];
        $_SESSION['admin_id'] = $row['maNguoiDung'];
        header("Location: index.php");
        exit;
    } else {
        $error = "Email hoặc mật khẩu sai hoặc không phải tài khoản admin!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập Admin</title>
    <link rel="stylesheet" href="assets/style.css"> <!-- Nếu có CSS -->
    <style>
        body {
            background: #f1f1f1;
            font-family: Arial;
            display: flex;
            height: 100vh;
            justify-content: center;
            align-items: center;
        }
        .login-box {
            background: #fff;
            padding: 30px;
            box-shadow: 0px 0px 10px #ccc;
            border-radius: 10px;
            width: 300px;
        }
        .login-box h2 {
            text-align: center;
        }
        .login-box input {
            width: 100%;
            padding: 8px;
            margin-top: 10px;
            margin-bottom: 15px;
        }
        .login-box button {
            width: 100%;
            background: #3498db;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
        }
        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Admin Login</h2>
        <form method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="matKhau" placeholder="Mật khẩu" required>
            <button type="submit">Đăng nhập</button>
        </form>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    </div>
</body>
</html>
