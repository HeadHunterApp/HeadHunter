import React, { useEffect, useState } from "react";
import {getProfilFejvadasz, postFotoFeltolt, putProfilFejvadász} from '../api/profil';

const FejvadaszProfil = ({ user, onSubmit }) => {
    const [name, setName] = useState(user.name);
    const [email, setEmail] = useState(user.email);
    const [telefonszam, setTelefonszam] = useState(user.telefonszam)
    //const [foto, setFoto] = useState(user.fenykep);
    const [terulet, setTerulet] = useState("");
    
    useEffect(()=>{
      getProfilFejvadasz().then((response)=>{
        setName(response.name);
        setEmail(response.email);
        setTelefonszam(response.telefonszam);
        setTerulet(response.terulet_nev); //backendben is így kerüljön elnevezésre
      })
    },[])

    useEffect(()=>{
      putProfilFejvadász().then((response)=>{
        setName(response.name);
        setEmail(response.email);
        setTelefonszam(response.telefonszam)
        setTerulet(response.terulet_nev);
      })
    })
  
  
    const handleSubmit = (e) => {
      e.preventDefault();
      
      onSubmit({ name, email, terulet});
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
          <label htmlFor="name">Név:</label>
          <input
            type="text"
            id="name"
            value={name}
            onChange={(e) => setName(e.target.value)}
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