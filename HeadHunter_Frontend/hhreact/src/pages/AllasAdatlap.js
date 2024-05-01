import React from "react";
import AllasAlap from "../components/allas/AllasAlap";
import VisszaLink from "../components/menu/VisszaLink";
import useAuthContext from "../contexts/AuthContext";
import AllasElvaras from "../components/allas/AllasElvaras";
import { postAllasJelentkezo, postAllaskerJelentkezes } from "../contexts/AllasContext";


export default function AllasAdatlap({ jobId }) {

  const { user } = useAuthContext();
  const isAdmin = (felhasznalo) => {
    return felhasznalo.jogosultsag === "admin";
  };
  const isHeadhunter = (felhasznalo) => {
    return felhasznalo.jogosultsag === "fejvadász";
  };
  const isJobseeker = (felhasznalo) => {
    return felhasznalo.jogosultsag === "álláskereső";
  };

  const allasId= jobId;
    
  const handleSeekerSubmit = async(e) => {
    e.preventDefault();
    try {
      await postAllaskerJelentkezes(allasId, user._token);
      alert('Sikeres jelentkezés!');
    } catch (error) {
      console.error(error);
      alert('Hiba történt a jelentkezés során');
    }
  };

  const chooseSeeker = {

  };
  /*
  const handleOtherSubmit = async(e) => {
    e.preventDefault();
    try {
      await postAllasJelentkezo(allasId, seekerId);
      alert('Sikeres jelentkezés!');
    } catch (error) {
      console.error(error);
      alert('Hiba történt a jelentkezés során');
    }
  };
  
*/

  return (
    <>
      <div className="job-info">
        <AllasAlap jobId={allasId} />
        <AllasElvaras jobId={allasId} />
        <div className="buttons" >
          {user && isJobseeker ? (
            <button type="submit" onSubmit={handleSeekerSubmit}>Jelentkezés</button>
          ) : (
            user && (isAdmin(user) || isHeadhunter(user))? (
              <button type="submit" /*onSubmit={handleOtherSubmit}*/>Jelentkeztetés</button>
            ) : (
              <div className="login-or-reg">Tetszik ez az állás? Belépést követően tudsz jelentkezni rá</div>
            )
          )}
        </div>
      </div>
      <div className="handling-button">
        {user && (isAdmin(user) || isHeadhunter(user)) && (
          <button>Szerkeszt</button>
        )}
        {user && isAdmin(user)(<button>Töröl</button>)}
      </div>
      <VisszaLink />
    </>
  );
}
