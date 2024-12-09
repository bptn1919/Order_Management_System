<?php
include("db_connection.php");

// Lấy dữ liệu từ form gửi đến
$MaDonHang = $_POST['MaDonHang'];
$NgayTao = $_POST['NgayTao'];
$TongSoTien = $_POST['TongSoTien'];
$TrangThai = $_POST['TrangThai'];
$NhanVienXuLy = $_POST['NhanVienXuLy'];
$KhoChua = $_POST['KhoChua'];
$NguoiNhan = $_POST['NguoiNhan'];
$CuaHangGui = $_POST['CuaHangGui'];
$NgayThanhToan = $_POST['NgayThanhToan'];
$PhuongThucThanhToan = $_POST['PhuongThucThanhToan'];

// Kiểm tra nếu các trường không rỗng
if (empty($MaDonHang) || empty($NgayTao) || empty($TongSoTien) || empty($TrangThai) || 
    empty($NhanVienXuLy) || empty($KhoChua) || empty($NguoiNhan) || empty($CuaHangGui) || 
    empty($NgayThanhToan) || empty($PhuongThucThanhToan)) {
    echo json_encode(['success' => false, 'message' => 'Tất cả các trường đều phải nhập!']);
    exit;
}

// Gọi stored procedure để thêm đơn hàng
$sql = "EXEC InsertDonHang ?, ?, ?, ?, ?, ?, ?, ?, ?, ?";

// Chuẩn bị câu lệnh
$stmt = $conn->prepare($sql);

// Kiểm tra nếu việc chuẩn bị câu lệnh thành công
if ($stmt === false) {
    echo json_encode(['success' => false, 'error' => 'Không thể chuẩn bị câu lệnh SQL.']);
    exit;
}

// Bind các tham số
$stmt->bindParam(1, $MaDonHang, PDO::PARAM_STR);
$stmt->bindParam(2, $NgayTao, PDO::PARAM_STR);
$stmt->bindParam(3, $TongSoTien, PDO::PARAM_INT);
$stmt->bindParam(4, $TrangThai, PDO::PARAM_STR);
$stmt->bindParam(5, $NhanVienXuLy, PDO::PARAM_STR);
$stmt->bindParam(6, $KhoChua, PDO::PARAM_STR);
$stmt->bindParam(7, $NguoiNhan, PDO::PARAM_STR);
$stmt->bindParam(8, $CuaHangGui, PDO::PARAM_STR);
$stmt->bindParam(9, $NgayThanhToan, PDO::PARAM_STR);
$stmt->bindParam(10, $PhuongThucThanhToan, PDO::PARAM_STR);

// Thực thi câu lệnh
try {
    $stmt->execute();
    echo json_encode(['success' => true, 'message' => 'Thêm đơn hàng thành công']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => 'Lỗi: ' . $e->getMessage()]);
}
?>
