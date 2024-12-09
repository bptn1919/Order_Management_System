const sql = require('mssql');

// Cấu hình kết nối SQL Server
const config = {
  user: 'sa',       // Tên người dùng
  password: '123',   // Mật khẩu
  server: 'localhost',  // Tên server (ví dụ: localhost)
  database: 'thu',   // Tên cơ sở dữ liệu
  options: {
    encrypt: false, // Kết nối bảo mật nếu cần
    trustServerCertificate: true // Tin cậy chứng chỉ của server (chỉ khi phát triển)
  },
  port: 1433,
};

// Hàm gọi Function từ SQL Server
async function callFunction() {
    try {
        const pool = await sql.connect(config);
        const result = await pool.request()
            .input('ViTri', sql.NVarChar(50), 'Quản lí')
            .query('SELECT * FROM dbo.EvaluateEmployeeSkillCapacityByPosition(@ViTri)');
        console.log("Gọi hàm thành công");
        console.table(result.recordset);  // Kết quả trả về từ hàm
    } catch (err) {
        console.error('Error:', err);
    }
}

async function getNhanVienData() {
    try {
      const pool = await sql.connect(config);
      const result = await pool.request().query('SELECT * FROM NhanVien'); // Truy vấn bảng NhanVien
      console.table(result.recordset);  // In kết quả dưới dạng bảng
    } catch (err) {
      console.error('Error:', err);
    }
  }

// Kết nối đến SQL Server và gọi hàm sau khi kết nối thành công
const poolPromise = new sql.ConnectionPool(config)
  .connect()
  .then(pool => {
    console.log('Kết nối thành công đến SQL Server!');
    // Gọi hàm sau khi kết nối thành công
    return callFunction(); // Gọi hàm tại đây
  })
  .catch(err => {
    console.error('Không thể kết nối đến SQL Server:', err);
    process.exit(1); // Dừng server nếu không kết nối được
  });

module.exports = poolPromise;
