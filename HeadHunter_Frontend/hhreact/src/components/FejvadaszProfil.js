import React, { useEffect, useState } from "react";
import {getProfilFejvadasz, postFotoFeltolt, putProfilFejvadász} from '../api/profil';
import axios from "../api/axios";
import { getTerulet } from "../api/terulet";
import Select from "react-select";

const FejvadaszProfil = ({ onSubmit }) => {
    const [nev, setNev] = useState("");
    const [email, setEmail] = useState("");
    const [telefonszam, setTelefonszam] = useState("")
    //const [foto, setFoto] = useState(user.fenykep);
    const [terulet, setTerulet] = useState([]);
    const [selectedTerulet, setselectedTerulet] = useState([]);

    useEffect(()=>{
      getProfilFejvadasz().then((response)=>{
        setNev(response.data.nev);
        setEmail(response.data.email);
        setTelefonszam(response.data.telefonszam);
        setselectedTerulet(response.data.teruletek.map((terulet)=>{
          return {
            value: terulet.terulet_id,
            label: terulet.megnevezes
          }
        })); 
      })
    },[])

  useEffect(()=>{
    getTerulet().then((response)=>{
      const teruletoptions = response.data.map((teret)=>{
        return{
          value:teret.terulet_id,
          label:teret.megnevezes,
        }
      })
      setTerulet(teruletoptions);
    })
  }, []);
  
    const handleSubmit = async(e) => {
      e.preventDefault();
      let token = "";

      await axios.get("/api/token").then((response) => {
        console.log(response);
        token = response.data;
      });

      console.log(token);
      
      const config = {
        headers: {
          'X-CSRF-TOKEN': token
      } };

      console.log(config);

      putProfilFejvadász({nev, email, telefonszam, selectedTerulet}, config).then((response)=>{
        if(response.status === '200'){
          alert('Módosítás sikersen megtörtént!');
        }
      })
    };

    const fenykepFeltoltes = (event) =>{
      event.preventDefault();
      const fajl = event.target.files[0];
      let FormData = new FormData();
      FormData.append(fajl.name, fajl)
      postFotoFeltolt(FormData);//megfelelő routot meg kell adni(írni)!!!
    }
  
    return (
      <form className="allprofil" onSubmit={handleSubmit}>
      
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
          <Select className="react-select" isMulti options={terulet} value={selectedTerulet} onChange={setselectedTerulet}/>
        </div>
        <button className="mentes" type="submit">Mentés</button>
      </form>
    );
  };
  
  export default FejvadaszProfil;