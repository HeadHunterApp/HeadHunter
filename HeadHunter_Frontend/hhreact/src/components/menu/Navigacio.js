import React from "react";
import "../../styles/Navigacio.css";
import NavLink from "../../components/menu/NavLink";
import useAuthContext from "../../contexts/AuthContext";
import NavLegordulo from "./NavLegordulo";

export default function Navigacio() {
  const { user } = useAuthContext();
  const isAdmin = (felhasznalo) => {
    return felhasznalo.jogosultsag === 'admin';
  };
  const isHeadhunter = (felhasznalo) => {
    return felhasznalo.jogosultsag === 'fejvadász';
  };

  return (
    <nav>
      <ul>
        <NavLink link="/" title="Kezdőlap" />
        <NavLink link="/jobs" title="Álláskeresés" />
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
      </ul>
      {user && isAdmin(user) && <NavLegordulo />}
    </nav>
  );
}
