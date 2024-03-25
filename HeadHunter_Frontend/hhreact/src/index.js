import React from "react";
import ReactDOM from "react-dom/client";
import { BrowserRouter } from "react-router-dom";
// import MainPage from "./MainPage"; // Change import statement
import "./index.css";

import { AuthProvider } from "./contexts/AuthContext";
import Regisztral from "./components/RegisztralForm";
import Fooldal from "./views/FoOldal";


const root = ReactDOM.createRoot(document.getElementById("root"));
root.render(
  <React.StrictMode>
    <BrowserRouter>
      <AuthProvider>
        <Fooldal/>
      </AuthProvider>
    </BrowserRouter>
  </React.StrictMode>
);