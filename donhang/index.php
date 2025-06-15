<?php include('../includes/connect.php'); ?>
<?php include('../includes/header.php'); ?>

<h2>📦 Danh sách đơn hàng</h2>

<table class="product-table">
    <thead>
        <tr>
            <th>Mã đơn</th>
            <th>Người dùng</th>
            <th>Địa chỉ</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
            <th>Ngày tạo</th>
            <th>Cập nhật</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * FROM don_hang ORDER BY ngayTao DESC";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['maDonHang']}</td>
                <td>{$row['maNguoiDung']}</td>
                <td>{$row['diaChiGiaoHang']}</td>
                <td>" . number_format($row['tongTien']) . "₫</td>
                <td>
                    <form method='post' action='capnhat.php'>
                        <input type='hidden' name='maDonHang' value='{$row['maDonHang']}'>
                        <select name='trangThai'>
                            <option " . ($row['trangThai'] == 'Chờ duyệt' ? 'selected' : '') . ">Chờ duyệt</option>
                            <option " . ($row['trangThai'] == 'Đã duyệt' ? 'selected' : '') . ">Đã duyệt</option>
                            <option " . ($row['trangThai'] == 'Đã giao' ? 'selected' : '') . ">Đã giao</option>
                            <option " . ($row['trangThai'] == 'Đã hủy' ? 'selected' : '') . ">Đã hủy</option>
                        </select>
                </td>
                <td>{$row['ngayTao']}</td>
                <td>
                        <button type='submit'>Cập nhật</button>
                    </form>
                </td>
            </tr>";
        }
        ?>
    </tbody>
</table>

<?php include('../includes/footer.php'); ?>