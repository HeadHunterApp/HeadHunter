import { useEffect, useState } from "react";
import { getProfilAllaskereso, putProfilAllakereso } from "../api/profil";


const SzemelyesAdatok = ({ onSubmit }) => {
    const [name, setName] = useState("");
    const [email, setEmail] = useState("");
    const [telefonszam, setTelefonszam] = useState("");
    
    const [fax, setFax] = useState("");
    const [allampolgarsag, setAllampolgarsag] = useState("");
    const [szul_ido, setSzul_ido] = useState(new Date);
    const [jogositvany, setJogositvany] = useState(false);
    const [keszseg, setKeszseg] = useState("");
    const [neme, setNeme] = useState();

    useEffect(()=>{
      getProfilAllaskereso().then((response)=>{
        setFax(response.fax) ;
        setAllampolgarsag(response.allampolgarsag);
        setSzul_ido(response.szul_ido);
        setJogositvany(response.jogositvany);
        setKeszseg(response.keszseg);
        setNeme(response.neme);
      })
    },[])

    useEffect(()=>{
        putProfilAllakereso().then((response)=>{
            setFax(response.fax) ;
            setAllampolgarsag(response.allampolgarsag);
            setSzul_ido(response.szul_ido);
            setJogositvany(response.jogositvany);
            setKeszseg(response.keszseg);
            setNeme(response.neme);
        })
    })

    const handleSubmit = (e) => {
      e.preventDefault();
      
      onSubmit({ name, email, fax, allampolgarsag, szul_ido, jogositvany, keszseg, neme});
    };

  
    return (
        <form onSubmit={handleSubmit}>
         
          <div>
            <label htmlFor="name">Vezetéknév/utónév:</label> {/* users tábla  */}
            <input
              type="text"
              id="name"
              value={name}
              onChange={(e) => setName(e.target.value)}
            />
          </div>       
          <div>
          <label htmlFor="telefonszam">Telefonszám:</label>
          <input
            type="text"
            id="telefonszam"
            value={telefonszam}
            onChange={(e) => setTelefonszam(e.target.value)}
          />
        </div>
          <div >
          <label>Fax:</label> {/* allaskeresos tábla  */}
            <input
              type="text"
              name="fax"
              value={fax}
              onChange={(e)=> setFax(e.target.value)}
            />
          </div>
          <div>
            <label htmlFor="email">E-mail:</label> {/* users tábla  */}
            <input
              type="email"
              id="email"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
            />
          </div>
          <div >
          <label>Állampolgárság:</label>  {/* allaskeresos tábla  */}
            <input
              type="text"
              name="allampolgarsag"
              value={allampolgarsag}
              onChange={(e) => setAllampolgarsag(e.target.value)}
            />
          </div>
          <div >
          <label>Születési idő:</label> {/* allaskeresos tábla  */}
            <input
              type="date"
              name="szul_ido"
              value={szul_ido}
              onChange={(e)=>setSzul_ido(e.target.value)}
            />
          </div>
          <div>
          <div className="nem">
              <label className="nem-label1"> Férfi</label> {/* allaskeresos tábla  */}
              <input 
                type="radio"
                value="ferfi"
                checked={neme === "ferfi"}
                name="nem"
                onChange={()=> setNeme(e.response.value)}
              />
            </div>
            <div className="nem">
              <label className="nem-label">Nő</label> {/* allaskeresos tábla  */}
              <input
                type="radio"
                value="nő"
                checked={neme === "nő"}
                name="nem"
                onChange={(e)=> setNeme(e.response.value)}
              />
            </div>
          </div>
          <div >
          <label>Vezetői engedély(ek):</label> {/* allaskeresos tábla  */}
            <input
              type="text"
              name="jogositvany"
              value={jogositvany}
              onChange={(e)=> setJogositvany(e.target.value)}
            />
          </div>
          <div >
          <label>Betölteni kívánt munkakör/foglalkozási terület:</label> {/* allaskeresos tábla  */}
            <input
              type="text"
              name="szoc_keszseg"
              value={keszseg}
              onChange={(e)=> setKeszseg(e.target.value)}
            />
          </div>
        </form>
      );
  };
  
  export default SzemelyesAdatok;