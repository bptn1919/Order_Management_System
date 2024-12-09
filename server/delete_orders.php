<?php
header("Access-Control-Allow-Methods: DELETE");
include("db_connection.php");


    // Lấy Mã đơn hàng từ URL
    $maDonHang = isset($_GET['MaDonHang']) ? $_GET['MaDonHang'] : '';

    if ($maDonHang) {
        // Câu lệnh SQL để xóa đơn hàng
        $deleteQuery = "EXEC DeleteDonHang @MaDonHang = :maDonHang";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bindParam(':maDonHang', $maDonHang);
        $stmt->execute();

        // Trả về kết quả thành công
        echo json_encode(['message' => 'Xóa đơn hàng thành công.']);
    } else {
        // Trả về lỗi nếu thiếu mã đơn hàng
        echo json_encode(['error' => 'Mã đơn hàng không hợp lệ.']);
    }

?>
