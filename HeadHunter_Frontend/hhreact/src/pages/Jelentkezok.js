import React, { useEffect, useState } from "react";
import useAuthContext from "../contexts/AuthContext";
import axios from "../api/axios";
import VisszaLink from "../components/menu/VisszaLink";
import { getAllasJelentkezoAll, putAllasJelentkezo } from "../contexts/AllasContext";
import JelentkezoSor from "../components/allas/JelentkezoSor";
import "../styles/Jelentkezok.css";

export default function Jelentkezok() {
    const { user, isAdmin, isHeadhunter } = useAuthContext();
    const [config, setConfig] = useState("");
    const [jelentkezesAll, setJelentkezesAll] = useState([]);
  
//token lekérés:
  useEffect(() => {
    const fetchData = async () => {
      let token = "";

      await axios.get("/api/token").then((response) => {
        console.log(response);
        token = response.data;
      });

      console.log("------------TOKEN--------------");
      console.log(token);

      const config = {
        headers: {
          "X-CSRF-TOKEN": token,
        },
      };
      setConfig(config);
    };

    fetchData();
  }, []);

//adatok betöltése:
  useEffect(() => {
    fetchJelentkezesek();
  }, []);

 //adatok lekérése az adatbázisból:
  const fetchJelentkezesek = async () => {
    try {
      const response = await getAllasJelentkezoAll(config);
      const osszesJelentkezes = response.data;
      setJelentkezesAll(osszesJelentkezes);
    } catch (error) {
      console.error('Jelentkezők betöltése sikertelen! Hiba:', error);
    }
  };

  //státuszmódosítás kezelése:
  const handleStatMod = async(allas, allaskereso, ujStat) => {
    const allas_id=allas;
    const user_id=allaskereso;
    const statusz=ujStat;
    try {
        console.log("allas_id:");
        console.log(allas_id);
        console.log("allaskereso user_id:");
        console.log(user_id);
        console.log("uj statusz:");
        console.log(statusz);
        await putAllasJelentkezo(allas_id, user_id, statusz, config);
        alert("Sikeres státuszmódosítás!");
    } catch (error) {
        console.error(error);
        alert("Hiba történt a státuszmódosítás során!");
    };
  };


    return (
      <>
        <div className="application-container">
          {jelentkezesAll.map((jel)=>
            <JelentkezoSor 
                key={jel.allas + '_' + jel.allaskereso} 
                allas={jel.allas} 
                cegnev={jel.cegnev}
                megnevezes={jel.megnevezes} 
                terulet={jel.terulet}
                pozicio={jel.pozicio} 
                allaskereso={jel.allaskereso} 
                nev={jel.nev} 
                statusz={jel.statusz}
                jelentkezes={jel.jelentkezes}
                frissites={jel.frissites}
                statValtas={handleStatMod}
                />
          )}
          <VisszaLink />
        </div>
      </>
    );
  }
  