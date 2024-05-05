import React, { useEffect, useState } from "react";
import AllasAlap from "../components/allas/AllasAlap";
import JelentkezesGomb from "../components/allas/JelentkezesGomb";
import VisszaLink from "../components/menu/VisszaLink";
import useAuthContext from "../contexts/AuthContext";
import AllasElvaras from "../components/allas/AllasElvaras";
import { useParams } from "react-router-dom";
import "../styles/AllasAdatlap.css";
import JelentkeztetGomb from "../components/allas/JelentkeztetGomb";

export default function AllasAdatlap() {
  const { user, isAdmin, isHeadhunter, isJobseeker } = useAuthContext();
  const { allas_id } = useParams();

  return (
    <>
      <div className="job-info">
        {console.log(allas_id)}
        <AllasAlap jobId={allas_id} />
        <AllasElvaras jobId={allas_id} />
        <div className="apply-buttons">
          {console.log(user)}
          {user && (isAdmin() || isHeadhunter()) ? (
            <JelentkeztetGomb allas_id={allas_id} />
          ) : user && isJobseeker ? (
            <>
              <JelentkezesGomb allas_id={allas_id} />
            </>
          ) : (
            <div className="login-or-reg">
              Tetszik ez az állás? Belépést követően tudsz jelentkezni rá!
            </div>
          )}
        </div>
        <div className="handling-buttons">
          {user && (isAdmin() || isHeadhunter()) && (
            <button>Szerkeszt</button>
          )}
          {user && isAdmin() && (<button>Töröl</button>)}
        </div>
        <VisszaLink />
      </div>
    </>
  );
}
