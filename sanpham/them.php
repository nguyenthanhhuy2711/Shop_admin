<?php include('../includes/connect.php'); ?>
<?php include('../includes/header.php'); ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ten = $_POST['tenSanPham'];
    $moTa = $_POST['moTa'];
    $gia = $_POST['gia'];

    // Upload ảnh chính
    $anh = $_FILES['anhSanPham']['name'];
    $target = "../assets/uploads/" . basename($anh);
    move_uploaded_file($_FILES['anhSanPham']['tmp_name'], $target);
    $duongDanAnhChinh = '/uploads/' . $anh;

    // Thêm sản phẩm
    $sql = "INSERT INTO san_pham (tenSanPham, moTa, gia, maDanhMuc, anhSanPham, ngayTao)
            VALUES ('$ten', '$moTa', '$gia', 1, '$duongDanAnhChinh', NOW())";
    $conn->query($sql);
    $maSanPhamMoi = $conn->insert_id;

    // Upload ảnh biến thể
    foreach ($_FILES['anhBienThe']['tmp_name'] as $index => $tmpName) {
        if ($_FILES['anhBienThe']['error'][$index] === 0) {
            $tenFile = basename($_FILES['anhBienThe']['name'][$index]);
            $duongDan = "/uploads/anh_bien_the/" . $tenFile;
            $fullPath = "../assets" . $duongDan;

            move_uploaded_file($tmpName, $fullPath);

            $sqlAnh = "INSERT INTO anh_bien_the (maSanPham, duongDan)
                       VALUES ('$maSanPhamMoi', '$duongDan')";
            $conn->query($sqlAnh);
        }
    }

    header('Location: index.php');
    exit;
}
?>

<h2>➕ Thêm sản phẩm</h2>

<form method="post" enctype="multipart/form-data" class="product-form">
    <label>Tên sản phẩm:</label>
    <input type="text" name="tenSanPham" required>

    <label>Mô tả:</label>
    <textarea name="moTa" rows="4" required></textarea>

    <label>Giá (VNĐ):</label>
    <input type="number" name="gia" required>

    <label>Ảnh chính:</label>
    <input type="file" name="anhSanPham" accept="image/*" required>

    <label>Ảnh biến thể (có thể chọn nhiều):</label>
    <input type="file" name="anhBienThe[]" accept="image/*" multiple>

    <br><br>
    <button type="submit">✅ Thêm sản phẩm</button>
</form>

<?php include('../includes/footer.php'); ?>
