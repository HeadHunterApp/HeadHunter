import React, { useState } from "react";
import "../../styles/Navigacio.css";
import NavLink from "../../components/menu/NavLink";

 /* ---- EZ A FELHASZNALOMODALBA KELL ---- */
/* import useAuthContext from "../../contexts/AuthContext";
import CustomModal from "../felhasznalo-kezeles/modal/CustomModal";
import Regisztracio from "../felhasznalo-kezeles/Regisztracio";
import Bejelentkezes from "../felhasznalo-kezeles/Bejelentkezes";
 */

export default function Navigacio() {
  
/*  ---- EZ CSAK AKKOR KELL, HA NEM A CLASST HASZNÁLJUK, DE AKKOR IS A FELHASZNALOMODALBA ----

  const [isRegOpen, setIsRegOpen] = useState(false);
  const [isBejOpen, setIsBejOpen] = useState(false);
  const { user, logout } = useAuthContext();


/*  ----  LINKEKHEZ A ROUTE MÉG HIÁNYZIK  -----  */


  return (
    <nav>
      <ul>
        <NavLink link="/" title="Kezdőlap" />
       {/*  {!user && (  */}
                <NavLink link="jobs" title="Álláskeresés" />
         {/*   )} */}

          
            {/*  ---- EZT A RÉSZT KELLENE ÁTÉPÍTENI, EGYESÍTENI A FELHASZNALOMODALLAL ---- */}
          {/* {user ? (
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

        <CustomModal isOpen={isRegOpen} onClose={() => setIsRegOpen(false)}>
          <Regisztracio />
        </CustomModal>

        <CustomModal isOpen={isBejOpen} onClose={() => setIsBejOpen(false)}>
          <Bejelentkezes />
        </CustomModal>
        
       */}

      </ul>
    </nav>
  );
}