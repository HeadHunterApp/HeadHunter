import React from "react";
import '../../styles/AllasKeresoKartya.css'
import useAuthContext from "../../contexts/AuthContext";
import { Link } from "react-router-dom";

const AllaskeresoKartya = ({ seeker }) => {
  const { user, isAdmin, isHeadhunter } = useAuthContext();

  return (
    <div className="seeker-card">
      <div className="seeker-title">
         <h2>Név: {seeker.nev}</h2> 
      </div>
      <div className="seeker-description">
        <p>Email: {seeker.email}</p> 
      </div>
      <div className="seeker-description">
        <p>Telefonszám: {seeker.telefonszam}</p> 
      </div>
      <div className="apply-button">
        <Link to={`/seeker-info/${seeker.user_id}`}>
          <button type="button">Részletek</button>
        </Link>
      </div>

    </div>
  );
};

export default AllaskeresoKartya;