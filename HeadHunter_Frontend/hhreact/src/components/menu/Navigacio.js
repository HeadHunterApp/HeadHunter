import React, { useState, useEffect, useRef } from "react";
import "../../styles/Navigacio.css";
import NavLink from "../../components/menu/NavLink";
import useAuthContext from "../../contexts/AuthContext";
import NavLegordulo from "./NavLegordulo";

export default function Navigacio() {
  const { user, isAdmin, isHeadhunter  } = useAuthContext();
  const [isMenuOpen, setIsMenuOpen] = useState(false);
  const menuItemsRef = useRef(null);

  const toggleMenu = () => {
    setIsMenuOpen(!isMenuOpen);
  };

  useEffect(() => {
    const handleResize = () => {
      const menuItems = menuItemsRef.current;
      if (!isMenuOpen) {
        if (window.innerWidth > 768) {
          menuItems.style.display = "flex";
        } else {
          menuItems.style.display = "none";
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
        <ul className={`menu-items ${isMenuOpen ? "open" : ""}`} ref={menuItemsRef}>
          <NavLink link="/" title="Kezdőlap" />
          <NavLink link="/jobs" title="Álláskeresés" />
          {user && isHeadhunter() && (
            <>
              <NavLink link="/hunter/jobs" title="Állások" />
              <NavLink link="/hunter/employers" title="Munkáltatók" />
              <NavLink link="/hunter/jobseekers" title="Álláskeresők" />
              <NavLink link="/hunter/hired" title="Felvett jelentkezők" />
            </>
          )}
          {user && isAdmin() && (
            <>
              <NavLink link="/admin/employers" title="Munkáltatók" />
              <NavLink link="/admin/jobseekers" title="Álláskeresők" />
              <NavLink link="/admin/hired" title="Felvett jelentkezők" />
              <NavLink link="/admin/headhunters" title="Fejvadászok" />
              <NavLegordulo />
            </>
          )}
        </ul>
      </div>
    </nav>
  );
}
