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
        /* telefonszam: "",
        fax: "",
        allampolgarsag: "magyar",
        jogositvany: false,
        szoc_keszseg: "", 
        cim:"", */
      });
    
      const {loginReg, errors} = useAuthContext();
      const handleInputChange = (e) => {
        const { name, value } = e.target;
        setFormData({
          ...formData,
          [name]: value,
        });
      };
    
      /*
      const handleCheckboxChange = (e) => {
        const { name, checked } = e.target;
        setFormData({
          ...formData,
          [name]: checked,
        });
      };
      */
    
      const handleSubmit = (e) => {
        e.preventDefault();
        console.log(formData);
        loginReg(formData, "/register");

        onClose();
      };
    

  return (
    <div className="regisztral" >
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
            {errors.nev && (
              <span className="text-danger">{errors.nev[0]}</span>
            )}
          </div>
        </div>
{/* regisztrációnál ez nem kell, ez az álláskereső profil szerkesztésbe kell majd, 
      akár rögtön irányíthatná oda a felhasználót a regisztrációt követően,
      mert korábban abban maradtunk, hogy csak usert rögzítsünk az egyszerűség kedvéért, személyes adatokat regisztráció után adja meg

         <div className="form-group">
         <p className="pnem">Neme:</p>
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
        
*/}

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
            name="password_confirmation"
            value={formData.password_confirmation}
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


        {/* <div className="form-group">
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
        </div> */}
 
        <button type="submit" className="">
          Regisztrálok
        </button>
      </form>
    </div>
  );
}
