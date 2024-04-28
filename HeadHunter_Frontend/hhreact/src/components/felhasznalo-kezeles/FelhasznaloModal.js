import React, { useState } from "react";
import "../../styles/FelhasznaloModal.css";
/* import '../../styles/components/menu/Navigacio.css'; */
import Bejelentkezes from "./Bejelentkezes";
import Regisztracio from "./Regisztracio";
import useAuthContext from "../../contexts/AuthContext";
import CustomModal from "./modal/CustomModal";
import { Link, useNavigate } from "react-router-dom";
import BejKezdolap from "../BejKezdolap";

export default function FelhasznaloModal() {
  const [isRegOpen, setIsRegOpen] = useState(false);
  const [isBejOpen, setIsBejOpen] = useState(false);
  const { user, logout } = useAuthContext();
  const navigate = useNavigate();

  const handleLogout = async () => {
    await logout(); //ez az axios-szal jelentkeztet ki
    navigate("/"); //ez viszi át a VendégLayoutra az AuthLayoutról
  };

  return (
    <div>
      <ul>
        {user ? (
          <>
            <li>
              <button className="open-button" onClick={handleLogout}>
                Kijelentkezés
              </button>
            </li>
            <li>
              <Link to={"profile"}>
                <button className="open-button">Profil</button>
              </Link>
            </li>
          </>
        ) : (
          <>
            <li>
              <button
                className="open-button"
                onClick={() => setIsBejOpen(true)}
              >
                Bejelentkezés
              </button>
            </li>
            <li>
              <button
                className="open-button"
                onClick={() => setIsRegOpen(true)}
              >
                Regisztráció
              </button>
            </li>
          </>
        )}

        <CustomModal isOpen={isRegOpen} onClose={() => setIsRegOpen(false)}>
          <Regisztracio onClose={() => setIsRegOpen(false)} />
        </CustomModal>

        <CustomModal isOpen={isBejOpen} onClose={() => setIsBejOpen(false)}>
          <Bejelentkezes onClose={() => setIsBejOpen(false)} />
        </CustomModal>
      </ul>
      {/* Bejelentkezett felhasználó esetén jelenik meg */}
      {user && <BejKezdolap />}
    </div>
  );
}
