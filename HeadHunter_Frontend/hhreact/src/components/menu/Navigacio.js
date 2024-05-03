import React from "react";
import "../../styles/Navigacio.css";
import NavLink from "../../components/menu/NavLink";
import useAuthContext from "../../contexts/AuthContext";
import NavLegordulo from "./NavLegordulo";

export default function Navigacio() {
  const { user, isAdmin, isHeadhunter } = useAuthContext();

  return (
    <nav>
      <ul>
        <NavLink link="/" title="Kezdőlap" />
        <NavLink link="/jobs" title="Álláskeresés" />
        {user && (isAdmin() || isHeadhunter()) && (
          <>
            <NavLink link="/admin/employers" title="Munkáltatók" />
            <NavLink link="/admin/jobseekers" title="Álláskeresők" />
            <NavLink link="/admin/hired" title="Felvett jelentkezők" />
          </>
        )}
        {user && isAdmin() && (
          <NavLink link="/admin/headhunters" title="Fejvadászok" />
        )}
      </ul>
      {user && isAdmin() && <NavLegordulo />}
    </nav>
  );
}
