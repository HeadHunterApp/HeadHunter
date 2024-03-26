import React from "react";
import ReactDOM from "react-dom/client";
import { BrowserRouter } from "react-router-dom";
// import MainPage from "./MainPage"; // Change import statement
import "./index.css";
import AdminAllasok from "./pages/AdminAllasok";
import { AuthProvider } from "./contexts/AuthContext";
<<<<<<< Updated upstream
import Regisztral from "./components/RegisztralForm";
import Fooldal from "./pages/FoOldal";
=======
import Fooldal from "./pages/FoOldal";
import Allaskereses from"./pages/AllasKereses";

>>>>>>> Stashed changes

const root = ReactDOM.createRoot(document.getElementById("root"));
root.render(
  <React.StrictMode>
    <BrowserRouter>
      <AuthProvider>
<<<<<<< Updated upstream
        < Regisztral/>
=======
        <Allaskereses/>
>>>>>>> Stashed changes
      </AuthProvider>
    </BrowserRouter>
  </React.StrictMode>
);