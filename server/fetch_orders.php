<?php
include "db_connection.php";

// Cấu hình phân trang
$itemsPerPage = 10;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Lấy trang hiện tại từ URL, nếu không có thì mặc định là 1
$start = ($currentPage - 1) * $itemsPerPage; // Tính vị trí bắt đầu của trang

// Lấy trạng thái từ request (GET parameter) và chuyển chuỗi có dấu thành không dấu
$trangThai = isset($_GET['trangthai']) ? $_GET['trangthai'] : '';

// Nếu có trạng thái, xử lý chuyển chuỗi có dấu thành không dấu
if (!empty($trangThai)) {
    $trangThai = removeVietnameseAccents($trangThai);
}

// Query để tính tổng số đơn hàng
$countQuery = "SELECT COUNT(*) AS total FROM DonHang WHERE TrangThaiDonHang = :trangthai";
$countStmt = $conn->prepare($countQuery);
$countStmt->bindParam(':trangthai', $trangThai);
$countStmt->execute();
$countResult = $countStmt->fetch(PDO::FETCH_ASSOC);
$totalItems = $countResult['total'] ?? 0; // Tổng số đơn hàng
$totalOrderPages = ceil($totalItems / $itemsPerPage); // Tổng số trang

// Query để lấy danh sách đơn hàng với phân trang
$query = "
    SELECT * 
    FROM DonHang 
    WHERE TrangThaiDonHang = :trangthai
    ORDER BY MaDonHang DESC 
    OFFSET :start ROWS FETCH NEXT :itemsPerPage ROWS ONLY";
$stmt = $conn->prepare($query);
$stmt->bindParam(':trangthai', $trangThai);
$stmt->bindValue(':start', $start, PDO::PARAM_INT);
$stmt->bindValue(':itemsPerPage', $itemsPerPage, PDO::PARAM_INT);
$stmt->execute();

$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Kết quả trả về bao gồm đơn hàng và thông tin phân trang
$response = [
    'orders' => $orders,
    'pagination' => [
        'currentPage' => $currentPage,
        'totalPages' => $totalOrderPages,
        'totalItems' => $totalItems
    ]
];

echo json_encode($response);
?>
