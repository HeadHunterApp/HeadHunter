import React, { useState, useEffect } from "react";
import axios from "../../api/axios";
import "../../styles/Tables.css";
import {
  getMunkaltato,
  postMunkaltato,
  putMunkaltato,
  deleteMunkaltato,
} from "../../contexts/FotablaContext";

const MunkaltatokLista = () => {
  const [config, setConfig] = useState("");

  useEffect(() => {
    const fetchData = async () => {
      let token = "";
      await axios.get("/api/token").then((response) => {
        token = response.data;
      });
      const config = {
        headers: {
          "X-CSRF-TOKEN": token,
        },
      };
      setConfig(config);
    };
    fetchData();
  }, []);

  const [munkaltatok, setMunkaltatok] = useState([]);
  const [modositottMunkaltato, setModositottMunkaltato] = useState({
    cegnev: "",
    szekhely: "",
    kapcsolattarto: "",
    telefonszam: "",
    email: "",
    munkaltato_id: null,
  });

  const [lastClickedButton, setLastClickedButton] = useState(null);

  useEffect(() => {
    const munkaltatokLekerdezese = async () => {
      try {
        const valasz = await getMunkaltato();
        setMunkaltatok(valasz.data);
      } catch (error) {
        console.error("Hiba a munkáltatók lekérdezésekor:", error);
      }
    };
    munkaltatokLekerdezese();
  }, []);

  const frissitMunkaltatok = async () => {
    try {
      const valasz = await getMunkaltato();
      setMunkaltatok(valasz.data);
    } catch (error) {
      console.error("Hiba a munkáltatók frissítésekor:", error);
    }
  };

  const handleModositottMunkaltatoChange = (esemeny) => {
    const { name, value } = esemeny.target;
    setModositottMunkaltato({ ...modositottMunkaltato, [name]: value });
  };

  const handleMunkaltatoModositasClick = (munkaltato) => {
    setModositottMunkaltato({
      ...munkaltato,
      munkaltato_id: munkaltato.munkaltato_id,
    });
    setLastClickedButton("Módosítás");
  };

  const handleMunkaltatoModositas = async (esemeny, munkaltatoId) => {
    esemeny.preventDefault();
    try {
      const valasz = await putMunkaltato(
        munkaltatoId,
        modositottMunkaltato,
        config
      );
      await frissitMunkaltatok();
    } catch (error) {
      console.error("Hiba a munkáltató módosítása során:", error);
    }
  };

  const munkaltatoTorlese = async (munkaltatoId, config) => {
    try {
      await axios.delete(`/api/employers/delete/${munkaltatoId}`, config);
      await frissitMunkaltatok(); // Munkáltatók újra lekérése a frontend állapot frissítéséhez
      // Sikeres törlés esetén a helyi állapot frissítése vagy más teendők
    } catch (error) {
      console.error("Hiba a munkáltató törlésekor:", error);
    }
  };
  

  const adatokFrissitese = (esemeny) => {
    const { name, value } = esemeny.target;
    setModositottMunkaltato({ ...modositottMunkaltato, [name]: value });
  };

  const ujMunkaltatoFelvitele = async (esemeny) => {
    esemeny.preventDefault();
    try {
      const valasz = await postMunkaltato(modositottMunkaltato, config);
      await frissitMunkaltatok();
    } catch (error) {
      console.error("Hiba az új munkáltató hozzáadásakor:", error);
    }
  };

  const handleButtonClick = (buttonName) => {
    setLastClickedButton(buttonName);
  };

  return (
    <div className="munkaltatok-container">
      <div className="button-container">
        {lastClickedButton !== "Új felvitele" && (
          <button
            className="action-button uj-felvitele-button"
            onClick={() => handleButtonClick("Új felvitele")}
          >
            Új felvitele
          </button>
        )}
      </div>
      <h2>Munkáltatók listája</h2>

      <table className="munkaltatok-table">
        <thead>
          <tr>
            <th>Cégnév</th>
            <th>Székhely</th>
            <th>Kapcsolattartó</th>
            <th>Telefonszám</th>
            <th>Email</th>
            <th>Műveletek</th>
          </tr>
        </thead>
        <tbody>
          {munkaltatok.map((munkaltato) => (
            <tr key={munkaltato.munkaltato_id}>
              <td>{munkaltato.cegnev}</td>
              <td>{munkaltato.szekhely}</td>
              <td>{munkaltato.kapcsolattarto}</td>
              <td>{munkaltato.telefonszam}</td>
              <td>{munkaltato.email}</td>
              <td>
                <button
                  className="action-button torles-button"
                  onClick={() =>
                    munkaltatoTorlese(munkaltato.munkaltato_id, config)
                  }
                >
                  Törlés
                </button>

                <button
                  className="action-button modositas-button"
                  onClick={() => handleMunkaltatoModositasClick(munkaltato)}
                >
                  Módosítás
                </button>
              </td>
            </tr>
          ))}
        </tbody>
      </table>

      {lastClickedButton === "Módosítás" && (
        <div>
          <h3>Munkáltató módosítása</h3>
          <form
            onSubmit={(e) =>
              handleMunkaltatoModositas(e, modositottMunkaltato.munkaltato_id)
            }
          >
            <label htmlFor="cegnev">Cégnév:</label>
            <input
              type="text"
              id="cegnev"
              name="cegnev"
              value={modositottMunkaltato.cegnev}
              onChange={handleModositottMunkaltatoChange}
              required
            />
            <label htmlFor="szekhely">Székhely:</label>
            <input
              type="text"
              id="szekhely"
              name="szekhely"
              value={modositottMunkaltato.szekhely}
              onChange={handleModositottMunkaltatoChange}
              required
            />
            <label htmlFor="kapcsolattarto">Kapcsolattartó:</label>
            <input
              type="text"
              id="kapcsolattarto"
              name="kapcsolattarto"
              value={modositottMunkaltato.kapcsolattarto}
              onChange={handleModositottMunkaltatoChange}
              required
            />
            <label htmlFor="telefonszam">Telefonszám:</label>
            <input
              type="tel"
              id="telefonszam"
              name="telefonszam"
              value={modositottMunkaltato.telefonszam}
              onChange={handleModositottMunkaltatoChange}
              required
            />
            <label htmlFor="email">Email:</label>
            <input
              type="email"
              id="email"
              name="email"
              value={modositottMunkaltato.email}
              onChange={handleModositottMunkaltatoChange}
              required
            />
            <button className="action-button modositas-button" type="submit">
              Módosítás
            </button>
          </form>
        </div>
      )}

      {lastClickedButton === "Új felvitele" && (
        <div>
          <h3>Új felvitele</h3>
          <form onSubmit={ujMunkaltatoFelvitele}>
            <label htmlFor="cegnev">Cégnév:</label>
            <input
              type="text"
              id="cegnev"
              name="cegnev"
              value={modositottMunkaltato.cegnev}
              onChange={adatokFrissitese}
              required
            />
            <label htmlFor="szekhely">Székhely:</label>
            <input
              type="text"
              id="szekhely"
              name="szekhely"
              value={modositottMunkaltato.szekhely}
              onChange={adatokFrissitese}
              required
            />
            <label htmlFor="kapcsolattarto">Kapcsolattartó:</label>
            <input
              type="text"
              id="kapcsolattarto"
              name="kapcsolattarto"
              value={modositottMunkaltato.kapcsolattarto}
              onChange={adatokFrissitese}
              required
            />
            <label htmlFor="telefonszam">Telefonszám:</label>
            <input
              type="tel"
              id="telefonszam"
              name="telefonszam"
              value={modositottMunkaltato.telefonszam}
              onChange={adatokFrissitese}
              required
            />
            <label htmlFor="email">Email:</label>
            <input
              type="email"
              id="email"
              name="email"
              value={modositottMunkaltato.email}
              onChange={adatokFrissitese}
              required
            />
            <button type="submit">Hozzáadás</button>
          </form>
        </div>
      )}
    </div>
  );
};

export default MunkaltatokLista;
