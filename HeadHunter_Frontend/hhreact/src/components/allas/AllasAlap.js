import React, { useEffect, useState } from "react";
import useAuthContext from "../../contexts/AuthContext";
import { getAllas } from "../../contexts/AllasContext";
import VisszaLink from "../menu/VisszaLink";

export default function AllasAlap({ jobId }) {
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
    getAllas(allasId).then((response) => {
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

  return (
    <>
      <div className="job-identifiers">
        <div className="job-id">
          <h2>{allasId}</h2>
        </div>
        <div className="job-title">
          <h2>{megnevezes}</h2>
        </div>
      </div>
      <div className="job-details">
        <div className="job-basic">
          <p>Munkáltató: {cegnev}</p>
        </div>
        <div className="job-basic">
          <p>Munkaterület: {terulet}</p>
        </div>
        <div className="job-basic">
          <p>Meghirdetett pozíció: {pozicio}</p>
        </div>
        <div className="job-description">
          <p>{leiras}</p>
        </div>
        <div className="job-basic">
          <p>Meghirdetve: {datum}</p>
        </div>
        {user && (isAdmin(user) || isHeadhunter(user)) && (
          <div className="job-status">
            <p>Hirdetés státusza: {statusz}</p>
          </div>
        )}
        {user && (isAdmin(user) (
          <div className="job-basic">
            <p>Fejvadász: {fejvadaszId} - {fejvadaszNev}</p>
          </div>
        ))}
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
