import React, { useState } from "react";
import useAuthContext from "../contexts/AuthContext";
import '../styles/components/Regisztral.css';

export default function Regisztracio() {
    const [formData, setFormData] = useState({
        nev: "",
        email: "",
        jelszo: "",
        jelszo2: "",
        nem: "",
        szul_ido: "",
        telefonszam: "",
        fax: "",
        allampolgarsag: "magyar",
        jogositvany: false,
        szoc_keszseg: "",
      });
    
      const {loginReg, errors} = useAuthContext();
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
        loginReg(formData, "/guest/jobseekers/new");
      };
    

  return (
    <div className="registal" >
      <h1 className="regisztracio">Regisztráció</h1>
      <form onSubmit={handleSubmit}>
        <div className="form-group">
        <label>Név:</label>
          <input
            type="text"
            name="nev"
            value={formData.nev}
            onChange={handleInputChange}
          />
          <div>
            {errors.name && (
              <span className="text-danger">{errors.name[0]}</span>
            )}
          </div>
        </div>
         <div className="form-group">
          <div className="nem">
            <label className="nem-label1"> Férfi</label>
            <input 
              type="radio"
              value="ferfi"
              checked={formData.nem === "ferfi"}
              name="nem"
              onChange={handleInputChange}
            />
          </div>
          <div className="nem">
            <label className="nem-label">Nő</label>
            <input
              type="radio"
              value="nő"
              checked={formData.nem === "nő"}
              name="nem"
              onChange={handleInputChange}
            />
          </div>
        </div>
        <div className="form-group">
          <label>Email:</label>
          <input
            type="text"
            name="email"
            value={formData.email}
            onChange={handleInputChange}
          />
         
          <div>
            {errors.email && (
              <span className="text-danger">{errors.email[0]}</span>
            )}
          </div>
        </div>
        <div className="form-group">
        <label>Jelszó:</label>
          <input
            type="password"
            name="jelszo"
            value={formData.jelszo}
            onChange={handleInputChange}
          />
          <div>
            {errors.password && (
              <span className="text-danger">{errors.password[0]}</span>
            )}
          </div>
        </div>
        <div className="form-group">
          <label >
            Jelszó újra:
          </label>
          <input
            type="password"
            name="jelszo2"
            value={formData.jelszo2}
            onChange={handleInputChange}
          />
          <div>
            {errors.password_confirmation && (
              <span className="text-danger">
                {errors.password_confirmation[0]}
              </span>
            )}
          </div>
        </div>
        <div className="form-group">
        <label>Születési idő:</label>
          <input
            type="date"
            name="szul_ido"
            value={formData.szul_ido}
            onChange={handleInputChange}
          />
        </div>
        <div className="form-group">
        <label>Telefon szám:</label>
          <input
            type="text"
            name="telefonszam"
            value={formData.telefonszam}
            onChange={handleInputChange}
          />
        </div>
        <div className="form-group">
        <label>Fax:</label>
          <input
            type="text"
            name="fax"
            value={formData.fax}
            onChange={handleInputChange}
          />
        </div>
        <div className="form-group">
        <label>Állampolgárság:</label>
          <input
            type="text"
            name="allampolgarsag"
            value={formData.allampolgarsag}
            onChange={handleInputChange}
          />
        </div>
        <div className="form-group">
        <label>Jogosítvány:</label>
          <input
            type="checkbox"
            name="jogositvany"
            checked={formData.jogositvany}
            onChange={handleCheckboxChange}
          />
        </div>
        <div className="form-group">
          <label>Szociális készség:</label>
          <input
            type="text"
            name="szoc_keszseg"
            checked={formData.szocKeszseg}
            onChange={handleCheckboxChange}
          />
        </div>

        <button type="submit" className="">
          Regisztrálok
        </button>
      </form>
    </div>
  );
}
