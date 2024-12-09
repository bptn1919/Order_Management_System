<?php
include("db_connection.php");

if (isset($_GET['position'])) {
    $position = $_GET['position'];

    // Gọi function SQL để lấy dữ liệu nhân viên theo vị trí
    $sql = "SELECT * FROM dbo.EvaluateEmployeeSkillCapacityByPosition(?)"; 
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $position);
    
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $employees = [];
        
        while ($row = $result->fetch_assoc()) {
            $employees[] = $row;
        }

        echo json_encode($employees);
    } else {
        echo json_encode(["error" => "Không thể lấy dữ liệu"]);
    }
}
?>
