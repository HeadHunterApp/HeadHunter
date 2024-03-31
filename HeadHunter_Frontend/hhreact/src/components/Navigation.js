import React from "react";
import NavLink from "./NavLink";
import "../styles/components/Navigation.css";

const Navigation = () => {
  return (
    <nav>
    
      <ul>
        <NavLink link="#" title="menu1"/>
        <NavLink link="#" title="menu2"/>
        <NavLink link="#" title="menu3"/>
      </ul>
    </nav>
  );
};

export default Navigation;
