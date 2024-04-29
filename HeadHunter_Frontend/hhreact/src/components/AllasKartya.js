import React from "react";
import "../styles/AllasKartya.css";
import useAuthContext from "../contexts/AuthContext";
import { Link } from "react-router-dom";

const AllasKartya = ({ job }) => {
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
    <div className="job-card">
      <div className="job-title">
        <h2>{job.megnevezes}</h2>
      </div>
      <div className="job-description">
        <p>{job.leiras}</p>
      </div>
      {user && (isAdmin(user) || isHeadhunter(user)) && (
        <div className="job-status">
          <p>{job.statusz}</p>
        </div>
      )}
      <div className="info-button">
        {/** ezt a stringify-t ki kell majd kommentelni */}
        {JSON.stringify(job)}
        <button>
          <Link to={`job-info/${job.allas_id}`}>Részletek</Link>
        </button>
      </div>
      <div className="apply-button">
        {user && isJobseeker ? (
          <button>Jelentkezés</button>
        ) : (
          <button>Jelentkeztetés</button>
        )}
      </div>
    </div>
  );
};

export default AllasKartya;
