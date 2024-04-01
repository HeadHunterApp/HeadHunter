import React, { useState } from "react";
import useAuthContext from "../contexts/AuthContext";
import NavLink from "./NavLink";
import CustomModal from "./Modal/CustomModal";
import Regisztracio from "./Regisztracio";
import Bejelentkezes from "./Bejelentkezes";

export default function Navigacio() {
  const [isRegOpen, setIsRegOpen] = useState(false);
  const [isBejOpen, setIsBejOpen] = useState(false);
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
              <li className="navbar-item">
                <button className="nav-link" onClick={() => setIsRegOpen(true)}>
                  Regisztracio
                </button>
              </li>

              <li className="navbar-item">
                <button className="nav-link" onClick={() => setIsBejOpen(true)}>
                  Bejelentkezes
                </button>
              </li>
            </>
          )}
        </ul>

        <CustomModal isOpen={isRegOpen} onClose={() => setIsRegOpen(false)}>
          <Regisztracio />
        </CustomModal>

        <CustomModal isOpen={isBejOpen} onClose={() => setIsBejOpen(false)}>
          <Bejelentkezes />
        </CustomModal>
      </div>
    </nav>
  );
}