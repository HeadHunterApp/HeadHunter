import React, { useEffect, useState } from "react";
import {
  getAllaskeresoNyelvtudas,
  getAllaskeresoTanulmany,
  getAllaskeresoTapasztalat,
} from "../../../api/profil";
import axios from "../../../api/axios";
import "../../../styles/profil.css";
import SzakmaiTapasztalat from "./components/SzakmaiTapasztalat";
import Nyelvismeret from "./components/Nyelvismeret";
import OktatasKepzes from "./components/OktatasKepzes";
import SzemelyesAdatok from "./components/SzemelyesAdatok";
import { getAllaskeresoTeruletek } from "../../../api/terulet";
import { getAllaskeresoPoziciok } from "../../../api/pozicio";
import { getAllaskeresoVegzettsegek } from "../../../api/vegzettseg";
import { getAllaskeresoNyelvek } from "../../../api/nyelv";

const AllaskeresoProfil = ({ onSubmit }) => {
  const [token, setToken] = useState("");

  const [szakmaiTapasztalat, setSzakmaiTapasztalat] = useState([]);
  const [nyelvTudas, setNyelvTudas] = useState([]);
  const [tanulmany, setTanulmany] = useState([]);
  const [teruletek, setTeruletek] = useState([]);
  const [poziciok, setPoziciok] = useState([]);
  const [vegzettsegek, setVegzettsegek] = useState([]);
  const [nyelvek, setNyelvek] = useState([]);


  useEffect(()=>{
    getAllaskeresoTeruletek().then((response)=>{
      const teruletoptions = response.data.map((teret)=>{
        return{
          value:teret.terulet_id,
          label:teret.megnevezes,
        }
      })
      setTeruletek(teruletoptions);
    })
  }, []);

  useEffect(()=>{
    getAllaskeresoPoziciok().then((response)=>{
      const poziciooptions = response.data.map((poz)=>{
        return{
          value:poz.pozkod,
          label:poz.pozicio,
        }
      })
      setPoziciok(poziciooptions);
    })
  }, []);

  useEffect(()=>{
    getAllaskeresoVegzettsegek().then((response)=>{
      const vegzettsegoptions = response.data.map((veg)=>{
        return{
          value:veg.vegzettseg_id,
          label:veg.megnevezes,
        }
      })
      setVegzettsegek(vegzettsegoptions);
    })
  }, []);

  useEffect(()=>{
    getAllaskeresoNyelvek().then((response)=>{
      const nyelvoptions = response.data.map((nyelv)=>{
        return{
          value:nyelv.nyelvkod,
          label:nyelv.nyelv + " - " + nyelv.szint,
        }
      })
      setNyelvek(nyelvoptions);
    })
  }, []);

  useEffect(() => {
    const fetchData = async () => {
      try {
        getAllaskeresoNyelvtudas().then((response) => {
          setNyelvTudas(response.data);
        });
      } catch (error) {
        console.log(error);
      }
      
      let token = "";

      await axios.get("/api/token").then((response) => {
        console.log(response);
        token = response.data;
      });

      console.log('------------TOKEN--------------')
      console.log(token);
  
      const config = {
        headers: {
          "X-CSRF-TOKEN": token,
        },
      };

      setToken(config);
    };

    fetchData();
  }, []);

  useEffect(() => {
    try {
      getAllaskeresoTanulmany().then((response) => {
        setTanulmany(response.data);
      });
    } catch (error) {
      console.log(error);
    }
  }, []);

  useEffect(() => {
    try {
      getAllaskeresoTapasztalat().then((response) => {
        setSzakmaiTapasztalat(response.data);
      });
    } catch (error) {
      console.log(error);
    }
  }, []);

  const onGenerealas = () => {};

  const szakmaiTapHozzaadas = () => {
    setSzakmaiTapasztalat([
      ...szakmaiTapasztalat,
      {
        idotartam: "",
        terulet: "",
        allaskeresotapasztalat: {
          cegnev: "",
          pozicio: "",
          kezdes: "",
          vegzes: "",
        },
      },
    ]);
  };

  const nyelvHozzaadas = () => {
    setNyelvTudas([
      ...nyelvTudas,
      {
        nyelv: "",
        szint: "",
        nyelvtudas: "",
        nyelvvizsga: "",
        olvasas: "",
        iras: "",
        beszed: "",
      },
    ]);
  };

  const oktHozzaadas = () => {
    setTanulmany([
      ...tanulmany,
      {
        idotartam: "",
        intezmeny: "",
        erintett_targytev: "",
        szak: "",
        szoc_keszseg: "",
      },
    ]);
  };

  

  return (
    <>
    <div className="menu">
    <div className="menu-list">Álláslehetőségek</div>
    <div className="menu-list">Jelentkezések</div>
  </div>
    <div className="allprofil">


      <SzemelyesAdatok id="szem_adatok" config={token} />

      {szakmaiTapasztalat.map((item, index) => {
        return (
          <SzakmaiTapasztalat
            config={token}
            data={item}
            teruletek={teruletek}
            poziciok={poziciok}
            id={`szakmaitap__${index}`}
          />
        );
      })}

      {nyelvTudas.map((item, index) => {
        return (
          <Nyelvismeret config={token} data={item} nyelvek={nyelvek} id={`nyelv__${index}`} />
        );
      })}

      {tanulmany.map((item, index) => {
        return (
          <OktatasKepzes
            config={token}
            data={item}
            vegzettsegek={vegzettsegek}
            id={`oktkepzes__${index}`}
          />
        );
      })}

      <div className="divbuttons">
        <button className="mentes" onClick={onGenerealas}>
          Önéletrajz generálás
        </button>

        <button className="mentes" onClick={szakmaiTapHozzaadas}>
          Szakmai Tapasztalat hozzáadása
        </button>

        <button className="mentes" onClick={nyelvHozzaadas}>
          Nyelvtudás hozzáadaása
        </button>

        <button className="mentes" onClick={oktHozzaadas}>
          Tanulmányok hozzáadása
        </button>
      </div>
    </div>
    </>
  );
};

export default AllaskeresoProfil;
