import React, { useEffect, useState } from "react";
import useAuthContext from "../../contexts/AuthContext";
import { getAllas } from "../../contexts/AllasContext";

export default function AllasAlap({ jobId }) {
  const { user, isAdmin, isHeadhunter } = useAuthContext();

  const allasId = jobId;
  const [cegnev, setCegnev] = useState("");
  const [megnevezes, setMegnevezes] = useState("");
  const [terulet, setTerulet] = useState("");
  const [pozicio, setPozicio] = useState("");
  const [leiras, setLeiras] = useState("");
  const [statusz, setStatusz] = useState("");
  const [datum, setDatum] = useState("");
  const [fejvadaszId, setFejvadaszId] = useState("");
  const [fejvadaszNev, setFejvadaszNev] = useState("");

  useEffect(() => {
    console.log(allasId);
    getAllas(allasId).then((response) => {
      console.log(response.data);
      setCegnev(response.data.cegnev);
      setMegnevezes(response.data.megnevezes);
      setTerulet(response.data.terulet);
      setPozicio(response.data.pozicio);
      setLeiras(response.data.leiras);
      setStatusz(response.data.statusz);
      setDatum(response.data.datum);
      if (response.data.fejvadasz) {
        setFejvadaszId(response.data.fejvadasz_id);
        setFejvadaszNev(response.data.fejvadasz);
      }
    });
  }, []);
  console.log({
    cegnev,
    megnevezes,
    terulet,
    pozicio,
    leiras,
    statusz,
    datum,
  });
  return (
    <>
      <div className="job-identifiers">
        <div className="job-id">
          <h2>{allasId}</h2>
        </div>
        <div className="jobtitle">
          <h2>{megnevezes}</h2>
        </div>
      </div>
      <div className="job-details">
        <div className="job-basic">
          <p>
            <span>Munkáltató: </span>
            {cegnev}
          </p>
        </div>
        <div className="job-basic">
          <p>
            <span>Munkaterület: </span>
            {terulet}
          </p>
        </div>
        <div className="job-basic">
          <p>
            <span>Meghirdetett pozíció: </span>
            {pozicio}
          </p>
        </div>
        <div className="jobdesc">
          <p>{leiras}</p>
        </div>
        <div className="job-basic">
          <p>
            <span>Meghirdetve: </span>
            {datum}
          </p>
        </div>
        {user && (isAdmin() || isHeadhunter()) && (
          <div className="job-status">
            <p>
              <span>Hirdetés státusza: </span>
              {statusz}
            </p>
          </div>
        )}
        {user &&
          isAdmin() && (
            <div className="job-basic">
              <p>
                <span>Fejvadász: </span>
                {fejvadaszId} - {fejvadaszNev}
              </p>
            </div>
          )}
      </div>
    </>
  );
}
