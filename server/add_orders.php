<?php
include("db_connection.php");
// Lấy dữ liệu từ form gửi đến
$MaDonHang = $_POST['MaDonHang'] ?? null;
$NgayTao = $_POST['NgayTao'] ?? null;
$TongSoTien = $_POST['TongSoTien'] ?? null;
$TrangThai = $_POST['TrangThai'] ?? null;
$NhanVienXuLy = $_POST['NhanVienXuLy'] ?? null;
$KhoChua = $_POST['KhoChua'] ?? null;
$NguoiNhan = $_POST['NguoiNhan'] ?? null;
$CuaHangGui = $_POST['CuaHangGui'] ?? null;
$NgayThanhToan = $_POST['NgayThanhToan'] ?? null;
$PhuongThucThanhToan = $_POST['PhuongThucThanhToan'] ?? null;

// Kiểm tra nếu các trường không rỗng
if (empty($MaDonHang) || empty($NgayTao) || empty($TongSoTien) || empty($TrangThai) || 
    empty($NhanVienXuLy) || empty($KhoChua) || empty($NguoiNhan) || empty($CuaHangGui) || 
    empty($NgayThanhToan) || empty($PhuongThucThanhToan)) {
    echo json_encode(['success' => false, 'message' => 'Tất cả các trường đều phải nhập!']);
    exit;
}

// Kết nối cơ sở dữ liệu
$conn = connectDB();
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Thiết lập chế độ lỗi

// Gọi stored procedure để thêm đơn hàng
$sql = "EXEC InsertDonHang ?, ?, ?, ?, ?, ?, ?, ?, ?, ?";

// Chuẩn bị câu lệnh
$stmt = $conn->prepare($sql);

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
    // Lấy thông báo lỗi từ PDOException
    $errorMessage = $e->getMessage();

    // Loại bỏ phần "SQLSTATE" hoặc thông tin kỹ thuật
    if (strpos($errorMessage, '[SQL Server]') !== false) {
        $errorMessage = substr($errorMessage, strpos($errorMessage, '[SQL Server]') + 12); // Lấy phần sau "[SQL Server]"
    }

    // Trả về lỗi đơn giản hơn
    echo json_encode(['success' => false, 'error' => $errorMessage]);
}

$stmt = null;
$conn = null;
?>
