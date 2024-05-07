import React, { useState } from "react";
import Select from 'react-select';
import useAuthContext from "../../contexts/AuthContext";

const JelentkezoSor = ( props ) => {
  const { user, isAdmin, isHeadhunter } = useAuthContext();
  const [aktualStat, setAktualStat] = useState(props.statusz);

  const statuszok = [
    { value: 1, label: 'jelentkezett' },
    { value: 2, label: 'folyamatban' },
    { value: 3, label: 'elutasítva' },
    { value: 4, label: 'felvéve' },
  ];

  const handleStatMod = async(kivalasztott) => {
    //felveszi a státusz az új értéket:
    const selectedStatKod = kivalasztott.value;
    console.log(selectedStatKod);
    const ujStat = kivalasztott.label;
    console.log(ujStat);
    //megvizsgálom, hogy olyat választott-e ki a felhasználó, amit lehet:
    if(aktualStat==="jelentkezett" && selectedStatKod < 2){
        alert("Ez a módosítás nem engedélyezett!");
    } else if (aktualStat==="folyamatban" && selectedStatKod < 3){
        alert("Ez a módosítás nem engedélyezett!");
    } else if (aktualStat==="elutasítva" || aktualStat==="felvéve" ){
        alert("Ez a pályázat már lezárult!");
    } else {
        setAktualStat(ujStat);
        props.statValtas(props.allas, props.allaskereso, ujStat);
    }
  };


  return (
    <div className="application">
      <div className="app-job">
        <div className="jobid">
            <h2>{props.allas}</h2>
        </div>
        <div className="jobdetail">
            <p>{props.cegnev}</p>
            <p>{props.megnevezes}</p>
        </div>
        <div className="posdetail">
            <p>Terület: {props.terulet}</p>
            <p>Pozíció: {props.pozicio}</p>
        </div>
      </div>
      <div className="app-applicant">
        <div className="seekerid">
                <h2>{props.allaskereso}</h2>
            </div>
            <div className="seekerdetail">
                <p>{props.nev}</p>
                <Select options={statuszok}
                    onChange={handleStatMod}
                    value={{value: aktualStat, label: aktualStat}}
                    placeholder={aktualStat}
                 />
            </div>
            <div className="datedetail">
                <p>Jelentkezés: {props.jelentkezes}</p>
                <p>Frissítve: {props.frissites}</p>
            </div>
      </div>
    </div>
  );
};

export default JelentkezoSor;