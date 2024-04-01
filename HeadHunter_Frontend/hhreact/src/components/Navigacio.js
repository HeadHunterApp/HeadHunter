import React, { useState } from "react";
import useAuthContext from "../contexts/AuthContext";
import "../styles/components/Navigation.css";
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
          <div className="left-column">
            <li>
              <NavLink link="/" title="Kezdőlap" />
            </li>
            {!user && (
              <li>
                <NavLink link="/allaskereses" title="Álláskeresés" />
              </li>
            )}
          </div>
          <div className="right-column">
            {user ? (
              <>
                <li>
                  <button className="open-button" onClick={logout}>
                    Kijelentkezés
                  </button>
                </li>
                <li>
                  <button className="open-button">
                    Profil
                  </button>
                </li>
              </>
            ) : (
              <>
                <li>
                  <button className="open-button" onClick={() => setIsBejOpen(true)}>
                    Bejelentkezes
                  </button>
                </li>
                <li>
                  <button className="open-button" onClick={() => setIsRegOpen(true)}>
                    Regisztracio
                  </button>
                </li>
              </>
            )}
          </div>
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