import React, { useState } from "react";
import '../../styles/Regisztracio.css';
import useAuthContext from "../../contexts/AuthContext";

export default function Regisztracio({onClose}) {
    const [formData, setFormData] = useState({
        nev: "",
        email: "",
        password: "",
        password_confirmation: "",
        nem: "",
        szul_ido: '2005-01-01',
        cim:""
        /* telefonszam: "",
        fax: "",
        allampolgarsag: "magyar",
        jogositvany: false,
        szoc_keszseg: "", 
        , */
      });
    
      const {loginReg, errors} = useAuthContext();
      const [error, setError] = useState(null);

      const handleInputChange = (e) => {
        const { name, value } = e.target;
        setFormData({
          ...formData,
          [name]: value,
        });
      };
    
      const handleSubmit = async (e) => {
        e.preventDefault();

        // Ellenőrizd, hogy a jelszó mezők egyeznek-e
        if (formData.password !== formData.password_confirmation) {
          setError('A jelszavak nem egyeznek meg!');
          return;
        }

        // Ellenőrizd, hogy van-e üres mező
        for (const key in formData) {
          if (formData.hasOwnProperty(key) && formData[key] === "") {
            setError('Minden mező kitöltése kötelező!');
            return;
          }
        }

        console.log(formData);
        loginReg(formData, "/register");

        onClose();
      };
    

  return (
    <div className="regisztral" >
      <h1 className="regisztracio">Regisztráció</h1>
      <form onSubmit={handleSubmit}>
        {error && ( // Megjeleníti az error üzenetet, ha az állapotban van hiba
          <div className="text-danger">{error}</div>
        )}
        <div className="form-group">
        <label>Név:</label>
          <input
            type="text"
            name="nev"
            value={formData.nev}
            onChange={handleInputChange}
          />
        </div>

         <div className="form-group">
         <p className="pnem">Neme:</p>
          <div className="nem">
          
            <label className="nem-label1"> Férfi</label>
            <input 
              type="radio"
              value="férfi"
              checked={formData.nem === "férfi"}
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
        <label>Születési idő:</label>
          <input
            type="date"
            name="szul_ido"
            value={formData.szul_ido}
            onChange={handleInputChange}
          />
        </div>
        <div className="form-group">
        <label>Lakcím:</label>
          <input
            type="text"
            name="cim"
            value={formData.cim}
            onChange={handleInputChange}
          />
        </div>

        <div className="form-group">
        
          <label>E-mail:</label>
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
            name="password"
            value={formData.password}
            onChange={handleInputChange}
          />
        </div>
        <div className="form-group">
          <label >
            Jelszó újra:
          </label>
          <input
            type="password"
            name="password_confirmation"
            value={formData.password_confirmation}
            onChange={handleInputChange}
          />
        </div>
 
        <button type="submit" className="">
          Regisztrálok
        </button>
      </form>
    </div>
  );
}