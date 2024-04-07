import React, { useState } from "react";
import '../../styles/FelhasznaloModal.css'; 
/* import '../../styles/components/menu/Navigacio.css'; */
import Bejelentkezes from "./Bejelentkezes";
import Regisztracio from "./Regisztracio";
import useAuthContext from "../../contexts/AuthContext";
import CustomModal from "./modal/CustomModal";
import { Link } from "react-router-dom";

export default function FelhasznaloModal() {
  const [isRegOpen, setIsRegOpen] = useState(false);
  const [isBejOpen, setIsBejOpen] = useState(false);
  const { user, logout } = useAuthContext();

  return(
    <div>
    <ul>
       {user ? (
              <>
              
                <li>
                  <button className="open-button" onClick={logout}>
                    Kijelentkezés
                  </button>
                </li>
                <li>
                  <Link className="open-button" to={"profil"}>
                    Profil
                  </Link>
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
        </ul>
    </div>
  )

}
/* class FelhasznaloModal extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      isRegistryOpen: false,
      isLoginOpen: false
    };
  }
  // modal state toggle funkció
  toggleRegistryModal = () => {
    this.setState(prevState => ({
      isRegistryOpen: !prevState.isRegistryOpen
    }));
  };

  toggleLoginModal = () => {
    this.setState(prevState => ({
      isLoginOpen: !prevState.isLoginOpen
    }));
  };

  render() {
    return (
      <div className="button-container"> */
{
  /*     ---- IDE KELLENE BEÉPÍTENI A BEJELENTKEZÉS-ELLENŐRZŐ RÉSZT ---- */
}

{
  /* gomb ami megnyitja a modalt */
}
{
  /* <button className="open-button" onClick={this.toggleLoginModal}>
            Bejelentkezés
          </button>
          <button className="open-button" onClick={this.toggleRegistryModal}>
            Regisztráció
          </button> */
}
{
  /*     ---- IDE KELLENE BEÉPÍTENI A CUSTOMMODAL RÉSZT, AMIT JÓ LENNE MAGYARRA ÁTNEVEZNI ---- */
}

{
  /* form */
}
{
  /* <div className={this.state.isLoginOpen ? 'modal open' : 'modal'}>
              <div className="modal-content">
                <span className="close" onClick={this.toggleLoginModal}>&times;</span>
                <Bejelentkezes/>
              </div>
          </div> */
}
{
  /* gomb ami megnyitja a popupot*/
}
{
  /* form */
}
{
  /* <div className={this.state.isRegistryOpen ? 'modal open' : 'modal'}>
            <div className="modal-content">
              <span className="close" onClick={this.toggleRegistryModal}>&times;</span>
              <Regisztracio/>
            </div>
          </div>
      </div>
    );
  }
} */
}

/* export default FelhasznaloModal; */
