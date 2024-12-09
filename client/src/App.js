import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';  // Import BrowserRouter
import { ToastContainer } from 'react-toastify';
import { Public, Home, Chitietnhanvien } from './pages/public/index';
import { MemberLayout, CheckOrder} from './pages/member';
import path from './utils/path';

function App() {
  return (
    <Router> {/* Bao quanh Routes bằng Router */}
      <div className="font-main relative">
        <Routes>
          <Route path={path.PUBLIC} element={<Public />}>
            <Route path={path.HOME} element={<Home />} />
            <Route path = {path.CHITIETNHANVIEN} element={<Chitietnhanvien />} />
          </Route>
          
        <Route path={path.MEMBER} element={<MemberLayout />}>
          <Route path={path.CHECK_ORDER} element={<CheckOrder />}/>
          <Route path={path.Add_ORDER} element={<AddOrder />}/>
        </Route>

        </Routes>
        <ToastContainer
          position="top-right"
          autoClose={5000}
          hideProgressBar={true}
          newestOnTop={false}
          closeOnClick
          rtl={false}
          pauseOnFocusLoss
          draggable
          pauseOnHover
        />
        {/* Same as */}
        <ToastContainer />
      </div>
    </Router> 
  );
}

export default App;
