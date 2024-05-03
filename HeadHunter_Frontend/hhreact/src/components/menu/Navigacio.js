import React, { useState, useEffect } from "react";
import "../../styles/Navigacio.css";
import NavLink from "../../components/menu/NavLink";
import useAuthContext from "../../contexts/AuthContext";
import NavLegordulo from "./NavLegordulo";

export default function Navigacio() {
  const { user } = useAuthContext();
  const [isMenuOpen, setIsMenuOpen] = useState(false);

  const toggleMenu = () => {
    setIsMenuOpen(!isMenuOpen);
  };

  const isAdmin = (felhasznalo) => {
    return felhasznalo?.jogosultsag === 'admin';
  };

  const isHeadhunter = (felhasznalo) => {
    return felhasznalo?.jogosultsag === 'fejvadász';
  };

  useEffect(() => {
    const handleResize = () => {
      if (!isMenuOpen) {
        if (window.innerWidth > 768) {
          document.querySelector(".menu-items").style.display = "flex";
        } else {
          document.querySelector(".menu-items").style.display = "none";
        }
      }
    };

    window.addEventListener("resize", handleResize);

    return () => {
      window.removeEventListener("resize", handleResize);
    };
  }, [isMenuOpen]);

  return (
    <nav>
      <div className="nav">
        <div className="menu-toggle" onClick={toggleMenu}>
          <div className="bar"></div>
          <div className="bar"></div>
          <div className="bar"></div>
        </div>
        <ul className={`menu-items ${isMenuOpen ? "open" : ""}`}>
          <NavLink link="/" title="Kezdőlap" />
          <NavLink link="/jobs" title="Álláskeresés" />
          {((isAdmin(user) || isHeadhunter(user)) && (
            <li className="menu-item">Állások</li>
          ))}
          {user && (isAdmin(user) || isHeadhunter(user)) && (
            <>
              <NavLink link="/admin/employers" title="Munkáltatók" />
              <NavLink link="/admin/jobseekers" title="Álláskeresők" />
              <NavLink link="/admin/hired" title="Felvett jelentkezők" />
            </>
          )}
          {user && isAdmin(user) && (
            <NavLink link="/admin/headhunters" title="Fejvadászok" />
          )}
          {user && isAdmin(user) && <NavLegordulo />}
        </ul>
      </div>
    </nav>
  );
}
