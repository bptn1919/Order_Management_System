// controllers/userController.js
const poolPromise = require('../config/dbconnect');

async function getUsers(req, res) {
  try {
    const pool = await poolPromise;
    const result = await pool.request().query('SELECT * FROM Nguoi');  // Thay 'Users' bằng tên bảng của bạn
    res.json(result.recordset);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
}

module.exports = {
  getUsers
};
