import React, { useEffect, useState } from "react";
import { getPozicio } from "../../contexts/FotablaContext";

const Poziciok = () => {
    const [poziciosList, setPoziciosList] = useState([]);

    useEffect(() => {
      getPozicio().then(response => {
          setPoziciosList(response.data); 
        })
        .catch(error => {
          console.error('Hiba történt:', error);
        });
    }, []);
  
    return (
      <div>
        <h1>Poziciók:</h1>
        <ul style={{listStyleType: "none"}}>
          {poziciosList.map(pozicio => (
            <li  key={pozicio.pozkod}>
            {pozicio.pozkod} - {pozicio.terulet.megnevezes} - {pozicio.pozicio}
          </li>
          ))}
        </ul>
      </div>
    );
  }

  export default Poziciok;