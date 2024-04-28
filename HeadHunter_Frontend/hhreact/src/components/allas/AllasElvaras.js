import React, { useEffect, useState } from "react";
import { getAllasIsmeret, getAllasNyelvtudas, getAllasTapasztalat, getAllasVegzettseg } from "../../contexts/AllasContext";

export default function AllasElvaras({ jobId }) {
  const allasId = jobId;
  const [ismeretElvaras, setIsmeretElvaras] = useState([]);
  const [ismeretElony, setIsmeretElony] = useState([]);
  const [nyelvtudas, setNyelvtudas] = useState([]);
  const [vegzettseg, setVegzettseg] = useState("");
  const [tapasztalat, setTapasztalat] = useState([]);

  useEffect(() => {
    getAllasIsmeret(allasId).then((response) => {
      const elvarasok = response.data.filter((item) => item.szint === "elvárás");
      const elonyok = response.data.filter((item) => item.szint === "előny");

      setIsmeretElvaras(elvarasok);
      setIsmeretElony(elonyok);
    });
  }, []);

  useEffect(() => {
    getAllasNyelvtudas(allasId).then((response) => {
      setNyelvtudas(response.data);
    });
  }, []);

  useEffect(() => {
    getAllasVegzettseg(allasId).then((response) => {
      setVegzettseg(response.data.megnevezes);
    });
  }, []);

  useEffect(() => {
    getAllasTapasztalat(allasId).then((response) => {
        setTapasztalat(response.data);
    });
  }, []);

  return (
    <>
      <div className="job-expectations">
        <div className="job-musthave">
          <h2>Elvárások a jelölttel szemben:</h2>
          <h3>Minimum végzettség:</h3>
          <ul>
            <li>{vegzettseg}</li>
          </ul>
          <h3>Elvárt munkatapasztalat:</h3>
          <ul>
            {tapasztalat.map((tapasztalat, index) => (
                <li key={index}>{tapasztalat.terulet} - {tapasztalat.pozicio} - {tapasztalat.leiras}</li>
          ))}
          </ul>
          <h3>Szükséges nyelvtudás:</h3>
          <ul>
            {nyelvtudas.map((nyelvtudas, index) => (
                <li key={index}>{nyelvtudas.nyelv} - {nyelvtudas.megnevezes}</li>
          ))}
          </ul>
          <h3>Képességek és szaktudás:</h3>
          <ul>
            {ismeretElvaras.map((ismeretElvaras, index) => (
                <li key={index}>{ismeretElvaras.megnevezes}</li>
          ))}
          </ul>
        </div>
        <div className="job-preference">
          <h2>A pozíció betöltésénél előnyt jelent:</h2>
          <ul>
            {ismeretElony.map((ismeretElony, index) => (
                <li key={index}>{ismeretElony.megnevezes}</li>
          ))}
          </ul>
        </div>
      </div>
    </>
  );
}
