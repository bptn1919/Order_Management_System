<?php
// Include the database connection file
include "db_connection.php";

// Đảm bảo là phương thức GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Kiểm tra xem tham số 'position' có tồn tại trong request hay không
    if (isset($_GET['position'])) {
        $position = $_GET['position'];
        
        // Chuẩn bị câu lệnh SQL với tham số động
        try {
            $sql = "SELECT * FROM dbo.EvaluateEmployeeSkillCapacityByPosition(:position)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':position', $position, PDO::PARAM_STR); // Bó buộc tham số 'position'
            $stmt->execute();
            
            $data = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            
            echo json_encode($data);
        } catch (PDOException $e) {
            echo json_encode(['error' => 'Lỗi kết nối cơ sở dữ liệu: ' . $e->getMessage()]);
        } 
    } else {
        echo json_encode(['error' => 'Position parameter is missing.']);
    }
}
?>
