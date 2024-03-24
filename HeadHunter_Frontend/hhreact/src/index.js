import React from "react";
import ReactDOM from "react-dom/client";
import { BrowserRouter } from "react-router-dom";
// import MainPage from "./MainPage"; // Change import statement
import "./index.css";
import AdminAllasok from "./pages/AdminAllasok";
import { AuthProvider } from "./contexts/AuthContext";
import Regisztral from "./components/RegisztralForm";
import Fooldal from "./pages/FoOldal";

const root = ReactDOM.createRoot(document.getElementById("root"));
root.render(
  <React.StrictMode>
    <BrowserRouter>
      <AuthProvider>
        < Regisztral/>
      </AuthProvider>
    </BrowserRouter>
  </React.StrictMode>
);