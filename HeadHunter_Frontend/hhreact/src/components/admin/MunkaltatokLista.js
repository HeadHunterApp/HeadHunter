import React, { useState, useEffect } from 'react';
import axios from 'axios';
import "../../styles/Tables.css";

const MunkaltatokLista = () => {
  // Állapotok inicializálása
  const [munkaltatok, setMunkaltatok] = useState([]);
  const [ujMunkaltato, setUjMunkaltato] = useState({
    cegnev: '',
    szekhely: '',
    kapcsolattarto: '',
    telefonszam: '',
    email: ''
  });

  // Munkáltatók lekérdezése az API-ról
  useEffect(() => {
    const munkaltatokLekerdezese = async () => {
      try {
        const valasz = await axios.get('http://127.0.0.1:8000/api/munkaltatok/all');
        setMunkaltatok(valasz.data);
      } catch (error) {
        console.error('Hiba a munkáltatók lekérdezésekor:', error);
      }
    };

    munkaltatokLekerdezese();
  }, []);

  // Munkáltató törlése
  const munkaltatoTorlese = async (munkaltatoId) => {
    try {
      await axios.delete(`http://127.0.0.1:8000/api/munkaltatok/${munkaltatoId}`);
      // Törölt munkáltató eltávolítása az állapotból
      setMunkaltatok(munkaltatok.filter((m) => m.munkaltato_id !== munkaltatoId));
    } catch (error) {
      console.error('Hiba a munkáltató törlésekor:', error);
    }
  };

  // Új munkáltató adatainak frissítése változás esetén
  const adatokFrissitese = (esemeny) => {
    const { name, value } = esemeny.target;
    // Új munkáltató állapotának frissítése a változásokkal
    setUjMunkaltato({ ...ujMunkaltato, [name]: value });
  };

  // Új munkáltató felvétele
  const ujMunkaltatoFelvitele = async (esemeny) => {
    esemeny.preventDefault();
    try {
      // CSRF token lekérdezése a meta tag-ből
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      // Új munkáltató felvétele az API-ra CSRF token-nel
      const valasz = await axios.post(
        'http://127.0.0.1:8000/api/munkaltatok/munkaltato',
        ujMunkaltato,
        {
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
          },
        }
      );
      console.log('Valasz:', valasz.data);
      // Új munkáltató hozzáadása az állapothoz
      setMunkaltatok([...munkaltatok, valasz.data]);
      // Űrlap visszaállítása
      setUjMunkaltato({
        cegnev: '',
        szekhely: '',
        kapcsolattarto: '',
        telefonszam: '',
        email: ''
      });
    } catch (error) {
      console.error('Hiba az új munkáltató hozzáadásakor:', error);
    }
  };

  return (
    <div className="munkaltatok-container">
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
          {munkaltatok.map((m) => (
            <tr key={m.munkaltato_id}>
              <td>{m.cegnev}</td>
              <td>{m.szekhely}</td>
              <td>{m.kapcsolattarto}</td>
              <td>{m.telefonszam}</td>
              <td>{m.email}</td>
              <td>
                <button onClick={() => munkaltatoTorlese(m.munkaltato_id)}>Törlés</button>
                <button>Módosítás</button>
                <button>Új felvitele</button>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
      <form onSubmit={ujMunkaltatoFelvitele}>
        <h2>Új munkáltató felvitele</h2>
        <label htmlFor="cegnev">Cégnév:</label>
        <input type="text" id="cegnev" name="cegnev" value={ujMunkaltato.cegnev} onChange={adatokFrissitese} required />
        <label htmlFor="szekhely">Székhely:</label>
        <input type="text" id="szekhely" name="szekhely" value={ujMunkaltato.szekhely} onChange={adatokFrissitese} required />
        <label htmlFor="kapcsolattarto">Kapcsolattartó:</label>
        <input type="text" id="kapcsolattarto" name="kapcsolattarto" value={ujMunkaltato.kapcsolattarto} onChange={adatokFrissitese} required />
        <label htmlFor="telefonszam">Telefonszám:</label>
        <input type="tel" id="telefonszam" name="telefonszam" value={ujMunkaltato.telefonszam} onChange={adatokFrissitese} required />
        <label htmlFor="email">Email:</label>
        <input type="email" id="email" name="email" value={ujMunkaltato.email} onChange={adatokFrissitese} required />
        <button type="submit">Hozzáadás</button>
      </form>
    </div>
  );
};

export default MunkaltatokLista;
