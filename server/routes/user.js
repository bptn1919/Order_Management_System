// routes/userRoutes.js
const express = require('express');
const router = express.Router();
const userController = require('../controllers/userController');

// Định nghĩa route API để lấy danh sách người dùng
router.get('/users', userController.getUsers);

module.exports = router;
