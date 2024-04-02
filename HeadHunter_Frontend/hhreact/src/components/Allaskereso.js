import React, { useEffect, useState } from "react";
import AllasKartya from "./AllasKartya";

/*  ----  EZ TÖRÖLHETŐ?  !!!MARCI!!!  -----  */


const Allaskereso = () =>{
    const [allasok, setAllasok] = useState([{munkaltato: "elso allas"}]);
    const [toltes, setToltes] =useState(false)
    
    const fetchAllasok = async () =>{
        setToltes(true);
        const response = await axios.get("/jobs/all");
        if(!response.ok){
            console.log("Hiba");
        }
     

    const adat = await response.json();

    setAllasok(adat);
    setToltes(false);
};
/* ez a useEffect le fog futni az oldal betöltésénél, illetve akkor is ha a fetchAllasok metódus megváltozott esetleg (nem fog)
csak a useEffectnél, amilyen változókat használ, vagy metódusokat a useEffecten belül, azokat be kell rakni a dependency array-be
a useEffect meghívja a fetchAllasokat, aminek az elején meg a végén van a setToltes metódus meghívva
az eléjén true-ra állítjuk mer akkor kezdi az api hívást, és mivel true emiatt adja vissza ezt a divet -><div>toltes</div>
ha pedig false, akkor megvannak az állások, úgy h már csak az Álláskártyákat kell megjeleníteni*/

useEffect(()=>{ 
    fetchAllasok();
},[fetchAllasok]);

if (toltes) return <div>toltes</div>;
    return(
        <div>
            {<ul>
                {allasok.map((allas)=>{
                    return(
                        <li>
                            <AllasKartya allas ={allas.munkaltato}/>
                        </li>
                    );

                })}
            </ul>}
        </div>
    );
}
export default Allaskereso;