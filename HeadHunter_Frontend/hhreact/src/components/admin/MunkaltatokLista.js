import React, { useState, useEffect } from "react";
import axios from "axios";
import "../../styles/Tables.css";

const MunkaltatokLista = () => {
  const [munkaltatok, setMunkaltatok] = useState([]);
  const [modositottMunkaltato, setModositottMunkaltato] = useState({
    cegnev: "",
    szekhely: "",
    kapcsolattarto: "",
    telefonszam: "",
    email: "",
    munkaltato_id: null, // Hozzáadva: az aktuális munkáltató azonosítójának tárolása
  });
  const [lastClickedButton, setLastClickedButton] = useState(null);

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
      // CSRF token lekérése a dokumentumból
      const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
  
      // Munkáltató módosítása, CSRF tokennal ellátva
      const valasz = await axios.put(
        `http://127.0.0.1:8000/api/munkaltatok/${munkaltatoId}`,
        modositottMunkaltato,
        {
          headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken, // CSRF token hozzáadása a kérés fejlécéhez
          },
        }
      );
  
      // Módosított munkáltató frissítése a helyi állapothoz
      const modositottIndex = munkaltatok.findIndex(
        (m) => m.munkaltato_id === munkaltatoId
      );
      const ujMunkaltatok = [...munkaltatok];
      ujMunkaltatok[modositottIndex] = valasz.data;
      setMunkaltatok(ujMunkaltatok);
  
      // Az űrlap mezőinek visszaállítása
      setModositottMunkaltato({
        cegnev: "",
        szekhely: "",
        kapcsolattarto: "",
        telefonszam: "",
        email: "",
        munkaltato_id: null,
      });
      setLastClickedButton(null); // Utolsó gomb visszaállítása null-ra
    } catch (error) {
      console.error("Hiba a munkáltató módosítása során:", error);
    }
  };
  

  useEffect(() => {
    const munkaltatokLekerdezese = async () => {
      try {
        const valasz = await axios.get(
          "http://127.0.0.1:8000/api/munkaltatok/all"
        );
        setMunkaltatok(valasz.data);
      } catch (error) {
        console.error("Hiba a munkáltatók lekérdezésekor:", error);
      }
    };

    munkaltatokLekerdezese();
  }, []);

  const munkaltatoTorlese = async (munkaltatoId) => {
    try {
      await axios.delete(
        `http://127.0.0.1:8000/api/munkaltatok/${munkaltatoId}`
      );
      setMunkaltatok(
        munkaltatok.filter((m) => m.munkaltato_id !== munkaltatoId)
      );
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
      // CSRF token lekérése a dokumentumból
      const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
  
      // Új munkáltató hozzáadása, CSRF tokennal ellátva
      const valasz = await axios.post(
        "http://127.0.0.1:8000/api/munkaltatok/munkaltato",
        modositottMunkaltato,
        {
          headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken, // CSRF token hozzáadása a kérés fejlécéhez
          },
        }
      );
  
      // Új munkáltató hozzáadása a helyi állapothoz
      setMunkaltatok([...munkaltatok, valasz.data]);
  
      // Az űrlap mezőinek visszaállítása
      setModositottMunkaltato({
        cegnev: "",
        szekhely: "",
        kapcsolattarto: "",
        telefonszam: "",
        email: "",
      });
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
                  onClick={() => munkaltatoTorlese(munkaltato.munkaltato_id)}
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
            <button
              className="action-button modositas-button"
              type="submit"
            >
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
