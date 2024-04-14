import React from "react";
import Main from "./components/Main";
import "./styles/App.css";
import VendegLayout from "./layout/VendegLayout";
import { Route, Routes } from "react-router-dom";
import Allaskereses from "./pages/AllasKereses";
import Profilok from "./pages/Profilok";
import Kezdolap from "./pages/Kezdolap";

export default function App() {
  return (
    <Routes>
      <Route path="/" element={<VendegLayout />}>
        <Route index element={<Main />} />
        <Route path="allaskereses" element={<Allaskereses/>}/>
        <Route path="profil" element={<Profilok/>}/>
        <Route path="kezdolap" element={<Kezdolap/>}/>
      </Route>
    </Routes>
  );
}

