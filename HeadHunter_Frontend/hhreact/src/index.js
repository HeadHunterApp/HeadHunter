import React from "react";
import ReactDOM from "react-dom/client";
import { BrowserRouter } from "react-router-dom";
// import MainPage from "./MainPage"; // Change import statement
import "./index.css";

import { AuthProvider } from "./contexts/AuthContext";
import Fooldal from "./pages/FoOldal";
import AllasKereses from"./pages/AllasKereses";


const root = ReactDOM.createRoot(document.getElementById("root"));
root.render(
  <React.StrictMode>
    <BrowserRouter>
      <AuthProvider>
        <AllasKereses/>
      </AuthProvider>
    </BrowserRouter>
  </React.StrictMode>
);