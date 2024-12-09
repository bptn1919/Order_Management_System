
<?php
// Thông tin kết nối cơ sở dữ liệu
$serverName = "NHI";  // Địa chỉ server SQL
$database = "thu";      // Tên cơ sở dữ liệu
header('Access-Control-Allow-Origin: *'); // Cung cấp quyền truy cập từ mọi nguồn

// Kết nối đến SQL Server sử dụng PDO
try {
    $conn = new PDO("sqlsrv:server=$serverName;Database=$database", "", "");
    // Thiết lập chế độ báo lỗi của PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo"kết nối thành công";

   
} catch (PDOException $e) {
    die(json_encode(['error' => 'Lỗi kết nối cơ sở dữ liệu: ' . $e->getMessage()])); 
}

// Hàm loại bỏ dấu tiếng Việt
function removeVietnameseAccents($str) {
    $accents = [
        'a' => ['à', 'á', 'ạ', 'ả', 'ã', 'â', 'ầ', 'ấ', 'ậ', 'ẩ', 'ẫ', 'ă', 'ằ', 'ắ', 'ặ', 'ẳ', 'ẵ'],
        'e' => ['è', 'é', 'ẹ', 'ẻ', 'ẽ', 'ê', 'ề', 'ế', 'ệ', 'ể', 'ễ'],
        'i' => ['ì', 'í', 'ị', 'ỉ', 'ĩ'],
        'o' => ['ò', 'ó', 'ọ', 'ỏ', 'õ', 'ô', 'ồ', 'ố', 'ộ', 'ổ', 'ỗ', 'ơ', 'ờ', 'ớ', 'ợ', 'ở', 'ỡ'],
        'u' => ['ù', 'ú', 'ụ', 'ủ', 'ũ', 'ư', 'ừ', 'ứ', 'ự', 'ử', 'ữ'],
        'y' => ['ỳ', 'ý', 'ỵ', 'ỷ', 'ỹ'],
        'd' => ['đ'],
        'A' => ['À', 'Á', 'Ạ', 'Ả', 'Ã', 'Â', 'Ầ', 'Ấ', 'Ậ', 'Ẩ', 'Ẫ', 'Ă', 'Ằ', 'Ắ', 'Ặ', 'Ẳ', 'Ẵ'],
        'E' => ['È', 'É', 'Ẹ', 'Ẻ', 'Ẽ', 'Ê', 'Ề', 'Ế', 'Ệ', 'Ể', 'Ễ'],
        'I' => ['Ì', 'Í', 'Ị', 'Ỉ', 'Ĩ'],
        'O' => ['Ò', 'Ó', 'Ọ', 'Ỏ', 'Õ', 'Ô', 'Ồ', 'Ố', 'Ộ', 'Ổ', 'Ỗ', 'Ơ', 'Ờ', 'Ớ', 'Ợ', 'Ở', 'Ỡ'],
        'U' => ['Ù', 'Ú', 'Ụ', 'Ủ', 'Ũ', 'Ư', 'Ừ', 'Ứ', 'Ự', 'Ử', 'Ữ'],
        'Y' => ['Ỳ', 'Ý', 'Ỵ', 'Ỷ', 'Ỹ'],
        'D' => ['Đ'],
    ];

    foreach ($accents as $nonAccent => $accentsArray) {
        $str = str_replace($accentsArray, $nonAccent, $str);
    }

    return $str;
}
?>