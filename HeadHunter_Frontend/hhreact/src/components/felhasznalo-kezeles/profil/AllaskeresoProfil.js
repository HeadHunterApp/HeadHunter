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

  //Betölti az álláskereső területét
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

  // betölti az álláskerső végzettségét
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

  //betölti az álláskereső pozícióját
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

  //betölti az álláskereső nyelvismeretét
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

  //betölti az álláskereső összes nyelvtudását tölti be
  useEffect(() => {
    const fetchData = async () => {
      try {
        getAllaskeresoNyelvtudas().then((response) => {
          setNyelvTudas(
            response.data.map((item, index) => {
              return {
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

  //betölti az álláskereső összes tanulmányát tölti be
  useEffect(() => {
    try {
      getAllaskeresoTanulmany().then((response) => {
        setTanulmany(
          response.data.map((item, index) => {
            return {
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

  //betölti az álláskereső összes szakmai tapasztalatát tölti be
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


  // továbbfejlsztés része
  const onGenerealas = () => {};

  // álláskereső új szakmai tapasztalat adatainak feltöltése
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

  // álláskereső új nyelvisemret adatainak feltöltése
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

  // álláskereső új Tanulmány adatainak feltöltése
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
              setNyelvTudas={setNyelvTudas}
              nyelvTudas={nyelvTudas}
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
            Nyelvismere hozzáadaása
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
