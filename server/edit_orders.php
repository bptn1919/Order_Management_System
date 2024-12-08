<?php
header("Access-Control-Allow-Methods: POST, PUT");
header("Access-Control-Allow-Headers: Content-Type");
include("db_connection.php");

$data = json_decode(file_get_contents("php://input"), true);
$maDonHang = $data['MaDonHang'];
$ngayTao = $data['NgayTao'];
$tongSoTien = $data['TongSoTien'];
$trangthai = $data['TrangThai'];

$query = "UPDATE DonHang SET NgayTao = :ngayTao, TongSoTien = :tongSoTien, TrangThai = :trangthai WHERE MaDonHang = :maDonHang";
$stmt = $conn->prepare($query);
$stmt->bindParam(':maDonHang', $maDonHang);
$stmt->bindParam(':ngayTao', $ngayTao);
$stmt->bindParam(':tongSoTien', $tongSoTien);
$stmt->bindParam(':trangthai', $trangthai);
$stmt->execute();

echo json_encode(['message' => 'Cập nhật thành công!']);
?>
