import React, { useState } from "react";
import "../styles/Regisztral.css";

const Regisztral = () => {
  const [formData, setFormData] = useState({
    nev: "",
    email: "",
    jelszo: "",
    nem: "",
    szul_ido: "",
    telefonszam: "",
    fax: "",
    allampolgarsag: "magyar",
    jogositvany: false,
    szoc_keszseg: "",
  });

  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setFormData({
      ...formData,
      [name]: value,
    });
  };

  const handleCheckboxChange = (e) => {
    const { name, checked } = e.target;
    setFormData({
      ...formData,
      [name]: checked,
    });
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    console.log(formData);
  };

  return (
    <div >
      <header className="header">
        <h1>Regisztrácó </h1>
      </header>
      <form onSubmit={handleSubmit} className="registration-form">
        <div className="form-group">
          <label>teljes név:</label>
          <input
            type="text"
            name="nev"
            value={formData.nev}
            onChange={handleInputChange}
          />
        </div>
        <div className="form-group">
        <label>
        <input
          type="radio"
          value="ferfi"
          checked={formData.nem === "ferfi"}
          onChange={handleInputChange}
        />
        Férfi
      </label>

      <label>
        <input
          type="radio"
          value="nő"
          checked={formData.nem === "nő"}
          onChange={handleInputChange}
        />
        Nő
      </label>
      </div>
        <div className="form-group">
          <label>email cím:</label>
          <input
            type="text"
            name="email"
            value={formData.email}
            onChange={handleInputChange}
          />
        </div>
        <div className="form-group">
          <label>jelszó:</label>
          <input
            type="password"
            name="jelszo"
            value={formData.jelszo}
            onChange={handleInputChange}

            
          />
        </div>
        <div className="form-group">
          <label>születési Dátum:</label>
          <input
            type="date"
            name="szul_ido"
            value={formData.szul_ido}
            onChange={handleInputChange}
          />
        </div>
        <div className="form-group">
          <label>telefon szám:</label>
          <input
            type="text"
            name="telefonszam"
            value={formData.telefonszam}
            onChange={handleInputChange}
          />
        </div>
        <div className="form-group">
          <label>fax:</label>
          <input
            type="text"
            name="fax"
            value={formData.fax}
            onChange={handleInputChange}
          />
        </div>
        <div className="form-group">
          <label>állampolgárság:</label>
          <input
            type="text"
            name="allampolgarsag"
            value={formData.allampolgarsag}
            onChange={handleInputChange}
          />
        </div>
        <div className="form-group">
          <label>jogosítvány:</label>
          <input
            type="checkbox"
            name="jogositvany"
            checked={formData.jogositvany}
            onChange={handleCheckboxChange}
          />
        </div>
        <div className="form-group">
          <label>nyelvtudás:</label>
          <select
            name="nyelvtudas"
            value={formData.nyelvtudas}
            onChange={handleInputChange}
          >
            <option value="">-- Válasszon --</option>
            <option value="kezdo">Kezdő</option>
            <option value="kozep">Középhaladó</option>
            <option value="halado">Haladó</option>
          </select>
        </div>
        <div className="form-group">
          <button type="submit">elküld</button>
        </div>
      </form>
    </div>
  );
};

export default Regisztral;
