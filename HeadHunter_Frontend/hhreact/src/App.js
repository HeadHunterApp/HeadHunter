import React from "react";
import Main from "./components/Main";
import "./styles/App.css";
import VendegLayout from "./layout/VendegLayout";
import { Route, Routes } from "react-router-dom";

export default function App() {
  return (
    <Routes>
      <Route path="/" element={<VendegLayout />}>
        <Route index element={<Main />} />
      </Route>
    </Routes>
  );
}

