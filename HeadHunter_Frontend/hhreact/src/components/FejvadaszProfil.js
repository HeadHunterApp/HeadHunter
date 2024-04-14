import React, { useEffect, useState } from "react";
import {getProfilFejvadasz, postFotoFeltolt} from '../api/profil';

const FejvadaszProfil = ({ user, onSubmit }) => {
    const [nev, setNev] = useState(user.nev);
    const [email, setEmail] = useState(user.email);
    const [telefonszam, setTelefonszam] = useState(user.telefonszam)
    //const [foto, setFoto] = useState(user.fenykep);
    const [terulet, setTerulet] = useState("");
    
    useEffect(()=>{
      getProfilFejvadasz().then((response)=>{
        setTerulet(response.terulet_nev) //backendben is így kerüljön elnevezésre
      })
    },[])
  
  
    const handleSubmit = (e) => {
      e.preventDefault();
      
      onSubmit({ nev, email, terulet});
    };

    const fenykepFeltoltes = (event) =>{
      event.preventDefault();
      const fajl = event.target.files[0];
      let FormData = new FormData();
      FormData.append(fajl.name, fajl)
      postFotoFeltolt(FormData);//megfelelő routot meg kell adni(írni)!!!
    }
  
    return (
      <form onSubmit={handleSubmit}>
        <div>
          <label htmlFor="nev">Név:</label>
          <input
            type="text"
            id="nev"
            value={nev}
            onChange={(e) => setNev(e.target.value)}
          />
        </div>
        <div>
          <label htmlFor="email">E-mail:</label>
          <input
            type="email"
            id="email"
            value={email}
            onChange={(e) => setEmail(e.target.value)}
          />
        </div>
        <div>
          <label htmlFor="telefonszam">Telefonszám:</label>
          <input
            type="text"
            id="telefonszam"
            value={telefonszam}
            onChange={(e) => setTelefonszam(e.target.value)}
          />
        </div>
        <div>
          <label htmlFor="fenykep">Fénykép:</label>
          <input
            type="file"
            id="fenykep"
            onChange={fenykepFeltoltes}
          />
        </div>
        <div>
          <label htmlFor="terulet">Terület:</label>
          <input
            type="text"
            id="terulet"
            value={terulet}
            onChange={(e) => setTerulet(e.target.value)}
          />
        </div>
        <button type="submit">Mentés</button>
      </form>
    );
  };
  
  export default FejvadaszProfil;