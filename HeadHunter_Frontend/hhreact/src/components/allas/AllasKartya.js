import React from "react";
import "../../styles/AllasKartya.css";
import useAuthContext from "../../contexts/AuthContext";
import { Link } from "react-router-dom";
import JelentkezesGomb from "./JelentkezesGomb";
import JelentkeztetGomb from "./JelentkeztetGomb";

const AllasKartya = ({ job }) => {
  const { user, isAdmin, isHeadhunter, isJobseeker } = useAuthContext();

  return (
    <div className="job-card">
      <div className="job-title">
        <h2>{job.megnevezes}</h2>
      </div>
      <div className="job-description">
        <p>{job.leiras}</p>
      </div>
      {user && (isAdmin() || isHeadhunter()) && (
        <div className="job-status">
          <p>{job.statusz}</p>
        </div>
      )}
      <div className="apply-button">
        <Link to={`/job-info/${job.allas_id}`}>
          <button type="button">Részletek</button>
        </Link>
      </div>
      <div className="apply-button">
        {user && isJobseeker() && (
         <JelentkezesGomb allas_id={job.allas_id} />          
        ) /* futásidő optimalizálás miatt kiszedve - ha visszatesszük, fenti && helyett ? kell
          : user && (isAdmin() || isHeadhunter()) && (
              <JelentkeztetGomb allas_id={job.allas_id} />
          )
        */
        }
      </div>
    </div>
  );
};

export default AllasKartya;