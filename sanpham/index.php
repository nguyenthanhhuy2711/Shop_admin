<?php
session_start();
if (!isset($_SESSION['admin_logged'])) {
    header("Location: ../login.php");
    exit;
}
include '../includes/connect.php';
include '../includes/header.php';
?>

<h2>📦 Danh sách sản phẩm</h2>
<a href="them.php" class="add-btn">➕ Thêm sản phẩm</a>

<table class="product-table">
    <tr>
        <th>STT</th>
        <th>Tên sản phẩm</th>
        <th>Giá</th>
        <th>Ảnh</th>
        <th>Thao tác</th>
    </tr>

<?php
$sql = "SELECT * FROM san_pham ORDER BY maSanPham DESC";
$result = $conn->query($sql);
$stt = 1;
while ($row = $result->fetch_assoc()):
?>
    <tr>
        <td><?= $stt++ ?></td>
        <td><?= $row['tenSanPham'] ?></td>
        <td><?= number_format($row['gia']) ?>₫</td>
        <td>
            <img src="../assets<?= $row['anhSanPham'] ?>" width="80"><br>
                <?php
            $maSP = $row['maSanPham'];
            $bienThe = $conn->query("SELECT duongDan FROM anh_bien_the WHERE maSanPham = $maSP");
             while ($a = $bienThe->fetch_assoc()):
                ?>
        <img src="../assets<?= $a['duongDan'] ?>" width="40" style="margin: 2px; border-radius: 5px;">
    <?php endwhile; ?>
</td>

        <td class="action-links">
            <a href="sua.php?id=<?= $row['maSanPham'] ?>">✏️ Sửa</a>
            <a href="xoa.php?id=<?= $row['maSanPham'] ?>" onclick="return confirm('Bạn có chắc muốn xoá?')">🗑️ Xoá</a>
        </td>
    </tr>
<?php endwhile; ?>
</table>

<?php include '../includes/footer.php'; ?>
