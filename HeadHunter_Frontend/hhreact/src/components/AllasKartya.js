import React from "react";
import "../styles/AllasKartya.css";
import useAuthContext from "../contexts/AuthContext";
import { Link } from "react-router-dom";

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
      {(isAdmin() || isHeadhunter()) && (
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
        {isJobseeker() ? (
          <button>Jelentkezés</button>
        ) : (
          <button>Jelentkeztetés</button>
        )}
      </div>
    </div>
  );
};

export default AllasKartya;

/* A változtatások itt a isAdmin, isHeadhunter és isJobseeker függvényekben vannak. 
Ezek most már helyesen ellenőrzik, hogy a felhasználó valóban létezik-e (user !== null), 
mielőtt megpróbálnák ellenőrizni a jogosultságát. Ez megakadályozza a hibákat, ha a user értéke null vagy undefined.

Ezenkívül a user változót most már megfelelően használjuk a isJobseeker függvényben is, amikor ellenőrizzük az álláskereső jogosultságot. */
