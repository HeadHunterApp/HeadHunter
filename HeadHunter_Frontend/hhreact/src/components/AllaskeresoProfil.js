import React from "react";
import { postFotoFeltolt} from '../api/profil';
import SzemelyesAdatok from "./SzemelyesAdatok";
import SzakmaiTapasztalat from "./SzakmaiTapasztalat";
import Nyelvismeret from "./NyelvIsmeret";
import OktatasKepzes from "./OktatasKepzes";

const AllaskeresoProfil = ({ onSubmit }) => {
     
  
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
          <label htmlFor="fenykep">Fénykép:</label> 
          <input
            type="file"
            id="fenykep"
            onChange={fenykepFeltoltes}
          />
        </div>
        <div className="temakor">SZEMÉLYES ADATOK:</div> 
        <div>
         <SzemelyesAdatok/>
        </div>
       
        <div className="temakor">SZAKMAI TAPASZTALAT</div>
        <div >
          <SzakmaiTapasztalat/>
        </div>

        <div className="temakor">OKTATÁS ÉS KÉPZÉS</div> 
        <div >
          <OktatasKepzes/>
        </div>
        <div className="temakor">NYELV ISMERET: </div>
        <div >
            <Nyelvismeret/>
        </div>
        
        <button type="submit">Mentés</button>
        <button type="submit">Szerkesztés</button>
        <button type="submit">Önéletrajz generálás</button>
      </form>
    );
  };
  
  export default AllaskeresoProfil;