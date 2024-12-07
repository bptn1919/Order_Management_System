<?php
header('Access-Control-Allow-Origin: *'); // Cung cấp quyền truy cập từ mọi nguồn

// Import file kết nối cơ sở dữ liệu
include 'db_connection.php';

// Cấu hình phân trang
$itemsPerPage = 10;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($currentPage - 1) * $itemsPerPage;

try {
    // Lấy trạng thái từ request (GET parameter)
    $trangThai = isset($_GET['trangthai']) ? $_GET['trangthai'] : '';

    // Query để tính tổng số đơn hàng
    $countQuery = "SELECT COUNT(*) AS total FROM DonHang WHERE TrangThai = :trangthai";
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
        WHERE TrangThai = :trangthai 
        ORDER BY NgayTao DESC 
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

} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
