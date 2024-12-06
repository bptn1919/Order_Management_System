import React , { useState } from 'react'


const CheckOrder = () => {
    const [activeTab, setActiveTab] = useState('sent'); // Mặc định là "Đơn hàng gửi đi"
  
    const sentOrders = (
      <div className="bg-white p-4 rounded shadow-md">
        <h2 className="text-xl font-bold mb-4">Đơn hàng gửi đi</h2>
        <ul>
          <li>Đơn hàng #1</li>
          <li>Đơn hàng #2</li>
          <li>Đơn hàng #3</li>
        </ul>
      </div>
    );
  
    const receivedOrders = (
      <div className="bg-white p-4 rounded shadow-md">
        <h2 className="text-xl font-bold mb-4">Đơn hàng nhận</h2>
        <ul>
          <li>Đơn hàng #A</li>
          <li>Đơn hàng #B</li>
          <li>Đơn hàng #C</li>
        </ul>
      </div>
    );
  
    return (
      <div className="bg-orange-400 w-full min-h-screen flex">
        {/* Sidebar với các nút */}
        <div className="w-1/4 bg-orange-500 p-4">
          <button
            className={`w-full py-3 mb-4 text-white font-bold rounded ${activeTab === 'sent' ? 'bg-red-600' : 'bg-red-400'}`}
            onClick={() => setActiveTab('sent')}
          >
            Đơn hàng gửi đi
          </button>
          <button
            className={`w-full py-3 text-white font-bold rounded ${activeTab === 'received' ? 'bg-red-600' : 'bg-red-400'}`}
            onClick={() => setActiveTab('received')}
          >
            Đơn hàng nhận
          </button>
        </div>
  
        {/* Nội dung */}
        <div className="w-3/4 bg-orange-200 p-6">
          {activeTab === 'sent' ? sentOrders : receivedOrders}
        </div>
      </div>
    );
}

export default CheckOrder