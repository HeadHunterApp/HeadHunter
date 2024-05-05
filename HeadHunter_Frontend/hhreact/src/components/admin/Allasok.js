import React, { useState, useEffect } from "react";
import axios from "axios";
import "../../styles/Tables.css";

const AllasokLista = () => {
  const [allasok, setAllasok] = useState([]);
  const [lastClickedButton, setLastClickedButton] = useState(null); // Új állapot létrehozása a legutóbbi kattintott gomb tárolására

  useEffect(() => {
    const fetchAllasok = async () => {
      try {
        const response = await axios.get(
          "http://localhost:8000/api/jobs-basic/all"
        );
        setAllasok(response.data);
      } catch (error) {
        console.error("Hiba az állások lekérésekor:", error);
      }
    };

    fetchAllasok();
  }, []);

  // Gombkattintás kezelése
  const handleButtonClick = (buttonName) => {
    setLastClickedButton(buttonName);
  };

  // Állás törlése
  const handleDelete = async (allasId) => {
    try {
      await axios.delete(`http://localhost:8000/jobs/delete/${allasId}`);
      setAllasok(allasok.filter((allas) => allas.allas_id !== allasId));
    } catch (error) {
      console.error("Hiba a törlés során:", error);
    }
  };

  return (
    <div className="munkaltatok-container">
      <div className="button-container">
        {lastClickedButton !== "Új felvitele" && ( // Új felvitele gomb csak akkor jelenik meg, ha nem volt rá kattintva
          <button
            className="action-button uj-felvitele-button"
            onClick={() => handleButtonClick("Új felvitele")}
          >
            Új felvitele
          </button>
        )}
      </div>
      <h2>Állások listája</h2>

      <table className="munkaltatok-table">
        <thead>
          <tr>
            <th>Állás ID</th>
            <th>Cégnév</th>
            <th>Megnevezés</th>
            <th>Leírás</th>
            <th>Státusz</th>
            <th>Műveletek</th>
          </tr>
        </thead>
        <tbody>
          {allasok.map((allas) => (
            <tr key={allas.allas_id}>
              <td>{allas.allas_id}</td>
              <td>{allas.cegnev}</td>
              <td>{allas.megnevezes}</td>
              <td>
                {allas.leiras.split("\n").map((line, index) => (
                  <div key={index}>{line}</div>
                ))}
              </td>
              <td>{allas.statusz}</td>
              <td>
                <button
                  className="action-button torles-button"
                  onClick={() => handleDelete(allas.allas_id)}
                >
                  Törlés
                </button>
                <button
                  className="action-button modositas-button"
                  onClick={() => handleButtonClick("Módosítás")}
                >
                  Módosítás
                </button>
                {/* Módosítás gomb kattintása */}
              </td>
            </tr>
          ))}
        </tbody>
      </table>

      {/* Tartalom megjelenítése a gombkattintás alapján */}
      {lastClickedButton === "Módosítás" && (
        <div>
          <h3>Állás módosítása</h3>
          {/* Itt jelenítsd meg az állás módosítása űrlapot */}
        </div>
      )}

      {lastClickedButton === "Új felvitele" && (
        <div>
          {/* Új felvitele űrlap */}
          <h3>Új felvitele</h3>
          {/* Itt jelenítsd meg az új felvitele űrlapot */}
        </div>
      )}
    </div>
  );
};

export default AllasokLista;
