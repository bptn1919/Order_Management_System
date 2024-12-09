<?php
// Include the database connection file
include "db_connection.php";

// Đảm bảo là phương thức GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Kiểm tra xem tham số 'storeID' và 'orderStatus' có tồn tại trong request hay không
    if (isset($_GET['storeID']) && isset($_GET['orderStatus'])) {
        $storeID = $_GET['storeID'];
        $orderStatus = $_GET['orderStatus'];
        
        // Chuẩn bị câu lệnh SQL với tham số động
        try {
            $sql = "SELECT * FROM dbo.CalculateDeliveryStatusByStore(:storeID, :orderStatus) ORDER BY Percentage DESC";
            $stmt = $conn->prepare($sql);
            
            // Gắn tham số vào câu lệnh
            $stmt->bindParam(':storeID', $storeID, PDO::PARAM_STR);
            $stmt->bindParam(':orderStatus', $orderStatus, PDO::PARAM_STR);
            
            // Thực thi câu lệnh
            $stmt->execute();
            
            // Lấy kết quả
            $data = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            
            // Trả về kết quả dưới dạng JSON
            echo json_encode($data);
        } catch (PDOException $e) {
            echo json_encode(['error' => 'Lỗi kết nối cơ sở dữ liệu: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['error' => 'storeID and orderStatus parameters are required.']);
    }
}

?>
