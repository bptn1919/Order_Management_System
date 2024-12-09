// server.js
const express = require('express');
const app = express();
const userRoutes = require('./routes/user');

const PORT = process.env.PORT || 5000;

app.use(express.json());

// Sử dụng các route API
app.use('/api', userRoutes);

app.listen(PORT, () => {
  console.log(`Server đang chạy trên cổng ${PORT}`);
});