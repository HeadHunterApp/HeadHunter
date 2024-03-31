import React from "react";
import useAuthContext from "../contexts/AuthContext";
import "../styles/components/Navigation.css";
import NavLink from "./NavLink";

export default function Navigacio() {
  const { user, logout } = useAuthContext();
  return (
    <nav className="">
      <div className="">
        <ul className="">
          <NavLink link="/" title="Kezdőlap" />
                   {user ? (
            <>
              <li className="navbar-item">
                <button className="nav-link" onClick={logout}>
                  Kijelentkezés
                </button>
              </li>
            </>
          ) : (
            <>
              <NavLink link="/allaskereses" title="Álláskeresés" />
             
              {/*<NavLink link="/regisztracio" title="Regisztráció" />*/}
             
            </>
          )}
        </ul>
      </div>
    </nav>
  );
}
