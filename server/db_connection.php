<?php
// Thông tin kết nối cơ sở dữ liệu
$serverName = "DESKTOP-4CDMDCJ";  // Địa chỉ server SQL
$database = "database_csdl";      // Tên cơ sở dữ liệu

try {
    // Kết nối đến SQL Server sử dụng PDO
    $conn = new PDO("sqlsrv:server=$serverName;Database=$database", "", "");
    // Thiết lập chế độ báo lỗi của PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die(json_encode(['error' => 'Lỗi kết nối cơ sở dữ liệu: ' . $e->getMessage()]));
}
?>
