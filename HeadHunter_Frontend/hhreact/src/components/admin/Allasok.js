import React, { useState, useEffect } from "react";
import axios from "../../api/axios";
import "../../styles/Tables.css";
import { getAllasAllRaw, postAllas, putAllas } from "../../contexts/AllasContext";
import { deleteAllas } from "../../contexts/AllasAdminContext";

const AllasokLista = () => {
  const [allasok, setAllasok] = useState([]);
  const [selectedAllas, setSelectedAllas] = useState(null);
  const [newAllas, setNewAllas] = useState({
    munkaltato: "",
    megnevezes: "",
    pozicio: "",
    statusz: "",
    leiras: "",
    fejvadasz: "",
  });
  const [lastClickedButton, setLastClickedButton] = useState(null);
  const [config, setConfig] = useState("");
  useEffect(() => {
      const fetchData = async () => {
        let token = "";
  
        await axios.get("/api/token").then((response) => {
          console.log(response);
          token = response.data;
        });
  
        console.log("------------TOKEN--------------");
        console.log(token);
  
        const config = {
          headers: {
            "X-CSRF-TOKEN": token,
          },
        };
        setConfig(config);
      };
  
      fetchData();
    }, []);
  useEffect(() => {
    const fetchAllasok = async () => {
      try {
        const response = await getAllasAllRaw();
        const sortedAllasok = response.data.sort((a, b) => a.allas_id - b.allas_id);
        setAllasok(sortedAllasok);
      } catch (error) {
        console.error("Hiba az állások lekérésekor:", error);
      }
    };

    fetchAllasok();
  }, []);

  const handleButtonClick = (buttonName, allas) => {
    setLastClickedButton(buttonName);
    if (buttonName === "Módosítás") {
      setSelectedAllas(allas);
    }
  };

  const handleDelete = async (allasId) => {
    try {
      console.log('handleDelete')
      await deleteAllas(allasId, config);
      setAllasok(allasok.filter((allas) => allas.allas_id !== allasId));
    } catch (error) {
      console.error("Hiba a törlés során:", error);
    }
  };

  const handleInputChange = (e) => {
    const { name, value } = e.target;
    if (selectedAllas) {
      setSelectedAllas({ ...selectedAllas, [name]: value });
    } else {
      setNewAllas({ ...newAllas, [name]: value });
    }
  };

  const handleNewAllasSubmit = async (e) => {
    e.preventDefault();
    try {
      await postAllas(newAllas, config); 
      setNewAllas({
        munkaltato: "",
        megnevezes: "",
        pozicio: "",
        statusz: "",
        leiras: "",
        fejvadasz: "",
      });
      setLastClickedButton(null);
      const response = await getAllasAllRaw(); // Vár a válaszra
      setAllasok(response.data); // Állások beállítása a válasz alapján
    } catch (error) {
      console.error("Hiba az új állás hozzáadásakor:", error);
    }
  };
  

  const handleUpdateAllasSubmit = async (e) => {
    e.preventDefault();
    try {
      // Ellenőrizze, hogy minden kötelező mező kitöltve van-e
      if (!selectedAllas.munkaltato || !selectedAllas.megnevezes || !selectedAllas.pozicio || !selectedAllas.statusz || !selectedAllas.leiras || !selectedAllas.fejvadasz) {
        console.error("Minden kötelező mezőt ki kell tölteni.");
        return;
      }
  
      await putAllas(selectedAllas.allas_id, selectedAllas, config);
      setSelectedAllas(null);
      setLastClickedButton(null);
      const response = await getAllasAllRaw();
      setAllasok(response.data);
    } catch (error) {
      console.error("Hiba az állás módosításakor:", error);
    }
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
      <h2>Állások listája</h2>

      <table className="munkaltatok-table">
        <thead>
          <tr>
            <th>Állás ID</th>
            <th>Munkáltató</th>
            <th>Megnevezés</th>
            <th>Pozíció</th>
            <th>Státusz</th>
            <th>Leírás</th>
            <th>Fejvadász</th>
            <th>Műveletek</th>
          </tr>
        </thead>
        <tbody>
          {allasok.map((allas) => (
            <tr key={allas.allas_id}>
              <td>{allas.allas_id}</td>
              <td>{allas.munkaltato || "-"}</td>
              <td>{allas.megnevezes}</td>
              <td>{allas.pozicio}</td>
              <td>{allas.statusz}</td>
              <td>{allas.leiras}</td>
              <td>{allas.fejvadasz || "-"}</td>
              <td>
                <button
                  className="action-button torles-button"
                  onClick={() => handleDelete(allas.allas_id)}
                >
                  Törlés
                </button>
                <button
                  className="action-button modositas-button"
                  onClick={() => handleButtonClick("Módosítás", allas)}
                >
                  Módosítás
                </button>
              </td>
            </tr>
          ))}
        </tbody>
      </table>

      {lastClickedButton === "Módosítás" && selectedAllas && (
        <div>
          <h3>Állás módosítása</h3>
          <form onSubmit={handleUpdateAllasSubmit}>
            <label htmlFor="munkaltato">Munkáltató:</label>
            <input
              type="text"
              id="munkaltato"
              name="munkaltato"
              value={selectedAllas.munkaltato}
              onChange={handleInputChange}
              required
            />
            <label htmlFor="fejvadasz">Fejvadász:</label>
            <input
              type="text"
              id="fejvadasz"
              name="fejvadasz"
              value={selectedAllas.fejvadasz}
              onChange={handleInputChange}
              required
            />
            <label htmlFor="megnevezes">Megnevezés:</label>
            <input
              type="text"
              id="megnevezes"
              name="megnevezes"
              value={selectedAllas.megnevezes}
              onChange={handleInputChange}
              required
            />
            <label htmlFor="pozicio">Pozíció:</label>
            <input
              type="text"
              id="pozicio"
              name="pozicio"
              value={selectedAllas.pozicio}
              onChange={handleInputChange}
              required
            />
            <label htmlFor="statusz">Státusz:</label>
            <input
              type="text"
              id="statusz"
              name="statusz"
              value={selectedAllas.statusz}
              onChange={handleInputChange}
              required
            />
            <label htmlFor="leiras">Leírás:</label>
            <textarea
              id="leiras"
              name="leiras"
              value={selectedAllas.leiras}
              onChange={handleInputChange}
              required
            />
            <button type="submit">Mentés</button>
          </form>
        </div>
      )}

      {lastClickedButton === "Új felvitele" && (
        <div>
          <h3>Új felvitele</h3>
          <form onSubmit={handleNewAllasSubmit}>
            <label htmlFor="munkaltato">Munkáltató:</label>
            <input
              type="text"
              id="munkaltato"
              name="munkaltato"
              value={newAllas.munkaltato}
              onChange={handleInputChange}
              required
            />
            <label htmlFor="fejvadasz">Fejvadász:</label>
            <input
              type="text"
              id="fejvadasz"
              name="fejvadasz"
              value={newAllas.fejvadasz}
              onChange={handleInputChange}
              required
            />
            <label htmlFor="megnevezes">Megnevezés:</label>
            <input
              type="text"
              id="megnevezes"
              name="megnevezes"
              value={newAllas.megnevezes}
              onChange={handleInputChange}
              required
            />
            <label htmlFor="pozicio">Pozíció:</label>
            <input
              type="text"
              id="pozicio"
              name="pozicio"
              value={newAllas.pozicio}
              onChange={handleInputChange}
              required
            />
            <label htmlFor="statusz">Státusz:</label>
            <input
              type="text"
              id="statusz"
              name="statusz"
              value={newAllas.statusz}
              onChange={handleInputChange}
              required
            />
            <label htmlFor="leiras">Leírás:</label>
            <textarea
              id="leiras"
              name="leiras"
              value={newAllas.leiras}
              onChange={handleInputChange}
              required
            />
            <button type="submit">Hozzáadás</button>
          </form>
        </div>
      )}
    </div>
  );
};

export default AllasokLista;
