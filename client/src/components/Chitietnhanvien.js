import React, { useState, useEffect } from "react";

const Chitietnhanvien = () => {
  const [position, setPosition] = useState(""); // Lưu vị trí chọn
  const [employeeData, setEmployeeData] = useState([]); // Lưu dữ liệu nhân viên

  const fetchEmployeeData = async (position) => {
    try {
      const response = await fetch(`/api/employeeData?position=${position}`);
      const data = await response.json();
      setEmployeeData(data);
    } catch (error) {
      console.error("Error fetching employee data:", error);
    }
  };

  useEffect(() => {
    if (position) {
      fetchEmployeeData(position);
    }
  }, [position]);

  return (
    <div className="bg-gradient-to-r from-orange-400 to-red-500 w-full min-h-screen flex flex-col items-center">
      {/* Tiêu đề ở giữa */}
      <div className="w-main h-[110px] py-[35px] flex items-center justify-center mb-4">
        <h2 className="text-2xl font-bold text-white">NHÂN VIÊN XUẤT SẮC NHẤT</h2>
      </div>

      {/* Bảng nền với nút gắn */}
      <div className="bg-white shadow-lg rounded-lg p-6 relative w-4/5 max-w-4xl">
        {/* Thanh lựa chọn */}
        <div className="absolute -top-10 left-1/2 transform -translate-x-1/2 flex space-x-4">
  <button
    onClick={() => setPosition("Quan li")}
    className={`w-40 h-16 flex items-center justify-center px-4 py-2 rounded-full shadow-md transition-transform transform ${
      position === "Quan li"
        ? "bg-indigo-600 text-white scale-110"
        : "bg-gray-100 text-gray-800 hover:bg-gray-200"
    }`}
  >
    Nhân viên<br />quản lí
  </button>
  <button
    onClick={() => setPosition("Ho tro")}
    className={`w-40 h-16 flex items-center justify-center px-4 py-2 rounded-full shadow-md transition-transform transform ${
      position === "Ho tro"
        ? "bg-teal-600 text-white scale-110"
        : "bg-gray-100 text-gray-800 hover:bg-gray-200"
    }`}
  >
    Nhân viên<br />hỗ trợ
  </button>
  <button
    onClick={() => setPosition("Van hanh")}
    className={`w-40 h-16 flex items-center justify-center px-4 py-2 rounded-full shadow-md transition-transform transform ${
      position === "Van hanh"
        ? "bg-yellow-600 text-white scale-110"
        : "bg-gray-100 text-gray-800 hover:bg-gray-200"
    }`}
  >
    Nhân viên<br />vận hành
  </button>
</div>


        {/* Nội dung bên trong bảng */}
        {employeeData.length > 0 ? (
          <table className="w-full table-auto bg-white shadow-md rounded-lg mt-12">
            <thead>
              <tr>
                <th className="px-4 py-2 border text-left">CCCD</th>
                <th className="px-4 py-2 border text-left">Họ và Tên</th>
                <th className="px-4 py-2 border text-left">Số Kỹ Năng</th>
                <th className="px-4 py-2 border text-left">Danh Sách Kỹ Năng</th>
                <th className="px-4 py-2 border text-left">Tổng Điểm Kỹ Năng</th>
                <th className="px-4 py-2 border text-left">Mức Độ Năng Lực</th>
              </tr>
            </thead>
            <tbody>
              {employeeData.map((employee) => (
                <tr key={employee.CCCD}>
                  <td className="px-4 py-2 border">{employee.CCCD}</td>
                  <td className="px-4 py-2 border">{employee.FullName}</td>
                  <td className="px-4 py-2 border">{employee.SkillCount}</td>
                  <td className="px-4 py-2 border">{employee.SkillList}</td>
                  <td className="px-4 py-2 border">{employee.SkillPointTotal}</td>
                  <td className="px-4 py-2 border">{employee.CapacityLevel}</td>
                </tr>
              ))}
            </tbody>
          </table>
        ) : (
          <div className="mt-12 text-gray-500 text-center">
            Chọn một vị trí để hiển thị dữ liệu.
          </div>
        )}
      </div>
    </div>
  );
};

export default Chitietnhanvien;
