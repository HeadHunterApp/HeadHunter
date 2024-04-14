import { useEffect, useState } from "react";
import { getAllaskeresoNyelvtudas, putAllaskeresoNyelvtudas } from "../api/profil";


const Nyelvismeret = ({ onSubmit }) => {
    const [anyanyelv, setAnyanyelv] = useState("");
    const [nyelvtudas, setNyelvtudas] = useState("");
    const [nyelvvizsga, setNyelvvizsga] = useState(false);
    const [olvasas, setOlvasas] = useState();
    const [iras, setIras] = useState("");
    const [beszed, setBeszed] = useState("");

    useEffect(()=>{
      getAllaskeresoNyelvtudas().then((response)=>{
            setAnyanyelv(response.anyanyelv);
            setNyelvvizsga(response.nyelvvizsga);
            setOlvasas(response.olvasas);
            setIras(response.iras);
            setBeszed(response.beszed);
            setNyelvtudas(response.allaskeresonyelkod.nyelvtudas);
      })
    },[])

    useEffect(()=>{
        putAllaskeresoNyelvtudas().then((response)=>{
            setAnyanyelv(response.anyanyelv);
            setNyelvvizsga(response.nyelvvizsga);
            setOlvasas(response.olvasas);
            setIras(response.iras);
            setBeszed(response.beszed);
            setNyelvtudas(response.allaskeresonyelkod.nyelvtudas);
        })
    })

    const handleSubmit = (e) => {
      e.preventDefault();
      
      onSubmit({ anyanyelv, nyelvtudas, nyelvvizsga, olvasas, iras, beszed});
    };

  
    return (
        <form onSubmit={handleSubmit}>
         
          <div>
            <label htmlFor="anyanyelv">Anyanyelv:</label> 
            <input
              type="text"
              id="anyanyelv"
              value={anyanyelv}
              onChange={(e) => setAnyanyelv(e.target.value)}
            />
          </div>       
          <div>
          <label htmlFor="nyelvtudas">Egyéb nyelvismeret:</label>
          <input
            type="text"
            id="nyelvtudas"
            value={nyelvtudas}
            onChange={(e) => setNyelvtudas(e.target.value)}
          />
        </div>
        
          <div >
          <label htmlFor="nyelvvizsga">Nylevvizsga:</label> 
            <input
              type="checkbox"
              name="nyelvvizsga"
              value={nyelvvizsga}
              onChange={(e)=> setNyelvvizsga(e.target.value)}
            />
          </div>
          <div >
          <label htmlFor="olvasas">Olvasási készség:</label> 
            <input
              type="text"
              name="olvasas"
              value={olvasas}
              onChange={(e)=> setOlvasas(e.target.value)}
            />
          </div>
          <div>
            <label htmlFor="iras">Írási készség:</label> 
            <input
              type="text"
              id="iras"
              value={iras}
              onChange={(e) => setIras(e.target.value)}
            />
          </div>
          <div>
            <label htmlFor="beszed">Beszédkészség:</label>
            <input
              type="text"
              id="beszed"
              value={beszed}
              onChange={(e) => setBeszed(e.target.value)}
            />
          </div>
        </form>
      );
  };
  
  export default Nyelvismeret;