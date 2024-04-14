import { useEffect, useState } from "react";
import { getAllaskeresoTapasztalat, putAllaskeresoTapasztalat} from "../api/profil";


const SzakmaiTapasztalat = ({ onSubmit }) => {
    const [idotartam, setIdotartam] = useState(0);
    const [cegnev, setCegnev] = useState("");
    const [terulet, setTerulet] = useState("");
    
    const [beosztas, setBeosztas] = useState("");

    useEffect(()=>{
      getAllaskeresoTapasztalat().then((response)=>{
            setIdotartam(response.idotartam) ;
            setCegnev(response.allaskeresotapasztalat.cegnev);
            setTerulet(response.terulet);
            setBeosztas(response.pozicio);
      })
    },[])

    useEffect(()=>{
        putAllaskeresoTapasztalat().then((response)=>{
            setIdotartam(response.idotartam) ;
            setCegnev(response.allaskeresotapasztalat.cegnev);
            setTerulet(response.terulet);
            setBeosztas(response.pozicio); 
        })
    })

    const handleSubmit = (e) => {
      e.preventDefault();
      
      onSubmit({ tapasztalat, terulet});
    };

  
    return (
        <form onSubmit={handleSubmit}>
         
          <div>
            <label htmlFor="idotartam">Időtartam:</label> {/* allaskereso_tapasztalats tábla  */}
            <input
              type="number"
              id="idotartam"
              value={idotartam}
              onChange={(e) => setIdotartam(e.target.value)}
            />
          </div>       
          <div>
          <label htmlFor="cegnev">Munkáltató neve:</label>
          <input
            type="text"
            id="cegnev"
            value={cegnev}
            onChange={(e) => setCegnev(e.target.value)}
          />
        </div>
          <div >
          <label htmlFor="terulet">Tevékenység típusaés ágazata:</label> {/* terulets tábla  */}
            <input
              type="text"
              name="terulet"
              value={terulet}
              onChange={(e)=> setTerulet(e.target.value)}
            />
          </div>
          <div>
            <label htmlFor="pozicio">Foglalkoztatás, beosztás:</label> {/* users tábla  */}
            <input
              type="text"
              id="pozicio"
              value={beosztas}
              onChange={(e) => setBeosztas(e.target.value)}
            />
          </div>
          
        </form>
      );
  };
  
  export default SzakmaiTapasztalat;