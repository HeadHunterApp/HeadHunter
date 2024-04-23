import React from "react";
import "../styles/Header.css";
import FelhasznaloModal from "./felhasznalo-kezeles/FelhasznaloModal";
import Navigacio from "./menu/Navigacio";

const Header = () => {
  return (
    <header className="header-container">
      <div className="left-column">
        <Navigacio />
      </div>
      <div className="right-column">
        <FelhasznaloModal/>
        
      </div>
    </header>
  );
};

export default Header;
