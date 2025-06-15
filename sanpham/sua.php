<?php include('../includes/connect.php'); ?>
<?php include('../includes/header.php'); ?>

<?php
$id = $_GET['id'];
$sql = "SELECT * FROM san_pham WHERE maSanPham = $id";
$sp = $conn->query($sql)->fetch_assoc();

// Lấy ảnh biến thể
$sql_bt = "SELECT * FROM anh_bien_the WHERE maSanPham = $id";
$anhBienThe = $conn->query($sql_bt);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ten = $_POST['tenSanPham'];
    $moTa = $_POST['moTa'];
    $gia = $_POST['gia'];

    if (!empty($_FILES['anhSanPham']['name'])) {
        $anh = $_FILES['anhSanPham']['name'];
        $target = "../assets/uploads/" . basename($anh);
        move_uploaded_file($_FILES['anhSanPham']['tmp_name'], $target);
        $sql = "UPDATE san_pham SET tenSanPham='$ten', moTa='$moTa', gia='$gia', anhSanPham='/uploads/$anh' WHERE maSanPham=$id";
    } else {
        $sql = "UPDATE san_pham SET tenSanPham='$ten', moTa='$moTa', gia='$gia' WHERE maSanPham=$id";
    }

    $conn->query($sql);

    // Xử lý thêm ảnh biến thể mới nếu có
    if (!empty($_FILES['anhBienThe']['name'][0])) {
        foreach ($_FILES['anhBienThe']['name'] as $index => $fileName) {
            $tmpName = $_FILES['anhBienThe']['tmp_name'][$index];
            $targetPath = "../assets/uploads/anh_bien_the/" . basename($fileName);
            move_uploaded_file($tmpName, $targetPath);

            $duongDan = "/uploads/anh_bien_the/" . basename($fileName);
            $conn->query("INSERT INTO anh_bien_the (maSanPham, duongDan) VALUES ($id, '$duongDan')");
        }
    }

    header('Location: index.php');
}
?>

<h2>✏️ Sửa sản phẩm</h2>

<form method="post" enctype="multipart/form-data" class="product-form">
    <label>Tên sản phẩm:</label>
    <input type="text" name="tenSanPham" value="<?= $sp['tenSanPham'] ?>" required>

    <label>Mô tả:</label>
    <textarea name="moTa" rows="4" required><?= $sp['moTa'] ?></textarea>

    <label>Giá (VNĐ):</label>
    <input type="number" name="gia" value="<?= $sp['gia'] ?>" required>

    <label>Ảnh chính (nếu thay đổi):</label>
    <input type="file" name="anhSanPham" accept="image/*">
    <br>
    <img src="../assets<?= $sp['anhSanPham'] ?>" width="100" style="margin-top:10px; border-radius:5px;"><br>

    <label>Ảnh biến thể mới (nếu thêm):</label>
    <input type="file" name="anhBienThe[]" accept="image/*" multiple>

    <br><br>
    <button type="submit">💾 Cập nhật</button>
</form>

<!-- Hiển thị ảnh biến thể đã có -->
<?php if ($anhBienThe->num_rows > 0): ?>
    <h3 style="margin-top: 30px;">Ảnh biến thể hiện tại:</h3>
    <div style="display: flex; flex-wrap: wrap; gap: 10px;">
        <?php while($row = $anhBienThe->fetch_assoc()): ?>
            <div style="text-align: center;">
                <img src="../assets<?= $row['duongDan'] ?>" width="100" style="border-radius: 5px;">
            </div>
        <?php endwhile; ?>
    </div>
<?php endif; ?>

<?php include('../includes/footer.php'); ?>
