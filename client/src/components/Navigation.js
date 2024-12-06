import React from 'react';
import { useNavigate } from 'react-router-dom';
import { Link } from 'react-router-dom';
import { IoChatbubbleEllipsesOutline } from "react-icons/io5";
import { FaRegUserCircle } from "react-icons/fa";

const Navigation = () => {
    const navigate = useNavigate();

    const handleLogin = () => {
        navigate('/login'); // Điều hướng đến trang đăng nhập
    };

    return (
        <div className="bg-red-600 w-full">
            {/* Khung giới hạn nội dung thanh điều hướng */}
            <div className="w-main h-[48px] py-2 mx-auto flex items-center justify-between">
                {/* Phía bên trái */}
                <div className="flex items-center space-x-8">
                    {/* Trang chủ */}
                    <Link to="/" className="hover:text-gray-200 text-white">
                        Trang chủ
                    </Link>

                    {/* Chính sách */}
                    <Link to="/policy" className="hover:text-gray-200 text-white">
                        Chính sách
                    </Link>

                    {/* Liên hệ */}
                    <div className="flex items-center space-x-2 cursor-pointer hover:text-gray-200 text-white">
                        <IoChatbubbleEllipsesOutline color="orange" size={20} className="text--800 h-6" />
                        <span className="text-base">Liên hệ</span>
                    </div>
                </div>

                {/* Phía bên phải */}
                <div className="flex items-center space-x-8">
                    {/* Đăng nhập */}
                    <button
                        className="flex items-center gap-2 rounded-md bg-slate-500 bg-opacity-20 px-1 py-2 hover:text-gray-200 text-xs"
                        onClick={handleLogin}
                    >
                        <FaRegUserCircle className="text-xl" />
                        <span className="px-0.5 text-sm">Đăng nhập</span>
                    </button>
                </div>
            </div>
        </div>
    );
};

export default Navigation;
