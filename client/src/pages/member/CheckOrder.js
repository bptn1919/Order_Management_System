import React, { useState, useEffect } from "react";

const CheckOrder = () => {
  const [activeTab, setActiveTab] = useState("sent"); // Tab hiện tại (Gửi đi/Nhận)
  const [orders, setOrders] = useState([]); // Danh sách đơn hàng
  const [pagination, setPagination] = useState({
    currentPage: 1,
    totalPages: 1,
  }); // Thông tin phân trang
  const [loading, setLoading] = useState(false); // Trạng thái đang tải
  const [error, setError] = useState(null); // Thông báo lỗi API

  // Hàm lấy dữ liệu từ API
  const fetchOrders = async (trangThai, page = 1) => {
    setLoading(true);
    setError(null); // Reset lỗi
    try {
      const response = await fetch(
        `http://localhost/server/fetch_orders.php?trangthai=${trangThai}&page=${page}`
      );
      const data = await response.json();

      if (response.ok) {
        setOrders(data.orders || []);
        setPagination(data.pagination || { currentPage: 1, totalPages: 1 });
      } else {
        setError("Không thể tải dữ liệu. Vui lòng thử lại.");
      }
    } catch (error) {
      setError("Có lỗi xảy ra khi kết nối tới API.");
    }
    setLoading(false);
  };

  // Gọi API khi tab hoặc trang thay đổi
  useEffect(() => {
    const trangThai = activeTab === "sent" ? "Gửi đi" : "Nhận";
    fetchOrders(trangThai, pagination.currentPage);
  }, [activeTab, pagination.currentPage]);

  // Hàm thay đổi tab
  const handleTabChange = (tab) => {
    setActiveTab(tab);
    setPagination({ ...pagination, currentPage: 1 }); // Reset về trang đầu
  };

  // Hàm thay đổi trang
  const changePage = (page) => {
    setPagination((prev) => ({ ...prev, currentPage: page }));
  };

  // Hàm xử lý nút thoát
  const handleExit = () => {
    window.location.href = "http://localhost:3000/";
  };

  const renderPagination = () => {
    const { currentPage, totalPages } = pagination;
    const paginationElements = [];

    // Hiển thị trang đầu và dấu "..." nếu cần
    if (currentPage > 3) {
      paginationElements.push(
        <button
          key={1}
          className={`px-4 py-2 mx-1 rounded ${
            currentPage === 1 ? "bg-blue-500 text-white" : "bg-gray-300"
          }`}
          onClick={() => changePage(1)}
        >
          1
        </button>
      );
      if (currentPage > 4) {
        paginationElements.push(
          <span key="dots-start" className="px-4 py-2 mx-1">
            ...
          </span>
        );
      }
    }

    // Hiển thị các trang gần với trang hiện tại
    for (
      let i = Math.max(1, currentPage - 2);
      i <= Math.min(totalPages, currentPage + 2);
      i++
    ) {
      paginationElements.push(
        <button
          key={i}
          className={`px-4 py-2 mx-1 rounded ${
            currentPage === i ? "bg-blue-500 text-white" : "bg-gray-300"
          }`}
          onClick={() => changePage(i)}
        >
          {i}
        </button>
      );
    }

    // Hiển thị trang cuối và dấu "..." nếu cần
    if (currentPage < totalPages - 2) {
      if (currentPage < totalPages - 3) {
        paginationElements.push(
          <span key="dots-end" className="px-4 py-2 mx-1">
            ...
          </span>
        );
      }
      paginationElements.push(
        <button
          key={totalPages}
          className={`px-4 py-2 mx-1 rounded ${
            currentPage === totalPages
              ? "bg-blue-500 text-white"
              : "bg-gray-300"
          }`}
          onClick={() => changePage(totalPages)}
        >
          {totalPages}
        </button>
      );
    }

    return (
      <div className="flex justify-center mt-4">
        {/* Trang trước */}
        <button
          className="px-4 py-2 mx-1 bg-gray-300 rounded"
          disabled={currentPage === 1}
          onClick={() => changePage(currentPage - 1)}
        >
          « Trang trước
        </button>
        {paginationElements}
        {/* Trang sau */}
        <button
          className="px-4 py-2 mx-1 bg-gray-300 rounded"
          disabled={currentPage === totalPages}
          onClick={() => changePage(currentPage + 1)}
        >
          Trang sau »
        </button>
      </div>
    );
  };

  return (
    <div className="bg-orange-400 w-full min-h-screen flex">
      {/* Sidebar với các nút */}
      <div className="w-1/4 bg-orange-500 p-4">
        <button
          className={`w-full py-3 mb-4 text-white font-bold rounded ${
            activeTab === "sent" ? "bg-red-600" : "bg-red-400"
          }`}
          onClick={() => handleTabChange("sent")}
        >
          Đơn hàng gửi
        </button>
        <button
          className={`w-full py-3 mb-4 text-white font-bold rounded ${
            activeTab === "received" ? "bg-red-600" : "bg-red-400"
          }`}
          onClick={() => handleTabChange("received")}
        >
          Đơn hàng nhận
        </button>
        <button
          className="w-full py-3 text-white font-bold bg-gray-600 rounded"
          onClick={handleExit}
        >
          Thoát
        </button>
      </div>

      {/* Nội dung */}
      <div className="w-3/4 bg-orange-200 p-6">
        {loading ? (
          <div>Đang tải...</div>
        ) : error ? (
          <div className="text-red-500">{error}</div>
        ) : (
          <div className="bg-white p-4 rounded shadow-md">
            <h2 className="text-xl font-bold mb-4">
              {activeTab === "sent" ? "Đơn hàng gửi đi" : "Đơn hàng nhận"}
            </h2>

            {/* Bảng hiển thị đơn hàng */}
            <table className="min-w-full bg-white border border-gray-300">
              <thead>
                <tr className="bg-gray-100">
                  <th className="px-4 py-2 text-left border-b">Mã đơn hàng</th>
                  <th className="px-4 py-2 text-left border-b">Ngày tạo</th>
                  <th className="px-4 py-2 text-left border-b">Tổng tiền</th>
                  <th className="px-4 py-2 text-left border-b">Thao tác</th>
                </tr>
              </thead>
              <tbody>
                {orders.length > 0 ? (
                  orders.map((order) => (
                    <tr key={order.MaDonHang}>
                      <td className="px-4 py-2 border-b">{order.MaDonHang}</td>
                      <td className="px-4 py-2 border-b">{order.NgayTao}</td>
                      <td className="px-4 py-2 border-b">
                        {order.TongSoTien} VND
                      </td>
                      <td className="px-4 py-2 border-b">
                        <button className="bg-blue-500 text-white px-4 py-2 rounded mr-2">
                          Chỉnh sửa
                        </button>
                        <button className="bg-red-500 text-white px-4 py-2 rounded">
                          Xóa
                        </button>
                      </td>
                    </tr>
                  ))
                ) : (
                  <tr>
                    <td colSpan="4" className="px-4 py-2 text-center">
                      Không có đơn hàng nào.
                    </td>
                  </tr>
                )}
              </tbody>
            </table>

            {/* Phân trang */}
            {renderPagination()}
          </div>
        )}
      </div>
    </div>
  );
};

export default CheckOrder;
