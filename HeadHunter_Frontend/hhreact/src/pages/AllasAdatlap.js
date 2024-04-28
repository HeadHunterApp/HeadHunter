import React from "react";

import AllasAlap from "../components/allas/AllasAlap";
import VisszaLink from "../components/menu/VisszaLink";
import useAuthContext from "../contexts/AuthContext";
import AllasElvaras from "../components/allas/AllasElvaras";

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

  return (
    <>
      <div className="job-info">
        <AllasAlap jobId={jobId} />
        <AllasElvaras jobId={jobId} />
        <div className="apply-button">
          {user && isJobseeker ? (
            <button>Jelentkezés</button>
          ) : (
            <button>Jelentkeztetés</button>
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
