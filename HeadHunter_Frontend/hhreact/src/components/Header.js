import React from "react";
import "../styles/components/Header.css";
import LoginModalForm from "./felhasznalo-kezeles/FelhasznaloModal";
import Navigacio from "./menu/Navigacio";

const Header = () => {
  return (
    <header>
      <div className="left-column">
        <Navigacio />
      </div>
      <div className="right-column">
        <LoginModalForm />
      </div>
    </header>
  );
};

export default Header;
