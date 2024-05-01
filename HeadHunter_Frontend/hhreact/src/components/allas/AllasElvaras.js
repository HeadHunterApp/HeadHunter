import React, { useEffect, useState } from "react";
import {
  getAllasIsmeret,
  getAllasNyelvtudas,
  getAllasTapasztalat,
  getAllasVegzettseg,
} from "../../contexts/AllasContext";

export default function AllasElvaras({ jobId }) {
  const allasId = jobId;
  //notEmpty:
  const [ismeretElvaras, setIsmeretElvaras] = useState([]);
  const [ismeretElony, setIsmeretElony] = useState([]);
  const [nyelvtudas, setNyelvtudas] = useState([]);
  const [vegzettseg, setVegzettseg] = useState([]);
  const [tapasztalat, setTapasztalat] = useState([]);

  //isEmpty:
  const [ismeretMsg, setIsmeretMsg] = useState("");
  const [nyelvtudasMsg, setNyelvtudasMsg] = useState("");
  const [vegzettsegMsg, setVegzettsegMsg] = useState("");
  const [tapasztalatMsg, setTapasztalatMsg] = useState("");

  useEffect(() => {
    getAllasIsmeret(allasId)
      .then((response) => {
        const elvarasok = response.data.filter(
          (item) => item.szint === "elvárás"
        );
        const elonyok = response.data.filter((item) => item.szint === "előny");

        setIsmeretElvaras(elvarasok);
        setIsmeretElony(elonyok);
        setIsmeretMsg("");
      })
      .catch((error) => {
        if (error?.response.status === 404) {
          console.log('message', error, error.response.data.message);
          setIsmeretMsg(error.response.data.message)
        }
      });
  }, []);

  useEffect(() => {
    getAllasNyelvtudas(allasId)
      .then((response) => {
        setNyelvtudas(response.data);
        setNyelvtudasMsg("");
      })
      .catch((error) => {
        if (error?.response.status === 404) {
          console.log('message', error, error.response.data.message);
          setNyelvtudasMsg(error.response.data.message)
        }
      });
  }, []);

  useEffect(() => {
    getAllasVegzettseg(allasId)
      .then((response) => {
        setVegzettseg(response.data.megnevezes);
        setVegzettsegMsg("");
      })
      .catch((error) => {
        if (error?.response.status === 404) {
          console.log('message', error, error.response.data.message);
          setVegzettsegMsg(error.response.data.message)
        }
      });
  }, []);

  useEffect(() => {
    getAllasTapasztalat(allasId)
      .then((response) => {
        setTapasztalat(response.data);
        setTapasztalatMsg("");
      })
      .catch((error) => {
        if (error?.response.status === 404) {
          console.log('message', error, error.response.data.message);
          setTapasztalatMsg(error.response.data.message)
        }
      });
  }, []);

  return (
    <>
      <div className="job-expectations">
        <div className="job-musthave">
          <h2>Elvárások a jelölttel szemben:</h2>
          <h4>Minimum végzettség:</h4>
          <ul>
          {!vegzettsegMsg ? (<li>{vegzettseg}</li>)
            : (<p>{vegzettsegMsg}</p>) }
          </ul>
          <h4>Elvárt munkatapasztalat:</h4>
          <ul>
            {!tapasztalatMsg ? tapasztalat.map((tapasztalat, index) => (
              <li key={index}>
                {tapasztalat.terulet} - {tapasztalat.pozicio} -{" "}
                {tapasztalat.leiras}
              </li>
            )): <p>{tapasztalatMsg} </p>}
          </ul>
          <h4>Szükséges nyelvtudás:</h4>
          <ul>
            {!nyelvtudasMsg ? nyelvtudas.map((nyelvtudas, index) => (
              <li key={index}>
                {nyelvtudas.nyelv} - {nyelvtudas.megnevezes}
              </li>
            )): <p>{nyelvtudasMsg} </p>}
          </ul>
          <h4>Képességek és szaktudás:</h4>
          <ul>
            {!ismeretMsg ? ismeretElvaras.map((ismeretElvaras, index) => (
              <li key={index}>{ismeretElvaras.megnevezes}</li>
            )): <p>{ismeretMsg} </p>}
          </ul>
        </div>
        {!ismeretElony.length ? null : (
          <div className="job-preference">
          <h2>A pozíció betöltésénél előnyt jelent:</h2>
          <ul>
            {ismeretElony.map((ismeretElony, index) => (
              <li key={index}>{ismeretElony.megnevezes}</li>
            ))}
          </ul>
          </div>
        )}
        
      </div>
    </>
  );
}
