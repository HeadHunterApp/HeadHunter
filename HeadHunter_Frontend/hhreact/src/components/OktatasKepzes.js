import { useEffect, useState } from "react";
import { getAllaskeresoTanulmany, putAllaskeresoTanulmany } from "../api/profil";



const OktatasKepzes = ({onSubmit }) => {
    const [idotartam, setIdotartam] = useState(0);
    const [intezmeny, setIntezmeny] = useState("");
    const [fotargy, setFotargy] = useState("")
    const [szakkepesites, setSzakkepesites] = useState("");

    const [keszseg, setKeszseg] = useState("");

    useEffect(()=>{
      getAllaskeresoTanulmany().then((response)=>{
            setIdotartam(response.idotartam);
            setIntezmeny(response.intezmeny);
            setFotargy(response.erintett_targytev);
            setSzakkepesites(response.szak)
            setKeszseg(response.szoc_keszseg); //?????
      })
    },[])

    useEffect(()=>{
        putAllaskeresoTanulmany().then((response)=>{
            setIdotartam(response.idotartam);
            setIntezmeny(response.intezmeny);
            setFotargy(response.erintett_targytev);
            setSzakkepesites(response.szak)
            setKeszseg(response.szoc_keszseg); //?????
        })
    })

    const handleSubmit = (e) => {
      e.preventDefault();
      
      onSubmit({ tapasztalat, keszseg});
    };

  
    return (
        <form onSubmit={handleSubmit}>
         
          <div>
            <label htmlFor="idotartam">Időtartam:</label> 
            <input
              type="number"
              id="idotartam"
              value={idotartam}
              onChange={(e) => setIdotartam(e.target.value)}
            />
          </div>       
          <div>
          <label htmlFor="intezmeny">Oktatási képzést nyújtó szervezet neve és típusa:</label>
          <input
            type="text"
            id="intezmeny"
            value={intezmeny}
            onChange={(e) => setIntezmeny(e.target.value)}
          />
        </div>
        
          <div >
          <label htmlFor="fotargy">Érintett fő tárgyak/készségek:</label> 
          <input
              type="text"
              name="fotargy"
              value={fotargy}
              onChange={(e)=> setFotargy(e.target.value)}
            />
          </div>
          <div >
          <label htmlFor="szakkepesites">Elnyert képesítés megnevezése:</label> 
            <input
              type="text"
              name="szakkepesites"
              value={szakkepesites}
              onChange={(e)=> setSzakképesites(e.target.value)}
            />
          </div>
          <div>
            <label htmlFor="szoc_keszseg">Szociális készségek és képességek:</label>
            <input
              type="text"
              id="szoc_keszseg"
              value={keszseg}
              onChange={(e) => setKeszseg(e.target.value)}
            />
          </div>
          
        </form>
      );
  };
  
  export default OktatasKepzes;