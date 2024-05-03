import React, { useEffect, useState } from "react";
import {getProfilFejvadasz, 
        postFotoFeltolt, 
        putProfilFejvadász,
        } from '../../../contexts/ProfilContext';
import axios from "../../../api/axios";
import { getTerulet } from "../../../contexts/FotablaContext";
import Select from "react-select";


const FejvadaszProfil = ({ onSubmit }) => {
    const [nev, setNev] = useState("");
    const [email, setEmail] = useState("");
    const [telefonszam, setTelefonszam] = useState("");
    const [terulet, setTerulet] = useState([]);
    const [selectedTerulet, setselectedTerulet] = useState([]);
    const [imageSrc, setImageSrc] = useState(null);
    

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
        if(response.data.fenykep){
          const decodedImage = 'data:image/png;base64,' + response.data.fenykep;
          setImageSrc(decodedImage);
        }

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

    const fenykepFeltoltes = async(event) =>{
      event.preventDefault();

      const fajl = event.target.files[0];
      
      setImageSrc(URL.createObjectURL(fajl));

      let formData = new FormData();
      formData.append('image', fajl)

      let token = "";
      await axios.get("/api/token").then((response) => {
        console.log(response);
        token = response.data;
      });

      //const Buffer = require("buffer").Buffer;
      //let base64Img = new Buffer(fajl).toString("base64");
      //let base64Img = Buffer.from(fajl).toString('base64');

      //let base64Img = base64.encode(fajl);

      postFotoFeltolt(formData, token);
     
    }
  
    return (
      <>

      <form className="allprofil" onSubmit={handleSubmit}>
      <div>
        <label htmlFor="fenykep">Fénykép:</label>
        <div style={{ display: "flex" }}>
          {imageSrc && <img className="photo" src={imageSrc} />}
          <div>
            <input type="file" id="fenykep" onChange={fenykepFeltoltes} />
          </div>
        </div>
      </div>
        <div>
          <label htmlFor="nev">Név:</label>
          <input
            type="text"
            id="nev"
            value={nev}
            placeholder="Vezeték/Keresztnév"
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
 
        <div className="area">
          <label htmlFor="terulet">Terület:</label>
          <Select className="react-select" 
                  isMulti options={terulet} 
                  value={selectedTerulet} 
                  onChange={setselectedTerulet}
                  maxMenuHeight={100}
                  />
        </div>
        <button className="mentes" type="submit">Mentés</button>
      </form>
      </>
    );
  };
  
  export default FejvadaszProfil;