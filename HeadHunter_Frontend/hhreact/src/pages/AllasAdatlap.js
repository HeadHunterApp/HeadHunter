import React from "react";

import AllasAlap from "../components/allas/AllasAlap";
import VisszaLink from "../components/menu/VisszaLink";
import useAuthContext from "../contexts/AuthContext";

export default function AllasAdatlap({ jobId }) {
  const { user } = useAuthContext();
  const isJobseeker = (felhasznalo) => {
    return felhasznalo.jogosultsag === "álláskereső";
  };

  return (
    <>
      <div className="job-info">
        <AllasAlap jobId={jobId} />
        <div className="apply-button">
          {user && isJobseeker ? (
            <button>Jelentkezés</button>
          ) : (
            <button>Jelentkeztetés</button>
          )}
        </div>
        <VisszaLink />
      </div>
    </>
  );
}
