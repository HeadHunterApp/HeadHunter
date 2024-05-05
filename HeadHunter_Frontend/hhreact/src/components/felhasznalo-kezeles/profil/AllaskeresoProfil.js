import React, { useEffect, useState } from "react";
import {
  getAllaskeresoNyelvtudas,
  getAllaskeresoTanulmany,
  getAllaskeresoTapasztalat,
} from "../../../contexts/ProfilContext";
import axios from "../../../api/axios";
import "../../../styles/profil.css";
import SzakmaiTapasztalat from "./components/SzakmaiTapasztalat";
import Nyelvismeret from "./components/Nyelvismeret";
import OktatasKepzes from "./components/OktatasKepzes";
import SzemelyesAdatok from "./components/SzemelyesAdatok";
import { getTerulet } from "../../../contexts/FotablaContext";
import { getPozicio } from "../../../contexts/FotablaContext";
import { getVegzettseg } from "../../../contexts/FotablaContext";
import { getNyelvtudas } from "../../../contexts/FotablaContext";

const AllaskeresoProfil = ({ onSubmit }) => {
  const [token, setToken] = useState("");
  const [config, setConfig] = useState("");

  const [szakmaiTapasztalat, setSzakmaiTapasztalat] = useState([]);
  const [nyelvTudas, setNyelvTudas] = useState([]);
  const [tanulmany, setTanulmany] = useState([]);
  const [teruletek, setTeruletek] = useState([]);
  const [poziciok, setPoziciok] = useState([]);
  const [vegzettsegek, setVegzettsegek] = useState([]);
  const [nyelvek, setNyelvek] = useState([]);

  useEffect(() => {
   
    getTerulet().then((response) => {
      const teruletoptions = response.data.map((teret) => {
        return {
          value: teret.terulet_id,
          label: teret.megnevezes,
        };
      });
      setTeruletek(teruletoptions);
    });
  }, []);

  useEffect(() => {
   getVegzettseg().then((response) => {
      const vegzettsegoptions = response.data.map((veg) => {
        return {
          value: veg.vegzettseg_id,
          label: veg.megnevezes,
        };
      });
      setVegzettsegek(vegzettsegoptions);
    });
  }, []);

  useEffect(() => {
   getPozicio().then((response) => {
      const poziciooptions = response.data.map((poz) => {
        return {
          value: poz.pozkod,
          label: poz.pozicio,
        };
      });
      setPoziciok(poziciooptions);
    });
  }, []);

  useEffect(() => {
    getNyelvtudas().then((response) => {
      const nyelvoptions = response.data.map((nyelv) => {
        return {
          value: nyelv.nyelvkod,
          label: nyelv.nyelv + " - " + nyelv.szint,
        };
      });
      setNyelvek(nyelvoptions);
    });
  }, []);

  useEffect(() => {
    const fetchData = async () => {
      try {
        getAllaskeresoNyelvtudas().then((response) => {
          setNyelvTudas(
            response.data.map((item, index) => {
              return{
                id: `nyelv__${index}`,
                ...item,
              };
            })
          );
        });
      } catch (error) {
        console.log(error);
      }

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

      setToken(token);
      setConfig(config);
    };

    fetchData();
  }, []);

  useEffect(() => {
    try {
      getAllaskeresoTanulmany().then((response) => {
        setTanulmany(
          response.data.map((item, index) => {
            return{
              id: `oktkepzes__${index}`,
              ...item,
            };
          })
        );
      });
    } catch (error) {
      console.log(error);
    }
  }, []);

  useEffect(() => {
    try {
      getAllaskeresoTapasztalat().then((response) => {
        setSzakmaiTapasztalat(
          response.data.map((item, index) => {
            return {
              id: `szakmaitap__${index}`,
              ...item,
            };
          })
        );
      });
    } catch (error) {
      console.log(error);
    }
  }, []);

  /* function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
  } */

  /* useEffect(() => {
    sleep(5000);
    console.log("Profilból írom:")
    console.log(nyelvTudas);
  }, []); */

  const onGenerealas = () => {};

  const szakmaiTapHozzaadas = () => {
    setSzakmaiTapasztalat([
      ...szakmaiTapasztalat,
      {
        id: `szakmaitap__${szakmaiTapasztalat.length}`,
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
        id: `nyelv__${nyelvTudas.length}`,
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
        id: `oktkepzes__${tanulmany.length}`,
        idotartam: "",
        intezmeny: "",
        erintett_targytev: "",
        szak: "",
        vegzettseg: "",
        vegzes: "",
        kezdes: "",
      },
    ]);
  };

  return (
    <>
      <div className="allprofil">
        <SzemelyesAdatok id="szem_adatok" config={config} token={token} />

        {szakmaiTapasztalat.map((item, index) => {
          return (
            <SzakmaiTapasztalat
              config={config}
              data={item}
              teruletek={teruletek}
              poziciok={poziciok}
              id={`szakmaitap__${index}`}
              setSzakmaiTapasztalat={setSzakmaiTapasztalat}
              szakmaiTapasztalat={szakmaiTapasztalat}
            />
          );
        })}

        {nyelvTudas.map((item, index) => {
          return (
            <Nyelvismeret
              config={config}
              data={item}
              nyelvek={nyelvek}
              id={`nyelv__${index}`}
              setNyelvTudas = {setNyelvTudas}
              nyelvTudas = {nyelvTudas}
            />
          );
        })}

        {tanulmany.map((item, index) => {
          return (
            <OktatasKepzes
              config={config}
              data={item}
              vegzettsegek={vegzettsegek}
              id={`oktkepzes__${index}`}
              setTanulmany={setTanulmany}
              tanulmany={tanulmany}
            />
          );
        })}

        <div className="divbuttons">
        <button className="mentes" onClick={szakmaiTapHozzaadas}>
            Szakmai Tapasztalat hozzáadása
          </button>
          <button className="mentes" onClick={nyelvHozzaadas}>
            Nyelvtudás hozzáadaása
          </button>
          <button className="mentes" onClick={oktHozzaadas}>
            Tanulmányok hozzáadása
          </button>

          <button className="mentes" onClick={onGenerealas}>
            Önéletrajz generálás
          </button>
        </div>
      </div>
    </>
  );
};

export default AllaskeresoProfil;
